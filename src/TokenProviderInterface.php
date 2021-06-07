<?php

declare(strict_types=1);


namespace GoogleMyBusiness;


interface TokenProviderInterface
{
    public function token(array $credentials = []): TokenInterface;
}