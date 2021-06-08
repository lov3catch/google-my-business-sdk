<?php

declare(strict_types=1);

namespace GoogleMyBusiness\Tests\VO\Names;

use GoogleMyBusiness\Api\VO\Names\AccountName;
use GoogleMyBusiness\Api\VO\Names\LocationName;
use PHPUnit\Framework\TestCase;

class LocationNameTest extends TestCase
{
    /**
     * @dataProvider validLocationNamesProvider
     */
    public function testValidAccountName(string $locationName, string $accountName): void
    {
        $locationNameObj = new LocationName($locationName);
        self::assertInstanceOf(LocationName::class, $locationNameObj);
        self::assertEquals($locationName, $locationNameObj->name);

        $accountNameObj = $locationNameObj->accountName();
        self::assertInstanceOf(AccountName::class, $accountNameObj);
        self::assertEquals($accountName, $accountNameObj->name);
    }

    public function validLocationNamesProvider(): iterable
    {
        yield [
            'accounts/108494581129006735086/locations/13195921940790549583',
            'accounts/108494581129006735086',
        ];
    }
}
