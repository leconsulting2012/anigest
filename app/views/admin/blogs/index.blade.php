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
@stop

@section('bodyOnLoad')
<body class="skin-blue fixed">
@stop

{{-- Content --}}
@section('content')
<div class="col-xs-12">
	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">Elenco di tutte le Notizie</h3>
			<div class="box-tools pull-right">
				@if (!Auth::user()->hasRole('installatore'))
				<a href="{{{ URL::to('admin/blogs/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Nuovo</a>
				@endif
			</div>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">

			<table id="blogs" class="table table-bordered table-hover dataTable">
				<thead>
					<tr>
						<th class="col-md-4">{{{ Lang::get('admin/blogs/table.title') }}}</th>
						<th class="col-md-2">{{{ Lang::get('admin/blogs/table.comments') }}}</th>
						<th class="col-md-2">{{{ Lang::get('admin/blogs/table.created_at') }}}</th>
						<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
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
			oTable = $('#blogs').dataTable( {
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
		        "sAjaxSource": "{{ URL::to('admin/blogs/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"90%", height:"90%"});
	     		}
			})
		});				
	</script>
@stop