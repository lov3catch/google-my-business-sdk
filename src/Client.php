<?php

declare(strict_types=1);


namespace GoogleMyBusiness;


use GoogleMyBusiness\Api\AnswerApi;
use GoogleMyBusiness\Api\LocationApi;
use GoogleMyBusiness\Api\QuestionApi;
use GoogleMyBusiness\Api\ReviewApi;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client
{
    public function __construct(private HttpClientInterface $httpClient, private TokenProviderInterface $tokenProvider)
    {
    }

    public function location(): LocationApi
    {
        return new LocationApi($this->httpClient, $this->tokenProvider);
    }

    public function answer(): AnswerApi
    {
        return new AnswerApi($this->httpClient, $this->tokenProvider);
    }

    public function question(): QuestionApi
    {
        return new QuestionApi($this->httpClient, $this->tokenProvider);
    }

    public function review(): ReviewApi
    {
        return new ReviewApi($this->httpClient, $this->tokenProvider);
    }
}