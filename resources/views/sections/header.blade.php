<nav class="navbar">
    <div class="brand-and-icon">
        <h1><a href="https://www.oneci.ci" class="navbar-brand"><img
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
