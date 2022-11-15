<?php

namespace app\services;

class FileDataStorage implements DataStorage
{
    public function write(string $prefix, string $data): void
    {
        file_put_contents(self::getFullPath("{$prefix}handle_result.txt"), $data);
    }

    public function getData(string $prefix): ?string
    {
        $filename = self::getFullPath("{$prefix}handle_result.txt");

        if (!file_exists($filename)) {
            return null;
        }

        $contents = file_get_contents($filename);

        unlink($filename);

        return $contents;
    }

    private static function getFullPath(string $filename)
    {
        return \Yii::getAlias("@app/$filename");
    }
}