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

        foreach ($xmlData as $xmlVarName => $xmlNode) {
            $attCodeText = '';
            $nodeVal = '';
            $nestedCodeText = '';

            $xmlNodeName = str_replace($soapReplacement, ':', $xmlVarName);
            $xmlVarName = str_replace($soapReplacement, '', $xmlVarName);

            if ($xmlNode->attributes()) {
                foreach ($xmlNode->attributes() as $attName => $attValue) {
                    $attName = str_replace($soapReplacement, ':', $attName);
                    $attCodeText .= $tabs.'$xml_'.$xmlVarName.'->setAttribute(\''.$attName.'\',\''.$attValue.'\');'.$breakType;
                }
            }

            if (trim($xmlNode->__toString())) {
                $nodeVal = ',\''.trim($xmlNode->__toString()).'\'';
            } elseif (count($xmlNode->children()) === 0) {
                //empty child element
            } else {
                $nestedCodeText .= self::makeXmlCode(
                    $xmlNode,
                    '$xml_'.$xmlVarName,
                    $tabs,
                    $breakType,
                    $tabType,
                    $soapReplacement
                );
            }

            $codeText .= $tabs.'$xml_'.$xmlVarName.' = $xml->createElement(\''.$xmlNodeName.'\''.$nodeVal.');'.$breakType;
            $codeText .= $attCodeText;
            $codeText .= $nestedCodeText;

            $codeText .= $start_tabs.$parentNodeName.'->appendChild($xml_'.$xmlVarName.');'.$breakType;
        }

        return $codeText;
    }
}
