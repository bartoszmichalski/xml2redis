<?php

namespace App\Service;

use App\Service\XMLReader;
use App\Service\Exporter;

class Handler
{
    private $reader;
    private $exporter;


    function __construct(XMLReader $reader, Exporter $exporter)
    {
        $this->reader = $reader;
        $this->exporter = $exporter;
    }

    public function execute($path)
    {
        $this->reader->readFile($path);

        $this->reader->filterData('//subdomains/subdomain');
        $subdomains = $this->reader->getSubdomains();
        $this->exporter->export('subdomains', $subdomains);


        $this->reader->filterData('//cookies/cookie');
        $cookies = $this->reader->prepareCookies();
        foreach ($cookies as $key => $cookie) {
            $this->exporter->export($key, $cookie);
        }
    }

    public function getAllKeys()
    {
        return $this->exporter->getAllKeys();
    }
}
