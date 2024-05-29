@extends('admin.layouts.auth-app')


@section('content')
    <section>

        <div class="signinpanel" style="background-color: rgba(153,153,153, 0.05);backdrop-filter: blur(1.2px);padding: 3.5em;border-radius: 0.4em; border-style: solid; border-width: 0.1em; border-color: #ccc">

            <div class="row">

                <div class="col-md-6">

                    <div class="signin-info">
                        <div class="logopanel">
                            <h1><span><img src="{{ URL::asset('back-office/assets/images/oneci_logo.svg') }}" alt="" style="width: 3em;"/></span></h1>
                        </div><!-- logopanel -->
                        <div class="mb20"></div>
                        <h5><strong style="font-family: Poppins; font-size: 0.9em"><b>Back Office de la plateforme de demande de Certificat de Conformité </b></strong></h5>
                        <div class="mb20"></div>
                    </div><!-- signin0-info -->

                </div><!-- col-sm-7 -->

                <div class="col-md-6">

                    <form method="post" action="{{ route('admin.auth.login.submit') }}">
                        <h4 class="nomargin">Qui êtes-vous ?</h4>
                        <p class="mt5 mb20">Veuillez saisir vos identifiants Kernel ci-dessous :</p>
                        @if(session()->has('error') && session()->get('error') || $errors->any())
                            <div id="error-msg">
                                <small style="color: #d9534f">
                                    <b>
                                        @if(session()->has('error') && session()->get('error'))
                                            <i class="fa fa-hand-paper fa-flip-horizontal"></i> &nbsp; {{ session()->get('error_message') }}
                                        @elseif($errors->any())
                                            <i class="fa fa-hand-paper fa-flip-horizontal"></i> &nbsp; {{ $errors->first() }}
                                        @endif
                                    </b>
                                </small>
                            </div>
                        @endif
                        {{ csrf_field() }}
                        <input type="hidden" name="context" value="authentication"/>
                        <input type="text" name="username_or_email" class="form-control uname" placeholder="Identifiant ou Adresse Mail ONECI" style="padding: 10px 38px 10px 10px;" required />
                        <input type="password" name="password" class="form-control pword" placeholder="Mot de passe" style="padding: 10px 38px 10px 10px;" required />
                        <!--<a href="{{ route('admin.auth.password.forgot') }}"><small><i class="fa fa-question-circle mr5"></i>J'ai oublié mon mot de passe...</small></a>-->
                        <button class="btn btn-success btn-block"><i class="fa fa-sign-in"></i> &nbsp; Entrer</button>

                    </form>
                </div><!-- col-sm-5 -->

            </div><!-- row -->

            <div class="signup-footer">
                <div class="pull-left" style="color: #d9534f">
                    <i class="fa fa-do-not-enter mr5"></i>
                    Accès strictement interdit à toute personne non autorisée
                </div>
                <!--<div class="pull-right">
                    &copy; Copyright 2018, tous droits reservés.
                </div>-->
            </div>

        </div><!-- signin -->

    </section>
@endsection
