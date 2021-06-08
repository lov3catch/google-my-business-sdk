<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api;


use GoogleMyBusiness\Api\VO\Answer;
use GoogleMyBusiness\Api\VO\Names\QuestionName;
use GoogleMyBusiness\Api\VO\Question;
use GoogleMyBusiness\Exceptions\EntityNotFoundException;
use GoogleMyBusiness\TokenProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class QuestionApi
{
    private HttpClientInterface $httpClient;
    private TokenProviderInterface $tokenProvider;

    public function __construct(HttpClientInterface $httpClient, TokenProviderInterface $tokenProvider)
    {
        $this->httpClient = $httpClient;
        $this->tokenProvider = $tokenProvider;
    }

    public function list(string $location, int $pageSize = 10, ?string $nextPageToken = null): iterable
    {
        $endpoint = sprintf('https://mybusiness.googleapis.com/v4/%s/questions', $location);

        $headers = ['Authorization' => 'Bearer ' . $this->tokenProvider->token()->accessToken()];
        $query = is_string($nextPageToken)
            ? ['pageSize' => $pageSize, 'pageToken' => $nextPageToken]
            : ['pageSize' => $pageSize];

        $resp = $this->httpClient->request(
            'GET',
            $endpoint,
            ['headers' => $headers, 'query' => $query]
        )->toArray();

        foreach ($resp['questions'] ?? [] as $question) {
            yield new Question($question);
        }

        if (isset($resp['nextPageToken'])) {
            yield from $this->list($location, $pageSize, $resp['nextPageToken']);
        }
    }

    public function get(string $question): Question
    {
        $location = (new QuestionName($question))->locationName()->name;

        /**
         * @var Question $questionData
         */
        foreach ($this->list($location) as $questionData) {
            if ($questionData->name()->name === $question) {
                return $questionData;
            }
        }

        throw new EntityNotFoundException('Question not found');
    }

    public function sendAnswer(Question $question, Answer $answer): Answer
    {
        $endpoint = sprintf('https://mybusiness.googleapis.com/v4/%s/answers:upsert', $question->name()->name);

        $options = [
            'json'    => ['answer' => ['text' => $answer->text()]],
            'headers' => ['Authorization' => 'Bearer ' . $this->tokenProvider->token()->accessToken()]
        ];

        $resp = $this->httpClient->request(
            'POST',
            $endpoint,
            $options
        )->toArray();

        return new Answer($resp);
    }
}