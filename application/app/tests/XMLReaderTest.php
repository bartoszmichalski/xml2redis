<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\XMLReader;


class XMLReaderTest extends TestCase {

    /**
     * @dataProvider filepathProvider
     */
    public function testreadFile($path)
    {
        $reader = new XMLReader();
        $reader->readfile($path);

        $this->assertIsString($reader->getData());
        $this->assertIsObject($reader->getCrawler());
    
    }

    /**
     * @dataProvider filepathProvider
     */
    public function testFilterData($path){
        $reader = new XMLReader();
        $reader->readfile($path);
        $reader->filterData("//subdomains/subdomain");

        $this->assertIsObject($reader->getNodes());
    }

    /**
     * @dataProvider filepathProvider
     */
    public function testGetSubdomains($path){
        $reader = new XMLReader();
        $reader->readfile($path);
        $reader->filterData("//subdomains/subdomain");

        $expSubdomains = [ 
            'http://test1.com',
            'http://test2.com',
        ];
        $this->assertEquals($expSubdomains, $reader->getSubdomains());
    }
    /**
     * @dataProvider filepathProvider
     */
    public function testGetCookies($path){
        $reader = new XMLReader();
        $reader->readfile($path);
        $reader->filterData("//cookies/cookie");

        $expCookies = [ 
            'cookie:test1-name:test1-host' => 'test1-value',
            'cookie:test2-name:test2-host' => 'test2-value',
        ];
        $this->assertEquals($expCookies, $reader->prepareCookies());
    }

    public function filepathProvider(): array
    {
        return [
            ['./tests/test.xml'],

        ];
    }
}