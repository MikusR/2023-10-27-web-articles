<?php

namespace App;

use App\Models\Article;

class articleCollection
{
    private array $articles;

    public function __construct()
    {
        $this->articles = [
            1 => new Article(1, '2003-01-02', 'Title 1', 'Content 1'),
            2 => new Article(2, '2004-01-09', 'Title 2', 'Content 2'),
            3 => new Article(3, '2005-01-10', 'Title 3', 'Content 3'),
            4 => new Article(4, '2004-01-11', 'Title 4', 'Content 4'),
            5 => new Article(5, '2005-01-12', 'Title 5', 'Content 5'),
            6 => new Article(6, '2008-01-14', 'Title 6', 'Content 6'),
            7 => new Article(7, '2004-01-17', 'Title 7', 'Content 7')
        ];
    }


    public function list(): array
    {
        return $this->articles;
    }


    public function get($id): Article
    {
        return $this->articles[$id];
    }
}