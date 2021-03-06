<?php

use PHPUnit\Framework\TestCase;
use fize\xml\Dom;
use fize\xml\SimpleXml;

class TestDom extends TestCase
{

    public function testImportSimplexml()
    {
        $sxe = SimpleXml::loadString('<books><book><title>blah</title></book></books>');

        if ($sxe === false) {
            echo 'Error while parsing the document';
            exit;
        }

        $dom_sxe = Dom::importSimpleXml($sxe);
        if (!$dom_sxe) {
            echo 'Error while converting XML';
            exit;
        }

        $dom = new DOMDocument('1.0');
        $dom_sxe = $dom->importNode($dom_sxe, true);
        $dom->appendChild($dom_sxe);

        echo $dom->saveXML();

        self::assertTrue(true);
    }
}
