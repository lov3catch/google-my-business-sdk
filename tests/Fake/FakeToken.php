<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Tests\Fake;


use GoogleMyBusiness\TokenInterface;

class FakeToken implements TokenInterface
{

    public function accessToken(): string
    {
        return 'fake-token';
    }

    public function refreshToken(): string
    {
        // TODO: Implement refreshToken() method.
    }

    public function accountId(): string
    {
        // TODO: Implement accountId() method.
    }
}