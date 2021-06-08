<?php

declare(strict_types=1);

namespace GoogleMyBusiness\Tests\VO\Names;

use GoogleMyBusiness\Api\VO\Names\AccountName;
use GoogleMyBusiness\Api\VO\Names\AnswerName;
use GoogleMyBusiness\Api\VO\Names\LocationName;
use GoogleMyBusiness\Api\VO\Names\QuestionName;
use PHPUnit\Framework\TestCase;

class AnswerNameTest extends TestCase
{
    /**
     * @dataProvider validAccountNamesProvider
     */
    public function testValidAccountName(
        string $answerName,
        string $questionName,
        string $locationName,
        string $accountName
    ): void {
        $answerNameObj = new AnswerName($answerName);
        self::assertEquals($answerName, $answerNameObj->name);

        $questionNameObj = new QuestionName($questionName);
        self::assertInstanceOf(QuestionName::class, $questionNameObj);
        self::assertEquals($questionName, $questionNameObj->name);

        $locationNameObj = $questionNameObj->locationName();
        self::assertInstanceOf(LocationName::class, $locationNameObj);
        self::assertEquals($locationName, $locationNameObj->name);

        $accountNameObj = $locationNameObj->accountName();
        self::assertInstanceOf(AccountName::class, $accountNameObj);
        self::assertEquals($accountName, $accountNameObj->name);
    }

    public function validAccountNamesProvider(): iterable
    {
        yield [
            'accounts/108494581129006735086/locations/13195921940790549583/questions/AIe9_BF8X4EpR_fF6mwcYdso9awgjt2w6P4U9rvIkET_YxwLyhoUEOMRz2R7YbTLl7uC0jMibL1KrcHmYge5PNGU-4sR81fqZYGy5MbnuZ_fYABJ-zvSiyTQJe-I-IPZvm8b1NllZbWl/answers/AIe9_BFu3rdicGrPrzdyu4PDXmqMiruH4AmiOxAqVuDroQ0K3RXlxVAfWDWQY4sjLE9IO-JB6gM8KMk96xOq4fJNZLBIPCTsoE5kjQwUhIfCmLIr_QcaPBU4F26EKkOEKufD_L2WxqJokYfYZaSSRC0rYWh5NZFoVR4AX6aOu6Mvr3e8_neEBKntWHP_53aUuOKGbnZizK_D',
            'accounts/108494581129006735086/locations/13195921940790549583/questions/AIe9_BF8X4EpR_fF6mwcYdso9awgjt2w6P4U9rvIkET_YxwLyhoUEOMRz2R7YbTLl7uC0jMibL1KrcHmYge5PNGU-4sR81fqZYGy5MbnuZ_fYABJ-zvSiyTQJe-I-IPZvm8b1NllZbWl',
            'accounts/108494581129006735086/locations/13195921940790549583',
            'accounts/108494581129006735086',
        ];
    }
}
