<?php

namespace App\Service;

use App\Service\XMLReader;
use App\Service\Exporter;

class Handler
{
    private $reader;
    private $exporter;


    function __construct(Exporter $exporter)
    {
        $this->exporter = $exporter;
    }

    public function execute($path)
    {
        $pathArr = explode('.', $path);
        $this->reader = StaticReaderFactory::factory(array_pop($pathArr));
        if (false === $this->reader) {
            exit('Unsupported format');
        }

        $this->reader->readFile($path);

        $this->reader->filterData('//subdomains/subdomain');
        $subdomains = $this->reader->getSubdomains();
        $this->exporter->export('subdomains', $subdomains);


        $this->reader->filterData('//cookies/cookie');
        $cookies = $this->reader->prepareCookies();

        if ($cookies) {
            foreach ($cookies as $key => $cookie) {
                $this->exporter->export($key, $cookie);
            }
        }
    }

    public function getAllKeys($keyPattern = '*'): array
    {
        return $this->exporter->getAllKeys($keyPattern);
    }
}
