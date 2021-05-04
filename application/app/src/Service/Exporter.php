<?php

namespace App\Service;

use \Predis\Client;

class Exporter
{

    private $client;

    public function __construct($redisHost, $redisPort)
    {
        $this->client = new Client([
            'scheme' => 'tcp',
            'host'   => $redisHost,
            'port'   => $redisPort,
        ]);
    }

    public function export(string $key, $data):void
    {
        $this->client->set($key, json_encode($data));
    }

    public function getAllKeys(string $pattern = '*'): array
    {
        return $this->client->keys($pattern);
    }

    public function flushdb()
    {
        return $this->client->flushdb();
    }
}
