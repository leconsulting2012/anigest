@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')antenne @stop
@section('author')Mauro Gallo @stop
@section('description')gestione delle interventi anenne @stop

{{-- Content --}}
@section('content')

	<div class="page-header">
		<h3>
			{{{ $title }}}

			<div class="pull-right">
				@if (!Auth::user()->hasRole('installatore'))
				<a href="{{{ URL::to('interventi/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Nuova</a>
				@endif
			</div>
		</h3>
	</div>

	<table id="interventi" cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-bordered dataTable">
		<thead>
			<tr>
				<th class="col-md-1">{{{ Lang::get('user/interventi/table.anagrafica') }}}</th>
				<th class="col-md-1">{{{ Lang::get('user/interventi/table.data') }}}</th>
				<th class="col-md-1">{{{ Lang::get('user/interventi/table.installatore') }}}</th>
				<th class="col-md-1">{{{ Lang::get('user/interventi/table.confermato') }}}</th>
				<th class="col-md-1">{{{ Lang::get('user/interventi/table.completato') }}}</th>
				<th class="col-md-1">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
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
				    "sLengthMenu":     "Visualizza _MENU_ elementi",
				    "sLoadingRecords": "Caricamento...",
				    "sProcessing":     "<img src='{{ URL::to('images/loading.gif') }}' /><br /><b>Caricamento...</b>",
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
		        "sAjaxSource": "{{ URL::to('interventi/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});
	</script>
@stop

@section('footer')
<hr>
fine.
@stop