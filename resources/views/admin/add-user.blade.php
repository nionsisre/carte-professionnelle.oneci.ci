@extends('admin/layout')
@section('content')

    <div class="card">
        <div class="card-header text-center"
             style="font-style: italic;color : white;
        background-color: green">
            <h5>AJOUTER UN UTILISATEUR</h5>
        </div>
        <div class="card-body">
            @if(session()->has('info'))
                <div class="alert alert-success text-center" role="alert">
                    {!! session('info')  !!}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif
            <form class="needs-validation" action="{{route('add.user')}}" method="post" novalidate>
                @csrf
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prénom" required>

                        <div class="invalid-feedback">Valeur incorrecte</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="nom">Nom </label>
                        <input type="text" class="form-control" id="nom"  name="name" placeholder="nom" required>

                        <div class="invalid-feedback">Valeur incorrecte</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="pseudo">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="j.email@oneci.ci" required>
                        <div class="invalid-feedback">Valeur incorrecte</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="ville">Login</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="login" required>
                        <div class="invalid-feedback">Valeur incorrecte</div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="ville">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="mot de passe" required>
                        <div class="invalid-feedback">Valeur incorrecte</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="pays">Direction</label>
                        <input type="text" class="form-control" id="direction" name="direction" placeholder="direction" required>

                        <div class="invalid-feedback">Valeur incorrecte</div>
                    </div>

                </div>

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="cp">Service</label>
                        <input type="text" class="form-control" id="service" name="service" placeholder="service" required>

                        <div class="invalid-feedback">Valeur incorrecte</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="ville">Fonction</label>
                        <input type="text" class="form-control" id="fonction" name="fonction" placeholder="fonction" required>

                        <div class="invalid-feedback">Valeur incorrecte</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="pays">Role</label>
                        <select id="inputState" name="role" class="form-control col" required>
                            <option disabled selected hidden>choisir un rôle...</option>
                            <option value="admin">Admin</option>
                            <option value="validateur">Validateur</option>
                            <option value="verificateur">Verificateur</option>
                            <option value="distributeur">Distributeur</option>
                        </select>
                        <div class="invalid-feedback">Valeur incorrecte</div>
                    </div>
                </div>

                <a class="btn btn-danger" href="{{ route('setting') }}" >Annuler</a>
                <button class="btn btn-primary" type="submit">Valider</button>
            </form>

        </div>
    </div>

@endsection
@section('script')
    <script>
        /*La fonction principale de ce script est d'empêcher l'envoi du formulaire si un champ a été mal rempli
         *et d'appliquer les styles de validation aux différents éléments de formulaire*/
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                let forms = document.getElementsByClassName('needs-validation');
                let validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
