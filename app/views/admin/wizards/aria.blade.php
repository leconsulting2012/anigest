@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
{{{ $title }}}
@stop

@section('keywords')antenne @stop
@section('author')Mauro Gallo @stop
@section('description')gestione delle interventi anenne @stop


@section('cssEsterni')
{{ HTML::style('css/bootstrap-datetimepicker.min.css') }} 
@stop

@section('jsEsterni')
{{ HTML::script('js/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('js/bootstrap-datetimepicker.pt-IT.js') }} 
{{ HTML::script('js/jquery.maskedinput.min.js') }}
@stop

@section('bodyOnLoad')
<body class="skin-blue fixed">
@stop

{{-- Content --}}
@section('content')

<div class="col-xs-12">
	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title">Procedura per l'inserimento Veloce dei DDT Aria</h3>
		</div><!-- /.box-header -->
		<div class="box-body">

			<form class="form-horizontal" method="post" action="{{ URL::to('wizardAria/') }}" autocomplete="off">
				<!-- CSRF Token -->
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<!-- ./ csrf token -->


	<div class="row">
		<div class="col-md-6">	
				<!-- Data di Ricezione -->
				<div class="form-group {{ $errors->first('dataRicezione', 'has-error') }}">
					<div class="col-md-6">
						<label class="control-label" for="content">Data Ricezione del Materiale</label>
							<div class='input-group date' id='datetimepicker2'>
								<input type='text' class="form-control" name="dataRicezione" id="dataRicezione" value="{{{ Input::old('dataRicezione', isset($intervento) ? $intervento->dataInstallazione : null) }}}" />
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						
						</div>
						{{ $errors->first('dataRicezione', '<label id="dataRicezione-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ Data di ricezione -->
			</div>
		<div class="col-md-6">
			<!-- Modello antenna -->
			<div class="form-group {{ $errors->first('tipoIntervento', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="tipoIntervento">Tipo di Intervento</label>
					@if ( Input::old('tipoIntervento') != '' )
					<select class="col-md-6 form-control" name="tipoIntervento" id="tipoIntervento">
						<option value="">-- SELEZIONA --</option>
						@foreach ($tipiIntervento as $modello)
						<option value="{{{ $modello->id }}}" {{{ ( ($modello->id == Input::old('tipoIntervento')) ? ' selected="selected"' : '') }}}>{{{ $modello->tipo }}}</option>
						@endforeach
					</select>
					@else
					<select class="col-md-6 form-control" name="tipoIntervento" id="tipoIntervento">
						<option value="">-- SELEZIONA --</option>
						@foreach ($tipiIntervento as $modello)
						<option value="{{{ $modello->id }}}" >{{{ $modello->tipo }}}</option>
						@endforeach
					</select>
					@endif
				</div>
			</div>
			<!-- ./ modello antenna -->	
</div>


		</div>

	<div class="row">
		<div class="col-md-6">

			<!-- cognome -->
			<div class="form-group {{ $errors->first('cognome', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="cognome">Cognome</label>
					<input class="form-control" type="text" name="cognome" id="cognome" value="{{{ Input::old('cognome', isset($anagrafica) ? $anagrafica->cognome : null) }}}" />
					{{ $errors->first('cognome', '<label id="cognome-error" class="control-label" for="inputError">:message</label>') }}
				</div>
			</div>
			<!-- ./ cognome-->
		</div>
		<div class="col-md-6">

			<!-- Nome -->
			<div class="form-group {{ $errors->first('nome', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="nome">Nome</label>
					<input class="form-control" type="text" name="nome" id="nome" value="{{{ Input::old('nome', isset($anagrafica) ? $anagrafica->nome : null) }}}" />
					{{ $errors->first('nome', '<label id="nome-error" class="control-label" for="inputError">:message</label>') }}
				</div>
			</div>
			<!-- ./ Nome -->
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">			

			<!-- indirizzo1 -->
			<div class="form-group {{ $errors->first('indirizzo1', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="indirizzo1">Indirizzo 1a riga</label>
					<input class="form-control" type="text" name="indirizzo1" id="indirizzo1" value="{{{ Input::old('indirizzo1', isset($anagrafica) ? $anagrafica->indirizzo1 : null) }}}" />
					{{ $errors->first('indirizzo1', '<label id="indirizzo1-error" class="control-label" for="inputError">:message</label>') }}
				</div>
			</div>
			<!-- ./ indirizzo1-->

		</div>
		<div class="col-md-6">

			<!-- indirizzo2 -->
			<div class="form-group {{ $errors->first('indirizzo2', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="indirizzo2">Indirizzo 2a riga</label>
					<input class="form-control" type="text" name="indirizzo2" id="indirizzo2" value="{{{ Input::old('indirizzo2', isset($anagrafica) ? $anagrafica->indirizzo2 : null) }}}" />
					{{ $errors->first('indirizzo2', '<label id="indirizzo2-error" class="control-label" for="inputError">:message</label>') }}

				</div>
			</div>
			<!-- ./ indirizzo2 -->	
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">				

			<!-- cap -->
			<div class="form-group {{ $errors->first('cap', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="content">CAP</label>
					<input class="form-control" type="text" name="cap" id="cap" value="{{{ Input::old('cap', isset($anagrafica) ? $anagrafica->cap : null) }}}" />
					{{ $errors->first('cap', '<label id="cap-error" class="control-label" for="inputError">:message</label>') }}

				</div>
			</div>
			<!-- ./ cap -->

		</div>
		<div class="col-md-4">

			<!-- citta -->
			<div class="form-group {{ $errors->first('citta', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="content">Città</label>
					<input class="form-control" type="text" name="citta" id="citta" value="{{{ Input::old('citta', isset($anagrafica) ? $anagrafica->citta : null) }}}" />
					{{ $errors->first('citta', '<label id="citta-error" class="control-label" for="inputError">:message</label>') }}
				</div>
			</div>
			<!-- ./ citta anagrafica -->	

		</div>
		<div class="col-md-4">

			<!-- provincia -->
			<div class="form-group {{ $errors->first('provincia', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="content">Provincia</label>
					<input class="form-control" type="text" name="provincia" id="provincia" value="{{{ Input::old('provincia', isset($anagrafica) ? $anagrafica->provincia : null) }}}" />
					{{ $errors->first('provincia', '<label id="provincia-error" class="control-label" for="inputError">:message</label>') }}
				</div>
			</div>
			<!-- ./ provincia anagrafica -->

		</div>
	</div>		

	<div class="row">
		<div class="col-md-6">			

			<!-- telefono -->
			<div class="form-group {{ $errors->first('telefono', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="content">Telefono Fisso</label>
					<input class="form-control" type="text" name="telefono" id="telefono" value="{{{ Input::old('telefono', isset($anagrafica) ? $anagrafica->telefono : null) }}}" />
					{{ $errors->first('telefono', '<label id="telefono-error" class="control-label" for="inputError">:message</label>') }}
				</div>
			</div>
			<!-- ./ telefono anagrafica -->

		</div>
		<div class="col-md-6">

			<!-- cellulare -->
			<div class="form-group {{ $errors->first('cellulare', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="content">Cellulare</label>
					<input class="form-control" type="text" name="cellulare" id="cellulare" value="{{{ Input::old('cellulare', isset($anagrafica) ? $anagrafica->cellulare : null) }}}" />
					{{ $errors->first('cellulare', '<label id="cellulare-error" class="control-label" for="inputError">:message</label>') }}
				</div>
			</div>
			<!-- ./ cellulare anagrafica -->

		</div>
	</div>	

		<div class="row">
			<div class="col-md-6">

				<!-- Installatore -->
				<div class="form-group {{ $errors->first('installatore_id', 'has-error') }}">
					<div class="col-md-12">
						<label class="control-label" for="installatore_id">Installatore</label>
						<select class="form-control" name="installatore_id" id="installatore_id">
							@if ( Input::old('installatore_id') != '' )
							<option value="">-- SELEZIONA --</option>
							@foreach ($installatori as $installatore)
							<option value="{{{ $installatore->id }}}" {{{ ( ($installatore->id == Input::old('installatore_id')) ? ' selected="selected"' : 'dddd') }}}>{{{ $installatore->username }}}</option>
							@endforeach
							@else
							<option value="">-- SELEZIONA --</option>
							@foreach ($installatori as $installatore)
							<option value="{{{ $installatore->id }}}" >{{{ $installatore->username }}}</option>
							@endforeach
							@endif
						</select>
					</div>
					{{ $errors->first('installatore_id', '<label id="installatore_id-error" class="control-label" for="inputError">:message</label>') }}
				</div>
			</div>
			<!-- ./ installatore -->	

		</div>	

	<div class="row">
		<div class="col-md-6">

			<!-- Seriale -->
			<div class="form-group {{ $errors->first('serialeAntenna', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="content">MAC Address Antenna</label>
					<input class="form-control mac" type="text" name="serialeAntenna" id="seriale" value="{{{ Input::old('serialeAntenna', isset($antenna) ? $antenna->seriale : null) }}}" />
					{{ $errors->first('serialeAntenna', '<label id="serialeAntenna-error" class="control-label" for="inputError">:message</label>') }}
				</div>
			</div>
			<!-- ./ seriale antenna -->		

		</div>		
		<div class="col-md-6 nascosto">
			<!-- Modello antenna -->
			<div class="form-group {{ $errors->first('modelloAntenna_id', 'has-error') }}">
				<div class="col-md-12">
					<label class="control-label" for="modelloAntenna_id">Modello Antenna</label>
					@if ( Input::old('modelloAntenna_id') != '' )
					<select class="col-md-6 form-control" name="modelloAntenna_id" id="modelloAntenna_id">
						<option value="">-- SELEZIONA --</option>
						@foreach ($modelliAntenna as $modello)
						<option value="{{{ $modello->id }}}" {{{ ( ($modello->id == Input::old('modelloAntenna_id')) ? ' selected="selected"' : '') }}}>{{{ $modello->nome }}}</option>
						@endforeach
					</select>
					@else
					<select class="col-md-6 form-control" name="modelloAntenna_id" id="modelloAntenna_id">
						<option value="">-- SELEZIONA --</option>
						@foreach ($modelliAntenna as $modello)
						<option value="{{{ $modello->id }}}" >{{{ $modello->nome }}}</option>
						@endforeach
					</select>
					@endif
				</div>
			</div>
			<!-- ./ modello antenna -->	

		</div>

	</div>	

		<div class="row">
			<div class="col-md-6 nascosto">

				<!-- Seriale Router -->
			<div class="form-group {{ $errors->first('serialeRouter', 'has-error') }}">
					<div class="col-md-12">
						<label class="control-label" for="content">MAC Address Router</label>
						<input class="form-control mac" type="text" name="serialeRouter" id="serialeRouter" value="{{{ Input::old('serialeRouter', isset($router) ? $antenna->router : null) }}}" />
						{{ $errors->first('serialeRouter', '<label id="serialeRouter-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ seriale router -->		

			</div>			
			<div class="col-md-6 nascosto">
				<!-- Modello -->
				<div class="form-group {{ $errors->first('modelloRouter_id', 'has-error') }}">
					<div class="col-md-12">
	                	<label class="control-label" for="modelloRouter_id">Modello Router</label>
	                	<select class="col-md-6 form-control" name="modelloRouter_id" id="modelloRouter_id">
	                	@if ( Input::old('modelloRouter_id') != '' )
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($modelliRouters as $modello)
		                        		<option value="{{{ $modello->id }}}" {{{ ( ($modello->id == Input::old('modelloRouter_id')) ? ' selected="selected"' : '') }}}>{{{ $modello->nome }}}</option>
		                        @endforeach
						@else
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($modelliRouters as $modello)
		                        		<option value="{{{ $modello->id }}}" >{{{ $modello->nome }}}</option>
		                        @endforeach
						@endif
						</select>
	            	</div>
	            	{{ $errors->first('modelloRouter_id', '<label id="modelloRouter_id-error" class="control-label" for="inputError">:message</label>') }}
				</div>
				<!-- ./ modello router -->

			</div>

		</div>	

			

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<button type="reset" class="btn btn-cancel">Annulla</button>
				<button type="submit" class="btn btn-success">Salva</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
		</div>
	</div>
</div>	
@stop

@section('scripts')
<script type="text/javascript">
$(function () {
	$('.date').datetimepicker({
		language: 'it'
	});
});
jQuery(function($){
	$(".mac").mask("**:**:**:**:**:**");
});

$( "#tipoIntervento" ).change(function() {
	if ($( "#tipoIntervento" ).val() != 1)
	{
	$( ".nascosto" ).hide();		
	}

});




</script>
@stop