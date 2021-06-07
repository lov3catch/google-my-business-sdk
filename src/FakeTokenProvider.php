<?php

declare(strict_types=1);


namespace GoogleMyBusiness;


class FakeTokenProvider implements \GoogleMyBusiness\TokenProviderInterface
{

    public function token(array $credentials = []): TokenInterface
    {
        return new Token();
    }
}