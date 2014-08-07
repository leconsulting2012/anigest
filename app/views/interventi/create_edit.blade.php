@extends('layouts.modal')

{{-- Web site Title --}}
@section('title')
{{{ $title }}}
@stop

@section('keywords')antenne @stop
@section('author')Mauro Gallo @stop
@section('description')gestione delle interventi anenne @stop


@section('cssEsterni')
{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
{{ HTML::style('css/combobox/bootstrap-combobox.css') }} 
@stop

@section('jsEsterni')
{{ HTML::script('js/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('js/bootstrap-datetimepicker.pt-IT.js') }}
{{ HTML::script('js/plugins/combobox/bootstrap-combobox.js') }}
@stop

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Generale</a></li>
			<li><a href="#tab-meta-data" data-toggle="tab">Parametri Antenna</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Blog Form --}}

	<form class="form-horizontal" method="post" action="@if (isset($intervento)){{ URL::to('interventi/' . $intervento->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs MAC -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<!-- Anagrafica -->
				<div class="form-group {{ $errors->first('anagrafica_id', 'has-error') }}">
					<div class="col-md-12">
	                	<label class="control-label" for="anagrafica_id">Anagrafica</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control combobox" name="anagrafica_id" id="anagrafica_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($anagrafiche as $a)
		                        		<option value="{{{ $a->id }}}" {{{ ( ($a->id == $intervento->anagrafica_id) ? ' selected="selected"' : '') }}}>{{{ $a->cognome }}} {{{ $a->nome }}} | {{{ $a->indirizzo1 }}} - {{{ $a->citta }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control combobox" name="anagrafica_id" id="anagrafica_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($anagrafiche as $a)
		                        		<option value="{{{ $a->id }}}" >{{{ $a->cognome }}} {{{ $a->nome }}} | {{{ $a->indirizzo1 }}} - {{{ $a->citta }}}</option>
		                        @endforeach
						</select>
						@endif
						{{ $errors->first('anagrafica_id', '<label id="anagrafica_id-error" class="control-label" for="inputError">:message</label>') }}
	            	</div>
				</div>
				<!-- ./ Anagrafica -->	

				<!-- Antenna -->
				<div class="form-group {{ $errors->first('antenna_id', 'has-error') }}">
					<div class="col-md-12">
	                	<label class="control-label" for="antenna_id">Antenna</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control combobox" name="antenna_id" id="antenna_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($antenne as $a)
		                        		<option value="{{{ $a->id }}}" {{{ ( ($a->id == $intervento->antenna_id) ? ' selected="selected"' : '') }}}> {{{ $a->mac }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control combobox" name="antenna_id" id="antenna_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($antenne as $a)
		                        		<option value="{{{ $a->id }}}" >{{{ $a->mac }}}</option>
		                        @endforeach
						</select>
						@endif
						{{ $errors->first('antenna_id', '<label id="antenna_id-error" class="control-label" for="inputError">:message</label>') }}
	            	</div>
				</div>
				<!-- ./ modello antenna -->	

				<!-- Router -->
				<div class="form-group {{ $errors->first('router_id', 'has-error') }}">
					<div class="col-md-12">
	                	<label class="control-label" for="router_id">Router</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control combobox" name="router_id" id="router_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($routers as $a)
		                        		<option value="{{{ $a->id }}}" {{{ ( ($a->id == $intervento->router_id) ? ' selected="selected"' : '') }}}>{{{ $a->mac }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control combobox" name="router_id" id="router_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($routers as $a)
		                        		<option value="{{{ $a->id }}}" >{{{ $a->mac }}}</option>
		                        @endforeach
						</select>
						@endif
						{{ $errors->first('router_id', '<label id="router_id-error" class="control-label" for="inputError">:message</label>') }}
	            	</div>
				</div>
				<!-- ./ Router -->	

				<!-- Data di Intervento -->
				<div class="form-group {{ $errors->first('c', 'has-error') }}">
					<div class="col-md-6">
						<label class="control-label" for="content">Data di Intervento</label>
							<div class='input-group date' id='datetimepicker2'>
								<input type='text' class="form-control" name="dataIntervento" id="dataIntervento" value="{{{ Input::old('dataIntervento', isset($intervento) ? $intervento->dataIntervento : null) }}}" />
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						
						</div>
						{{ $errors->first('dataIntervento', '<label id="dataIntervento-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ Data di intervento -->

				<!-- Installatore -->
				<div class="form-group {{{ $errors->has('user_id') ? 'error' : '' }}}">
					<div class="col-md-12">
	                	<label class="control-label" for="userid_id">Installatore</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control" name="user_id" id="user_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($installatori as $a)
		                        		<option value="{{{ $a->id }}}" {{{ ( ($a->id == $intervento->user_id) ? ' selected="selected"' : '') }}}>{{{ $a->username }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control" name="user_id" id="user_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($installatori as $a)
		                        		<option value="{{{ $a->id }}}" >{{{ $a->username }}}</option>
		                        @endforeach
						</select>
						@endif
						{{ $errors->first('user_id', '<label id="user_id-error" class="control-label" for="inputError">:message</label>') }}
	            	</div>
				</div>
				<!-- ./ Installatore -->

				<!-- Tipo Intervento -->
				<div class="form-group {{{ $errors->has('tipiIntervento_id') ? 'error' : '' }}}">
					<div class="col-md-12">
	                	<label class="control-label" for="tipiIntervento_id">Tipo Intervento</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control" name="tipiIntervento_id" id="tipiIntervento_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($modelliIntervento as $a)
		                        		<option value="{{{ $a->id }}}" {{{ ( ($a->id == $intervento->tipiIntervento_id) ? ' selected="selected"' : '') }}}>{{{ $a->tipo }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control" name="tipiIntervento_id" id="tipiIntervento_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($modelliIntervento as $a)
		                        		<option value="{{{ $a->id }}}" >{{{ $a->tipo }}}</option>
		                        @endforeach
						</select>
						@endif
						{{ $errors->first('tipiIntervento_id', '<label id="tipiIntervento_id-error" class="control-label" for="inputError">:message</label>') }}
	            	</div>
				</div>
				<!-- ./ modello antenna -->						


				<!-- Note -->
				<div class="form-group {{{ $errors->has('note') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Note</label>
						<input class="form-control" type="text" name="note" id="note" value="{{{ Input::old('note', isset($intervento) ? $intervento->note : null) }}}" />
						{{{ $errors->first('note', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ Data di intervento -->
				{{ $errors->first('note', '<label id="note-error" class="control-label" for="inputError">:message</label>') }}
			</div>
			<!-- ./ general tab -->

			<!-- Meta Data tab -->
			<div class="tab-pane" id="tab-meta-data">
				<!-- IP -->
				<div class="form-group {{ $errors->first('ip', 'has-error') }}">
					<div class="col-md-6">
						<label class="control-label" for="content">Indirizzo IP</label>
						<input type='text' class="form-control" name="ip" value="{{{ Input::old('ip', isset($intervento) ? $intervento->ip : null) }}}" />
						{{ $errors->first('ip', '<label id="ip-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ IP -->

				<!-- BSID -->
				<div class="form-group {{ $errors->first('bsid', 'has-error') }}">
					<div class="col-md-6">
						<label class="control-label" for="content">BSID</label>
						<input type='text' class="form-control" name="bsid" value="{{{ Input::old('bsid', isset($intervento) ? $intervento->bsid : null) }}}" />
						{{ $errors->first('bsid', '<label id="bsid-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ BSID -->

				<!-- rssi -->
				<div class="form-group {{ $errors->first('rssi', 'has-error') }}">
					<div class="col-md-6">
						<label class="control-label" for="content">RSSI</label>
						<input type='text' class="form-control" name="rssi" value="{{{ Input::old('rssi', isset($intervento) ? $intervento->rssi : null) }}}" />
						{{ $errors->first('rssi', '<label id="rssi-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ rssi -->

				<!-- cmri -->
				<div class="form-group {{ $errors->first('cmri', 'has-error') }}">
					<div class="col-md-6">
						<label class="control-label" for="content">CMRI</label>
						<input type='text' class="form-control" name="cmri" value="{{{ Input::old('cmri', isset($intervento) ? $intervento->cmri : null) }}}" />
						{{ $errors->first('cmri', '<label id="cmri-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ cmri -->				
			</div>
			<!-- ./ meta data tab -->
		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<element class="btn btn-default close_popup">Indietro</element>
				<button type="reset" class="btn btn-cancel">Annulla</button>
				<button type="submit" class="btn btn-success">Salva</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop

@section('scripts')
<script type="text/javascript">
$(function () {
	$('.date').datetimepicker({
		language: 'it'
	});
});

$(document).ready(function(){
	$('.combobox').combobox();
});

</script>
@stop
