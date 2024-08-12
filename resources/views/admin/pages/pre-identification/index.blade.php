@extends('admin.layouts.app')

@section('page-title-tab')
    <div class="pageheader">
        <h2><i class="fa fa-tasks"></i> &nbsp; Traitement des demandes de fiche de pré-enrôlement {{ env('APP_NAME') }}</h2>
    </div>
@endsection

@section('page-styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    {{--<link rel="stylesheet" href="{{ URL::asset('back-office/assets/css/jquery.datatables.css') }}" />--}}
@endsection

@section('vendor-scripts')
    <script src="{{ URL::asset('back-office/assets/js/flot/jquery.flot.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/flot/jquery.flot.resize.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/flot/jquery.flot.symbol.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/flot/jquery.flot.crosshair.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/flot/jquery.flot.categories.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/flot/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/morris.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/raphael-2.1.0.min.js') }}"></script>

    <script src="{{ URL::asset('back-office/assets/js/vendors/lottie-interactivity.min.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/vendors/lottie-player.js') }}"></script>
    <script src="{{ URL::asset('back-office/assets/js/app.js') }}"></script>
    {{--
    <script src="/node_modules/@lottiefiles/lottie-player/dist/lottie-player.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-interactivity@latest/dist/lottie-interactivity.min.js"></script>
    --}}
    {{--
    const player = document.getElementById("ostatplus-animation");
    player.addEventListener("ready", () => {
        const lottieInteractivity = window.lottieInteractivity;
        lottieInteractivity.create({ player: '#ostatplus-animation', mode: 'play', actions: [{visibility: [0,1], frames: [54]}] });
    });
    --}}
@endsection

@section('page-scripts')
    @include('admin.panels.scripts.form-tools')
    <script>
        {{-- Initializations --}}
        jQuery('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy'
        });
    </script>
    @include('admin.pages.pre-identification.datatable.scripts')
    @include('admin.pages.pre-identification.documents.scripts')
    @include('admin.pages.pre-identification.approve.scripts')
    @include('admin.pages.pre-identification.deny.scripts')
@endsection

{{--
@section('logo')
    <img src="{{ URL::asset('back-office/assets/images/ostatplus_icon.svg') }}" alt="" style="width: 2.5em; padding: 0.2em 0.2em"/>
@endsection
--}}

@section('content')

    <div class="row">

        <div class="col-sm-12">

            <div class="panel panel-dark">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-tasks mr10"></i>Traitement des demandes de  fiche de pré-enrôlement {{ env('APP_NAME') }}</h3><br/>
                    Cette rubrique permet de traiter les demandes de  fiche de pré-enrôlement {{ env('APP_NAME') }} en vérifiant l'authenticité des documents justificatifs fournis par le client.
                </div>
                <div class="panel-body">
                    @include('admin.pages.pre-identification.datatable.index')
                </div>
            </div><!-- panel -->

            @include('admin.pages.pre-identification.documents.modal')
            @include('admin.pages.pre-identification.approve.modal')
            @include('admin.pages.pre-identification.deny.modal')

        </div><!-- col-sm-12 -->

    </div><!-- row -->

@endsection
