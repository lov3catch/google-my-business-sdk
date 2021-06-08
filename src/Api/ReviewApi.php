<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api;


use GoogleMyBusiness\Api\VO\Review;
use GoogleMyBusiness\Api\VO\ReviewReply;
use GoogleMyBusiness\TokenProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ReviewApi
{
    private HttpClientInterface $httpClient;
    private TokenProviderInterface $tokenProvider;

    public function __construct(HttpClientInterface $httpClient, TokenProviderInterface $tokenProvider)
    {
        $this->httpClient = $httpClient;
        $this->tokenProvider = $tokenProvider;
    }

    public function list(string $location, int $pageSize = 50, ?string $nextPageToken = null): iterable
    {
        $endpoint = sprintf('https://mybusiness.googleapis.com/v4/%s/reviews', $location);

        $headers = ['Authorization' => 'Bearer ' . $this->tokenProvider->token()->accessToken()];
        $query = is_string($nextPageToken)
            ? ['pageSize' => $pageSize, 'pageToken' => $nextPageToken]
            : ['pageSize' => $pageSize];

        $resp = $this->httpClient->request(
            'GET',
            $endpoint,
            ['headers' => $headers, 'query' => $query]
        )->toArray();

        foreach ($resp['reviews'] ?? [] as $review) {
            yield new Review($review);
        }

        if (isset($resp['nextPageToken'])) {
            yield from $this->list($location, $pageSize, $resp['nextPageToken']);
        }
    }

    public function get(string $review): Review
    {
        $endpoint = sprintf('https://mybusiness.googleapis.com/v4/%s', $review);

        $resp = $this->httpClient->request(
            'GET',
            $endpoint,
            ['headers' => ['Authorization' => 'Bearer ' . $this->tokenProvider->token()->accessToken()]]
        );

        return new Review($resp->toArray());
    }

    public function sendReply(Review $review, ReviewReply $reply): ReviewReply
    {
        $endpoint = sprintf('https://mybusiness.googleapis.com/v4/%s/reply', $review->name()->name);

        $options = [
            'json'    => ['comment' => $reply->comment()],
            'headers' => ['Authorization' => 'Bearer ' . $this->tokenProvider->token()->accessToken()]
        ];

        $resp = $this->httpClient->request('PUT', $endpoint, $options)->toArray();

        return new ReviewReply($resp);
    }

    public function deleteReply(Review $review): void
    {
        $endpoint = sprintf('https://mybusiness.googleapis.com/v4/%s/reply', $review->name()->name);

        $options = ['headers' => ['Authorization' => 'Bearer ' . $this->tokenProvider->token()->accessToken()]];

        $this->httpClient->request('DELETE', $endpoint, $options);
    }
}
