<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO;


class ReviewReply
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function comment(): string
    {
        return $this->data['comment'];
    }

    public function updateTime(): \DateTimeImmutable
    {
        return (new \DateTimeImmutable())->setTimestamp(strtotime($this->data['updateTime']));
    }
}