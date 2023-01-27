<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ONECI</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"/>
    <script defer src="https://use.fontawesome.com/releases/v5.4.1/js/all.js" integrity="sha384-L469/ELG4Bg9sDQbl0hvjMq8pOcqFgkSpwhwnslzvVVGpDjYJ6wJJyYjvG3u8XW7" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body, html{
            background-image: url("{{asset('images/bg2.png')}}");
            background-repeat: repeat;
        }
        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: green;
            border-color: green;
        }
    </style>
    @yield('css')
</head>
<body>
@include('sweetalert::alert')
<div class="container-fluid bg-white pb-4 mb-4 bg-light">
    <nav class="navbar navbar-light ">
        <a class="navbar-brand" href="#"><img src="{{URL::asset('/images/logooneci.png')}}" height="50px"/></a>
        <span class="navbar-text" style="color:#e58539; font-size: 2em; font-weight: bold">Office National de l'Etat Civil et de Identification</span>
        <a class="navbar-brand" href="#"><img src="{{URL::asset('/images/civlogo.png')}}" height="50px"/></a>
    </nav>

    <div class="row bg-bg-secondary bg-light">
        <div class="col  text-center">
            <h1 style="font-size: 2em; font-weight: bold; font-style: italic">TABLEAU DE BORD STATISTIQUE DES ABONNES TELEPHONIQUES</h1>
        </div>
    </div>

    <div class="row bg-white p-4 mb-4 bg-light">
        <div class="col-md-2">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active"
                   id="list-home-list"
                   aria-controls="home" href="{{ route('admin_home') }}" style="font-weight: bold"><span class="fa fa-home fa-1x"></span>&nbspAccueil</a>

{{--                @if(\Illuminate\Support\Facades\Auth::User()->role_id == 1 ||  \Illuminate\Support\Facades\Auth::User()->role_id == 2 ||  \Illuminate\Support\Facades\Auth::User()->role_id == 3)--}}
{{--                    <a class="list-group-item list-group-item-action"--}}
{{--                       id="list-home-list"--}}
{{--                       aria-controls="home" href="{{ route('working') }}" style="font-weight: bold"><span class="fa fa-database fa-1x"></span>&nbspTraitements</a>--}}
{{--                @endif--}}


{{--                <a class="list-group-item list-group-item-action"--}}
{{--                   id="list-home-list"--}}
{{--                   aria-controls="home" href="{{ route('rapport') }}" style="font-weight: bold"><span class="fa fa-file fa-1x" ></span>&nbspEtats</a>--}}

                <a class="list-group-item list-group-item-action"
                   id="list-home-list"
                   aria-controls="home" href="{{ route('abonnees.exportation') }}" style="font-weight: bold"><span class="fa fa-upload fa-1x" ></span>&nbspExportation</a>

                <a class="list-group-item list-group-item-action"
                   id="list-home-list"
                   aria-controls="home" href="{{ route('abonnees.importation') }}" style="font-weight: bold"><span class="fa fa-download fa-1x" ></span>&nbspImportation</a>

{{--                @if(\Illuminate\Support\Facades\Auth::User()->role_id == 1 ||  \Illuminate\Support\Facades\Auth::User()->role_id == 2 ||  \Illuminate\Support\Facades\Auth::User()->role_id == 3)--}}
{{--                    <a class="list-group-item list-group-item-action "--}}
{{--                       id="list-profile-list"--}}
{{--                       aria-controls="profile" href="{{ route('setting') }}" style="font-weight: bold"><span class="fa fa-cog fa-1x"></span>&nbspParametres</a>--}}
{{--                @endif--}}

                <a class="list-group-item list-group-item-action"
                   href="{{ route('logout') }}" style="font-weight: bold"><span class="fa fa-user-circle fa-1x"></span> &nbspDeconnecter
                    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 2)
                        (Admin)
                    @endif
                </a>
            </div>
        </div>
        <br/>
        <div class="col-md-10">
            @yield('content')
        </div>
    </div>
</div>

</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
{{-- toastr js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
<!-- Bootstrap CSS -->
@yield('script')

<script type="text/javascript">


    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    //image img#image
    var image = document.getElementById("image");

    // La fonction previewphoto
    var previewphoto  = function (e) {

        // e.files contient un objet FileList
        const [photo] = e.files

        // "photo" est un objet File
        if (photo) {

            // objet FileReader
            var reader = new FileReader();

            // événement déclenché lorsque la lecture est complète
            reader.onload = function (e) {
                // On change URL de image (base64)
                image.src = e.target.result
            }

            // On lit le fichier "photo" uploadé
            reader.readAsDataURL(photo)

        }
    }
    $(document).ready(function () {
        $('#datatable').DataTable({
            responsive: true,
            "language": {
                "sProcessing": "Traitement en cours ...",
                "sLengthMenu": "Afficher _MENU_ lignes",
                "sZeroRecords": "Aucun résultat trouvé",
                "sEmptyTable": "Aucune donnée disponible",
                "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
                "sInfoEmpty": "Aucune ligne affichée",
                "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
                "sInfoPostFix": "",
                "sSearch": "Rechercher:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Chargement...",
                "oPaginate": {
                    "sFirst": "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent"
                },
                "oAria": {
                    "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
                }
            }
        });
    });

</script>
</html>
