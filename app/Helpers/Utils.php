<?php

namespace App\Helpers;

class Utils
{
  /**
   * (PHP 4, PHP 5, PHP 7+)<br/>
   * This function is used to replace the accented characters with their accent-less equivalents<br/><br/>
   * <b>string</b> removeAccentedChars(<b>string</b> $str)<br/>
   * @param string $str <p>
   * </p>
   * @return string result
   */
  function removeAccentedChars($str) {
    $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
    $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
    return str_replace($search, $replace, $str);
  }

    /**
     * (PHP 4, PHP 5, PHP 7+)<br/>
     * This function is used to remove the invisible BOM (Byte Order Mark) UTF-8 on a given JSON String<br/><br/>
     * <b>string</b> removeInvisibleBOMContentsOnJSONString(<b>string</b> $json_string)<br/>
     * @param string $json_string <p>
     * </p>
     * @return string result
     */
    function removeInvisibleBOMContentsOnJSONString($json_string) {
        // Nettoyage des caractères invisibles
        $json_string = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json_string);
        // Suppression du BOM s'il existe
        if (substr($json_string, 0, 3) === pack('CCC', 0xEF, 0xBB, 0xBF)) {$contents = substr($json_string, 3);}
        // Retour de la chaine nettoyée
        return $json_string;
    }

}
