<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api;


use App\Sdk\Api\VO\Answer;
use App\Sdk\Api\VO\Names\AnswerName;
use GoogleMyBusiness\Exceptions\EntityNotFoundException;
use Psr\Http\Client\ClientInterface;

class AnswerApi
{
    public function __construct(private ClientInterface $httpClient, private TokenProviderInterface $tokenProvider)
    {
    }

    public function list(string $question, int $pageSize = 10, ?string $nextPageToken = null): iterable
    {
        $endpoint = sprintf('https://mybusiness.googleapis.com/v4/%s/answers', $question);

        $headers = ['Authorization' => 'Bearer ' . $this->tokenProvider->token()->accessToken()];
        $query = is_string($nextPageToken)
            ? ['pageSize' => $pageSize, 'pageToken' => $nextPageToken]
            : ['pageSize' => $pageSize];

        $resp = $this->httpClient->request(
            'GET',
            $endpoint,
            ['headers' => $headers, 'query' => $query]
        )->toArray();

        foreach ($resp['answers'] ?? [] as $answer) {
            yield new Answer($answer);
        }

        if (isset($resp['nextPageToken'])) {
            yield from $this->list($question, $pageSize, $resp['nextPageToken']);
        }
    }

    public function get(string $answer): Answer
    {
        $question = (new AnswerName($answer))->questionName()->name;

        /**
         * @var Answer $answerData
         */
        foreach ($this->list($question) as $answerData) {
            if ($answerData->name()->name === $question) {
                return $answerData;
            }
        }

        throw new EntityNotFoundException('Answer not found');
    }
}