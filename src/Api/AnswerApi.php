<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api;


use GoogleMyBusiness\Api\VO\Answer;
use GoogleMyBusiness\Api\VO\Names\AnswerName;
use GoogleMyBusiness\Exceptions\EntityNotFoundException;
use GoogleMyBusiness\TokenProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AnswerApi
{
    private HttpClientInterface $httpClient;
    private TokenProviderInterface $tokenProvider;

    public function __construct(HttpClientInterface $httpClient, TokenProviderInterface $tokenProvider)
    {
        $this->httpClient = $httpClient;
        $this->tokenProvider = $tokenProvider;
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