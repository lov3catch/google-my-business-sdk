<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO\Names;


class ReviewName
{
    public function __construct(public string $name)
    {
    }

    public function locationName(): LocationName
    {
        [$locationName, $_] = explode('/reviews', $this->name);

        return new LocationName($locationName);
    }
}