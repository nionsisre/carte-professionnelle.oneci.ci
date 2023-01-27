@extends('admin/main')
@section('content')

    <div class="card">
        <div class="card-header text-center"
             style="font-style: italic;color : white;
        background-color: green">
            <h5>EXPORTATION DES ABONNES</h5>
        </div>
        <div class="card-body">
            <form action="{{route('operateur.search.export')}}" method="post" class="form-group" style="margin-left: 130px">
                @csrf
                <div class="form-row">

                    <div class="form-inline col-md-2">
                        <select id="inputState" name="operateur" class="form-control col" html-required="true">
                            <option disabled selected hidden>Choisie Opérateur</option>
                            <option value="0">Tout </option>
                            <option value="1">Orange CI </option>
                            <option value="2">MTN CI</option>
                            <option value="3">Moov Africa</option>
                        </select>
                    </div>

                    <div class="form-inline col-md-2">
                        <select id="inputState" name="statut" class="form-control col" html-required="true">
                            <option disabled selected hidden>Choisie Statut</option>
                            <option value="0">Tout </option>
                            <option value="1">IAT</option>
                            <option value="3">IDV</option>
                            <option value="4">IDR</option>
                        </select>
                    </div>

                    <div class="form-inline col-md-8">
                        <label for="">Du</label>&nbsp;&nbsp;
                        <input type="date" class="form-control" name="date1" autocomplete=off>&nbsp;&nbsp;
                        <label for="">Au</label>&nbsp;&nbsp;
                        <input type="date" name="date2" class="form-control" autocomplete=off>

                        <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span>&nbsp;Chercher</button>

                        <a class="input-group-btn btn btn-primary" href="{{ route('abonnees.exportation') }}" style="margin-left: 10px">
                            <span class="fa fa-sign"></span>&nbsp;&nbsp;Rafraichir
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
