<?php

namespace App\Controllers;

use App\articleCollection;
use App\Models\Article;
use App\Response;

class ArticleController
{
    private articleCollection $articles;

    public function __construct()
    {
        $this->articles = new articleCollection();
    }

    public function index(): Response
    {
        return new Response('articles.index', [
                'articles' => $this->articles->list()
            ]
        );
    }

    public function show(int $id): Response
    {
        $article = $this->articles->get($id);
        return new Response(
            'single.article',
            ['article' => $article]
        );
    }
}