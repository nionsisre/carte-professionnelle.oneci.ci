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
            <table class="table table-striped table-bordered table-responsive" style="width:100%; margin-top: 50px; margin-bottom: 50px"id="datatable" >
                <thead>
                <tr>
                    <th>Date Enregistrement</th>
                    <th>Operateur</th>
                    <th>N°Télephone</th>
                    <th>N°Dossier</th>
                    <th>N°Document</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
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
                        <td>{{$operateur->libelle_operateur}}</td>
                        <td>{{preg_replace("/\s+/","",$operateur->numero_de_telephone)}}</td>
                        <td>{{$operateur->numero_dossier}}</td>
                        <td>{{$operateur->numero_document}}</td>
                        <td>{{$operateur->nom}}</td>
                        <td>{{ $operateur->prenoms}}</td>
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
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form action="" method="post">
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
                                    <option value="En cours de traitement">En cours de traitement</option>
                                    <option value="Traiter">Traiter</option>
                                    <option value="Refuser">Refuser</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group msg">
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

    <!-- Modal download -->
    <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Complément de documents</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" name="id"  id="iddoc">
                                <select class="form-control" name="typedocument" autocomplete=off required>
                                    <option value="" disabled selected hidden>Type de documents</option>
                                    <option value="courrier">Courrier</option>
                                    <option value="procurationdoc">Procuration</option>
                                    <option value="justificatif">Justificatif</option>
                                    <option value="piecemandataire">Piéce mandataire</option>
                                    <option value="certificat">Certificat</option>
                                    <option value="recepisse">Récepisse</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12" >
                                <input type="hidden" name="id"  id="typedoc">
                                <input type="file" style="padding-bottom: 37px" class="form-control" name="doc"/>
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

        $(function () {
            // alert("ok");
            $(document).on('click','.btn-document',function () {
                var id = $(this).attr('fileId');
                $("#iddoc").val(id);
                $("#typedoc").val(id);
            })
        })

        $(document).ready(function(){
            $("select").change(function(){
                $(this).find("option:selected").each(function(){
                    var val = $(this).attr("value");
                    if(val == 'Refuser'){
                        $(".msg").show();
                    } else{
                        $(".msg").hide();
                    }
                });
            }).change();
        });
    </script>
@endsection
