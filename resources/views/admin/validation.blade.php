@extends('admin/main')
@section('content')

    <div class="card">
        <div class="card-header text-center"
             style="font-style: italic;color : white;
        background-color:green">
            <h5 >TRAITEMENT DES ABONNES</h5>
        </div>
        <div class="card-body">
            @if(session()->has('info'))
                <div class="alert alert-success text-center" role="alert">
                    {!! session('info')  !!}
                </div>
            @endif
                @if(session()->has('warning'))
                    <div class="alert alert-warning text-center" role="alert">
                        {!! session('warning')  !!}
                    </div>
                @endif
{{--                <div class="card-body">--}}
{{--                    <form action="{{route('abonnees.validation.search')}}" method="post" class="form-group" style="margin-left: 130px">--}}
{{--                        @csrf--}}
{{--                        <div class="form-row">--}}

{{--                            <div class="form-inline col-md-2">--}}
{{--                                <select id="inputState" name="operateur" class="form-control col" html-required="true">--}}
{{--                                    <option disabled selected hidden>Choisie Opérateur</option>--}}
{{--                                    <option value="0">Tout </option>--}}
{{--                                    <option value="1">Orange CI </option>--}}
{{--                                    <option value="2">MTN CI</option>--}}
{{--                                    <option value="3">Moov Africa</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

{{--                            <div class="form-inline col-md-2">--}}
{{--                                <select id="inputState" name="statut" class="form-control col" html-required="true">--}}
{{--                                    <option disabled selected hidden>Choisie Statut</option>--}}
{{--                                    <option value="0">Tout </option>--}}
{{--                                    <option value="1">IAT</option>--}}
{{--                                    <option value="3">IDV</option>--}}
{{--                                    <option value="4">IDR</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

{{--                            <div class="form-inline col-md-8">--}}
{{--                                <label for="">Du</label>&nbsp;&nbsp;--}}
{{--                                <input type="date" class="form-control" name="date1" autocomplete=off>&nbsp;&nbsp;--}}
{{--                                <label for="">Au</label>&nbsp;&nbsp;--}}
{{--                                <input type="date" name="date2" class="form-control" autocomplete=off>--}}

{{--                                <button type="submit" class="btn btn-primary" style="margin-top: 05px; margin-left: 15px"><span class="fa fa-search"></span>&nbsp;Chercher</button>--}}

{{--                                <a class="input-group-btn btn btn-primary" href="{{ route('abonnees.exportation') }}" style="margin-top: 05px;margin-left: 10px">--}}
{{--                                    <span class="fa fa-sign"></span>&nbsp;&nbsp;Rafraichir--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
            <table class="table table-striped table-bordered table-responsive" style="width:100%; margin-top: 50px; margin-bottom: 50px"id="datatable" >
                <thead>
                <tr>
                    <th>Date Enregistrement</th>
                    <th>Date validation</th>
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
                    <th>Motif du rejet</th>
                </tr>
                </thead>
                <tbody>
                @foreach($operateurs as $operateur)
                    <tr>
                        <td>{{date('d-m-Y',strtotime($operateur->created_at))}}</td>
                        <td>{{date('d-m-Y',strtotime($operateur->validation))}}</td>
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
                        <td>
                            @if($operateur->libelle_statut == 'Numéro non-vérifié')
                                <button type="button" style="font-style: italic; font-size: 14px;" class="btn btn-primary btn-status" statusId="{{$operateur->id}}"  data-toggle="modal" data-target="#exampleModalCenter">
                                    {{ $operateur->libelle_statut}}
                                </button>
                            @elseif($operateur->libelle_statut == 'Numéro identifié')
                                <span style="color: green; font-weight: bold;">{{ $operateur->libelle_statut}}</span>
                            @elseif($operateur->libelle_statut == 'Document justificatif en attente d\'approbation')
                                <button type="button" style="font-style: italic; font-size: 14px;"
                                        class="btn btn-warning btn-status" statusId="{{$operateur->id}}"  data-toggle="modal" data-target="#exampleModalCenter">
                                    {{ $operateur->libelle_statut}}
                                </button>
                            @else
                                <button type="button" style="font-style: italic; font-size: 14px;"
                                        class="btn btn-danger btn-status" statusId="{{$operateur->id}}"  data-toggle="modal" data-target="#exampleModalCenter">
                                    {{ $operateur->libelle_statut}}
                                </button>
                            @endif
                        </td>
                        <td>{{$operateur->observation}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form action="{{ route('abonnees.validation.update') }}" method="post">
            @csrf
            @method('put')
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Changement le status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" name="id"  id="idstatus">
                                <select class="form-control" name="status" autocomplete=off required>
                                    <option value="" disabled selected hidden>Changer le status</option>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 2)
                                        <option value="2">Document justificatif en attente d'approbation</option>
                                        <option value="3">Numéro identifié</option>
                                        <option value="4">Identification refusée</option>
                                    @endif
                                    <option value="5">Information Conforme</option>
                                    <option value="6">Information Nom Conforme</option>
                                </select>
                            </div>
                            <br/>
                        </div>
                        <div class="form-group block-observation" style="margin-top: 2.1em">
                            <div class="col-sm-12">
                                <input type="hidden" name="id"  id="txtobservation">
                                <textarea class="form-control " name="txtobservation" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
        // alert("ok");
            $(document).on('click','.btn-status',function () {
                var id = $(this).attr('statusId');
                $("#idstatus").val(id);
                $("#txtobservation").val(id);
            })
        })

        $(document).ready(function(){
            $("select").change(function(){
                $(this).find("option:selected").each(function(){
                    var val = $(this).attr("value");
                    if(val == '4'){
                        $(".block-observation").show();
                    } else{
                        $(".block-observation").hide();
                    }
                });
            }).change();
        });

    </script>
@endsection
