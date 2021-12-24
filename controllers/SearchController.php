<?php

namespace app\controllers;

use app\services\HighestPriorityService;
use app\services\LowPriorityService;
use app\services\MiddlePriorityService;
use yii\rest\Controller;

class SearchController extends Controller
{

    public function actionIndex(){

        /**
         * @todo выполнить задачи параллельно
         */
        $searchServices = [
            new HighestPriorityService(),
            new MiddlePriorityService(),
            new LowPriorityService()
        ];

        foreach ($searchServices as $service) {
            return $service->handle();
        }
    }

}