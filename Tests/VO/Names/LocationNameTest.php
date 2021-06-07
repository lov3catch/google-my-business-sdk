<?php

declare(strict_types=1);

namespace App\Sdk\Tests\Api\VO\Names;

use App\Sdk\Api\VO\Names\LocationName;
use PHPUnit\Framework\TestCase;

class LocationNameTest extends TestCase
{
    /**
     * @dataProvider validLocationNamesProvider
     */
    public function testValidAccountName(string $locationName, string $validAccountId, string $validLocationId): void
    {
        $locationNameObj = new LocationName($locationName);

        self::assertEquals($validAccountId, $locationNameObj->accountName()->id());
        self::assertEquals($validLocationId, $locationNameObj->id());
    }

    public function validLocationNamesProvider(): iterable
    {
        yield [
            'accounts/108494581129006735086/locations/13195921940790549583',
            '108494581129006735086',
            '13195921940790549583'
        ];
    }
}
