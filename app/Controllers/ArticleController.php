<?php

namespace App\Controllers;

use App\Models\Article;
use App\Response;

class ArticleController
{
    public function index(): Response
    {
        return new Response('articles.index', [
                'articles' => [
                    new Article('Title 1', 'Content 1'),
                    new Article('Title 2', 'Content 2')
                ]
            ]
        );
    }

    public function show(): array
    {
        return [new Article('Title 3', 'Content 3')];
    }
}