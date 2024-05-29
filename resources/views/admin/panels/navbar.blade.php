<div class="headerbar">

    <a class="menutoggle"><i class="fa fa-bars"></i></a>

    <form class="searchform" autocomplete="off" action="{{ route('admin.home') }}" method="post">
        <input type="text" class="form-control" id="menu-search" name="keyword" placeholder="Rechercher la rubrique..." onkeypress="searchMenuDisplay()" />
    </form>

    <div class="header-right">
        <ul class="headermenu">

            <li>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="padding-left: 1.5em;padding-right: 2em;padding-top: 0.3em;padding-bottom: 0.3em;">
                        <div class="session-badge">
                            <span class="caret" style="float: right;margin-top: 1.1em;margin-left: 1.8em;margin-right: 0em;"></span>
                            <div class="user-name-role-badge">
                                <b><span class="user-name-badge">{{ $username }}</span></b><br/>
                                <span>{{ $role_name }}</span>
                            </div>
                            <i class="unknown-user-icon-badge fa fa-user-circle"></i>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <li><a href="{{ route('admin.auth.login') }}"><i class="fa fa-sign-out-alt mr10"></i> Déconnexion</a></li>
                    </ul>
                </div>
            </li>

        </ul>
    </div><!-- header-right -->

</div><!-- headerbar -->
