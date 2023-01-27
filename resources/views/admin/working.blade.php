@extends('admin/layout')
@section('content')

    <div class="card">
        <div class="card-header text-center"
             style="font-style: italic;color : white;
        background-color:green">
            <h5 >TRAITEMENT DES PROCURATIONS</h5>
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
                    <th>N°Procuration</th>
                    <th>Type de demande</th>
                    <th>Status Traitement</th>
                    <th>Observation</th>
                    <th>Nom Mandataire</th>
                    <th>Prénom Mandataire</th>
                    <th>Contact Mandataire</th>
                    <th>Nom Titulaire</th>
                    <th>Prénom Titulaire</th>
                    <th>Pays de residence</th>
                    <th>Courrier</th>
                    <th>Procuration</th>
                    <th>Justificatif</th>
                    <th>Piéce d'identité</th>
                    <th>Certificat</th>
                    <th>Recepisse</th>
                    <th>Date demande</th>
                    <th>Charger les documents</th>
                    <th>Complement de documents</th>
                </tr>
                </thead>
                <tbody>
                @foreach($procurations as $procuration)
                    @if($procuration->transationstatus == 1)
                <tr>
                    <td style="font-weight: bold; font-style: italic">{{$procuration->numeroprocuration}}</td>
                    <td style="font-weight: bold; font-style: italic">{{$procuration->typedemande}}</td>
                    <td>

                        @if($procuration->procurationstatus == 'En attente')
                            <button type="button" style="font-style: italic; font-size: 14px;" class="btn btn-primary btn-status" statusId="{{$procuration->id}}"  data-toggle="modal" data-target="#exampleModalCenter">
                                {{ $procuration->procurationstatus}}
                            </button>
                        @elseif($procuration->procurationstatus == 'Traiter')
                            <span style="color: green; font-weight: bold;">{{ $procuration->procurationstatus}}</span>
                        @else
                            <button type="button" style="font-style: italic; font-size: 14px;"
                                    class="btn btn-warning btn-status" statusId="{{$procuration->id}}"  data-toggle="modal" data-target="#exampleModalCenter">
                                {{ $procuration->procurationstatus}}
                            </button>

                        @endif
                    </td>
                    <td>{{$procuration->observationstatus}}</td>
                    <td>{{ $procuration->nommandataire}}</td>
                    <td>{{ $procuration->prenommandataire}}</td>
                    <td>{{ $procuration->contactmandataire}}</td>
                    <td>{{ $procuration->nomtitulaire}}</td>
                    <td>{{ $procuration->prenomtitulaire}}</td>
                    <td>{{ $procuration->lieuresidenttitulaire}}</td>

                    <td>
                        @if($procuration->piecejoints[0]->courrier)
                        <a target="_blank" href="{{ asset('storage/'.$procuration->piecejoints[0]->courrier) }}">
                            <img src="{{ asset('storage/'.$procuration->piecejoints[0]->courrier) }}" alt="courrier" width="50" height="50">
                        </a>
                        @else
                        <p>Aucun document</p>
                        @endif
                    </td>

                    <td>
                        @if($procuration->piecejoints[0]->procurationdoc)
                        <a target="_blank" href="{{ asset('storage/'.$procuration->piecejoints[0]->procurationdoc) }}">
                        <img src="{{ asset('storage/'.$procuration->piecejoints[0]->procurationdoc) }}" alt="procuration"  width="50" height="50">
                        </a>
                        @else
                            <p>Aucun document</p>
                        @endif
                    </td>

                    <td>
                        @if($procuration->piecejoints[0]->justificatif)
                        <a target="_blank" href="{{ asset('storage/'. $procuration->piecejoints[0]->justificatif) }}">
                        <img src="{{ asset('storage/'. $procuration->piecejoints[0]->justificatif) }}" alt="justificatif" width="50" height="50">
                        </a>
                        @else
                            <p>Aucun document</p>
                        @endif
                    </td>

                    <td>
                        @if($procuration->piecejoints[0]->piecemandataire)
                        <a target="_blank" href="{{ asset('storage/'. $procuration->piecejoints[0]->piecemandataire) }}">
                            <img src="{{ asset('storage/'. $procuration->piecejoints[0]->piecemandataire) }}" alt="piece mandataire"   width="50" height="50">
                        </a>
                        @else
                            <p>Aucun document</p>
                        @endif
                    </td>

                    <td>
                        @if($procuration->piecejoints[0]->certificat)
                        <a target="_blank" href="{{ asset('storage/'. $procuration->piecejoints[0]->certificat) }}">
                            <img src="{{ asset('storage/'. $procuration->piecejoints[0]->certificat) }}" alt="certificat" width="50" height="50">
                        </a>
                        @else
                            <p>Aucun document</p>
                        @endif
                    </td>

                    <td>
                        @if($procuration->piecejoints[0]->recepisse)
                        <a target="_blank" href="{{ asset('storage/' . $procuration->piecejoints[0]->recepisse) }}">
                            <img src="{{ asset('storage/' . $procuration->piecejoints[0]->recepisse) }}" alt="recepisse"  width="50" height="50">
                        </a>
                        @else
                            <p>Aucun document</p>
                        @endif
                    </td>

                    <td>{{ date('d-m-Y',strtotime($procuration->created_at))}}</td>


                    <td>
                        <a style="font-style: italic;"
                           class="btn btn-primary btn-archive"
                           href="{{route('zipdownload',$procuration->id)}}">&nbsp;
                            ArchiveZIP
                        </a>
                    </td>

                    <td>
                        <a type="button" style="font-style: italic; font-size: 14px; margin-left: 50px"
                                class="btn-document" fileId="{{$procuration->id}}"  data-toggle="modal" data-target="#modalCenter">
                            <span class="fa fa-download"></span>
                        </a>
                    </td>
                </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form action="{{route('updatestatus')}}" method="post">
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
        <form action="{{route('working.update.document')}}" method="post" enctype="multipart/form-data">
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
