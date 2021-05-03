<?php

namespace App\Service;

use stdClass;
use Symfony\Component\DomCrawler\Crawler;


class XMLReader
{

    private $data;
    private $crawler;
    private $nodes;

    public function readFile(string $path):void
    {
        $this->data = file_get_contents($path);
        $this->crawler = new Crawler($this->data);
    }

    public function filterData($selector)
    {
        $this->nodes = $this->crawler->filterXPath($selector);
    }

    public function getSubdomains()
    {
        $values = [];
        foreach ($this->nodes as $node) {
            $values[] = $node->nodeValue;
        }
        return $values;
    }

    public function prepareCookies()
    {
        $values = [];
        foreach ($this->nodes as $node) {
            $values['cookie:' . $node->getAttribute('name') . ':' . $node->getAttribute('host')] = $node->nodeValue;
        }
        return $values;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the value of crawler
     */ 
    public function getCrawler()
    {
        return $this->crawler;
    }

    /**
     * Get the value of nodes
     */ 
    public function getNodes()
    {
        return $this->nodes;
    }
}
