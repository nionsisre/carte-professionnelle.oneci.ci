<?php

namespace App\Helpers;

/**
 * Utilities class with various helper methods.
 */
class Utils
{
    /**
     * Remove accented characters from a string.
     *
     * @param string $str The input string.
     * @return string The input string with accented characters removed.
     */
    function removeAccentedChars($str) {
        $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
        $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");

        return str_replace($search, $replace, $str);
    }

    /**
     * (PHP 4, PHP 5, PHP 7+)<br/>
     * This function is used to remove invisible characters and BOM (Byte Order Mark) from a JSON string.<br/><br/>
     * <b>string</b> removeInvisibleBOMContentsOnJSONString(<b>string</b> $json_string)<br/>
     * @param string $json_string <p>The input JSON string</p>
     * @return string The cleaned JSON string
     */
    function removeInvisibleBOMContentsOnJSONString($json_string) {
        // Nettoyage des caractères invisibles
        $json_string = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json_string);
        // Suppression du BOM s'il existe
        if (substr($json_string, 0, 3) === pack('CCC', 0xEF, 0xBB, 0xBF)) {$contents = substr($json_string, 3);}

        // Retour de la chaine nettoyée
        return $json_string;
    }

    /**
     * Validate if a domain is authorized or not based on the provided email.
     *
     * @param string $email The email address to validate.
     * @param bool $professional_email_only Determines if only professional email domains are allowed.
     * @return bool Returns true if the domain is authorized, false otherwise.
     */
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
     * Generate a unique signature for a user's password.
     *
     * @param string $user_password The user's password.
     * @return string A unique signature for the user's password.
     */
    function signature($user_password){
        return md5(sha1("\$@lty".$user_password."\$@lt"));
    }

    /**
     * Convert a date to French format.
     *
     * @param string $format The format of the output date.
     * @param int|false $timestamp The timestamp to use for the conversion. If false, the current timestamp will be used.
     * @return string The date in French format.
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
