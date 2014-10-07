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


		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">AniGEST - Changelog</h3>
			</div>
			<div class="panel-body">
				<p>Versione attualmente in uso: <b>0.2</b></p>


				<h4>Versione 0.2 </h4>
				<p>(07/10/2014)</p>
				<ul>
					<li>Corretto Bug su modifica di un intervento da parte degli installatori</li>
					<li>Su scheda anagrafica ora si possono vedere tutti gli interventi ad essa associati</li>
				</ul>

				<h4>Versione 0.1</h4>
				<p>(06/09/2014)</p>
				<ul>
					<li>Prima release.</li>
				</ul>

			</div>
		</div>


	</div>	
	@stop