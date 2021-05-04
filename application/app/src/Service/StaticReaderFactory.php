<?php

namespace App\Service;

use App\Service\XMLReader;

final class StaticReaderFactory
{
    public static function factory(string $type)
    {
        switch ($type) {
            case 'xml':
                return new XMLReader;
            default:
                return false;
        }
    }
}
