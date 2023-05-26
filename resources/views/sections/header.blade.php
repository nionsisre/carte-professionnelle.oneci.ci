@if(!$mobile_header_enabled)
<nav class="navbar">
    <div class="brand-and-icon">
        <h1><a href="https://www.oneci.ci" class="navbar-brand"><img
                    src="{{ URL::asset('assets/images/oneci_logo.svg') }}"
                    alt="Logo ONECI"
                    style="width: 2.7em; margin-top: 0.4em"/></a></h1>
        <button type="button" class="navbar-toggler">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="navbar-collapse">
        <ul class="navbar-nav">
            <li>
                <a href="https://www.oneci.ci/accueil">Accueil</a>
            </li>
            <!--<li>
                <a href="{{ route('pre_identification_abonnes_mobile') }}">Pré-identification</a>
            </li>-->
            <li>
                <a href="{{ route('accueil') }}">Identification</a>
            </li>
            <li>
                <a href="{{ route('consultation_statut_identification') }}">Consultation</a>
            </li>
            <!--<li>
                <a href="https://www.oneci.ci/qui-sommes-nous">Qui sommes-nous ?</a>
            </li>
            <li>
                <a href="https://www.oneci.ci/contacts">Contacts</a>
            </li>-->
        </ul>
    </div>
</nav>
@endif
