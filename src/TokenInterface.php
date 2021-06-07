<?php

declare(strict_types=1);


namespace GoogleMyBusiness;


interface TokenInterface
{
    public function accessToken(): string;
    public function refreshToken(): string;
    public function accountId(): string;
}