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
        <div class="card-body" >
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            <form action="{{route('rapport.import')}}" method="post" style="margin-left: 250px; padding-left: 25em" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div col-md-12>
                        <div class="form-group" id="fichier-field">
                            <center>
                                <div class="col-md-8">
                                    <input type="file" name="fichier" id="fichier-input"
                                           class="inputfile" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                           style="display: none" required="required">
                                    <label for="fichier-input" class="atcl-inv hoverable"
                                           style="background-color: #bdbdbd6b;padding: 2em;border: solid 1px black;border-style: dashed;border-radius: 1em; width: 18em; height: 12em">
                                        <i class="fa fa-file-excel-o fa-3x mr10" style="padding: 0.2em 0em; margin-bottom: 0.2em; color: #0b2e13"></i><br/>
                                        <span style="font-style: italic">Charger le document…<br/>Le document à charger doit être  au format <b>*.xlsx</b> ou <b>*.xls</b>
                                    </span>
                                    </label>

                                </div>
                                <br/>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <center>
                        <div col-md-12 style="margin-left: 2em">
                            <div class="form-inline col-md-12">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Importer</button>
                                <a class="input-group-btn btn btn-primary" href="{{ route('abonnees.importation') }}" style="margin-left: 10px">
                                    <span class="fa fa-sign"></span>&nbsp;&nbsp;Rafraichir
                                </a>
                            </div>
                        </div>
                    </center>
                </div>
            </form>
        </div>
    </div>
    @if(Session::has('files'))
        <div class="card" style="margin-top: 15px">
            <div class="card-header text-center" style="font-style: italic;color : white;background-color: #007bff">
                <h5>LISTE DES ABONNES IMPORTES</h5>
            </div>
            <div class="card-body">
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
                        <th>Observation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Session::get('files') as $cle)
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
                            <td>{{ $cle["observation"] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if(Session::has('cles'))
    <div class="card" style="margin-top: 15px">
        <div class="card-header text-center" style="font-style: italic;color : white;background-color: #dc3a41">
            <h5>LISTE DES ABONNES N'EXISTANT PAS EN BASE</h5>
        </div>
        <div class="card-body">
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

@section('script')
<script type="text/javascript">
    {{--
    |--------------------------------------------------------------------------
    | Input file stylé
    |--------------------------------------------------------------------------
    --}}
    jQuery('.inputfile').each(function () {
        var $input = jQuery(this),
            $label = $input.next('label'),
            labelVal = $label.html();

        $input.on('change', function (e) {
            var fileName = '';

            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else if (e.target.value)
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                $label.find('span').html(fileName);
            else
                $label.html(labelVal);
        });

        {{-- Firefox bug fix --}}
        $input
            .on('focus', function () {
                $input.addClass('has-focus');
            })
            .on('blur', function () {
                $input.removeClass('has-focus');
            });
    });

</script>
@endsection
