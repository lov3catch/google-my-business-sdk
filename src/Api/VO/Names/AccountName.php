<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO\Names;


class AccountName
{
    public function __construct(public string $name)
    {
    }

    public function id(): string
    {
        [, $accountId] = explode('/', $this->name);

        return $accountId;
    }
}