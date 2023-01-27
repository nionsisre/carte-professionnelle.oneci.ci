@extends('admin/layout')
@section('css')
    <style>

    </style>
@endsection

@section('content')

    <div class="card">
        <div class="card-header text-center"
             style="font-style: italic;color : white;
        background-color: green">
            <h5 >GESTION DES UTILISATEURS</h5>
        </div>
        <div class="card-body">
            @if(session()->has('info'))
                <div class="alert alert-success text-center" role="alert">
                    {!! session('info')  !!}
                </div>
            @endif
            @if(\Illuminate\Support\Facades\Auth::User()->role == 'root')
                <div class="row ">
                    <div class="col-md-3 offset-md-9" style="margin-bottom: 30px;">
                        <a class="input-group-btn btn btn-primary"  href="{{route('user')}}" style="margin-left: 10px">
                            <span class="fa fa-user-circle"></span>&nbsp;&nbsp;Ajouter un utilisateur
                        </a>
                    </div>
                </div>
             @endif
            <table class="table table-striped table-bordered table-responsive" style="margin-top: 50px; margin-bottom: 50px ;"id="datatable" >
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Identifiant</th>
                    <th>Direction</th>
                    <th>Service</th>
                    <th>Fonction</th>
                    <th>Role</th>
                    <th>Date enregistrement</th>
                    <th>Status</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->prenom}}</td>
                    <td>{{$user->identifiant}}</td>
                    <td>{{$user->direction}}</td>
                    <td>{{$user->service}}</td>
                    <td>{{$user->fonction}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->dateop}}</td>
                    <td>
                        @if($user->status == 1)
                            Actif
                        @else
                            Inactif
                        @endif
                    </td>
                    <td><a href="#" statusId="{{$user->id}}" class="btn-status"
                           data-toggle="modal" data-target="#exampleModalCenter">
                            <span class="fa fa-pen" style="color: darkorange"></span>
                        </a>
                    </td>
                    <td><a href="#"><span class="fa fa-trash" style="color: red"></span></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form action="{{route('update.user')}}" method="post">
            @csrf
            @method('put')
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Mise à jours</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col">
                                <input type="hidden" name="id"  id="idstatus">
                                <select class="form-control" name="role" autocomplete=off required>
                                    <<option value="" disabled selected hidden>Changer le rôle</option>
                                    <option value="admin">Admin</option>
                                    <option value="validateur">Validateur</option>
                                    <option value="verificateur">Verificateur</option>
                                </select>
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
            })
        })

    </script>
@endsection


