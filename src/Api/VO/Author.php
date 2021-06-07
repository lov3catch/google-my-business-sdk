<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO;

class Author
{
    public function __construct(private array $data)
    {
    }

    public function displayName(): string
    {
        return $this->data['displayName'];
    }

    public function profilePhotoUrl(): string
    {
        return $this->data['profilePhotoUrl'];
    }

    public function type(): string
    {
        return $this->data['type'];
    }
}