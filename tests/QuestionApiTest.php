<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Tests;

use GoogleMyBusiness\Api\QuestionApi;
use GoogleMyBusiness\Api\VO\Question;
use GoogleMyBusiness\Tests\Fake\FakeTokenProvider;
use GoogleMyBusinessMock\GoogleMyBusinessFakeHttpClient;
use PHPUnit\Framework\TestCase;

class QuestionApiTest extends TestCase
{
    public function testList(): void
    {
        $api = new QuestionApi(new GoogleMyBusinessFakeHttpClient(), new FakeTokenProvider());

        $questions = $api->list('accounts/108494581129006735086/locations/6394464039148850881');

        self::assertNotEmpty($questions);

        /**
         * @var $questions Question[]
         */
        foreach ($questions as $question) {
            self::assertInstanceOf(Question::class, $question, 'Wrong instance of');
        }
    }
}