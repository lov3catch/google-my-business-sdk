<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO;


use GoogleMyBusiness\Api\VO\Names\ReviewName;

class Review
{
    public function __construct(private array $data)
    {
    }

    public function name(): ReviewName
    {
        return new ReviewName($this->data['name']);
    }

    public function reviewId(): string
    {
        return $this->data['reviewId'];
    }

    public function reviewer(): Reviewer
    {
        return new Reviewer($this->data['reviewer']);
    }

    public function startRating(): string
    {
        return $this->data['starRating'];
    }

    public function comment(): string
    {
        return $this->data['comment'] ?? '';
    }

    public function createdTime(): \DateTimeImmutable
    {
        return (new \DateTimeImmutable())->setTimestamp(strtotime($this->data['createTime']));
    }

    public function updatedTime(): \DateTimeImmutable
    {
        return (new \DateTimeImmutable())->setTimestamp(strtotime($this->data['updateTime']));
    }

    public function reviewReply(): ?ReviewReply
    {
        return isset($this->data['reviewReply'])
            ? new ReviewReply($this->data['reviewReply'])
            : null;
    }

    public function hasReply(): bool
    {
        return $this->reviewReply() instanceof ReviewReply;
    }
}