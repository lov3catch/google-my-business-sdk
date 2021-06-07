<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Tests;

use App\Fake\FakeTokenProvider;
use App\Sdk\Api\QuestionApi;
use App\Sdk\Api\VO\Question;
use App\SdkFake\GoogleMyBusinessFakeHttpClient;
use PHPUnit\Framework\TestCase;

class QuestionApiTest extends TestCase
{
    public function testList(): void
    {
        $api = new QuestionApi(new GoogleMyBusinessFakeHttpClient(), new FakeTokenProvider());

        $questions = $api->list('accounts/108494581129006735086/locations/6394464039148850881');

        self::assertNotEmpty($questions);

        /**
         * @var $questions \App\Sdk\Api\VO\Question[]
         */
        foreach ($questions as $question) {
            self::assertInstanceOf(Question::class, $question, 'Wrong instance of');
        }
    }
}