<?php

declare(strict_types=1);


namespace GoogleMyBusiness\Api\VO\Names;


class AnswerName
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function questionName(): QuestionName
    {
        [$questionName, $_] = explode('/answers', $this->name);

        return new QuestionName($questionName);
    }
}