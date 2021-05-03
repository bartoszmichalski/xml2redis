<?php

namespace App\Service;

use \Predis\Client;

class Exporter
{

    private $client;
    private $redisHost;
    private $redisPort;

    public function __construct($redisHost, $redisPort)
    {
        $this->redisHost = $redisHost;
        $this->redisPort = $redisPort;
    }

    private function configure():void
    {
        $this->client = new Client([
            'scheme' => 'tcp',
            'host'   => $this->redisHost,
            'port'   => $this->redisPort,
        ]);
    }


    public function export(string $key, $data):void
    {
        $this->configure();

        $this->client->set($key, json_encode($data));
    }

    public function getAllKeys(string $pattern = '*'): array
    {
        return $this->client->keys($pattern);
    }
}
