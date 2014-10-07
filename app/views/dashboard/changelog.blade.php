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
			<h4 class="page-header">
				AniGEST - Changelog
			</h4>

			<h4>Versione 0.2</h4>
			<ul>
				<li>Corretto Bug su modifica di un intervento da parte degli installatori</li>
				<li>Su scheda anagrafica ora si possono vedere tutti gli interventi ad essa associati</li>
			<ul>
		</div>
	</div>	
@stop