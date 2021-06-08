<?php

declare(strict_types=1);

namespace GoogleMyBusiness\Tests;

use GoogleMyBusiness\Api\AnswerApi;
use GoogleMyBusiness\Api\LocationApi;
use GoogleMyBusiness\Api\QuestionApi;
use GoogleMyBusiness\Api\ReviewApi;
use GoogleMyBusiness\Client;
use GoogleMyBusiness\SdkFake\GoogleMyBusinessFakeHttpClient;
use GoogleMyBusiness\Tests\Fake\FakeTokenProvider;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testLocation(): void
    {
        $client = new Client(new GoogleMyBusinessFakeHttpClient(), new FakeTokenProvider());

        self::assertInstanceOf(LocationApi::class, $client->location());
    }

    public function testReview(): void
    {
        $client = new Client(new GoogleMyBusinessFakeHttpClient(), new FakeTokenProvider());

        self::assertInstanceOf(ReviewApi::class, $client->review());
    }

    public function testQuestion(): void
    {
        $client = new Client(new GoogleMyBusinessFakeHttpClient(), new FakeTokenProvider());

        self::assertInstanceOf(QuestionApi::class, $client->question());
    }

    public function testAnswer(): void
    {
        $client = new Client(new GoogleMyBusinessFakeHttpClient(), new FakeTokenProvider());

        self::assertInstanceOf(AnswerApi::class, $client->answer());
    }
}
