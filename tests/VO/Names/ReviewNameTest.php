<?php

declare(strict_types=1);

namespace GoogleMyBusiness\Tests\VO\Names;

use GoogleMyBusiness\Api\VO\Names\AccountName;
use GoogleMyBusiness\Api\VO\Names\LocationName;
use GoogleMyBusiness\Api\VO\Names\ReviewName;
use PHPUnit\Framework\TestCase;

class ReviewNameTest extends TestCase
{
    /**
     * @dataProvider validAccountNamesProvider
     */
    public function testValidAccountName(string $reviewName, string $locationName, string $accountName): void
    {
        $reviewNameObj = new ReviewName($reviewName);
        self::assertEquals($reviewName, $reviewNameObj->name);

        $locationNameObj = $reviewNameObj->locationName();
        self::assertInstanceOf(LocationName::class, $locationNameObj);
        self::assertEquals($locationName, $locationNameObj->name);

        $accountNameObj = $locationNameObj->accountName();
        self::assertInstanceOf(AccountName::class, $accountNameObj);
        self::assertEquals($accountName, $accountNameObj->name);
    }

    public function validAccountNamesProvider(): iterable
    {
        yield [
            'accounts/108494581129006735086/locations/6394464039148850881/reviews/AbFvOqmDfUP0EhJuYm-w3KXy3gSxYn-NS9CiDOo4tOjO4PRuq4PWUWbGkh6K-fePdKQaXi0cycFGGg',
            'accounts/108494581129006735086/locations/6394464039148850881',
            'accounts/108494581129006735086',
        ];
    }
}
