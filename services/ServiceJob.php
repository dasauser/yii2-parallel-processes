<?php

namespace app\services;

use yii\base\BaseObject;
use yii\queue\JobInterface;

class ServiceJob extends BaseObject implements JobInterface
{
    public $prefix;
    /** @var PriorityServiceAbstract */
    public $service;
    /** @var DataStorage */
    public $dataStorage;

    public function execute($queue)
    {
        $this->dataStorage->write($this->prefix, $this->service->handle());
    }
}
