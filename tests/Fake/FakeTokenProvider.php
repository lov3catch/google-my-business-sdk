<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Tests\Fake;


use GoogleMyBusiness\TokenInterface;
use GoogleMyBusiness\TokenProviderInterface;

class FakeTokenProvider implements TokenProviderInterface
{

    public function token(array $credentials = []): TokenInterface
    {
        return new FakeToken();
    }
}