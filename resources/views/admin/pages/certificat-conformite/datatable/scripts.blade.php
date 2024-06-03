{{-- <script src="{{asset('back-office/assets/js/datatables/datatable.js')}}"></script>
<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.js')}}"></script> --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    {{-- Datatable Initialization --}}
    var myDatatable;
    jQuery(document).ready(function() {
        "use strict";
        myDatatable = jQuery('.my-datatable').DataTable({
            processing: true,
            serverSide: true,
            sPaginationType : "full_numbers",
            autoFill: true,
            responsive : true,
            pageLength: 10,
            dom: 'rtp', {{-- default 'lfrtip' --}}
            language : {
                url : "{{ route('datatables.french.json') }}"
            },
            ajax: {
                url: "{{ route('admin.certificat.datatable') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            },
            initComplete: function(settings, json) {
                {{-- Code JavaScript à exécuter après le chargement initial des données--}}
                jQuery('.mainpanel').height( $(".contentpanel").height() + 150 );
                {{--Mise à jour du nombre total d'enregistrements--}}
                let info = myDatatable.page.info();
                {{--$('#total-rows').text(json.recordsTotal);--}}
                $('#total-rows').text(info.recordsDisplay);
            },
            createdRow: function(row, data, dataIndex) {
                {{-- Ajouter une classe à la ligne entière--}}
                jQuery(row).addClass('glow-user-tr');
                jQuery(row).find('td').css('vertical-align', 'middle');
            },
            columnDefs: [
                    {
                        targets: 9,
                    createdCell: function(td, cellData, rowData, row, col) {
                        jQuery(td).css('text-align', 'center');
                    }
                }
            ],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'lieu_livraison', name: 'lieu_livraison'},
                {data: 'numero_dossier', name: 'numero_demande'},
                {{--{
                    data: 'numero_cni_nni', name: 'numero_cni_nni',
                    render: function (data, type, row, meta) {
                        return '<i class="fa fa-barcode mr10"></i>'+data;
                    }
                },--}}
                {data: 'numero_cni_nni', name: 'numero_cni_nni'},
                {data: 'nom_complet', name: 'nom_complet'},
                {data: 'nom_complet_mere', name: 'nom_complet_mere'},
                {data: 'nom_complet_decision', name: 'nom_complet_decision'},
                {data: 'numero_date_decision', name: 'numero_date_decision'},
                {data: 'lieu_decision', name: 'lieu_decision'},
                {data: 'statut_demande', name: 'statut_demande'},
                {data: 'date_demande', name: 'date_demande'},
                {data: 'documents_justificatifs', name: 'documents_justificatifs'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {data: 'observations', name: 'observations', orderable: false, searchable: false},
                @foreach($columns as $column)
                    @if ($column !== 'id' && $column !== 'created_at')
                    {!! "{data: '".$column."', name: '".$column."', searchable: true, visible: false}," !!}
                    @endif
                @endforeach
            ]
            {{--order : [[ 3, 'asc' ]],--}}
        });

        myDatatable.on('processing.dt', function(e, settings, processing) {
            if (processing) {
                $('#loader').show();
                jQuery('.my-datatable').hide();
            } else {
                $('#loader').hide();
                jQuery('.my-datatable').show();
                jQuery('.mainpanel').height( $(".contentpanel").height() + 150 );
                {{--Mise à jour du nombre total d'enregistrements--}}
                let info = myDatatable.page.info();
                {{--$('#total-rows').text(json.recordsTotal);--}}
                $('#total-rows').text(info.recordsDisplay);
                console.log(info);
            }
        });

        {{-- Set documents en attente de vérification --}}
        jQuery('#statut-demande').val("2").trigger('change');
    });

    {{-- myDatatable Search --}}
    $('#btn-table-search').on( 'keyup click', function () {
        myDatatable.search($('#table-search-text').val()).draw();
    } );
    $('#table-search-text').bind("enterKey",function(e){
        myDatatable.search($('#table-search-text').val()).draw();
    });
    $('#table-search-text').keyup(function(e){
        if(e.keyCode == 13) {
            $(this).trigger("enterKey");
        }
    });
    {{-- Status Filter --}}
    $('#statut-demande').change(function() {
        var selectedStatut = $(this).val();
        myDatatable.column('statut:name').search(selectedStatut).draw();
    });
    {{-- Lieu Livraison Filter --}}
    $('#lieux-livraison').change(function() {
        var selectedLieuLivraison = $(this).val();
        myDatatable.column('code_lieu_retrait:name').search(selectedLieuLivraison).draw();
    });
</script>
