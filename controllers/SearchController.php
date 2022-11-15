<?php

namespace app\controllers;

use app\services\HighestPriorityService;
use app\services\LowPriorityService;
use app\services\MiddlePriorityService;
use app\services\ServiceManager;
use yii\rest\Controller;

class SearchController extends Controller
{
    public function actionIndex()
    {
        /**
         * @todo выполнить задачи параллельно
         */
        return \Yii::$container->get(ServiceManager::class, [
            'services' => [
                new HighestPriorityService(),
                new MiddlePriorityService(),
                new LowPriorityService(),
            ],
        ])->handle();
    }

}