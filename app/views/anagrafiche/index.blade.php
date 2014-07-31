@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')anagrafiche @stop
@section('author')Mauro Gallo @stop
@section('description')gestione delle installazioni anenne @stop

{{-- Content --}}
@section('content')
<style type="text/css">

</style>
	<div class="page-header">
		<h3>
			{{{ $title }}}

			<div class="pull-right">
				@if (!Auth::user()->hasRole('installatore'))
				<a href="{{{ URL::to('anagrafiche/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Nuova</a>
				@endif
			</div>
		</h3>
	</div>

	<table id="anagrafiche" cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-bordered dataTable">
		<thead>
			<tr>
				<th class="col-md-2">{{{ Lang::get('user/anagrafiche/table.nome') }}}</th>
				<th class="col-md-2">{{{ Lang::get('user/anagrafiche/table.cognome') }}}</th>
				<th class="col-md-2">{{{ Lang::get('user/anagrafiche/table.indirizzo1') }}}</th>
				<th class="col-md-2">{{{ Lang::get('user/anagrafiche/table.aggiornato') }}}</th>
				<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
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
			oTable = $('#anagrafiche').dataTable( {
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
				    "sProcessing":     "Elaborazione...",
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
		        "sAjaxSource": "{{ URL::to('anagrafiche/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});
	</script>
@stop