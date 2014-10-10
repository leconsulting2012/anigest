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
				<h4>Versione 0.3 (attuale)</h4>
				<p>(10/10/2014)</p>
				<ul>
					<li>Eliminata colonna "Numero Seriale" in Antenne</li>
					<li>Eliminata colonna "Numero Seriale" in Routers</li>
					<li>Inserita ricerca negli interventi anche nella colonna relativa al cliente</li>
					<li>In dashboard, prossimi interventi, è possbile aprire la scheda di un intervento direttamente cliccando l'apposito pulsante.</li>
					<li>Corretto Bug su creazione di un intervento.</li>
					<li>Corretto bug #59</li>
				</ul>

				<h4>Versione 0.2</h4>
				<p>(07/10/2014)</p>
				<ul>
					<li>Corretto Bug su modifica di un intervento da parte degli installatori.</li>
					<li>Su scheda anagrafica ora si possono vedere tutti gli interventi ad essa associati.</li>
					<li>Visualizzazione changelog.</li>
				</ul>

				<h4>Versione 0.1</h4>
				<p>(24/08/2014)</p>
				<ul>
					<li>Prima release.</li>
				</ul>

			</div>
		</div>


	</div>	
	@stop