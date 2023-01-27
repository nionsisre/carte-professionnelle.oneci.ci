@extends('admin/main')


<style>
    .btn-download {
        border: 1px solid gray;
        border-radius: 4px;
        font-size: 1rem;
        font-weight: 400;
        color: #212529;
        text-align: left;
        height: 38px;
        margin-right: 0;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 10px;
        opacity: 0;
    }
</style>
@yield('css')

@section('content')

    <div class="card">
        <div class="card-header text-center"
             style="font-style: italic;color : white;
        background-color: green">
            <h5>IMPORTATIONS DES ABONNES</h5>
        </div>
        <div class="card-body">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

            <form action="{{route('rapport.import')}}" method="post" class="form-group" style="margin-left: 250px" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">

{{--                    <div class="form-inline col-md-2">--}}
{{--                        <select id="inputState" name="operateur" class="form-control col" html-required="true">--}}
{{--                            <option disabled selected hidden>Choix Opérateur</option>--}}
{{--                            <option value="1">Orange CI </option>--}}
{{--                            <option value="2">MTN CI</option>--}}
{{--                            <option value="3">Moov Africa</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <div class="form-inline col-md-4" >
                        <div class="custom-file">
                            <input id="logo" type="file" class="custom-file-input" name="fichier" autocomplete=off required>
                            <label for="logo" class="custom-file-label text-truncate" style="padding-right: 55px;">Télécharger Fichier</label>
                        </div>
                    </div>
                    <div class="form-inline col-md-8">
{{--                        <input type="date" class="form-control" name="date" autocomplete=off required>&nbsp;&nbsp;--}}
                        <button type="submit" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Importer</button>
                        <a class="input-group-btn btn btn-primary" href="{{ route('abonnees.importation') }}" style="margin-left: 10px">
                            <span class="fa fa-sign"></span>&nbsp;&nbsp;Rafraichir
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(Session::has('cles'))
    <div class="card" style="margin-top: 15px">
        <div class="card-header text-center" style="font-style: italic;color : white;background-color: #dc3a41">
            <h5>LISTE DES ABONNES N'EXISTANT PAS EN BASE</h5>
        </div>
        <div class="card-body">
{{--            <form action="#" method="post" class="form-group">--}}
{{--                @csrf--}}
{{--                <div class="row ">--}}
{{--                    <div class="col-md-3 offset-md-9">--}}
{{--                        <button class="input-group-btn btn btn-success" type="submit" style="margin-left: 10px">--}}
{{--                            <span class="fa fa-file-excel"></span>&nbsp;&nbsp;Export-Excel--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}

            <table class="table table-striped table-bordered table-responsive" style="width:100%; margin-top: 80px; margin-bottom: 50px"id="datatable" >
                <thead>
                <tr>
                    <th>Operateur</th>
                    <th>N°Télephone</th>
                    <th>N°Dossier</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Date de Naissance</th>
                    <th>Lieu de  Naissance</th>
                    <th>Nationalité</th>
                    <th>Genre</th>
                    <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                @foreach(Session::get('cles') as $cle)
                    <tr>
                        <td>{{ $cle["operateur"] }}</td>
                        <td>{{ $cle["ntelephone"] }}</td>
                        <td>{{ $cle["ndossier"] }}</td>
                        <td>{{ $cle["nom"] }}</td>
                        <td>{{ $cle["prenoms"] }}</td>
                        <td>{{ $cle["date_de_naissance"] }}</td>
                        <td>{{ $cle["lieu_de_naissance"] }}</td>
                        <td>{{ $cle["nationalite"] }}</td>
                        <td>{{ $cle["genre"] }}</td>
                        <td>{{ $cle["statut"] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
@endsection
