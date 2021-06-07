<?php

declare(strict_types=1);


namespace GoogleMyBusiness;


use App\Sdk\Api\AnswerApi;
use App\Sdk\Api\LocationApi;
use App\Sdk\Api\QuestionApi;
use App\Sdk\Api\ReviewApi;
use Psr\Http\Client\ClientInterface;

class Client
{
    public function __construct(private ClientInterface $httpClient, private TokenProviderInterface $tokenProvider)
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