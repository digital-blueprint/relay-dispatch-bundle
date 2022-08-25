<?php

declare(strict_types=1);

namespace Dbp\Relay\DispatchBundle\Helpers;

class Tools
{
    /**
     * Convert binary data to a data url.
     */
    public static function getDataURI(string $data, string $mime): string
    {
        return 'data:'.$mime.';base64,'.base64_encode($data);
    }

    public static function makeXmlCodeFromSoap(
        $soapString,
        $parentNodeName = '$xml',
        $tabs = '',
        $breakType = "\n",
        $tabType = '    '
    ): string {
        $xmlString = preg_replace("/(<\/?)(\w+):([^>]*>)/", '$1$2___$3', $soapString);
        $xml = simplexml_load_string($xmlString);

        return self::makeXmlCode($xml, $parentNodeName, $tabs, $breakType, $tabType);
    }

    public static function makeXmlCode(
        $xmlData,
        $parentNodeName = '$xml',
        $tabs = '',
        $breakType = '<br>',
        $tabType = '&#9;',
        $soapReplacement = '___'
    ): string {
        $start_tabs = $tabs;
        $tabs = $tabs.$tabType;
        $codeText = '';

        if ($parentNodeName === '$xml') {
            $codeText = '$xml = new \DOMDocument(\'1.0\',\'UTF-8\');'.$breakType;
        }

        foreach ($xmlData as $xmlvarname => $xmlnode) {
            $attCodeText = '';
            $nodeVal = '';
            $nestedCodeText = '';

            $xmlnodename = str_replace($soapReplacement, ':', $xmlvarname);
            $xmlvarname = str_replace($soapReplacement, '', $xmlvarname);

            if ($xmlnode->attributes()) {
                foreach ($xmlnode->attributes() as $attname => $attvalue) {
                    $attname = str_replace($soapReplacement, ':', $attname);
                    $attCodeText .= $tabs.'$xml_'.$xmlvarname.'->setAttribute(\''.$attname.'\',\''.$attvalue.'\');'.$breakType;
                }
            }

            if (trim($xmlnode->__toString())) {
                $nodeVal = ',\''.trim($xmlnode->__toString()).'\'';
            } elseif (count($xmlnode->children()) === 0) {
                //empty child element
            } else {
                $nestedCodeText .= self::makeXmlCode(
                    $xmlnode,
                    '$xml_'.$xmlvarname,
                    $tabs,
                    $breakType,
                    $tabType,
                    $soapReplacement
                );
            }

            $codeText .= $tabs.'$xml_'.$xmlvarname.' = $xml->createElement(\''.$xmlnodename.'\''.$nodeVal.');'.$breakType;
            $codeText .= $attCodeText;
            $codeText .= $nestedCodeText;

            $codeText .= $start_tabs.$parentNodeName.'->appendChild($xml_'.$xmlvarname.');'.$breakType;
        }

        return $codeText;
    }
}
