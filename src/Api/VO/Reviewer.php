<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO;


class Reviewer
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function displayName(): string
    {
        return $this->data['displayName'];
    }

    public function profilePhotoUrl(): string
    {
        return $this->data['profilePhotoUrl'];
    }
}