@extends('admin/layout')
@section('content')

    <div class="card">
        <div class="card-header text-center"
             style="font-style: italic;color : white;
        background-color: green">
            <h5>RAPPORT DES TRAITEMENTS</h5>
        </div>
        <div class="card-body">
            <form action="{{route('rapport.export')}}" method="post" class="form-group">
                @csrf
                <div class="row ">
                    <div class="col-md-3 offset-md-9">
                        <a class="input-group-btn btn btn-primary" href="{{ route('rapport') }}" style="margin-left: 10px">
                            <span class="fa fa-sign"></span>&nbsp;&nbsp;Rafraichir
                        </a>

                        <button class="input-group-btn btn btn-success" type="submit" style="margin-left: 10px">
                            <span class="fa fa-file-excel"></span>&nbsp;&nbsp;Export(CSV)
                        </button>
                    </div>
                </div>
            </form>
            @if($procurations != null)
            <table class="table table-striped table-bordered table-responsive" style="width:100%; margin-top: 50px; margin-bottom: 50px"id="datatable" >
                <thead>
                <tr>
                    <th>N°Procuration</th>
                    <th>Type de demande</th>
                    <th>Status</th>
                    <th>Observation</th>
                    <th>Nom Mandataire</th>
                    <th>Prénom Mandataire</th>
                    <th>Contact Mandataire</th>
                    <th>Nom Titulaire</th>
                    <th>Prénom Titulaire</th>
                    <th>Pays de residence</th>
                    <th>Date demande</th>
                </tr>
                </thead>
                <tbody>
                @foreach($procurations as $procuration)
                <tr>
                    <td>{{$procuration->numeroprocuration}}</td>
                    <td>{{$procuration->typedemande}}</td>
                    <td>{{$procuration->procurationstatus}}</td>
                    <td>{{$procuration->observationstatus}}</td>
                    <td>{{ $procuration->nommandataire}}</td>
                    <td>{{ $procuration->prenommandataire}}</td>
                    <td>{{ $procuration->contactmandataire}}</td>
                    <td>{{ $procuration->nomtitulaire}}</td>
                    <td>{{ $procuration->prenomtitulaire}}</td>
                    <td>{{ $procuration->lieuresidenttitulaire}}</td>
                    <td>{{ $procuration->dateop}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
                @endif
        </div>
    </div>

@endsection
