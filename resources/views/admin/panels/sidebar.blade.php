<div class="leftpanelinner">

    <h5 class="sidebartitle" style="margin-top: -30px;">Menu principal</h5>
    <ul class="nav nav-pills nav-stacked nav-bracket">
        <li @if(\Route::is('admin.home')) class="active" @endif>
            <a href="{{ route('admin.home') }}">
                <i class="fa fa-home"></i> <span>Accueil</span>
            </a>
        </li>
        <li @if(\Route::is('admin.certificat')) class="active" @endif>
            <a href="{{ route('admin.certificat') }}">
                <i class="fa fa-tasks"></i> <span>Traiter les demandes de certificat de conformité @if(\Route::is('admin.home') && $nombre_demandes_non_traitees != 0)<span class="pull-right badge badge-danger">{{ $nombre_demandes_non_traitees }}</span>@endif</span>
            </a>
        </li>
    </ul>

    <h5 class="sidebartitle">Options du compte</h5>
    <ul class="nav nav-pills nav-stacked nav-bracket">
        <li @if(\Route::is('admin.auth.login')) class="active" @endif><a href="{{ route('admin.auth.login') }}"><i class="fa fa-sign-out-alt"></i> <span>Déconnexion</span></a></li>
    </ul>
</div><!-- leftpanelinner -->
