<?php

namespace app\services;

use yii\queue\Queue;

class ServiceManager
{
    /**
     * @var PriorityServiceAbstract[]
     */
    private array $services;
    private Queue $queueService;
    private DataStorage $dataStorage;

    /**
     * @param array<PriorityServiceAbstract> $services
     */
    public function __construct(Queue $queueService, DataStorage $dataStorage, array $services)
    {
        $this->services = $services;
        $this->queueService = $queueService;
        $this->dataStorage = $dataStorage;
    }

    public function handle()
    {
        $prefix = microtime();

        foreach ($this->services as $service) {
            $this->queueService->push(
                new ServiceJob([
                    'prefix' => $prefix,
                    'service' => $service,
                    'dataStorage' => $this->dataStorage,
                ])
            );
        }

        while (!$result = $this->dataStorage->getData($prefix)) {
            sleep(1);
        }

        return $result;
    }
}