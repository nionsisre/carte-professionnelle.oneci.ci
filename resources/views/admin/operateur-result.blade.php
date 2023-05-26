@extends('admin/main')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="alert alert-dark" style="font-style: italic;color : white;
        background-color: black">
                <center>
                    <h5>EXPORTATION DES ABONNES</h5>
                </center>

            </div>
        </div>
    </div>
            <form action="{{route('rapport.export')}}" method="post" class="form-group">
                @csrf
                <div class="row ">
                    <div class="col-md-3 offset-md-9">
                        <a class="input-group-btn btn btn-primary" href="{{ route('abonnees.exportation') }}" style="float: right">
                            <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;Retour
                        </a>

{{--                        <button class="input-group-btn btn btn-success" type="submit" style="margin-left: 10px">--}}
{{--                            <span class="glyphicon glyphicon-export"></span>&nbsp;&nbsp;Export-Excel--}}
{{--                        </button>--}}
                    </div>
                </div>
            </form>
{{--            @if($operateurs != null)--}}
            <table class="table table-striped table-bordered " id="datatable" >
                <thead>
                <tr>
                    <th>Date Enregistrement</th>
                    <th>Date Validation</th>
                    <th>Operateur</th>
                    <th>N°Télephone</th>
                    <th>N°Dossier</th>
                    <th>N°Document</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Epouse</th>
                    <th>Date de Naissance</th>
                    <th>Lieu de  Naissance</th>
                    <th>Nationalité</th>
                    <th>Type de piéce</th>
                    <th>Document</th>
                    <th>Genre</th>
                    <th>Statut</th>

                </tr>
                </thead>
                <tbody>
                @foreach($operateurs as $operateur)
                <tr>
                    <td>{{date('d-m-Y',strtotime($operateur->created_at))}}</td>
                    <td>{{$operateur->date_validation}}</td>
                    <td>{{$operateur->libelle_operateur}}</td>
                    <td>{{preg_replace("/\s+/","",$operateur->numero_de_telephone)}}</td>
                    <td>{{$operateur->numero_dossier}}</td>
                    <td>{{$operateur->numero_document}}</td>
                    <td>{{$operateur->nom}}</td>
                    <td>{{ $operateur->prenoms}}</td>
                    <td>{{ $operateur->nom_epouse}}</td>
                    <td>{{ date('d-m-Y',strtotime($operateur->date_de_naissance))}}</td>
                    <td>{{ $operateur->lieu_de_naissance}}</td>
                    <td>{{ $operateur->nationalite}}</td>
                    <td>{{ $operateur->type_cni}}</td>
                    <td>
                        @if($operateur->document_justificatif)
                            <a target="_blank" href="{{ asset('storage/'.$operateur->document_justificatif) }}">
                                <img src="{{ asset('storage/'.$operateur->document_justificatif) }}" alt="document justificatif" width="50" height="50">
                            </a>
                        @else
                            <p>Aucun document</p>
                        @endif
                    </td>
                    <td>{{ $operateur->genre}}</td>
                    <td>{{ $operateur->libelle_statut}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>

@endsection
