<?php

declare(strict_types=1);

namespace GoogleMyBusiness\Tests\VO\Names;

use GoogleMyBusiness\Api\VO\Names\AccountName;
use PHPUnit\Framework\TestCase;

class AccountNameTest extends TestCase
{
    /**
     * @dataProvider validAccountNamesProvider
     */
    public function testValidAccountName(string $accountName, string $accountId): void
    {
        $accountNameObj = new AccountName($accountName);

        self::assertEquals($accountName, $accountNameObj->name);
        self::assertEquals($accountId, $accountNameObj->id());
    }

    public function validAccountNamesProvider(): iterable
    {
        yield [
            'accounts/108494581129006735086',
            '108494581129006735086'
        ];
    }
}
