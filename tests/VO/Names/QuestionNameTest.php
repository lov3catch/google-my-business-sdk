<?php

declare(strict_types=1);

namespace GoogleMyBusiness\Tests\VO\Names;

use GoogleMyBusiness\Api\VO\Names\AccountName;
use GoogleMyBusiness\Api\VO\Names\LocationName;
use GoogleMyBusiness\Api\VO\Names\QuestionName;
use PHPUnit\Framework\TestCase;

class QuestionNameTest extends TestCase
{
    /**
     * @dataProvider validAccountNamesProvider
     */
    public function testValidAccountName(string $questionName, string $locationName, string $accountName): void
    {
        $questionNameObj = new QuestionName($questionName);
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
            'accounts/108494581129006735086/locations/13195921940790549583/questions/AIe9_BF8X4EpR_fF6mwcYdso9awgjt2w6P4U9rvIkET_YxwLyhoUEOMRz2R7YbTLl7uC0jMibL1KrcHmYge5PNGU-4sR81fqZYGy5MbnuZ_fYABJ-zvSiyTQJe-I-IPZvm8b1NllZbWl',
            'accounts/108494581129006735086/locations/13195921940790549583',
            'accounts/108494581129006735086'
        ];
    }
}
