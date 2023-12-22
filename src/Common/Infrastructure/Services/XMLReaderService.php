<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Services;

use SimpleXMLElement;

class XMLReaderService
{

    public function read(string $xmlPath, string $xpath): array
    {
        $xml = simplexml_load_file($xmlPath);
        //fixme: mejorar excepcion
        if(!$xml){
            throw new \Exception('Error reading XML file');
        }

        $namespaces = $xml->getNameSpaces(true);

        if(!empty($namespaces)) {
            $this->registerNamespaces($xml, $namespaces);
        }

        $result = $xml->xpath($xpath);

        return $result;
    }

    private function registerNamespaces(SimpleXMLElement $xml, array $namespaces): void
    {
        foreach ($namespaces as $key => $value) {
            $prefix = empty($key) ? 'ns' : $key;
            $xml->registerXPathNamespace( $prefix ?? 'ns', $value);
        }
    }
}