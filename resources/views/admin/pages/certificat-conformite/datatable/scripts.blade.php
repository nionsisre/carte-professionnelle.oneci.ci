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
            dom: 'rtp', /* default 'lfrtip' */
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
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                @foreach($columns as $column)
                    @if ($column !== 'id' && $column !== 'created_at')
                    {!! "{data: '".$column."', name: '".$column."', searchable: true, visible: false}," !!}
                    @endif
                @endforeach
            ],
            {{--




            {
                    data: 'id', name: 'photo',
                    render: function (data, type, row, meta) {
                        try {
                            if (row.photos.photo !== "") {
                                return '<img src="data:image/png;base64,'+row.photos.photo+'" alt="Photo" width="150" />';
                            } else {
                                return "Aucune photo";
                            }
                        } catch(e) { return "Aucune photo"; }
                    }
                },
                {
                    data: 'id', name: 'signature',
                    render: function (data, type, row, meta) {
                        try {
                            if (row.signatures.signature !== "") {
                                return '<img src="data:image/png;base64,'+row.signatures.signature+'" alt="Photo" width="100" />';
                            } else {
                                return "Aucune signature";
                            }
                        } catch(e) { return "Aucune signature"; }
                    }
                },
                @foreach($columns as $column)
                    @if ($column !== 'id' && $column !== 'created_at' && $column !== 'updated_at' /* && $column !== 'code_ville'
                && $column !== 'code_grade'  && $column !== 'code_emploi'  && $column !== 'code_structure'
                && $column !== 'code_sexe'  && $column !== 'code_ville_naissance'  && $column !== 'code_civilite'*/)
                    {!! "{data: '".$column."', name: '".$column."', searchable: true}," !!}
                    @endif
                @endforeach





            select : {
                style :    'os',
                selector : 'td:first-child'
            },
            --}}
            order : [[ 3, 'asc' ]],
        });
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
</script>
