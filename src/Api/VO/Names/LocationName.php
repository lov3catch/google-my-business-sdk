<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO\Names;


class LocationName
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function id(): string
    {
        [, $accountId, , $locationId] = explode('/', $this->name);

        return $locationId;
    }

    public function accountName(): AccountName
    {
        [$accountName, $_] = explode('/locations', $this->name);

        return new AccountName($accountName);
    }
}