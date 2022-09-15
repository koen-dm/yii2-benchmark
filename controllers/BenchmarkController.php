<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\Response;

class BenchmarkController extends Controller
{
    public function actionIndex(): Response
    {
        return $this->asJson(["message" => "Hello World"]);
    }
}