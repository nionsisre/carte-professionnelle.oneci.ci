@extends('admin/layout')
@section('content')

    <div class="card">
        <div class="card-header text-center"
             style="font-style: italic;color : white;
        background-color: green">
            <h5>RAPPORT DES TRAITEMENTS</h5>
        </div>
        <div class="card-body">
            <form action="{{route('rapport.search')}}" method="post" class="form-group" style="margin-left: 130px">
                @csrf
                <div class="form-row">

                    <div class="form-inline col-md-2">
                        <select id="inputState" name="status" class="form-control col" required>
                            <option disabled selected hidden>Choose status...</option>
                            <option value="En attente">En attente</option>
                            <option value="Accepter">Accepter</option>
                            <option value="Refuser">Refuser</option>
                        </select>
                    </div>

                    <div class="form-inline col-md-10">
                        <label for="">Du</label>&nbsp;&nbsp;
                        <input type="date" class="form-control" name="date1" autocomplete=off>&nbsp;&nbsp;
                        <label for="">Au</label>&nbsp;&nbsp;
                        <input type="date" name="date2" class="form-control" autocomplete=off>

                        <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span>&nbsp;Chercher</button>

                        <a class="input-group-btn btn btn-primary" href="{{ route('rapport') }}" style="margin-left: 10px">
                            <span class="fa fa-sign"></span>&nbsp;&nbsp;Rafraichir
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
