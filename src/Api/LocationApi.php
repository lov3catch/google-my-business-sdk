<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api;


use GoogleMyBusiness\Api\VO\Location;
use GoogleMyBusiness\Api\VO\Names\AccountName;
use GoogleMyBusiness\TokenProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LocationApi
{
    public function __construct(private HttpClientInterface $httpClient, private TokenProviderInterface $tokenProvider)
    {
    }

    public function list(AccountName $accountName, int $pageSize = 10, ?string $nextPageToken = null): iterable
    {
        $endpoint = sprintf('https://mybusiness.googleapis.com/v4/%s/locations', $accountName->name);

        $headers = ['Authorization' => 'Bearer ' . $this->tokenProvider->token()->accessToken()];
        $query = is_string($nextPageToken)
            ? ['pageSize' => $pageSize, 'pageToken' => $nextPageToken]
            : ['pageSize' => $pageSize];

        $resp = $this->httpClient->request(
            'GET',
            $endpoint,
            ['headers' => $headers, 'query' => $query]
        )->toArray();

        foreach ($resp['locations'] ?? [] as $location) {
            yield new Location($location);
        }

        if (isset($resp['nextPageToken'])) {
            yield from $this->list($accountName, $pageSize, $resp['nextPageToken']);
        }
    }
}