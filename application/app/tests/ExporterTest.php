<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\Exporter;


class ExporterTest extends TestCase
{
    public function testExport()
    {

        $exporter = new Exporter('redis', 6379);
        $exporter->flushdb();
        $exporter->export('key', 'value');

        $redisValue = $exporter->getAllKeys('key');

        $exp = [
            'key',
        ];
        $this->assertEquals($exp, $redisValue);
    }

    public function testgetAllKeys()
    {

        $exporter = new Exporter('redis', 6379);
        $exporter->flushdb();
        $exporter->export('test1', 'value1');
        $exporter->export('test2', 'value2');

        $redisValue = $exporter->getAllKeys('test*');

        $exp = [
            'test2',
            'test1',
        ];
        $this->assertEquals($exp, $redisValue);
    }
}
