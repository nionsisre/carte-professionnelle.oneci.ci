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

    function validateDomain($email, $professional_email_only) {
        // Récupération du domaine de l'adresse e-mail
        list(, $domain) = explode('@', $email);
        // Liste des domaines exclus
        $excludedDomains = ($professional_email_only) ? ['hotmail.fr', 'outlook.com', 'gmail.com', 'myemail.com', 'yahoo.com'] : [];
        // Charger les données du fichier domains.json
        $additionalExcludedDomains = json_decode(file_get_contents(resource_path('data/spams/domains.json')), true);
        // Fusionner les domaines exclus du fichier JSON avec ceux existants
        $excludedDomains = array_merge($excludedDomains, $additionalExcludedDomains);
        // Vérification si le domaine est dans la liste des domaines exclus
        if (in_array($domain, $excludedDomains)) {
            return false; // Domaine non autorisé
        }

        return true; // Domaine autorisé
    }

    /**
     * (PHP 4, PHP 5, PHP 7)<br/>
     * This function creates signature of users password<br/><br/>
     * <b>string</b> signature(<b>string</b> $user_password)<br/>
     * @param string $user_password <p>
     * Received password via post
     * </p>
     * @return string Value of password signature
     */
    function signature($user_password){
        return md5(sha1("\$@lty".$user_password."\$@lt"));
    }

    /**
     * (PHP 4, PHP 5, PHP 7)<br/>
     * This function is like date() but in French<br/><br/>
     * <b>string</b> date_fr(<b>string</b> $format[, <b>string</b> $timestamp])<br/>
     * @param string $format <p>
     * PHP date() like format
     * </p>
     * @param string $timestamp <p>
     * Timestamp or mktime()
     * </p>
     * @return string $result in "Lundi 01 janvier 1970" format
     */
    function date_fr($format, $timestamp=false) {
        // Check timestamp value
        if (!$timestamp) {
            $date_en = date($format);
        } else {
            $date_en = date($format, $timestamp);
        }
        // English Day of week array
        $texte_en = array(
            "Monday", "Tuesday", "Wednesday", "Thursday",
            "Friday", "Saturday", "Sunday", "January",
            "February", "March", "April", "May",
            "June", "July", "August", "September",
            "October", "November", "December"
        );
        // French Day of week array
        $texte_fr = array(
            "Lundi", "Mardi", "Mercredi", "Jeudi",
            "Vendredi", "Samedi", "Dimanche", "Janvier",
            "Fếvrier", "Mars", "Avril", "Mai",
            "Juin", "Juillet", "Août", "Septembre",
            "Octobre", "Novembre", "D&eacute;cembre"
        );
        // Replace English, with French Day of week array in $date_en and
        // send it to $date_fr
        $date_fr = str_replace($texte_en, $texte_fr, $date_en);
        // English Month of year array
        $texte_en = array(
            "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun",
            "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
            "Aug", "Sep", "Oct", "Nov", "Dec"
        );
        // French Month of year array
        $texte_fr = array(
            "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim",
            "Jan", "Fév", "Mar", "Avr", "Mai", "Jui",
            "Jui", "Aoû", "Sep", "Oct", "Nov", "Déc"
        );
        // Replace English, with French Month of year array in $date_en and
        // send it to $date_fr
        $date_fr = str_replace($texte_en, $texte_fr, $date_fr);
        return $date_fr;
    }

}
