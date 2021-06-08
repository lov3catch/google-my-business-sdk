<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO;


use GoogleMyBusiness\Api\VO\Names\LocationName;

class Location
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function name(): LocationName
    {
        return new LocationName($this->data['name']);
    }
}