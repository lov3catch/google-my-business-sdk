<?php

declare(strict_types=1);

namespace GoogleMyBusiness\Tests;

use GoogleMyBusiness\Api\LocationApi;
use GoogleMyBusiness\Api\VO\Location;
use GoogleMyBusiness\Api\VO\Names\AccountName;
use GoogleMyBusiness\SdkFake\GoogleMyBusinessFakeHttpClient;
use GoogleMyBusiness\Tests\Fake\FakeTokenProvider;
use PHPUnit\Framework\TestCase;

class LocationApiTest extends TestCase
{
    public function testList(): void
    {
        $locationApi = new LocationApi(new GoogleMyBusinessFakeHttpClient(), new FakeTokenProvider());

        $locations = $locationApi->list(new AccountName('accounts/108494581129006735086'));

        self::assertNotEmpty($locations);

        foreach ($locations as $location) {
            self::assertInstanceOf(Location::class, $location, 'Wrong instance of');
        }
    }
}