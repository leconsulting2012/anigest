@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}

			<div class="pull-right">
				<a href="{{{ URL::to('admin/users/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Nuovo</a>
			</div>
		</h3>
	</div>

	<table id="users" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-2">{{{ Lang::get('admin/users/table.username') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/users/table.email') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/users/table.activated') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/users/table.created_at') }}}</th>
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
				oTable = $('#users').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
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
		        "sAjaxSource": "{{ URL::to('admin/users/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});
	</script>
@stop