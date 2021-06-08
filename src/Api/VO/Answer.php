<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO;

use DateTimeImmutable;
use GoogleMyBusiness\Api\VO\Names\AnswerName;

class Answer
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function name(): AnswerName
    {
        return new AnswerName($this->data['name']);
    }

    public function author(): Author
    {
        return new Author($this->data['author']);
    }

    public function text(): string
    {
        return $this->data['text'];
    }

    public function createdTime(): DateTimeImmutable
    {
        return (new DateTimeImmutable())->setTimestamp(strtotime($this->data['createTime']));
    }

    public function updatedTime(): DateTimeImmutable
    {
        return (new DateTimeImmutable())->setTimestamp(strtotime($this->data['updateTime']));
    }
}