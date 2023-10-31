<?php

namespace App\Models;

class Article
{
    private int $id;
    private string $time;
    private string $title;
    private string $content;

    public function __construct(int $id, string $time, string $title, string $content)
    {
        $this->id = $id;
        $this->time = $time;
        $this->title = $title;
        $this->content = $content;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getTitle(): string
    {
        return $this->title;
    }


    public function getContent(): string
    {
        return $this->content;
    }
}