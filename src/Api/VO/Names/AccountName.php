<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO\Names;


class AccountName
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function id(): string
    {
        [, $accountId] = explode('/', $this->name);

        return $accountId;
    }
}