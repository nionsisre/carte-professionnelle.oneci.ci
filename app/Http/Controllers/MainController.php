<?php

namespace App\Http\Controllers;

use App\Models\AbonnesOperateur;
use App\Models\AbonnesTypePiece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        //-----------------------------------------------------------------
        // Current URL Global variable
        //-----------------------------------------------------------------
        $ADMIN_DASHBOARD_NAME = "oneciwebadmin"; //.date_fr('d', time()).date_fr('m', time()).date_fr('Y', time());
        //-----------------------------------------------------------------
        // HTTP URLS
        //-----------------------------------------------------------------
        $URL = 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; // Full URL
        $ROUTING_URL = $this->getCurrentUri(); // It's the routing requests string
        $SUBSTR_URL = ($ROUTING_URL !== "/") ? substr($URL, 0, strpos($URL, $ROUTING_URL)) : substr($URL, 0, -1); // It's URL without routing requests
        $SUBSTR_URL_SLASH = ($ROUTING_URL !== "/") ? $SUBSTR_URL."/" : $URL;
        $SUBSTR_URL_ADMIN = $SUBSTR_URL_SLASH."admin";
        $SUBSTR_URL_ADMIN_SLASH = $SUBSTR_URL_ADMIN."/";
        $SUBSTR_URL_DASHBOARD = $SUBSTR_URL_SLASH.$ADMIN_DASHBOARD_NAME;
        $SUBSTR_URL_DASHBOARD_SLASH = $SUBSTR_URL_DASHBOARD."/";
        $ADMIN_ROUTE = false;
        $API_ENABLED = false;
        $MOBILE_HEADER_ENABLED = (isset($_GET["displaymode"]) && $_GET["displaymode"] == "myoneci") ? true : false;
        //-----------------------------------------------------------------
        // LOCAL PATHS
        //-----------------------------------------------------------------
        $LOCAL_URL = substr(dirname(__DIR__), 0, strpos(dirname(__DIR__), "/main")); // local path (/var/www/../) to website root without slash
        $LOCAL_URL_SLASH = $LOCAL_URL."/"; // local path (/var/www/../) to website root with slash
        //-----------------------------------------------------------------
        // SITEMAP XML URL
        //-----------------------------------------------------------------
        $SITEMAP_URL = $LOCAL_URL_SLASH."sitemap.xml";
        //-----------------------------------------------------------------
        // Old OpenStreetMap Location Edit link
        //-----------------------------------------------------------------
        // http://umap.openstreetmap.fr/fr/map/anonymous-edit/423529:vuUkSg0gO9iX9dR5Uw9V0QpS0yA
        //-----------------------------------------------------------------
        //-----------------------------------------------------------------
        $COMPANY_SHORT_NAME = "ONECI";
        $COMPANY_NAME = "Office National de l'Etat Civil et de l'Identification";
        $COMPANY_FULL_NAME = "Office National de l'Etat Civil et de l'Identification - ONECI";
        $COMPANY_POSTAL_ADDRESS = "BP V168 Abidjan 19,<br> Boulevard Botreau Roussel, Abidjan-Plateau";
        $COMPANY_ADDRESS_1 = "(+225) 27 20 30 79 00 / 27 20 25 45 59";
        $COMPANY_WEBSITE = "https://www.oneci.ci";
        $COMPANY_WEBSITE_DISPLAY = "www.oneci.ci";
        $COMPANY_WEBSITE_DISPLAY_SHORT = "oneci.ci";
        //-----------------------------------------------------------------
        // ONECI Kernel Micro-services URL
        //-----------------------------------------------------------------
        $ONECI_PANEL_MICROSERVICES_API_KEY = "123";
        //$ONECI_PANEL_MICROSERVICES_URL = "https://kernel.oneci.ci/get-status-api?API_KEY=".$ONECI_PANEL_MICROSERVICES_API_KEY."&";
        //$ONECI_PANEL_MICROSERVICES_URL = "http://clfvcfl.cluster024.hosting.ovh.net/get-status-api?API_KEY=".$ONECI_PANEL_MICROSERVICES_API_KEY."&";
        //$ONECI_PANEL_MICROSERVICES_URL = "https://tracking.onici.net/get-status-api?API_KEY=".$ONECI_PANEL_MICROSERVICES_API_KEY."&";
        //$ONECI_PANEL_MICROSERVICES_URL = "http://localhost/kernel.oneci.ci/get-status-api?API_KEY=".$ONECI_PANEL_MICROSERVICES_API_KEY."&";
        $ONECI_PANEL_MICROSERVICES_URL = "https://kernel.oneci.ci/get-status-api?API_KEY=".$ONECI_PANEL_MICROSERVICES_API_KEY."&";
        $ONECI_KERNEL_URL = "https://kernel.oneci.ci";
        //$ONECI_KERNEL_URL = "http://localhost/kernel.oneci.ci";
        // Url processing
        $routes = array();
        $routes = explode('/', $ROUTING_URL);
        foreach($routes as $route) {
            /*if(trim($route) === '' || trim($route) === null) {
                array_push($routes, $route);
                array_pop($routes);
            }*/
            if(trim($route) != '') {
                array_push($routes, $route);
                array_pop($routes);
            }
        }

        $abonnes_operateurs = AbonnesOperateur::all();
        $civil_status_center = DB::table('civil_status_center')->get();
        $abonnes_type_pieces = AbonnesTypePiece::all();

        return view('pages.home', [
            'abonnes_type_pieces' => $abonnes_type_pieces,
            'abonnes_operateurs' => $abonnes_operateurs,
            'civil_status_center' => $civil_status_center,
            'SUBSTR_URL' => $SUBSTR_URL,
            'routes' => $routes,
            'SUBSTR_URL_SLASH' => $SUBSTR_URL_SLASH,
            'cleanStringToUrl' => $this->cleanStringToUrl($str = ""),
            'removeAccentedChars' => $this->removeAccentedChars($str = ""),
            'ONECI_KERNEL_URL' => $ONECI_KERNEL_URL,
            'ONECI_PANEL_MICROSERVICES_API_KEY' => $ONECI_PANEL_MICROSERVICES_API_KEY,
            'MOBILE_HEADER_ENABLED' => $MOBILE_HEADER_ENABLED,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function consultation() {

        //-----------------------------------------------------------------
        // Current URL Global variable
        //-----------------------------------------------------------------
        $ADMIN_DASHBOARD_NAME = "oneciwebadmin"; //.date_fr('d', time()).date_fr('m', time()).date_fr('Y', time());
        //-----------------------------------------------------------------
        // HTTP URLS
        //-----------------------------------------------------------------
        $URL = 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; // Full URL
        $ROUTING_URL = $this->getCurrentUri(); // It's the routing requests string
        $SUBSTR_URL = ($ROUTING_URL !== "/") ? substr($URL, 0, strpos($URL, $ROUTING_URL)) : substr($URL, 0, -1); // It's URL without routing requests
        $SUBSTR_URL_SLASH = ($ROUTING_URL !== "/") ? $SUBSTR_URL."/" : $URL;
        $SUBSTR_URL_ADMIN = $SUBSTR_URL_SLASH."admin";
        $SUBSTR_URL_ADMIN_SLASH = $SUBSTR_URL_ADMIN."/";
        $SUBSTR_URL_DASHBOARD = $SUBSTR_URL_SLASH.$ADMIN_DASHBOARD_NAME;
        $SUBSTR_URL_DASHBOARD_SLASH = $SUBSTR_URL_DASHBOARD."/";
        $ADMIN_ROUTE = false;
        $API_ENABLED = false;
        $MOBILE_HEADER_ENABLED = (isset($_GET["displaymode"]) && $_GET["displaymode"] == "myoneci") ? true : false;
        //-----------------------------------------------------------------
        // LOCAL PATHS
        //-----------------------------------------------------------------
        $LOCAL_URL = substr(dirname(__DIR__), 0, strpos(dirname(__DIR__), "/main")); // local path (/var/www/../) to website root without slash
        $LOCAL_URL_SLASH = $LOCAL_URL."/"; // local path (/var/www/../) to website root with slash
        //-----------------------------------------------------------------
        // SITEMAP XML URL
        //-----------------------------------------------------------------
        $SITEMAP_URL = $LOCAL_URL_SLASH."sitemap.xml";
        //-----------------------------------------------------------------
        // Old OpenStreetMap Location Edit link
        //-----------------------------------------------------------------
        // http://umap.openstreetmap.fr/fr/map/anonymous-edit/423529:vuUkSg0gO9iX9dR5Uw9V0QpS0yA
        //-----------------------------------------------------------------
        //-----------------------------------------------------------------
        $COMPANY_SHORT_NAME = "ONECI";
        $COMPANY_NAME = "Office National de l'Etat Civil et de l'Identification";
        $COMPANY_FULL_NAME = "Office National de l'Etat Civil et de l'Identification - ONECI";
        $COMPANY_POSTAL_ADDRESS = "BP V168 Abidjan 19,<br> Boulevard Botreau Roussel, Abidjan-Plateau";
        $COMPANY_ADDRESS_1 = "(+225) 27 20 30 79 00 / 27 20 25 45 59";
        $COMPANY_WEBSITE = "https://www.oneci.ci";
        $COMPANY_WEBSITE_DISPLAY = "www.oneci.ci";
        $COMPANY_WEBSITE_DISPLAY_SHORT = "oneci.ci";
        //-----------------------------------------------------------------
        // ONECI Kernel Micro-services URL
        //-----------------------------------------------------------------
        $ONECI_PANEL_MICROSERVICES_API_KEY = "123";
        //$ONECI_PANEL_MICROSERVICES_URL = "https://kernel.oneci.ci/get-status-api?API_KEY=".$ONECI_PANEL_MICROSERVICES_API_KEY."&";
        //$ONECI_PANEL_MICROSERVICES_URL = "http://clfvcfl.cluster024.hosting.ovh.net/get-status-api?API_KEY=".$ONECI_PANEL_MICROSERVICES_API_KEY."&";
        //$ONECI_PANEL_MICROSERVICES_URL = "https://tracking.onici.net/get-status-api?API_KEY=".$ONECI_PANEL_MICROSERVICES_API_KEY."&";
        //$ONECI_PANEL_MICROSERVICES_URL = "http://localhost/kernel.oneci.ci/get-status-api?API_KEY=".$ONECI_PANEL_MICROSERVICES_API_KEY."&";
        $ONECI_PANEL_MICROSERVICES_URL = "https://kernel.oneci.ci/get-status-api?API_KEY=".$ONECI_PANEL_MICROSERVICES_API_KEY."&";
        $ONECI_KERNEL_URL = "https://kernel.oneci.ci";
        //$ONECI_KERNEL_URL = "http://localhost/kernel.oneci.ci";
        // Url processing
        $routes = array();
        $routes = explode('/', $ROUTING_URL);
        foreach($routes as $route) {
            /*if(trim($route) === '' || trim($route) === null) {
                array_push($routes, $route);
                array_pop($routes);
            }*/
            if(trim($route) != '') {
                array_push($routes, $route);
                array_pop($routes);
            }
        }

        $abonnes_operateurs = AbonnesOperateur::all();
        $civil_status_center = DB::table('civil_status_center')->get();
        $abonnes_type_pieces = AbonnesTypePiece::all();

        return view('pages.consultation', [
            'abonnes_type_pieces' => $abonnes_type_pieces,
            'abonnes_operateurs' => $abonnes_operateurs,
            'civil_status_center' => $civil_status_center,
            'SUBSTR_URL' => $SUBSTR_URL,
            'routes' => $routes,
            'SUBSTR_URL_SLASH' => $SUBSTR_URL_SLASH,
            'cleanStringToUrl' => $this->cleanStringToUrl($str = ""),
            'removeAccentedChars' => $this->removeAccentedChars($str = ""),
            'ONECI_KERNEL_URL' => $ONECI_KERNEL_URL,
            'ONECI_PANEL_MICROSERVICES_API_KEY' => $ONECI_PANEL_MICROSERVICES_API_KEY,
            'MOBILE_HEADER_ENABLED' => $MOBILE_HEADER_ENABLED,
        ]);
    }

    /**
     * (PHP 4, PHP 5, PHP 7)<br/>
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
     * (PHP 4, PHP 5, PHP 7)<br/>
     * This function is used to remove space and special chars to a given string and replace it with hyphens<br/><br/>
     * <b>string</b> cleanStringToUrl(<b>string</b> $str)<br/>
     * @param string $str <p>
     * </p>
     * @return string result without spaces and special chars
     */
    function cleanStringToUrl($str) {
        $str = $this->removeAccentedChars(strtolower($str));
        $str = str_replace(' ', '-', $str); // Replaces all spaces with hyphens.
        $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str); // Removes special chars.

        return preg_replace('/-+/', '-', $str); // Replaces multiple hyphens with single one.
    }

    /**
     * (PHP 4, PHP 5, PHP 7)<br/>
     * This function is used to get current uri using clean routing<br/><br/>
     * <b>string</b> getCurrentUri()<br/>
     * @return string Value of result
     */
    function getCurrentUri() {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        $uri = '/' . trim($uri, '/');
        return $uri;
    }


}
