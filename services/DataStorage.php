<?php

namespace app\services;

interface DataStorage
{
    public function write(string $prefix, string $data): void;

    public function getData(string $prefix): ?string;
}