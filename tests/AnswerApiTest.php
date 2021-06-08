<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Tests;

use GoogleMyBusiness\Api\AnswerApi;
use GoogleMyBusiness\Api\VO\Answer;
use GoogleMyBusiness\Api\VO\Question;
use GoogleMyBusiness\SdkFake\GoogleMyBusinessFakeHttpClient;
use GoogleMyBusiness\Tests\Fake\FakeTokenProvider;
use PHPUnit\Framework\TestCase;

class AnswerApiTest extends TestCase
{
    public function testList(): void
    {
        $api = new AnswerApi(new GoogleMyBusinessFakeHttpClient(), new FakeTokenProvider());

        $answers = $api->list(
            'accounts/108494581129006735086/locations/13195921940790549583/questions/AIe9_BF8X4EpR_fF6mwcYdso9awgNBXZYS-R4EHEW06LmxMr91KSWl_9vqMChjmP_lpnINp1kxXgkp5abmOdyb03He-ESr6SJkSiDuR9p25gq0NZ3dwvC7bgj0LUTqKnjuhhBXVth9ys'
        );

        self::assertNotEmpty($answers);

        /**
         * @var $answers Answer[]
         */
        foreach ($answers as $answer) {
            self::assertInstanceOf(Question::class, $answer, 'Wrong instance of');
        }
    }
}