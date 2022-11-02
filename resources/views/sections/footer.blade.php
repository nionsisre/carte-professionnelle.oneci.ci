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
        </div>
    </div>
    <!-- end footer bottom -->
</footer>
<!-- end footer -->
<?php } ?>
