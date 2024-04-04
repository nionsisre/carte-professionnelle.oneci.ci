@extends('layouts.app')

@section('title', 'Paiement Effectué !')

@section('scripts')
    <script>
        setTimeout(function() {
            // Redirection automatique après 5secondes.
            window.location.href = "https://www.oneci.ci";
        }, 5000);
    </script>
@endsection

@section('content')

    <!-- begin content -->
    <section id="content" class="container clearfix">
        <section>
            <div class="column-last">
                <br/><br/><br/><br/><br/><br/><br/>
                <!-- begin services -->
                <section class="container">
                    <center>
                        <div>
                            <div class="iconbox-icon"><i class="fad fa-check fa-4x mr10" style="--fa-primary-color: #F78E0C; --fa-secondary-color:#388E3C; --fa-secondary-opacity:0.9; margin-bottom: 0.5em; margin-top: 0.5em"></i></div>
                            <h2 class="iconbox-title">Paiement effectué avec succès !</h2>
                            <h4>Cette fenêtre se fermera automatiquement, veuillez patienter svp...</h4>
                            <div class="iconbox-icon"><i class="fad fa-spinner fa-spin fa-2x mr10"></i></div>
                        </div>
                    </center>
                    <div class="clear"></div>
                </section><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                <!-- end services -->
            </div>
        </section>
    </section>
@endsection
