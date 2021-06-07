<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO;


use App\Sdk\Api\VO\Names\LocationName;

class Location
{
    public function __construct(private array $data)
    {
    }

    public function name(): LocationName
    {
        return new LocationName($this->data['name']);
    }
}