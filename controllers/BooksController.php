<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class BooksController extends Controller
{
    private static array $books;

    public function init()
    {
        parent::init();

        self::$books = [
            new Book("1", "In Search of Lost Time", "Marcel Proust", 2),
            new Book("2", "The Great Gatsby", "F. Scott Fitzgerald", 5),
            new Book("3", "War and Peace", "Leo Tolstoy", 6),
        ];
    }

    public function actionIndex(): Response
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $this->asJson(self::$books);
    }
}

class Book
{

    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $author,
        public readonly int    $quantity,
    )
    {
    }


}
