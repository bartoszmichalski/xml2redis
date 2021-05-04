<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\Handler;
use App\Service\Exporter;


class HandlerTest extends TestCase
{

    /**
     * @dataProvider filepathProvider
     */
    public function testExecute($path)
    {

        $exporter = new Exporter('redis', 6379);

        $exporter->flushdb();
        $handler = new Handler($exporter);
        $handler->execute($path);


        $keys = $handler->getAllKeys();
        $exp = [
            "cookie:test2-name:test2-host",
            "subdomains",
            "cookie:test1-name:test1-host",
        ];
        $this->assertEquals($exp, $keys);
    }

    public function filepathProvider(): array
    {
        return [
            ['./tests/test.xml'],
        ];
    }
}
