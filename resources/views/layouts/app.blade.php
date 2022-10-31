<!DOCTYPE HTML>

<!--[if IE 8]>
<html class="ie8 no-js"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js"> <!--<![endif]-->

<head>

    <!-- begin meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--<meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src https://*; child-src 'none';" />-->
    <meta name="author" content="ONECI - Office National de l'Etat Civil et de l'Identification">
    <meta name="dev" content="patrickangel.ndri@gmail.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- end meta -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144568720-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-144568720-1');
    </script>
    <!-- End Google Analytics -->

    <!-- Begin All size Favicons for all pages -->
    <link href="{{ URL::asset('assets/images/favicons/favicon.ico') }}" type="image/x-icon" rel="shortcut icon">
    <link rel="apple-touch-icon-precomposed" sizes="57x57"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-57x57.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-114x114.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-72x72.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-144x144.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-60x60.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-120x120.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-76x76.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
          href="{{ URL::asset('assets/images/favicons/apple-touch-icon-152x152.png') }}"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicons/favicon-196x196.png') }}"
          sizes="196x196"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicons/favicon-96x96.png') }}"
          sizes="96x96"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicons/favicon-32x32.png') }}"
          sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicons/favicon-16x16.png') }}"
          sizes="16x16"/>
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicons/favicon-128.png') }}"
          sizes="128x128"/>
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="{{ URL::asset('assets/images/favicons/mstile-144x144.png') }}"/>
    <meta name="msapplication-square70x70logo" content="{{ URL::asset('assets/images/favicons/mstile-70x70.png') }}"/>
    <meta name="msapplication-square150x150logo" content="{{ URL::asset('assets/images/favicons/mstile-150x150.png') }}"/>
    <meta name="msapplication-wide310x150logo" content="{{ URL::asset('assets/images/favicons/mstile-310x150.png') }}"/>
    <meta name="msapplication-square310x310logo" content="{{ URL::asset('assets/images/favicons/mstile-310x310.png') }}"/>
    <!-- End All size Favicons for all pages -->

    <!-- Begin Template CSS for all pages -->
    <link href="{{ URL::asset('assets/css/style-2.1.0.css') }}" type="text/css" rel="stylesheet"
          id="main-style">
    <link href="{{ URL::asset('assets/css/responsive.css') }}" type="text/css" rel="stylesheet">
    <!--[if IE]>
    <link href="{{ URL::asset('assets/css/ie.css') }}" type="text/css" rel="stylesheet"> <![endif]-->
    <link href="{{ URL::asset('assets/css/colors/oneci-green-theme.css') }}" type="text/css" rel="stylesheet"
          id="color-style">
    <link href="{{ URL::asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- End Template CSS for all pages -->

    <!-- BEGIN MODERN NAVBAR CSS SETTINGS -->
    <!--<link rel="stylesheet" href="{{ URL::asset('assets/css/modern-navbar.css') }}">-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/modern-navbar-custom-1.0.1.css') }}">
    <!-- END MODERN NAVBAR CSS SETTINGS -->

    <!-- begin JS for all pages -->
    <!--<script src="{{ URL::asset('assets/js/index.js') }}" type="text/javascript"></script>-->
    <!-- npm -->
    <script src="{{ URL::asset('assets/js/jquery-3.6.1.min.js') }}" type="text/javascript"></script>
    <!-- jQuery -->
    <script src="{{ URL::asset('assets/js/jquery-migrate-1.4.1.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.0.js"></script>
    <script src="{{ URL::asset('assets/js/modernizr.custom.js') }}" type="text/javascript"></script>
    <!-- Modernizr -->
    <!--[if IE 8]>
            <script src="{{ URL::asset('assets/js/respond.min.js') }}" type="text/javascript"></script>
            <script src="{{ URL::asset('assets/js/selectivizr-min.js') }}" type="text/javascript"></script>
    <![endif]-->
    <script src="{{ URL::asset('assets/js/ddlevelsmenu.js') }}" type="text/javascript"></script>
    <!-- drop-down menu -->
    <script src="{{ URL::asset('assets/js/tinynav.min.js') }}" type="text/javascript"></script>
    <!-- tiny nav -->
    <script src="{{ URL::asset('assets/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <!-- form validation -->
    <script src="{{ URL::asset('assets/js/jquery.easing.js') }}" type="text/javascript"></script>
    <!-- jQuery easing -->
    <!--<script src="{{ URL::asset('assets/js/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>-->
    <!-- tabs, toggles, accordion -->
    <script src="{{ URL::asset('assets/js/jquery.flexslider-min.js') }}" type="text/javascript"></script>
    <!-- slider -->
    <script src="{{ URL::asset('assets/js/jquery.jcarousel.min.js') }}" type="text/javascript"></script>
    <!-- carousel -->
    <script src="{{ URL::asset('assets/js/jquery.ui.totop.min.js') }}" type="text/javascript"></script>
    <!-- scroll to top -->
    <script src="{{ URL::asset('assets/js/jquery.fitvids.js') }}" type="text/javascript"></script>
    <!-- responsive video embeds -->
    <script src="{{ URL::asset('assets/js/jquery.tweet.js') }}" type="text/javascript"></script>
    <!-- Twitter widget -->
    <script src="{{ URL::asset('assets/js/jquery.tipsy.js') }}" type="text/javascript"></script>
    <!-- tooltips -->
    <!-- End JS for all pages -->

    <link href="{{ URL::asset('assets/css/select2.min.css') }}" rel='stylesheet' type='text/css'>
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.modal.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.modal.min.css') }}"/>
    <link href="{{ URL::asset('assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('assets/js/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/jquery.mask.js') }}" type="text/javascript"></script>
    <!-- Core Stylesheet -->
    <link href="{{ URL::asset('assets/css/smart-wizard/smart_wizard.min.css') }}" rel="stylesheet"/>
    <!-- Optional SmartWizard themes -->
    <!--<link href="<?php echo $SUBSTR_URL . "/"; ?>assets/css/smart-wizard/smart_wizard_arrows.min.css" rel="stylesheet">
        <link href="<?php echo $SUBSTR_URL . "/"; ?>assets/css/smart-wizard/smart_wizard_dots.min.css" rel="stylesheet">
        <link href="<?php echo $SUBSTR_URL . "/"; ?>assets/css/smart-wizard/smart_wizard_round.min.css" rel="stylesheet">
        <link href="<?php echo $SUBSTR_URL . "/"; ?>assets/css/smart-wizard/smart_wizard_square.min.css" rel="stylesheet">-->
    <!-- All In One -->
    <link href="{{ URL::asset('assets/css/smart-wizard/smart_wizard_all.css') }}" rel="stylesheet"/>
    <style>
        :root {
            --sw-border-color: #eeeeee;
            --sw-toolbar-btn-color: #ffffff;
            --sw-toolbar-btn-background-color: #F78E0C;
            --sw-anchor-default-primary-color: #f8f9fa;
            --sw-anchor-default-secondary-color: #b0b0b1;
            --sw-anchor-active-primary-color: #F78E0C;
            --sw-anchor-active-secondary-color: #ffffff;
            --sw-anchor-done-primary-color: #ffcc80;
            --sw-anchor-done-secondary-color: #fefefe;
            --sw-anchor-disabled-primary-color: #f8f9fa;
            --sw-anchor-disabled-secondary-color: #dbe0e5;
            --sw-anchor-error-primary-color: #dc3545;
            --sw-anchor-error-secondary-color: #ffffff;
            --sw-anchor-warning-primary-color: #ffc107;
            --sw-anchor-warning-secondary-color: #ffffff;
            --sw-progress-color: #F78E0C;
            --sw-progress-background-color: #f8f9fa;
            --sw-loader-color: #F78E0C;
            --sw-loader-background-color: #f8f9fa;
            --sw-loader-background-wrapper-color: rgba(255, 255, 255, 0.7);
        }
    </style>

    <!-- end JS -->
    <title>ONECI | Office National de l'Etat Civil et de l'Identification</title>
    <meta name="google-site-verification" content="HwJVTaGHHVbOC9VrYiz__okc1_1pDRBL-SzpDdhBpZM"/>

</head>

<body>

<?php
    $routes[1] = "nos-services";
    $routes[2] = "retrait-par-procuration";
?>

<div id="fb-root"></div>


<div class="main-wrapper" style="margin: -5px 0;">
    <nav class="navbar">
        <div class="brand-and-icon">
            <h1><a href="<?php echo $SUBSTR_URL; ?>" class="navbar-brand"><img
                        src="{{ URL::asset('assets/images/oneci_logo.svg') }}"
                        style="width: 2.7em; margin-top: 0.4em"/></a></h1>
            <button type="button" class="navbar-toggler">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li <?php if (isset($routes[1]) && $routes[1] === "accueil" || !(isset($routes[1]))) echo 'class="current"' ?>>
                    <a href="<?php echo $SUBSTR_URL_SLASH."accueil" ?>">Accueil</a>
                </li>
                <li <?php if (isset($routes[1]) && $routes[1] === "qui-sommes-nous") echo 'class="current"' ?>>
                    <a href="<?php echo $SUBSTR_URL_SLASH."qui-sommes-nous" ?>">Qui sommes-nous ?</a>
                </li>
                <li <?php if (isset($routes[1]) && $routes[1] === "carte-identite") echo 'class="current"' ?>>
                    <a href="javascript:void(0);" class="menu-link">Nos produits &nbsp; <span class="drop-icon"><i
                                class="fas fa-chevron-down"></i></span></a>
                    <div class="sub-menu">
                        <!-- item -->
                        <div class="sub-menu-item">
                            <h4 style="padding: 1em 0em; border-bottom: solid 1px #ccc;margin-right: 3em">Carte
                                Nationale d'Identité</h4>
                            <ul>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/documents-a-fournir" ?>"><i
                                            class="fad fa-copy fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Liste des documents à fournir</a></li>
                                <li>
                                    <a href="<?php echo $SUBSTR_URL_SLASH."nos-produits/procedure-de-retrait-special-de-cni" ?>"><i
                                            class="fad fa-hand-receiving fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Procédure de retrait spécial de CNI</a></li>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/liste-centres-correction" ?>"><i
                                            class="fad fa-map-marker-edit fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Liste des centres de correction</a></li>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/liste-centres-enrolement" ?>"><i
                                            class="fad fa-map-marker-alt fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Liste des centres d'enrôlement</a></li>
                                <li>
                                    <a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/liste-centres-distribution" ?>"><i
                                            class="fad fa-map-marker-alt fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Liste des centres de retrait</a></li>
                                <li style="margin-bottom: 0.5em"><a
                                        href="<?php echo $SUBSTR_URL_SLASH."carte-identite/liste-centres-enrolement-et-distribution" ?>"><i
                                            class="fad fa-map-marker-alt fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Liste des centres mixtes (enrôlement + retrait)</a></li>
                                <br/>
                            </ul>
                        </div>
                        <!-- end of item -->
                        <!-- item -->
                        <div class="sub-menu-item">
                            <h4 style="padding: 1em 0em; border-bottom: solid 1px #ccc;margin-right: 3em">Attestation
                                d'Identité</h4>
                            <ul>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."attestation-identite" ?>"><i
                                            class="fad fa-copy fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Liste des documents à fournir</a></li>
                                <br/>
                            </ul>
                        </div>
                        <!-- end of item -->
                        <!-- item -->
                        <div class="sub-menu-item">
                            <h4 style="padding: 1em 0em; border-bottom: solid 1px #ccc;margin-right: 3em">Carte de
                                Résident</h4>
                            <ul>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."carte-resident/documents-a-fournir" ?>"><i
                                            class="fad fa-copy fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Liste des documents à fournir</a></li>
                                <br/>
                            </ul>
                        </div>
                        <!-- end of item -->
                        <!-- item -->
                        <div class="sub-menu-item">
                            <h4 style="padding: 1em 0em; border-bottom: solid 1px #ccc;margin-right: 3em">Extrait de
                                naissance</h4>
                            <ul>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."etat-civil" ?>"><i
                                            class="fad fa-exclamation-circle fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Informations</a></li>
                                <br/>
                            </ul>
                        </div>
                        <!-- end of item -->
                        <br/>
                    </div>
                </li>
                <li <?php if (isset($routes[1]) && $routes[1] === "carte-identite") echo 'class="current"' ?>>
                    <a href="javascript:void(0);" class="menu-link">Nos services &nbsp; <span class="drop-icon"><i
                                class="fas fa-chevron-down"></i></span></a>
                    <div class="sub-menu">
                        <!-- item -->
                        <div class="sub-menu-item">
                            <h4 style="padding: 1em 0em; border-bottom: solid 1px #ccc;margin-right: 3em">Identité</h4>
                            <ul>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."service-vip" ?>"><i
                                            class="fad fa-crown fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Service VIP</a></li>
                                <li><a href="https://rnpp.ci/voucher/index"><i class="fad fa-money-bill fa-1x mr10"
                                                                               style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Achat du timbre d'enrôlement</a></li>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/suivi-de-statut" ?>"><i
                                            class="fad fa-check-double fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Suivi du statut de la CNI</a></li>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/rechercher-cni-perdue" ?>"><i
                                            class="fad fa-search fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Rechercher une CNI perdue</a></li>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/declarer-cni-retrouvee" ?>"><i
                                            class="fad fa-id-card fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Déclarer une CNI retrouvée</a></li>
                                <li><a href="https://statut.oneci.ci/numero-de-demande"><i
                                            class="fad fa-question-circle fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Je n'ai pas mon numéro de demande</a></li>
                                <!--<li><a href="<?php echo $SUBSTR_URL_SLASH . "nos-services/retrait-special-de-cni" ?>"><i class="fad fa-hand-receiving fa-1x mr10" style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i> &nbsp; Initier un retrait spécial de CNI</a></li>-->
                                <li><a href="https://procuration.oneci.ci"><i class="fad fa-hand-receiving fa-1x mr10"
                                                                              style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Initier un retrait spécial de CNI</a></li>
                                <br/>
                            </ul>
                        </div>
                        <!-- end of item -->
                        <!-- item -->
                        <div class="sub-menu-item">
                            <h4 style="padding: 1em 0em; border-bottom: solid 1px #ccc;margin-right: 3em">
                                Authentification</h4>
                            <ul>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."nos-services/service-authentification" ?>"><i
                                            class="fad fa-fingerprint fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Service Authentification</a></li>
                                <!--<li><a href="https://identite.oneci.ci"><i class="fad fa-fingerprint fa-1x mr10" style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i> &nbsp; Service Authentification</a></li>-->
                                <li><a href="https://identite.oneci.ci/nni"><i class="fad fa-barcode fa-1x mr10"
                                                                               style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Initier une demande de numéro NNI</a></li>
                                <!--<li><a href="<?php echo $SUBSTR_URL_SLASH . "nos-services/demande-de-nni" ?>"><i class="fad fa-barcode fa-1x mr10" style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i> &nbsp; Initier une demande de numéro NNI</a></li>-->
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."nos-services/commande-de-tvi" ?>"><i
                                            class="fad fa-tablet-rugged fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Commander mon Terminal TVI</a></li>
                                <br/>
                            </ul>
                        </div>
                        <!-- end of item -->
                        <!-- item -->
                        <div class="sub-menu-item">
                            <h4 style="padding: 1em 0em; border-bottom: solid 1px #ccc;margin-right: 3em">
                                Réclamation</h4>
                            <ul>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."nos-services/service-reclamation" ?>"><i
                                            class="fad fa-headset fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Service Réclamation</a></li>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."nos-services/retard-de-production" ?>"><i
                                            class="fad fa-engine-warning fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Faire une réclamation de votre titre</a></li>
                                <br/>
                            </ul>
                        </div>
                        <!-- end of item -->
                        <!-- item -->
                        <div class="sub-menu-item" style="margin: 0; padding: 0;width: 100%">
                            <img src="<?php echo $SUBSTR_URL_SLASH . "assets/images/nos-services-illustration.jpg"; ?>"
                                 alt="Image d'illustration pour la CNI">
                        </div>
                        <!-- end of item -->
                    </div>
                </li>
                <li <?php if (isset($routes[1]) && $routes[1] === "contacts") echo 'class="current"' ?>>
                    <a href="<?php echo $SUBSTR_URL_SLASH."contacts" ?>">Contacts</a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-link">
                        Plus &nbsp;
                        <span class="drop-icon">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </a>
                    <div class="sub-menu">
                        <!-- item -->
                        <div class="sub-menu-item">
                        </div>
                        <!-- end of item -->
                        <!-- item -->
                        <div class="sub-menu-item">
                            <h4 style="padding: 1em 0em; border-bottom: solid 1px #ccc;margin-right: 3em">Divers</h4>
                            <ul>
                                <li>
                                    <a href="<?php echo $SUBSTR_URL_SLASH; ?>"><i
                                            class="fad fa-newspaper fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Actualités</a></li>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."documentation" ?>"><i
                                            class="fad fa-archive fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Documentation</a></li>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."oneci-carriere" ?>"><i
                                            class="fad fa-building fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; ONECI Carrière</a></li>
                                <li><a href="<?php echo $SUBSTR_URL_SLASH."mediatheque" ?>"><i
                                            class="fad fa-images fa-1x mr10"
                                            style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i>
                                        &nbsp; Médiathèque</a></li>
                                <br/>
                            </ul>
                        </div>
                        <!-- end of item -->
                        <!-- item -->
                        <div class="sub-menu-item">
                            <div align="center" style="position: relative; top:40%">
                                <a href="<?php echo $SUBSTR_URL_SLASH . "l-oneci-vous-ecoute"; ?>" class="button black">
                                    <span style="color: white"><i
                                            class="fa fa-ear"></i> &nbsp; L'ONECI VOUS ECOUTE</span>
                                </a>
                            </div>
                        </div>
                        <!-- end of item -->
                        <!-- item -->
                        <div class="sub-menu-item" style="margin: 0; padding: 0;width: 100%">
                            <img
                                src="<?php echo $SUBSTR_URL_SLASH . "assets/images/services-divers-illustration.jpg"; ?>"
                                alt="Image d'illustration pour les services divers">
                        </div>
                        <!-- end of item -->
                    </div>
                </li>


            </ul>
        </div>
    </nav>
</div>

<!-- begin container -->
<div id="wrap">

    <div class="spacer">&nbsp;</div>
    <div class="spacer">&nbsp;</div>

    <!-- begin page title -->
    <section id="page-title">
        <div class="container clearfix">
            <nav id="breadcrumbs" style="float: left !important">
                <ul>
                    <li><a href="<?php echo $SUBSTR_URL_SLASH."accueil" ?>">Accueil</a> &rsaquo;</li>
                    <li>Nos services &rsaquo;</li>
                    <li>Retrait par procuration</li>
                </ul>
            </nav>
        </div>
    </section>
    <!-- begin page title -->

    <!-- begin content -->
    <section id="content" class="container clearfix">
        <!-- begin our company -->
        <section>
            <div class="column-last">

                <?php if (isset($_SESSION["PRE_ORDER_TVI"]["RESPONSE_CODE"]) && $_SESSION["PRE_ORDER_TVI"]["RESPONSE_CODE"] == "1") { ?>

                <center>
                    <i class="fad fa-check-circle"
                       style="--fa-primary-color: #388E3C; --fa-secondary-color:#F78E0C; --fa-secondary-opacity:0.9; font-size: 10em;margin: 0.3em 0em 0.2em;"></i>
                    <br/>
                    <div><?php echo $_SESSION["PRE_ORDER_TVI"]["MESSAGE"]; ?></div>
                    <a href="<?php echo $SUBSTR_URL."/accueil"; ?>" class="button black"><i
                            class="fa fa-home text-white"></i> &nbsp; Retourner à l'accueil</a>
                </center>

                    <?php session_destroy(); ?>

                <?php } else { ?>

                <h2><i class="fa fa-hands-helping text-black mr10"></i> &nbsp; Initier un retrait de Carte Nationale
                    d'Identité par procuration</h2>
                <h5>
                    Veuillez renseigner les champs du formulaire ci-dessous afin d'initier un retrait de Carte Nationale
                    d'Identité par procuration<br/>
                </h5>

                    <?php if (isset($_SESSION["PRE_ORDER_TVI"]["RESPONSE_CODE"]) && $_SESSION["PRE_ORDER_TVI"]["RESPONSE_CODE"] == "2") { ?>

                <div id="modalError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <center>
                        <div class="notification-box notification-box-error">
                            <div class="modal-header">
                                <h3><i class="fa fa-warning"></i>
                                    &nbsp; <?php echo $_SESSION["PRE_ORDER_TVI"]["TITLE"]; ?></h3>
                            </div>
                            <div class="modal-body">
                                <p><?php echo $_SESSION["PRE_ORDER_TVI"]["MESSAGE"]; ?></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" rel="modal:close"
                               style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Ok</a>
                        </div>
                    </center>
                </div>
                <div id="contact-notification-box-error" class="notification-box notification-box-error">
                    <p>
                        <b><?php echo $_SESSION["PRE_ORDER_TVI"]["TITLE"]; ?> :</b><br/>
                            <?php echo $_SESSION["PRE_ORDER_TVI"]["MESSAGE"]; ?>
                    </p>
                </div>

                <?php } ?>

                <div style="background-color: rgba(217, 217, 217, 0.46);padding: 2em; margin: 0em -2em;">
                    <center>
                        <div id="tvi-preorder-container">
                            <form id="ctptch-frm-id" class="content-form" method="post"
                                  action="<?php echo $SUBSTR_URL."/signaler-retard-de-production"; ?>">
                                    <?php
                                    // --------------------------------------------------------------------------
                                    // Everything is ok so getting data using REST-API Micro service
                                    // --------------------------------------------------------------------------
                                    $get_parameters = array(
                                        "instruction" => "GET_CIVIL_STATUS_CENTRES_LIST",
                                        "client" => "KERNEL"
                                    );
                                    $url = $ONECI_KERNEL_URL . '/get-info?API_KEY=' . $ONECI_PANEL_MICROSERVICES_API_KEY . '&' . http_build_query($get_parameters);
                                    $contents = file_get_contents($url);
                                    // --------------------------------------------------------------------------
                                    // REST-API Micro service feedback processing
                                    // --------------------------------------------------------------------------
                                    if (isset($contents) && !empty($contents)) {
                                        // --------------------------------------------------------------------------
                                        // JSON Clean
                                        // --------------------------------------------------------------------------
                                        for ($i = 0; $i <= 31; ++$i) $contents = str_replace(chr($i), "", $contents);
                                        $contents = str_replace(chr(127), "", $contents);
                                        if (0 === strpos(bin2hex($contents), 'efbbbf')) $contents = substr($contents, 3);
                                        // --------------------------------------------------------------------------
                                        // Result USE Cases
                                        // --------------------------------------------------------------------------
                                        try {
                                            $result = json_decode($contents, true); // Decoding serialized json into an array
                                            //var_dump($result);
                                            if (isset($result["error"]) && !$result["error"]) {
                                                $result = $result["data"];
                                            }
                                        } catch (Exception $e) {
                                            $flag = true;
                                        }
                                    }
                                    /*echo $url."<br/>";
                                    var_dump($contents);*/
                                    ?>
                                <div id="smartwizard">
                                    <ul class="nav">
                                        <li>
                                            <a class="nav-link" href="#step-1"><i
                                                    class="fa fa-info-circle text-white"></i> &nbsp; Etape 1 :
                                                Informations sur le Mandataire</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#step-2"><i class="fa fa-id-card text-white"></i>
                                                &nbsp; Etape 2 : Informations sur la Carte Nationale d'Identité</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#step-3"><i class="fa fa-copy text-white"></i>
                                                &nbsp; Etape 3 : Documents justificatifs</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#step-4"><i class="fa fa-eye text-white"></i>
                                                &nbsp; Etape 4 : Récapitulatif</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#step-5"><i
                                                    class="fa fa-credit-card text-white"></i> &nbsp; Etape 5 : Paiement
                                                des Frais de services</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#step-6"><i class="fa fa-check text-white"></i>
                                                &nbsp; Etape 6 : Notification de prise en compte de la requête</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="step-1" class="tab-pane" role="tabpanel">
                                            <br/><br/>
                                            <h2>Informations sur le mandataire :</h2><br/>
                                            <input type="hidden" name="context" value="WITHDRAWAL_WITH_PROCURATION"/>
                                            <input type="hidden" name="token"
                                                   value=""/>
                                            <div class="container clearfix">
                                                <div class="form-group one-half column-last" id="first-name-field">
                                                    <label class="col-sm-2 control-label">
                                                        Entrez votre nom<span style="color: #d9534f">*</span> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="delegate-first-name-input"
                                                               name="delegate-first-name"
                                                               placeholder="Nom ou Nom de l'époux..."
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["first_name"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["first_name"] . '"';
                                                               } ?> maxlength="25" required="required"
                                                               style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                                <div class="form-group one-half column-last" id="last-name-field">
                                                    <label class="col-sm-2 control-label">
                                                        Entrez votre prénom<span style="color: #d9534f">*</span> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="delegate-last-name-input"
                                                               name="delegate-last-name" placeholder="Prénom(s)..."
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"] . '"';
                                                               } ?> maxlength="70" required="required"
                                                               style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>
                                            <div class="container clearfix">
                                                <div class="form-group one-half column-last" id="birth-date-field">
                                                    <label class="col-sm-2 control-label">
                                                        Entrez votre date de naissance<span
                                                            style="color: #d9534f">*</span> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="date" id="delegate-birth-date-input"
                                                               name="delegate-birth-date"
                                                               placeholder="Date de Naissance"
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["birth_date"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["birth_date"] . '"';
                                                               } ?>  required="required"
                                                               style="width: 17.5em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                                    <?php if (isset($result) && is_array($result)) { ?>
                                                <div class="form-group one-half column-last" id="birth-place-field">
                                                    <label class="col-sm-2 control-label">
                                                        Entrez votre lieu de naissance<span
                                                            style="color: #d9534f">*</span> :
                                                    </label>
                                                    <span style="display: none" id="err-toast"></span>
                                                    <div class="col-sm-10">
                                                        <select class="form-control good-select"
                                                                id="delegate-birth-place-input"
                                                                name="delegate-birth-place"
                                                                placeholder="Lieu de naissance" required="required"
                                                                style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                            <option value="" selected disabled>Choisir le lieu de
                                                                naissance
                                                            </option>
                                                                <?php foreach ($result as $ec) { ?>
                                                            <option
                                                                value="<?php echo $ec["civil_status_center_id"]; ?>" <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]) && $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["birth_place"] == $ec["civil_status_center_id"]) {
                                                                echo 'selected';
                                                            } ?>><?php echo $ec["civil_status_center_label"]; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <br/>
                                            <div class="container clearfix">
                                                <div class="form-group one-half column-last" id="birth-place-field">
                                                    <label class="col-sm-2 control-label">
                                                        Quel est votre lien de parenté avec le propriétaire de la
                                                        CNI<span style="color: #d9534f">*</span> :
                                                    </label>
                                                    <span style="display: none" id="err-toast"></span>
                                                    <div class="col-sm-10">
                                                        <select class="form-control good-select"
                                                                id="delegate-filiation-input" name="delegate-filiation"
                                                                placeholder="Lien de parenté" required="required"
                                                                style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                            <option value="" selected disabled>Lien de parenté</option>
                                                            <option value="1">Grand-Parent</option>
                                                            <option value="2">Père / Mère</option>
                                                            <option value="3">Oncle / Tante</option>
                                                            <option value="4">Frère / Soeur</option>
                                                            <option value="5">Epoux / Epouse</option>
                                                            <option value="6">Cousin / Cousine</option>
                                                            <option value="7">Fils / Fille</option>
                                                            <option value="8">Ami(e) / Proche</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group one-half column-last" id="last-name-field">
                                                    <label class="col-sm-2 control-label">
                                                        Lieu de résidence<span style="color: #d9534f">*</span> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="delegate-residence-input"
                                                               name="delegate-residence"
                                                               placeholder="Lieu de résidence..."
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"] . '"';
                                                               } ?> maxlength="70" required="required"
                                                               style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>
                                            <div class="form-group" id="form-number-field">
                                                <br/>
                                                <div class="col-sm-12">
                                                    <label class="col-sm-2 control-label">
                                                        Entrez votre numéro de téléphone mobile<span
                                                            style="color: #d9534f">*</span> :
                                                    </label>
                                                    <span style="display: none" id="err-toast"></span>
                                                    <div class="col-sm-10"><span style="width: 2em">+ 225</span> &nbsp;
                                                        <input type="text" class="form-control good-select"
                                                               id="delegate-msisdn-input" name="delegate-msisdn"
                                                               placeholder="__ __ __ __ __" maxlength="14"
                                                               style="width: 13.9em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"]) && !empty($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"] . '"';
                                                               } ?> required="required"/></div>
                                                </div>
                                                <br/>
                                                <div class="col-sm-12">
                                                    <label class="col-sm-2 control-label">
                                                        <em>Entrez votre adresse mail pour recevoir toute notification
                                                            relative à votre requête :</em>
                                                    </label>
                                                    <span style="display: none" id="err-mail-toast"></span>
                                                    <div><input type="email" class="form-control good-select"
                                                                id="email-input" name="email"
                                                                placeholder="Adresse Mail..." maxlength="150"
                                                                style="width: 21.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"
                                                                <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["email"]) && !empty($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["email"])) {
                                                            echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["email"] . '"';
                                                        } ?> /></div>
                                                    <br/>
                                                </div>
                                                <div class="form-group" id="comment-field">
                                                    <label class="col-sm-2 control-label">
                                                        <em>Commentaire(s) / Observation(s) complémentaires :</em>
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <textarea type="text" id="comment-input" name="comment"
                                                                  placeholder="Commentaire(s) ou Observation(s)..."
                                                                  <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["comment"])) {
                                                                      echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["comment"] . '"';
                                                                  } ?> maxlength="400"
                                                                  style="width: 21.5em; height: 4em; text-align: center; resize: none;"></textarea>
                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-2" class="tab-pane" role="tabpanel">
                                            <br/><br/>
                                            <h2>Informations sur le titulaire de la Carte Nationale d'Identité :</h2>
                                            <br/>
                                            <div class="form-group" id="form-number-field">
                                                <label class="col-sm-2 control-label">
                                                    Numéro du récépissé d'enrôlement :
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="form-number-input" name="form-number"
                                                           placeholder="Numéro de demande..."
                                                           <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["recepisse_number"])) {
                                                               echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["recepisse_number"] . '"';
                                                           } ?> maxlength="11"
                                                           style="width: 17.4em; text-align: center"/>
                                                </div>
                                                <br/>
                                            </div>
                                            <div class="container clearfix">
                                                <div class="form-group one-half column-last" id="first-name-field">
                                                    <label class="col-sm-2 control-label">
                                                        <em>Numéro de BL (présent dans le SMS de retrait)</em> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="bl-number-input" name="bl-number"
                                                               placeholder="Numéro de BL (faculatif)..."
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["first_name"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["first_name"] . '"';
                                                               } ?> maxlength="25" required="required"
                                                               style="width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                                <div class="form-group one-half column-last" id="last-name-field">
                                                    <label class="col-sm-2 control-label">
                                                        <em>ID du paquet (présent dans le SMS de retrait)</em> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="paquet-id-input" name="paquet-id"
                                                               placeholder="ID du paquet (faculatif)..."
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"] . '"';
                                                               } ?> maxlength="70" required="required"
                                                               style="width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>
                                            <div class="container clearfix">
                                                <div class="form-group one-half column-last" id="first-name-field">
                                                    <label class="col-sm-2 control-label">
                                                        Nom du titulaire de la CNI<span style="color: #d9534f">*</span>
                                                        :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="first-name-input" name="first-name"
                                                               placeholder="Nom ou Nom de l'époux..."
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["first_name"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["first_name"] . '"';
                                                               } ?> maxlength="25" required="required"
                                                               style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                                <div class="form-group one-half column-last" id="last-name-field">
                                                    <label class="col-sm-2 control-label">
                                                        Prénom du titulaire de la CNI<span
                                                            style="color: #d9534f">*</span> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="last-name-input" name="last-name"
                                                               placeholder="Prénom(s) du titulaire..."
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"] . '"';
                                                               } ?> maxlength="70" required="required"
                                                               style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                            </div>
                                            <div class="container clearfix">
                                                <div class="form-group one-half column-last" id="birth-date-field">
                                                    <label class="col-sm-2 control-label">
                                                        Date de naissance du titulaire de la CNI<span
                                                            style="color: #d9534f">*</span> :
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <input type="date" id="birth-date-input" name="birth-date"
                                                               placeholder="Date de Naissance"
                                                               <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["birth_date"])) {
                                                                   echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["birth_date"] . '"';
                                                               } ?>  required="required"
                                                               style="width: 17.5em; text-align: center"/>
                                                    </div>
                                                    <br/>
                                                </div>
                                                    <?php if (isset($result) && is_array($result)) { ?>
                                                <div class="form-group one-half column-last" id="birth-place-field">
                                                    <label class="col-sm-4 control-label">
                                                        Lieu de naissance du titulaire de la CNI<span
                                                            style="color: #d9534f">*</span> :
                                                    </label>
                                                    <span style="display: none" id="err-toast"></span>
                                                    <div class="col-sm-10">
                                                        <select class="form-control good-select" id="birth-place-input"
                                                                name="birth-place" placeholder="Lieu de naissance"
                                                                required="required"
                                                                style="width: 17.5em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;">
                                                            <option value="" selected disabled>Choisir le lieu de
                                                                naissance
                                                            </option>
                                                                <?php foreach ($result as $ec) { ?>
                                                            <option
                                                                value="<?php echo $ec["civil_status_center_id"]; ?>" <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]) && $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["birth_place"] == $ec["civil_status_center_id"]) {
                                                                echo 'selected';
                                                            } ?>><?php echo $ec["civil_status_center_label"]; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <br/>
                                            <div class="form-group column-last" id="last-name-field">
                                                <label class="col-sm-2 control-label">
                                                    Lieu de résidence du titulaire de CNI<span
                                                        style="color: #d9534f">*</span> :
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="residence-input" name="residence"
                                                           placeholder="Lieu de résidence..."
                                                           <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"])) {
                                                               echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["last_name"] . '"';
                                                           } ?> maxlength="70" required="required"
                                                           style="text-transform: uppercase; width: 17.4em; text-align: center"/>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="form-group" id="form-number-field">
                                                <div class="col-sm-12">
                                                    <label class="col-sm-4 control-label">
                                                        Numéro de téléphone du titulaire de la CNI<span
                                                            style="color: #d9534f">*</span> :
                                                    </label>
                                                    <span style="display: none" id="err-toast"></span>
                                                    <div class="col-sm-10"><input type="text"
                                                                                  class="form-control good-select"
                                                                                  id="msisdn-input" name="msisdn"
                                                                                  placeholder="Numéro de téléphone"
                                                                                  maxlength="24"
                                                                                  style="width: 17.4em; text-align: center; border: 1px solid #d9d9d9;padding: 6px 10px;border-radius: 0;box-shadow: 0 0 5px rgba(0,0,0,0.1) inset;line-height: normal;"
                                                                                  <?php if (isset($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"]) && !empty($_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"])) {
                                                                                      echo 'value="' . $_SESSION["WITHDRAWAL_WITH_PROCURATION"]["msisdn"] . '"';
                                                                                  } ?> required="required"/></div>
                                                </div>
                                                <br/>
                                            </div>
                                        </div>
                                        <div id="step-3" class="tab-pane" role="tabpanel">
                                            <br/><br/>
                                            <h2>Courrier de demande adressé au Directeur Général de l’ONECI :</h2>
                                            <label for="document-input" class="col-sm-2 control-label">
                                                <em>Le document scanné à charger doit être en <b>*.jpg</b> ou en <b>*.pdf</b>
                                                    et avoir une résolution minimum de <b>150 dpi</b> et ne doit pas
                                                    excéder <b>800 Ko</b>.</em>
                                            </label>
                                            <div class="form-group" id="form-number-field">
                                                <div class="col-sm-10">
                                                    <div class="box">
                                                        <input type="file" name="documents[]" id="document-0-input"
                                                               class="inputfile" accept="application/pdf, image/jpeg"
                                                               style="display: none">
                                                        <label for="document-0-input" class="atcl-inv hoverable"
                                                               style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 20em;"><i
                                                                class="fad fa-file-upload fa-3x mr10"
                                                                style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><span>Charger le document…</span></label>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <br/>
                                            <h2>Procuration légalisée de la mairie, aux fins de retrait de la CNI,
                                                datant de moins de 3 mois :</h2>
                                            <label for="document-input" class="col-sm-2 control-label">
                                                <em>Le document scanné à charger doit être en <b>*.jpg</b> ou en <b>*.pdf</b>
                                                    et avoir une résolution minimum de <b>150 dpi</b> et ne doit pas
                                                    excéder <b>800 Ko</b>.</em>
                                            </label>
                                            <div class="form-group" id="form-number-field">
                                                <div class="col-sm-10">
                                                    <div class="box">
                                                        <input type="file" name="documents[]" id="document-1-input"
                                                               class="inputfile" accept="application/pdf, image/jpeg"
                                                               style="display: none">
                                                        <label for="document-1-input" class="atcl-inv hoverable"
                                                               style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 20em;"><i
                                                                class="fad fa-file-upload fa-3x mr10"
                                                                style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><span>Charger le document…</span></label>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <br/>
                                            <h2>Photocopie de la pièce d'identité du mandataire en cours de validité
                                                :</h2>
                                            <label for="document-input" class="col-sm-2 control-label">
                                                <em>Le document scanné à charger doit être en <b>*.jpg</b> ou en <b>*.pdf</b>
                                                    et avoir une résolution minimum de <b>150 dpi</b> et ne doit pas
                                                    excéder <b>800 Ko</b>.</em>
                                            </label>
                                            <div class="form-group" id="form-number-field">
                                                <label for="document-input" class="col-sm-2 control-label">
                                                    <b><i class="fa fa-id-card"></i>&nbsp; Pièce d'identité acceptée :
                                                        <br>
                                                        <span>(Carte Nationale d'Identité valide, Récépissé d’enrôlement ou l’Attestation d’Identité valide)</span></b>
                                                </label>
                                                <div class="col-sm-10">
                                                    <div class="box">
                                                        <input type="file" name="documents[]" id="document-2-input"
                                                               class="inputfile" accept="application/pdf, image/jpeg"
                                                               style="display: none">
                                                        <label for="document-2-input" class="atcl-inv hoverable"
                                                               style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 20em;"><i
                                                                class="fad fa-file-upload fa-3x mr10"
                                                                style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><span>Charger le document…</span></label>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <br/>
                                            <h2>Justificatif de résidence à l’étranger du titulaire de la CNI :</h2>
                                            <label for="document-input" class="col-sm-2 control-label">
                                                <em>Le document scanné à charger doit être en <b>*.jpg</b> ou en <b>*.pdf</b>
                                                    et avoir une résolution minimum de <b>150 dpi</b> et ne doit pas
                                                    excéder <b>800 Ko</b>.</em>
                                            </label>
                                            <div class="form-group" id="form-number-field">
                                                <label for="document-input" class="col-sm-2 control-label">
                                                    <b><i class="fa fa-file"></i>&nbsp; Document accepté : <br>
                                                        <span>(Carte d’étudiant, Permis d’étude, Carte consulaire, Facture d’eau ou d’électricité)</span></b>
                                                </label>
                                                <div class="col-sm-10">
                                                    <div class="box">
                                                        <input type="file" name="documents[]" id="document-3-input"
                                                               class="inputfile" accept="application/pdf, image/jpeg"
                                                               style="display: none">
                                                        <label for="document-3-input" class="atcl-inv hoverable"
                                                               style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 20em;"><i
                                                                class="fad fa-file-upload fa-3x mr10"
                                                                style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><span>Charger le document…</span></label>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                            <br/>
                                            <h2>Récépissé d’enrôlement de la CNI à retirer :</h2>
                                            <label for="document-input" class="col-sm-2 control-label">
                                                <em>Le document scanné à charger doit être en <b>*.jpg</b> ou en <b>*.pdf</b>
                                                    et avoir une résolution minimum de <b>150 dpi</b> et ne doit pas
                                                    excéder <b>800 Ko</b>.</em>
                                            </label>
                                            <div class="form-group" id="form-number-field">
                                                <div class="col-sm-10">
                                                    <div class="box">
                                                        <input type="file" name="documents[]" id="document-4-input"
                                                               class="inputfile" accept="application/pdf, image/jpeg"
                                                               style="display: none">
                                                        <label for="document-4-input" class="atcl-inv hoverable"
                                                               style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 20em;"><i
                                                                class="fad fa-file-upload fa-3x mr10"
                                                                style="padding: 0.2em 0em;--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.2em"></i><br/><span>Charger le document…</span></label>
                                                    </div>
                                                </div>
                                                <br/>
                                            </div>
                                        </div>
                                        <div id="step-4" class="tab-pane" role="tabpanel">
                                            <br/><br/>
                                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                            <div class="col-sm-12">
                                                <button class="button" type="submit" value="Submit" id="cptch-sbmt-btn"
                                                        style="width: 100%;padding: 1em;"><i
                                                        class="fa fa-credit-card"></i> &nbsp; Procéder au paiement
                                                </button>
                                            </div>
                                        </div>
                                        <div id="step-5" class="tab-pane" role="tabpanel">
                                            Step 5
                                        </div>
                                        <div id="step-6" class="tab-pane" role="tabpanel">
                                            Step 6
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                            </form>
                        </div>
                    </center>
                </div>

                    <?php if (isset($_SESSION["PRE_ORDER_TVI"])) unset($_SESSION["PRE_ORDER_TVI"]); ?>

                <?php } ?>

            </div>
        </section>
    </section>

    <?php if (!$MOBILE_HEADER_ENABLED) { ?>
        <!-- begin footer -->
    <footer id="footer">
            <?php if ($routes[1] == "" || $routes[1] == "accueil") { ?>
            <!-- begin footer featured -->
        <div id="footer-featured" style="background-color: #F78E0C;">
            <div class="container clearfix">
                <div align="center">
                    <h1 style="font-size: 1.5em;">Restez en contact avec nous en nous suivant sur les réseaux sociaux
                        :</h1>
                    <div style="margin-top: 3em">
                        <div class="one-fourth atcl" style="margin-right: 0em"><a href="https://twitter.com/Oneci_ci"
                                                                                  title="Twitter" target="_blank"><img
                                    src="<?php echo $SUBSTR_URL; ?>/assets/images/social-media/social_btn_twitter.svg"
                                    alt="Icone Twitter"
                                    style="box-shadow:0 0 10px rgba(60,72,88,0.35) !important; width: 5em; border-radius: 3em; margin-bottom: 3em"></a>
                        </div>
                        <div class="one-fourth atcl" style="margin-right: 0em"><a
                                href="https://www.facebook.com/oneciofficiel" title="Facebook" target="_blank"><img
                                    src="<?php echo $SUBSTR_URL; ?>/assets/images/social-media/social_btn_facebook.svg"
                                    alt="Icone Facebook"
                                    style="box-shadow:0 0 10px rgba(60,72,88,0.35) !important; width: 5em; border-radius: 3em; margin-bottom: 3em"></a>
                        </div>
                        <div class="one-fourth atcl" style="margin-right: 0em"><a
                                href="https://www.linkedin.com/company/office-national-d-identification-c-i/"
                                title="LinkedIn" target="_blank"><img
                                    src="<?php echo $SUBSTR_URL; ?>/assets/images/social-media/social_btn_linkedin.svg"
                                    alt="Icone LinkedIn"
                                    style="box-shadow:0 0 10px rgba(60,72,88,0.35) !important; border-radius: 3em; width: 5em; margin-bottom: 3em"></a>
                        </div>
                        <div class="one-fourth atcl" style="margin-right: 0em"><a
                                href="https://www.youtube.com/channel/UCXfkjZr4KdlTn_tnzvn30VQ" title="YouTube"
                                target="_blank"><img
                                    src="<?php echo $SUBSTR_URL; ?>/assets/images/social-media/social_btn_youtube.svg"
                                    alt="Icone Youtube"
                                    style="box-shadow:0 0 10px rgba(60,72,88,0.35) !important; border-radius: 3em; width: 5em; margin-bottom: 3em"></i>
                            </a></div>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
        <!-- end footer featured -->
        <?php } ?>

            <!-- begin footer top -->
        <div id="footer-top">
            <div class="container clearfix">
                <h2 id="plan-site">PLAN DU SITE</h2>
                <div class="one-fourth">
                    <div class="widget">
                        <h3>Nos Produits</h3>
                        <h6>Carte nationale d'identité</h6>
                        <p>
                            <a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/documents-a-fournir" ?>"
                               class="text-white">> Liste des documents à fournir</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."nos-produits/procedure-de-retrait-special-de-cni" ?>"
                               class="text-white">> Procédure de retrait spécial de CNI</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/liste-centres-correction" ?>"
                               class="text-white">> Liste des centres de correction</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/liste-centres-enrolement" ?>"
                               class="text-white">> Liste des centres d'enrôlement</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/liste-centres-distribution" ?>"
                               class="text-white">> Liste des centres de retrait</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/liste-centres-enrolement-et-distribution" ?>"
                               class="text-white">> Liste des centres mixtes (enrôlement + retrait)</a><br/>
                        </p>
                        <h6>Attestation d'identité</h6>
                        <p>
                            <a href="<?php echo $SUBSTR_URL_SLASH."attestation-identite" ?>" class="text-white">> Liste
                                des documents à fournir</a><br/>
                        </p>
                        <h6>Carte de résident</h6>
                        <p>
                            <a href="<?php echo $SUBSTR_URL_SLASH."carte-resident/documents-a-fournir" ?>"
                               class="text-white">> Liste des documents à fournir</a><br/>
                        </p>
                        <h6>Etat Civil</h6>
                        <p><a href="<?php echo $SUBSTR_URL_SLASH."etat-civil" ?>" class="text-white">> Informations sur
                                l'Etat civil</a></p>
                    </div>
                </div>
                <div class="one-fourth">
                </div>
                <div class="one-fourth">
                    <div class="widget">
                        <h3>Nos services</h3>
                        <h6>Identité</h6>
                        <p>
                            <a href="<?php echo $SUBSTR_URL_SLASH."service-vip" ?>" class="text-white">> Service VIP</a><br/>
                            <a href="https://rnpp.ci/voucher/index" class="text-white">> Achat du timbre
                                d'enrôlement</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/suivi-de-statut" ?>"
                               class="text-white">> Suivi du statut de la CNI</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/rechercher-cni-perdue" ?>"
                               class="text-white">> Rechercher une CNI perdue</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."carte-identite/declarer-cni-retrouvee" ?>"
                               class="text-white">> Déclarer une CNI retrouvée</a><br/>
                            <a href="https://statut.oneci.ci/numero-de-demande" class="text-white">> Je n'ai pas mon
                                numéro de demande</a><br/>
                            <a href="https://procuration.oneci.ci" class="text-white">> Initier un retrait spécial de
                                CNI</a><br/>
                        </p>
                        <h6>Authentification</h6>
                        <p>
                            <a href="<?php echo $SUBSTR_URL_SLASH."nos-services/service-authentification" ?>"
                               class="text-white">> Service Authentification</a><br/>
                            <a href="https://identite.oneci.ci/nni" class="text-white">> Initier une demande de numéro
                                NNI</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."nos-services/commande-de-tvi" ?>" class="text-white">>
                                Commander mon Terminal TVI</a><br/>
                        </p>
                        <h6>Réclamation</h6>
                        <p>
                            <a href="<?php echo $SUBSTR_URL_SLASH."nos-services/service-reclamation" ?>"
                               class="text-white">> Service Réclamation</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."nos-services/retard-de-production" ?>"
                               class="text-white">> Faire une réclamation de votre titre</a>
                        </p>
                    </div>
                </div>
                <div class="one-fourth">
                    <div class="widget">
                        <h3>Qui sommes-nous ?</h3>
                        <p>
                            <a href="<?php echo $SUBSTR_URL_SLASH."accueil" ?>" class="text-white">> Page
                                d'accueil</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."qui-sommes-nous" ?>" class="text-white">>
                                Présentation de l'ONECI</a>
                        </p>
                    </div>
                    <div class="widget">
                        <h3>Divers</h3>
                        <p>
                            <a href="<?php echo $SUBSTR_URL_SLASH; ?>"
                               class="text-white">> Actualités</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."documentation" ?>" class="text-white">>
                                Documentation</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."oneci-carriere" ?>" class="text-white">> ONECI
                                Carrière</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."mediatheque" ?>" class="text-white">> Médiathèque</a><br/>
                            <a href="<?php echo $SUBSTR_URL_SLASH."l-oneci-vous-ecoute" ?>" class="text-white">> L'ONECI
                                vous écoute</a>
                        </p>
                    </div>
                    <div class="widget">
                        <h3>Newsletter</h3>
                        <p>Abonnez-vous à notre Newsletter pour ne rien rater sur les actualités de l'ONECI.</p>
                        <div id="newsletter-notification-box-success" class="notification-box notification-box-success"
                             style="display: none;">
                            <p class="text-black">Vous venez de souscrire avec succès à notre newsletter.</p>
                            <a href="#" class="notification-close notification-close-success">x</a>
                        </div>
                        <div id="newsletter-notification-box-error" class="notification-box notification-box-error"
                             style="display: none;">
                            <p class="text-black">La souscription n'a pu être effectuée avec cette adresse mail à cause
                                d'une erreur interne. Veuillez réessayer plus tard SVP.</p>
                            <a href="#" class="notification-close notification-close-error">x</a>
                        </div>
                        <form id="newsletter-form" class="content-form" action="#" method="post">
                            <input id="newsletter" type="email" name="newsletter"
                                   placeholder="Entrez votre adresse mail ici&hellip;" class="required"
                                   style="width: 100%">
                            <button id="subscribe" class="button black" name="subscribe" style="width: 100%"><i
                                    class="fa fa-envelope text-white"></i> &nbsp; Souscrire à la newsletter
                            </button>
                            <!--<input id="subscribe" class="button" type="submit" name="subscribe" value="Souscrire à la newsletter">-->
                        </form>
                    </div>
                </div>
                <div class="one-fourth column-last">
                    <div class="widget contact-info">
                        <h3>Nous contacter</h3>
                        <div>
                            <i class="fa fa-mailbox"></i> &nbsp; <strong>Adresse Postale : </strong> &nbsp;BP V168
                            Abidjan 19, Boulevard Botreau Roussel, Abidjan-Plateau<br/><br/>
                            <i class="fa fa-phone"></i><strong> &nbsp; Téléphone : </strong> &nbsp;(+225) 27 20 30 79 00
                            / 27 20 25 45 59 <br/>
                            <i class="fa fa-phone-office"></i> &nbsp; <strong>Call Center : </strong> &nbsp;(+225) 27 20
                            23 96 60 / 27 20 30 79 40 / 1340<br/>
                            <i class="fa fa-fax"></i> &nbsp; <strong>Fax : </strong> &nbsp;(+225) 27 20 24 29
                            13<br/><br/>
                            <i class="fa fa-envelope"></i> &nbsp; </strong>standard_accueil@oneci.ci<br/><br/>
                            <i class="fa fa-calendar-check"></i> &nbsp; <strong>Horaires : </strong> &nbsp;08h00 à 12h00
                            / 13h00 à 17h00
                        </div>
                    </div>
                </div>
                <!--
                <div class="one-fourth">
                    <div class="widget">
                        <h3>Carte de résident</h3>
                        <p>
                            > Liste des documents à fournir<br/>
                            > Liste des centres de correction<br/>
                            > Liste des centres d'enrôlement<br/>
                            > Liste des centres de retrait<br/>
                            > Liste des centres mixtes (enrôlement + retrait)<br/>
                            > Suivi du statut de la carte nationale d'identité<br/>
                            > Service VIP CNI
                        </p>
                    </div>
                </div>
                <div class="one-fourth">
                    <div class="widget">
                        <h3>Text Widget</h3>
                        <p>Cras pretium elit quis nunc congue ut sollicitudin ante mattis. Nam cursus tellus vel libero pretium ut sagittis felis.</p>
                        <p>Etiam laoreet nisl a dolor convallis euismod. Nulla felis velit, elementum ut fringilla ac, tincidunt eu justo.</p>
                    </div>
                </div>
                <div class="one-fourth">
                    <div class="widget newsletter">
                        <h3>Newsletter</h3>
                        <p>Subscribe to our email newsletter for useful tips and valuable resources sent out every second Monday.</p>
                        <div id="newsletter-notification-box-success" class="notification-box notification-box-success" style="display: none;">
                            <p>You have successfully subscribed to our newsletter.</p>
                            <a href="#" class="notification-close notification-close-success">x</a>
                        </div>

                        <div id="newsletter-notification-box-error" class="notification-box notification-box-error" style="display: none;">
                            <p>Your email address couldn't be subscribed because a server error occurred. Please try again later.</p>
                            <a href="#" class="notification-close notification-close-error">x</a>
                        </div>
                        <form id="newsletter-form" class="content-form" action="#" method="post">
                            <input id="newsletter" type="email" name="newsletter" placeholder="Enter your email address &hellip;" class="required">
                            <input id="subscribe" class="button" type="submit" name="subscribe" value="Subscribe">
                        </form>
                    </div>
                </div>-->
            </div>
        </div>
        <!-- end footer top -->
        <!-- begin footer bottom -->
        <div id="footer-bottom">
            <div class="container clearfix">
                <div class="three-fourths">
                    <p>Copyright &copy; <?php echo date("Y", time()); ?> - Office National de l'Etat Civil et de
                        l'Identification (ONECI) - Tous droits reservés. </p>
                </div>
                <!--<div class="one-half column-last">
                    <ul class="social-links">
                        <li class="twitter"><a href="https://twitter.com/cote_oni" title="Twitter" target="_blank">Twitter</a></li>
                        <li class="facebook"><a href="https://web.facebook.com/ONICote/" title="Facebook" target="_blank">Facebook</a></li>
                        <li class="linkedin"><a href="https://www.linkedin.com/in/oni-côte-d-ivoire-oni-ci-626021156" title="LinkedIn" target="_blank">LinkedIn</a></li>
                        <li class="youtube"><a href="https://www.youtube.com/channel/UCMMd2MXCIP5BNOfW0lfUGOQ" title="YouTube" target="_blank">YouTube</a></li>
                    </ul>
                </div>-->
            </div>
        </div>
        <!-- end footer bottom -->
    </footer>
    <!-- end footer -->
    <?php } ?>
</div>
<!-- end container -->
<?php if ($routes[1] == "accueil") { ?>
<script src="{{ URL::asset('assets/js/jquery.flipper-responsive.js') }}"></script>
<script>
    jQuery(function ($) {
        jQuery('#myFlipper').flipper('init');
        jQuery('#modalFlipper').flipper('init');
    });
</script>
<?php } ?>
<?php if (isset($routes[2]) && ($routes[2] != "suivi-de-statut" || $routes[2] != "temporary23092020" || $routes[2] == "enrolement-vip" || $routes[2] == "service-vip-cni" || $routes[2] == "rechercher-cni-perdue" || $routes[2] == "demande-de-nni" || $routes[2] == "retard-de-production" || $routes[2] == "commande-de-tvi")) { ?>
<script src="{{ URL::asset('assets/js/select2.min.js') }}" type='text/javascript'></script>
<script>
    function count($this) {
        var current = parseInt($this.html(), 10);
        current = current + 1;
        $this.html(++current);
        if (current > $this.data('count')) {
            $this.html($this.data('count'));
        } else {
            setTimeout(function () {
                count($this)
            }, 1);
        }
    }

    jQuery(".stat-count").each(function () {
        jQuery(this).data('count', parseInt(jQuery(this).html(), 10));
        jQuery(this).html('0');
        count(jQuery(this));
    });
</script>
<?php } ?>
<?php if (isset($routes[2]) && ($routes[2] == "retrait-par-procuration" || $routes[2] == "retrait-de-cni-defunt" || $routes[2] == "retrait-de-cni-pour-personnes-vulnerables")) { ?>
<script src='https://www.google.com/recaptcha/api.js?render=6Le0UkweAAAAAO7QZXFPlJWyprDjUA-uxpT3DRIq'></script>
<script src="{{ URL::asset('assets/js/select2.min.js') }}" type='text/javascript'></script>
<script src="{{ URL::asset('assets/js/smart-wizard/jquery.smartWizard.min.js') }}"></script>
<script>
    jQuery('#smartwizard').smartWizard({
        selected: 0, /* Initial selected step, 0 = first step*/
        theme: 'arrows', /* theme for the wizard, related css need to include for other than default theme*/
        justified: true, /* Nav menu justification. true/false*/
        autoAdjustHeight: true, /* Automatically adjust content height*/
        backButtonSupport: true, /* Enable the back button support*/
        enableUrlHash: true, /* Enable selection of the step based on url hash*/
        transition: {
            animation: 'none', /* Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)*/
            speed: '400', /* Animation speed. Not used if animation is 'css'*/
            easing: '', /* Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'*/
            prefixCss: '', /* Only used if animation is 'css'. Animation CSS prefix*/
            fwdShowCss: '', /* Only used if animation is 'css'. Step show Animation CSS on forward direction*/
            fwdHideCss: '', /* Only used if animation is 'css'. Step hide Animation CSS on forward direction*/
            bckShowCss: '', /* Only used if animation is 'css'. Step show Animation CSS on backward direction*/
            bckHideCss: '', /* Only used if animation is 'css'. Step hide Animation CSS on backward direction*/
        },
        toolbar: {
            position: 'bottom', /* none|top|bottom|both*/
            showNextButton: true, /* show/hide a Next button*/
            showPreviousButton: true, /* show/hide a Previous button*/
            extraHtml: '' /* Extra html to show on toolbar*/
        },
        anchor: {
            enableNavigation: true, /* Enable/Disable anchor navigation*/
            enableNavigationAlways: false, /* Activates all anchors clickable always*/
            enableDoneState: true, /* Add done state on visited steps*/
            markPreviousStepsAsDone: true, /* When a step selected by url hash, all previous steps are marked done*/
            unDoneOnBackNavigation: false, /* While navigate back, done state will be cleared*/
            enableDoneStateNavigation: true /* Enable/Disable the done state navigation*/
        },
        keyboard: {
            keyNavigation: true, /* Enable/Disable keyboard navigation(left and right keys are used if enabled)*/
            keyLeft: [37], /* Left key code*/
            keyRight: [39] /* Right key code*/
        },
        lang: { /* Language variables for button*/
            next: 'Suivant >',
            previous: '< Précédent'
        },
        disabledSteps: [], /* Array Steps disabled*/
        errorSteps: [], /* Array Steps error*/
        warningSteps: [], /* Array Steps warning*/
        hiddenSteps: [], /* Hidden steps*/
        getContent: null /* Callback function for content loading*/
    });
    /*
    jQuery('#smartwizard').smartWizard({
        // Initial selected step, 0 = first step
        selected: 0,
        // 'arrows', 'square', 'round', 'dots'
        theme: 'arrows',
        // lang
        lang: {
            next:'Suivant >',
            previous:'< Précédent'
        },
        // Nav menu justification. true/false
        justified: true,
        // Automatically adjust content height
        autoAdjustHeight: true,
        // Show url hash based on step
        enableURLhash: true,
        // Enable the back button support
        backButtonSupport: true,
        // <a href="https://www.jqueryscript.net/animation/">Animation</a> options
        transition: {
            // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
            animation:'slideHorizontal',
            // Animation speed. Not used if animation is 'css'
            speed:'400',
            // Animation easing. Not supported without a jQuery easing plugin. Not used if animation is 'css'
            easing:'',
            // Only used if animation is 'css'. Animation CSS prefix
            prefixCss:'',
            // Only used if animation is 'css'. Step show Animation CSS on forward direction
            fwdShowCss:'',
            // Only used if animation is 'css'. Step hide Animation CSS on forward direction
            fwdHideCss:'',
            // Only used if animation is 'css'. Step show Animation CSS on backward direction
            bckShowCss:'',
            // Only used if animation is 'css'. Step hide Animation CSS on backward direction
            bckHideCss:'',
        }
    });
    */
    jQuery('.inputfile').each(function () {
        var $input = jQuery(this),
            $label = $input.next('label'),
            labelVal = $label.html();

        $input.on('change', function (e) {
            var fileName = '';

            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else if (e.target.value)
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                $label.find('span').html(fileName);
            else
                $label.html(labelVal);
        });

        /* Firefox bug fix */
        $input
            .on('focus', function () {
                $input.addClass('has-focus');
            })
            .on('blur', function () {
                $input.removeClass('has-focus');
            });
    });
</script>
<?php } ?>
<?php if ($routes[1] == "" || $routes[1] == "accueil") { ?>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<script src="{{ URL::asset('assets/js/jquery.counterup.min.js') }}" type='text/javascript'></script>
<script src="{{ URL::asset('assets/js/waypoints.min.js') }}" type='text/javascript'></script>
<?php } elseif ($routes[1] == "" || $routes[1] == "l-oneci-vous-ecoute" || ($routes[1] == "carte-identite") || ($routes[1] == "carte-resident") || ($routes[1] == "nos-services")) { ?>
    <?php if (isset($routes[2]) && ($routes[2] == "suivi-de-statut" || ($routes[2] == "service-vip-cni") || ($routes[2] == "service-vip-cr")) || ($routes[2] == "rechercher-cni-perdue") || ($routes[2] == "demande-de-nni") || ($routes[2] == "retard-de-production" || $routes[2] == "commande-de-tvi")) { ?>
<script src='https://www.google.com/recaptcha/api.js?render=6Le0UkweAAAAAO7QZXFPlJWyprDjUA-uxpT3DRIq'></script>
<script>
    grecaptcha.ready(function () {
        // do request for recaptcha token
        // response is promise with passed token
        grecaptcha.execute('6Le0UkweAAAAAO7QZXFPlJWyprDjUA-uxpT3DRIq', {action: 'validate_captcha'})
            .then(function (token) {
                // add token value to form
                document.getElementById('g-recaptcha-response').value = token;
            });
    });
    /* Initialize select2 */
    jQuery("#birth-place-input").select2();
    jQuery("#naf-code-input").select2();
    /*
    jQuery("#cptch-sbmt-btn").click(function () {
        var first_time = true;
        jQuery("#ctptch-frm-id").on("submit", function (event) {
            if (first_time) {
                first_time = false;
                event.preventDefault();

            }
        });
    });
    */
    /*function onSubmit(token) {
        document.getElementById("ctptch-frm-id").submit();
    }*/
</script>
<?php } ?>
<?php } if (isset($routes[2]) && ($routes[2] == "service-vip-cr")) { ?>
<script src="{{ URL::asset('assets/js/countrySelectCEDEAO.js') }}" type='text/javascript'></script>
<script language="JavaScript">
    jQuery("#country_selector").countrySelect({
        // defaultCountry: "jp",
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // responsiveDropdown: true,
        preferredCountries: ['fr', 'us', 'cn', 'ru', 'ca', 'gb', 'de']
    });
    jQuery("#country_selector").change(function () {
        var selected_country = this.value;
        console.log(selected_country);
        if (selected_country !== "France") {
            jQuery("#vip-block-1").hide();
        } else {
            jQuery("#vip-block-1").show();
        }
        jQuery("#checkboxSuccess_1").prop('checked', false);
    });
</script>
<?php } ?>
<script language="JavaScript">
    /* ONECI ChatBot Nouveau */
    /*(function(d, m){
        var kommunicateSettings =
            {
                "appId":"1eff44a7b90c1295ebdd46abe91fcdd87",
                "popupWidget":true,
                "automaticChatOpenOnNavigation":true,
                "voiceOutput":true,
                "voiceName":"Google français",
                "voiceRate":1
            };
        var s = document.createElement("script"); s.type = "text/javascript"; s.async = true;
        s.src = "https://widget.kommunicate.io/v2/kommunicate.app";
        var h = document.getElementsByTagName("head")[0]; h.appendChild(s);
        window.kommunicate = m; m._globals = kommunicateSettings;
    })(document, window.kommunicate || {});*/
    <?php if (isset($routes[2]) && ($routes[2] == "rechercher-cni-perdue" || ($routes[2] == "demande-de-nni") || ($routes[2] == "retard-de-production") || ($routes[2] == "commande-de-tvi"))) { ?>
    /* Retard de production Company or Individual CheckBox */
    jQuery('input[type="radio"]').click(function () {
        if (jQuery('#rp-status_1').is(':checked')) {
            jQuery('#company-name-field').attr("style", "display:none");
            jQuery("#company-name-input").removeAttr("required");
        }
        if (jQuery('#rp-status_2').is(':checked')) {
            jQuery('#company-name-field').attr("style", "");
            jQuery("#company-name-input").attr("required", "required");
        }
    });
    var flagme = 0;
    jQuery("#no-form-number").click(function () {
        if (flagme === 0) {
            jQuery("#no-form-number-text").text("Je connais mon numéro NNI");
            flagme++;
            jQuery("#form-number-field").attr("style", "display: none");
            jQuery("#first-name-field").attr("style", "");
            jQuery("#last-name-field").attr("style", "");
            jQuery("#birth-date-field").attr("style", "");
            jQuery("#birth-place-field").attr("style", "");
            jQuery("#form-nni-input").removeAttr("required");
            jQuery("#first-name-input").attr("required", "required");
            jQuery("#last-name-input").attr("required", "required");
            jQuery("#birth-date-input").attr("required", "required");
            jQuery("#birth-place-input").attr("required", "required");
            jQuery("#form-nni-input").val("");
            jQuery("#first-name-input").val("");
            jQuery("#last-name-input").val("");
            jQuery("#birth-date-input").val("");
            jQuery("#birth-place-input").val("");
            jQuery("#tsch-input").val("1");
        } else {
            jQuery("#no-form-number-text").text("J'ai oublié mon numéro NNI");
            flagme = 0;
            jQuery("#form-number-field").attr("style", "");
            jQuery("#first-name-field").attr("style", "display: none");
            jQuery("#last-name-field").attr("style", "display: none");
            jQuery("#birth-date-field").attr("style", "display: none");
            jQuery("#birth-place-field").attr("style", "display: none");
            jQuery("#form-nni-input").attr("required", "required");
            jQuery("#first-name-input").removeAttr("required");
            jQuery("#last-name-input").removeAttr("required");
            jQuery("#birth-date-input").removeAttr("required");
            jQuery("#birth-place-input").removeAttr("required");
            jQuery("#form-nni-input").val("");
            jQuery("#first-name-input").val("");
            jQuery("#last-name-input").val("");
            jQuery("#birth-date-input").val("");
            jQuery("#birth-place-input").val("");
            jQuery("#tsch-input").val("0");
        }
    });
    /*jQuery("#birth-date-input").datepicker({
        dateFormat : 'yy-mm-dd',
        changeMonth : true,
        changeYear : true,
        yearRange: '-100y:c+nn',
        maxDate: '-1d'
    });*/
    jQuery("#form-number-input").mask('99999999999');
    jQuery("#msisdn-input").mask('99 99 99 99 99');
    jQuery("#company-focal-point-msisdn-input").mask('99 99 99 99 99');
    <?php } ?>
    <?php if (isset($routes[2]) && ($routes[2] == "enrolement-vip" || $routes[2] == "service-vip-cni" || $routes[2] == "service-vip-cr")) { ?>
    /* VIP Enrolment */
    /* Appointment Calendar */
    natDays = [
        [1, 1, 'jan'], [4, 5, 'avr'],
        [5, 1, 'mai'], [5, 13, 'mai1'], [5, 24, 'mai2'],
        [8, 7, 'aou'], [8, 15, 'aou1'],
        [10, 19, 'oct'], [11, 1, 'nov'], [11, 15, 'nov1'], [12, 25, 'dec']
    ];

    function nationalDays(date) {
        for (i = 0; i < natDays.length; i++) {
            if (date.getMonth() == natDays[i][0] - 1
                && date.getDate() == natDays[i][1]) {
                return [false, natDays[i][2] + '_day'];
            }
        }
        return [true, ''];
    }

    function noWeekendsOrHolidays(date) {
        var noWeekend = $.datepicker.noWeekends(date);
        if (noWeekend[0]) {
            return nationalDays(date);
        } else {
            return noWeekend;
        }
    }

    var currdate = new Date();
    if (currdate.getHours() >= 15) {
        jQuery("#appointment-date-input-mod").datepicker({
            beforeShowDay: noWeekendsOrHolidays,
            minDate: 1,
            maxDate: "+365D",
            altField: "#datepicker",
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
            dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
            dayNamesMin: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
            weekHeader: 'Sem.',
            dateFormat: 'dd/mm/yy',
            onSelect: function (dateText, selObj) {
                var now = new Date();
                var curdate = now.getDate();
                var curhour = now.getHours();
                var finhour;
                if (selObj.selectedDay == curdate) {
                    for (var i = 8; i < curhour + 1; i++) {
                        valhour = (i < 10) ? "0" + i : "" + i + "";
                        jQuery("#hour-range option[value='" + (valhour) + ":00:00']").hide();
                    }
                    finhour = ((curhour + 1) < 10) ? "0" + (curhour + 1) : "" + (curhour + 1) + "";
                    jQuery("#hour-range option[value='" + (finhour) + ":00:00']").attr("selected", "selected");
                } else {
                    for (var i = 8; i < 15; i++) {
                        valhour = (i < 10) ? "0" + i : "" + i + "";
                        jQuery("#hour-range option[value='" + (valhour) + ":00:00']").show();
                    }
                    finhour = ((curhour + 1) < 10) ? "0" + (curhour + 1) : "" + (curhour + 1) + "";
                    jQuery("#hour-range option[value='" + (finhour) + ":00:00']").removeAttr("selected");
                    finhour = "08";
                    jQuery("#hour-range option[value='" + (finhour) + ":00:00']").attr("selected", "selected");
                }
                /* var pretty = [ now.getFullYear(), '-', now.getMonth() + 1, '-', now.getDate(), ' ', now.getHours(), ':', now.getMinutes(), ':', now.getSeconds()].join('');*/
            }
        });
    } else {
        jQuery("#appointment-date-input-mod").datepicker({
            beforeShowDay: noWeekendsOrHolidays,
            minDate: 0,
            maxDate: "+365D",
            altField: "#datepicker",
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
            dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
            dayNamesMin: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
            weekHeader: 'Sem.',
            dateFormat: 'dd/mm/yy',
            onSelect: function (dateText, selObj) {
                var now = new Date();
                var curdate = now.getDate();
                var curhour = now.getHours();
                var finhour;
                if (selObj.selectedDay == curdate) {
                    if (curhour >= 15) {
                        window.location.reload();
                    }
                    for (var i = 8; i < curhour + 1; i++) {
                        valhour = (i < 10) ? "0" + i : "" + i + "";
                        jQuery("#hour-range option[value='" + (valhour) + ":00:00']").hide();
                    }
                    finhour = ((curhour + 1) < 10) ? "0" + (curhour + 1) : "" + (curhour + 1) + "";
                    jQuery("#hour-range option[value='" + (finhour) + ":00:00']").attr("selected", "selected");
                } else {
                    for (var i = 8; i < 15; i++) {
                        valhour = (i < 10) ? "0" + i : "" + i + "";
                        jQuery("#hour-range option[value='" + (valhour) + ":00:00']").show();
                    }
                    finhour = ((curhour + 1) < 10) ? "0" + (curhour + 1) : "" + (curhour + 1) + "";
                    jQuery("#hour-range option[value='" + (finhour) + ":00:00']").removeAttr("selected");
                    finhour = "08";
                    jQuery("#hour-range option[value='" + (finhour) + ":00:00']").attr("selected", "selected");
                }
                /* var pretty = [ now.getFullYear(), '-', now.getMonth() + 1, '-', now.getDate(), ' ', now.getHours(), ':', now.getMinutes(), ':', now.getSeconds()].join('');*/
            }
        });
    }
    /* Appointment Modal Behavior */
    jQuery('#modalError').modal({
        escapeClose: false,
        clickClose: false,
        showClose: false
    });
    jQuery('#modalInfo').modal({
        escapeClose: false,
        clickClose: false,
        showClose: false
    });
    jQuery("#appointment-date-input-mod").keydown(function (event) {
        return false;
    });
    jQuery("#form-msisdn-input-mod").mask('99 99 99 99 99');
    /* VIP Content Display First time*/
    if (jQuery('#checkboxSuccess_1').is(':checked')) {
        jQuery('#vip-block-2').attr("style", "");
    }
    if (jQuery('#checkboxSuccess_2').is(':checked')) {
        jQuery('#vip-block-2').attr("style", "");
    }
    if (jQuery('#checkboxSuccess_3').is(':checked')) {
        jQuery('#vip-block-3').attr("style", "display:none");
        jQuery("#checkboxSuccess_5").removeAttr("required");
        jQuery("#checkboxSuccess_6").removeAttr("required");
    }
    if (jQuery('#checkboxSuccess_4').is(':checked')) {
        jQuery('#vip-block-3').attr("style", "");
        jQuery("#checkboxSuccess_5").attr("required", "required");
        jQuery("#checkboxSuccess_6").attr("required", "required");
    }
    /* VIP Content Display */
    jQuery('input[type="radio"]').click(function () {
        /*if(jQuery('#checkboxSuccess_1').is(':checked')) {
            window.location.href='https://statut.oneci.ci';
            return false;
        }*/
        if (jQuery('#checkboxSuccess_1').is(':checked')) {
            jQuery('#vip-block-2').attr("style", "");
        }
        if (jQuery('#checkboxSuccess_2').is(':checked')) {
            jQuery('#vip-block-2').attr("style", "");
        }
        if (jQuery('#checkboxSuccess_3').is(':checked')) {
            jQuery('#vip-block-3').attr("style", "display:none");
            jQuery("#checkboxSuccess_5").removeAttr("required");
            jQuery("#checkboxSuccess_6").removeAttr("required");
        }
        if (jQuery('#checkboxSuccess_4').is(':checked')) {
            jQuery('#vip-block-3').attr("style", "");
            jQuery("#checkboxSuccess_5").attr("required", "required");
            jQuery("#checkboxSuccess_6").attr("required", "required");
        }
    });
    <?php } ?>
    /* ---------------------------------------------------- */
    /* NOTE : Use web server to view HTML files as real-time update will not work if you directly open the HTML file in the browser. */
    <?php if (isset($routes[2]) && ($routes[2] == "suivi-de-statut" || $routes[2] == "temporary23092020")) { ?>
        <?php if (isset($_SESSION["CHECK_ID_STATUS"][0]) && $_SESSION["CHECK_ID_STATUS"][0] == 4) { ?>
    var flagwrap = 0;
    var rs = 0;
    var animatedTimer;

    function updateTime() {
        if (rs <= 0) {
            jQuery("#form-send-authcode-link").text("Cliquez ici pour recevoir un code par SMS");
            clearInterval(animatedTimer);
        } else {
            rs--;
            jQuery("#form-send-authcode-link").text("Réessayez dans " + Math.floor(rs / 60) + " : " + Math.floor(rs - (Math.floor(rs / 60) * 60)));
        }
    }

    jQuery("#location-change-btn").click(function () {
        if (flagwrap === 0) {
            jQuery("#location-change-container").removeAttr("style");
            jQuery("#location-change-btn").text("Annuler");
            flagwrap++;
        } else {
            jQuery("#location-change-container").attr("style", "display: none");
            jQuery("#location-change-btn").text("Changer de centre");
            flagwrap = 0;
        }
    });
    jQuery("#form-send-authcode-link").click(function () {
        if (jQuery("#form-send-authcode-link").text() == "Cliquez ici pour recevoir un code par SMS") {
            var msisdn = jQuery("#form-msisdn-input").val();
            if (msisdn.length < 11) {
                jQuery("#err-toast").text("Veuillez saisir un numéro de téléphone correct SVP");
                jQuery("#err-toast").attr("style", "color: red;font-style: italic;");
                setTimeout(function () {
                    jQuery("#err-toast").attr("style", "display: none");
                }, 3000);
            } else {
                if (msisdn.substring(0, 2) == "01" || msisdn.substring(0, 2) == "05" || msisdn.substring(0, 2) == "07") {
                    var cli = "ONECI.CI";
                    var vtkn = jQuery("#vtkn").val();
                    var rcp = jQuery("#rcp").val();
                    var msisdn = jQuery("#form-msisdn-input").val();
                    $.ajax({
                        url: "<?php echo $SUBSTR_URL_SLASH; ?>" + "cni-status-checker",
                        type: "POST",
                        data: {cli: cli, tn: vtkn, ins: "SEND_VCODE", rcp: rcp, msisdn: msisdn},
                        dataType: "json",
                        success: function (data) {
                            if (!data.error) {
                                jQuery("#err-toast").text("SMS envoyé avec succès au +225 " + msisdn).attr("style", "color: green;font-style: italic;");
                                setTimeout(function () {
                                    jQuery("#err-toast").attr("style", "display: none");
                                }, 10000);
                                rs = parseInt(data.remaining_sec);
                                animatedTimer = setInterval(updateTime, 1000);
                                jQuery("#form-send-authcode-link").text("Réessayez dans " + Math.floor(rs / 60) + " : " + Math.floor(rs - (Math.floor(rs / 60) * 60)));
                            } else {
                                jQuery("#err-toast").text(data.error_msg).attr("style", "color: red;font-style: italic;");
                                setTimeout(function () {
                                    jQuery("#err-toast").attr("style", "display: none");
                                }, 3000);
                                rs = parseInt(data.remaining_sec);
                                animatedTimer = setInterval(updateTime, 1000);
                                jQuery("#form-send-authcode-link").text("Réessayez dans " + Math.floor(rs / 60) + " : " + Math.floor(rs - (Math.floor(rs / 60) * 60)));
                            }
                        },
                        error: function () {
                            jQuery("#err-toast").text("Impossible de joindre le serveur, vérifiez votre connexion ou réessayez plus tard...").attr("style", "color: red;font-style: italic;");
                            setTimeout(function () {
                                jQuery("#err-toast").attr("style", "display: none");
                            }, 3000);
                        }
                    });
                } else {
                    jQuery("#err-toast").text("Le numéro de téléphone saisi est invalide").attr("style", "color: red;font-style: italic;");
                    setTimeout(function () {
                        jQuery("#err-toast").attr("style", "display: none");
                    }, 3000);
                }
            }
        }
    });
    jQuery("#form-msisdn-input").mask('99 99 99 99 99');
    jQuery("#form-authcode-input").mask('999999');
    /* Initialize select2 */
    jQuery("#center-slct-lst").select2();
    <?php } else if (isset($_SESSION["CHECK_ID_STATUS"][0]) && $_SESSION["CHECK_ID_STATUS"][0] == 5) { ?>
    var flagwrap = 0;
    var rs = 0;
    var animatedTimer;
    jQuery("#enroll-sys-container").removeAttr("style");
    jQuery("#enroll-sys-btn").text("Annuler");

    function updateTime() {
        if (rs <= 0) {
            jQuery("#form-send-authcode-link").text("Cliquez ici pour recevoir un code par SMS");
            clearInterval(animatedTimer);
        } else {
            rs--;
            jQuery("#form-send-authcode-link").text("Réessayez dans " + Math.floor(rs / 60) + " : " + Math.floor(rs - (Math.floor(rs / 60) * 60)));
        }
    }

    jQuery("#enroll-sys-btn").click(function () {
        if (flagwrap === 0) {
            jQuery("#enroll-sys-container").removeAttr("style");
            jQuery("#enroll-sys-btn").text("Annuler");
            flagwrap++;
        } else {
            jQuery("#enroll-sys-container").attr("style", "display: none");
            jQuery("#enroll-sys-btn").text("Obtenir le code");
            flagwrap = 0;
        }
    });
    jQuery("#enroll-sys-modal-lnk").click(function () {
        flagwrap = 0;
        jQuery("#enroll-sys-container").removeAttr("style");
        jQuery("#enroll-sys-btn").text("Annuler");
        flagwrap++;
    });
    jQuery("#form-send-authcode-link").click(function () {
        if (jQuery("#form-send-authcode-link").text() == "Cliquez ici pour recevoir un code par SMS") {
            var msisdn = jQuery("#form-msisdn-input-mod").val();
            var birthdate = jQuery("#birth-date-input-mod").val();
            var birthdateFormatted = new Date(birthdate);
            var today = new Date();
            if (birthdateFormatted > today) {
                jQuery("#err-toast").text("La date de naissance saisie est incorrecte").attr("style", "color: red;font-style: italic;");
                setTimeout(function () {
                    jQuery("#err-toast").attr("style", "display: none");
                }, 3000);
            } else {
                if (msisdn.length < 11) {
                    jQuery("#err-toast").text("Veuillez saisir un numéro de téléphone correct SVP");
                    jQuery("#err-toast").attr("style", "color: red;font-style: italic;");
                    setTimeout(function () {
                        jQuery("#err-toast").attr("style", "display: none");
                    }, 3000);
                } else {
                    if (msisdn.substring(0, 2) == "01" || msisdn.substring(0, 2) == "05" || msisdn.substring(0, 2) == "07") {
                        var cli = "ONECI.CI";
                        var vtkn = jQuery("#vtkn").val();
                        var rcp = jQuery("#rcp").val();
                        var msisdn = jQuery("#form-msisdn-input-mod").val();
                        $.ajax({
                            url: "<?php echo $SUBSTR_URL_SLASH; ?>" + "cni-status-checker",
                            type: "POST",
                            data: {cli: cli, tn: vtkn, ins: "SEND_VCODE_ENROLL", rcp: rcp, msisdn: msisdn},
                            dataType: "json",
                            success: function (data) {
                                if (!data.error) {
                                    jQuery("#err-toast").text("SMS envoyé avec succès au +225 " + msisdn).attr("style", "color: green;font-style: italic;");
                                    setTimeout(function () {
                                        jQuery("#err-toast").attr("style", "display: none");
                                    }, 10000);
                                    rs = parseInt(data.remaining_sec);
                                    animatedTimer = setInterval(updateTime, 1000);
                                    jQuery("#form-send-authcode-link").text("Réessayez dans " + Math.floor(rs / 60) + " : " + Math.floor(rs - (Math.floor(rs / 60) * 60)));
                                } else {
                                    jQuery("#err-toast").text(data.error_msg).attr("style", "color: red;font-style: italic;");
                                    setTimeout(function () {
                                        jQuery("#err-toast").attr("style", "display: none");
                                    }, 3000);
                                    rs = parseInt(data.remaining_sec);
                                    animatedTimer = setInterval(updateTime, 1000);
                                    jQuery("#form-send-authcode-link").text("Réessayez dans " + Math.floor(rs / 60) + " : " + Math.floor(rs - (Math.floor(rs / 60) * 60)));
                                }
                            },
                            error: function () {
                                jQuery("#err-toast").text("Impossible de joindre le serveur, vérifiez votre connexion ou réessayez plus tard...").attr("style", "color: red;font-style: italic;");
                                setTimeout(function () {
                                    jQuery("#err-toast").attr("style", "display: none");
                                }, 3000);
                            }
                        });
                    } else {
                        jQuery("#err-toast").text("Le numéro de téléphone saisi est invalide").attr("style", "color: red;font-style: italic;");
                        setTimeout(function () {
                            jQuery("#err-toast").attr("style", "display: none");
                        }, 3000);
                    }
                }
            }
        }
    });
    jQuery("#form-msisdn-input").mask('99 99 99 99 99');
    jQuery("#form-msisdn-input-mod").mask('99 99 99 99 99');
    jQuery("#form-authcode-input").mask('999999');
    jQuery("#form-authcode-input-mod").mask('999999');
    <?php } else if (isset($_SESSION["CHECK_ID_STATUS"][0]) && $_SESSION["CHECK_ID_STATUS"][0] == 7) { ?>
    /* Appointment Calendar */
    natDays = [
        [1, 1, 'jan'], [4, 5, 'avr'],
        [5, 1, 'mai'], [5, 13, 'mai1'], [5, 24, 'mai2'],
        [8, 7, 'aou'], [8, 15, 'aou1'],
        [10, 19, 'oct'], [11, 1, 'nov'], [11, 15, 'nov1'], [12, 25, 'dec']
    ];

    function nationalDays(date) {
        for (i = 0; i < natDays.length; i++) {
            if (date.getMonth() == natDays[i][0] - 1
                && date.getDate() == natDays[i][1]) {
                return [false, natDays[i][2] + '_day'];
            }
        }
        return [true, ''];
    }

    function noWeekendsOrHolidays(date) {
        var noWeekend = $.datepicker.noWeekends(date);
        if (noWeekend[0]) {
            return nationalDays(date);
        } else {
            return noWeekend;
        }
    }

    jQuery("#appointment-date-input-mod").datepicker({
        beforeShowDay: noWeekendsOrHolidays,
        minDate: 3,
        maxDate: "+365D",
        altField: "#datepicker",
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        weekHeader: 'Sem.',
        dateFormat: 'dd/mm/yy'
    });
    /* Appointment Modal Behavior */
    var flagwrap = 0;
    jQuery("#appointment-appliance-btn").click(function () {
        if (flagwrap === 0) {
            jQuery("#appointment-appliance-container").removeAttr("style");
            jQuery("#appointment-appliance-btn").text("Annuler");
            flagwrap++;
        } else {
            jQuery("#appointment-appliance-container").attr("style", "display: none");
            jQuery("#appointment-appliance-btn").text("Prendre un rendez-vous de retrait CNI");
            flagwrap = 0;
        }
    });
    jQuery("#appointment-appliance-lnk").click(function () {
        flagwrap = 0;
        jQuery("#appointment-appliance-container").removeAttr("style");
        jQuery("#appointment-appliance-btn").text("Annuler");
        flagwrap++;
    });
    jQuery("#appointment-date-input-mod").keydown(function (event) {
        return false;
    });
    jQuery("#form-msisdn-input-mod").mask('99 99 99 99 99');
    <?php } ?>
        <?php unset($_SESSION['CHECK_ID_STATUS']); ?>
    jQuery("#form-number-input").mask('99999999999');
    jQuery("#form-number-input-mod").mask('99999999999');
    jQuery('#modalSuccess').modal({
        escapeClose: false,
        clickClose: false,
        showClose: false
    });
    jQuery('#modalSuccess2').modal({
        escapeClose: false,
        clickClose: false,
        showClose: false
    });
    jQuery('#modalInfo').modal({
        escapeClose: false,
        clickClose: false,
        showClose: false
    });
    jQuery('#modalWarning').modal({
        escapeClose: false,
        clickClose: false,
        showClose: false
    });
    jQuery('#modalError').modal({
        escapeClose: false,
        clickClose: false,
        showClose: false
    });
    <?php } ?>
    jQuery(document).ready(function () {
        /*var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-1965499-1']);
        _gaq.push(['_trackPageview']);
        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();*/
        <?php if ($routes[1] == "" || $routes[1] == "accueil") { ?>
        window.setInterval(function (color) {
            if (jQuery("#flash-news-btn").attr("style") !== "background-color: #f44336") {
                jQuery("#link-rnpp").attr("style", "background-color: #f44336");
                jQuery("#flash-news").attr("style", "border: solid 0.2em red; box-shadow: 0px 0px 7px rgba(255, 0, 0, 1);");
                jQuery("#flash-news-btn").attr("style", "background-color: #f44336");
            } else {
                jQuery("#link-rnpp").attr("style", "background-color: #388E3C");
                jQuery("#flash-news").attr("style", "border: solid 0.2em #388E3C; box-shadow: 0px 0px 7px rgba(56, 142, 60, 1);");
                jQuery("#flash-news-btn").attr("style", "background-color: #388E3C");
            }
            if (jQuery("#report-btn").attr("style") !== "background-color: #f44336; display: inline-block") {
                jQuery("#report-btn").attr("style", "background-color: #f44336; display: inline-block");
            } else {
                jQuery("#report-btn").attr("style", "background-color: #388E3C; display: inline-block");
            }
        }, 300);
        /*var loopClicker;

        function loopClickerStart() {
            loopClicker = setInterval(function () {
                jQuery(".jcarousel-next-horizontal").click();
            }, 1000);
        }

        function loopClickerStop() {
            clearInterval(timer);
        }*/
        setInterval(function () {
            var temp = jQuery("#s").css("display"); /*jQuery("#s").attr("style");*/
            if (jQuery('a:hover').length === 0 && jQuery("#s").css("display") == "none") {
                jQuery(".jcarousel-next-horizontal").click();
            }
        }, 3000);
        /*setInterval(function () {
            if ( jQuery('a:hover').length === 0 ) {
                jQuery(".jcarousel-next-horizontal").click();
            }
        }, 3000);*/
        <?php } ?>


        <?php if (isset($routes[2]) && ($routes[2] == "suivi-de-statut" || $routes[2] == "temporary23092020")) { ?>

        var flagme = 0;
        jQuery('input[type="radio"]').click(function () {
            /*if(jQuery('#checkboxSuccess_1').is(':checked')) {
                window.location.href='https://statut.oneci.ci';
                return false;
            }*/
            if (jQuery('#checkboxSuccess_1').is(':checked')) {
                jQuery('#no-form-number').attr("style", "display: none");
                jQuery("#no-form-number-text").text("Je n'ai pas mon numéro de récépissé d'enrôlement");
                jQuery("#form-number-field").attr("style", "");
                jQuery('#first-last-name-field').attr("style", "");  /* Recherche nom et prenoms */
                jQuery("#first-name-field").attr("style", "display: none");
                jQuery("#last-name-field").attr("style", "display: none");
                jQuery("#birth-date-field").attr("style", "display: none");
                jQuery("#form-number-input").attr("required", "required");
                jQuery('#first-last-name-field').attr("required", "required");  /* Recherche nom et prenoms */
                jQuery("#first-name-input").removeAttr("required");
                jQuery("#last-name-input").removeAttr("required");
                jQuery("#birth-date-input").removeAttr("required");
                jQuery("#form-number-input").val("");
                jQuery("#first-name-input").val("");
                jQuery("#last-name-input").val("");
                jQuery("#birth-date-input").val("");
                jQuery("#tsch-input").val("0");
            }
            if (jQuery('#checkboxSuccess_2').is(':checked')) {
                jQuery('#no-form-number').attr("style", "margin-bottom: 2.5em;");
                if (flagme === 0) {
                    jQuery("#no-form-number-text").text("Je n'ai pas mon numéro de récépissé d'enrôlement");
                    jQuery("#form-number-field").attr("style", "");
                    jQuery('#first-last-name-field').attr("style", "display: none");  /* Recherche nom et prenoms */
                    jQuery("#first-name-field").attr("style", "display: none");
                    jQuery("#last-name-field").attr("style", "display: none");
                    jQuery("#birth-date-field").attr("style", "display: none");
                    jQuery("#form-number-input").attr("required", "required");
                    jQuery('#first-last-name-input').removeAttr("required");  /* Recherche nom et prenoms */
                    jQuery("#first-name-input").removeAttr("required");
                    jQuery("#last-name-input").removeAttr("required");
                    jQuery("#birth-date-input").removeAttr("required");
                    jQuery("#form-number-input").val("");
                    jQuery("#first-name-input").val("");
                    jQuery("#last-name-input").val("");
                    jQuery("#birth-date-input").val("");
                    jQuery("#tsch-input").val("0");
                } else {
                    jQuery("#no-form-number-text").text("Je suis en possession de mon numéro de récépissé d'enrôlement");
                    jQuery("#form-number-field").attr("style", "display: none");
                    jQuery('#first-last-name-field').attr("style", "display: none"); /* Recherche nom et prenoms */
                    jQuery("#first-name-field").attr("style", "");
                    jQuery("#last-name-field").attr("style", "");
                    jQuery("#birth-date-field").attr("style", "");
                    jQuery("#form-number-input").removeAttr("required");
                    jQuery('#first-last-name-input').removeAttr("required");  /* Recherche nom et prenoms */
                    jQuery("#first-name-input").attr("required", "required");
                    jQuery("#last-name-input").attr("required", "required");
                    jQuery("#birth-date-input").attr("required", "required");
                    jQuery("#form-number-input").val("");
                    jQuery("#first-name-input").val("");
                    jQuery("#last-name-input").val("");
                    jQuery("#birth-date-input").val("");
                    jQuery("#tsch-input").val("1");
                }
            }
        });
        jQuery("#no-form-number").click(function () {
            if (flagme === 0) {
                jQuery("#no-form-number-text").text("Je suis en possession de mon numéro de récépissé d'enrôlement");
                flagme++;
                jQuery("#form-number-field").attr("style", "display: none");
                jQuery("#first-name-field").attr("style", "");
                jQuery("#last-name-field").attr("style", "");
                jQuery("#birth-date-field").attr("style", "");
                jQuery("#form-number-input").removeAttr("required");
                jQuery("#first-name-input").attr("required", "required");
                jQuery("#last-name-input").attr("required", "required");
                jQuery("#birth-date-input").attr("required", "required");
                jQuery("#form-number-input").val("");
                jQuery("#first-name-input").val("");
                jQuery("#last-name-input").val("");
                jQuery("#birth-date-input").val("");
                jQuery("#tsch-input").val("1");
            } else {
                jQuery("#no-form-number-text").text("Je n'ai pas mon numéro de récépissé d'enrôlement");
                flagme = 0;
                jQuery("#form-number-field").attr("style", "");
                jQuery("#first-name-field").attr("style", "display: none");
                jQuery("#last-name-field").attr("style", "display: none");
                jQuery("#birth-date-field").attr("style", "display: none");
                jQuery("#form-number-input").attr("required", "required");
                jQuery("#first-name-input").removeAttr("required");
                jQuery("#last-name-input").removeAttr("required");
                jQuery("#birth-date-input").removeAttr("required");
                jQuery("#form-number-input").val("");
                jQuery("#first-name-input").val("");
                jQuery("#last-name-input").val("");
                jQuery("#birth-date-input").val("");
                jQuery("#tsch-input").val("0");
            }
        });

        /*jQuery("#birth-date-input").datepicker({
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });*/

        /*jQuery("#birth-date-input").mask('00/00/0000');*/

        <?php } ?>

    });
</script>
<script src="{{ URL::asset('assets/js/modern-navbar.js') }}"></script>
</body>
</html>
