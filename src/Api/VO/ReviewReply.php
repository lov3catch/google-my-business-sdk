<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO;


class ReviewReply
{
    public function __construct(private array $data)
    {
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