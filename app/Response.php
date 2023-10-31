<?php

namespace App;

class Response
{
    private array $data;
    private string $viewName;

    public function __construct(string $viewName, array $data)
    {
        $this->data = $data;
        $this->viewName = $viewName;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getViewName(): string
    {
        return $this->viewName;
    }
}