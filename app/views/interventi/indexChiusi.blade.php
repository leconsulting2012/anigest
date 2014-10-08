@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
{{{ $title }}}
@stop

@section('keywords')antenne @stop
@section('author')Mauro Gallo @stop
@section('description')gestione delle interventi anenne @stop


@section('cssEsterni')
{{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
{{ HTML::style('css/colorbox.css') }}
@stop

@section('jsEsterni')
{{ HTML::script('js/jquery.colorbox-min.js') }}
{{ HTML::script('js/plugins/datatables/jquery.dataTables.js') }}.
{{ HTML::script('js/plugins/datatables/dataTables.bootstrap.js') }}
{{ HTML::script('js/plugins/datatables/datatables.fnReloadAjax.js') }} 
@stop

@section('bodyOnLoad')
<body class="skin-blue fixed">
@stop

{{-- Content --}}
@section('content')

<div class="col-xs-12">
	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">Elenco di tutti gli Interventi Chiusi</h3>
			<div class="box-tools pull-right">
			</div>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
			<table id="interventi" cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-bordered table-hover dataTable">
				<thead>
					<tr>
						<th class="col-xs-6 col-md-1">Data Intervento</th>
						<th class="col-xs-12 col-md-2">Cliente</th>
						<th class="col-xs-6 col-md-1">Installatore</th>
						<th class="col-xs-6 col-md-1">Tipo Intervento</th>
						<th class="col-xs-6 col-md-1">{{{ Lang::get('table.actions') }}}</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {

			oTable = $('#interventi').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oStdClasses": {
					"sFilter": "dataTables_filter",
				},
				"oLanguage": {
					"sEmptyTable":     "Nessun dato presente nella tabella",
				    "sInfo":           "Vista da _START_ a _END_ di _TOTAL_ elementi",
				    "sInfoEmpty":      "Vista da 0 a 0 di 0 elementi",
				    "sInfoFiltered":   "(filtrati da _MAX_ elementi totali)",
				    "sInfoPostFix":    "",
				    "sInfoThousands":  ",",
				    "sLengthMenu":     "_MENU_ elementi per pagina",
				    "sLoadingRecords": "Caricamento...",
				    "sProcessing":     "<b>Caricamento...</b>",
				    "sSearch":         "Cerca:",
				    "sZeroRecords":    "La ricerca non ha portato alcun risultato.",
					"oPaginate": {
						"sFirst":      "Inizio",
				        "sPrevious":   "Precedente",
				        "sNext":       "Successivo",
				        "sLast":       "Fine"
					},		
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": true,
		        "sAjaxSource": "{{ URL::to('interventi/dataChiusi') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"90%", height:"90%"});
	     		}
			})
		});
	</script>
@stop
