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
}
