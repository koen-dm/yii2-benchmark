<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use function Amp\ParallelFunctions\parallelMap;

class BenchmarkController extends Controller
{

    public function actionIndex(): Response
    {
        $response = Yii::$app->response;
        $request = Yii::$app->request;

        if (!Yii::$app->request->getIsPost()) {
            $response->setStatusCode(405);
            return $response;
        }
        $parallel = $request->getQueryParam("parallel");
        $nestedArray = $request->post();

        if ($parallel == "true") {
            parallelMap($nestedArray, function ($array) {
                $this->sort($array);
            });
        } else {
            foreach ($nestedArray as $array) {
                $this->sort($array);
            }
        }


        return $response;
    }

    public function actionTest(): Response
    {
        return $this->asJson(["message" => "Hello World"]);
    }


    private function sort(array $arr): array
    {
        $size = count($arr) - 1;
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size - $i; $j++) {
                $k = $j + 1;
                if ($arr[$k] < $arr[$j]) {
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }
        return $arr;
    }

}
