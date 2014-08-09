@extends('layouts.modal')

{{-- Web site Title --}}
@section('title')
{{{ $title }}}
@stop

@section('keywords')antenne @stop
@section('author')Mauro Gallo @stop
@section('description')gestione delle interventi anenne @stop

@section('jsEsterni')
{{ HTML::script('js/jquery.maskedinput.min.js') }}
@stop

{{-- Content --}}
@section('content')

	{{-- Edit Blog Form --}}

	<form class="form-horizontal" method="post" action="@if (isset($intervento)){{ URL::to('interventi/' . $intervento->id . '/close') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<div class="col-xs-12">
			<legend>Apparato</legend>	

			<div class="row">
				<div class="col-xs-12">
					<div class="form-group {{ $errors->first('esito', 'has-error') }}">
						{{ Form::label('esito', '(*) Esito') }}
						{{ Form::select('esito', array('' => '-- SELEZIONA --', 'div1' => 'KO', 'div2' => 'OK'), Input::old('esito'), array('id' => 'dropDown', 'class' => 'form-control')) }}
						{{ $errors->first('esito', '<label id="esito-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
			</div>   

			<div id="div1" class="drop-down-show-hide">
				<div class="row">
					<!-- Note -->
					<div class="form-group {{{ $errors->has('noteMale') ? 'error' : '' }}}">
						<div class="col-xs-12">
							<label class="control-label" for="content">Note</label>
							<textarea class="form-control" name="noteMale" id="noteMale" rows="3" placeholder="Mancanza di segnale">{{{ Input::old('noteMale', isset($intervento) ? $intervento->noteMale : null) }}}</textarea>
							{{{ $errors->first('noteMale', '<span class="help-inline">:message</span>') }}}
						</div>
					</div>
					<!-- ./ Data di intervento -->
					{{ $errors->first('noteMale', '<label id="noteMale-error" class="control-label" for="inputError">:message</label>') }}
				</div> 
			</div>

			<div  id="div2" class="drop-down-show-hide">
				<!-- IP -->
				<div class="row">
					<div class="form-group {{ $errors->first('ip', 'has-error') }}">
						<div class="col-xs-12">
							<label class="control-label" for="content">Indirizzo IP</label>
							<input type='text' class="form-control" name="ip" value="{{{ Input::old('ip', isset($intervento) ? $intervento->ip : null) }}}" />
							{{ $errors->first('ip', '<label id="ip-error" class="control-label" for="inputError">:message</label>') }}
						</div>
					</div>
				</div>
				<!-- ./ IP -->

				<!-- BSID -->
				<div class="row">
					<div class="form-group {{ $errors->first('bsid', 'has-error') }}">
						<div class="col-xs-12">
							<label class="control-label" for="content">BSSID</label>
							<input type='text' class="form-control" name="bsid" value="{{{ Input::old('bsid', isset($intervento) ? $intervento->bsid : null) }}}" />
							{{ $errors->first('bsid', '<label id="bsid-error" class="control-label" for="inputError">:message</label>') }}
						</div>
					</div>
				</div>
				<!-- ./ BSID -->

				<!-- rssi -->
				<div class="row">				
					<div class="form-group {{ $errors->first('rssi', 'has-error') }}">
						<div class="col-xs-12">
							<label class="control-label" for="content">RSSI</label>
							<input type='text' class="form-control" name="rssi" value="{{{ Input::old('rssi', isset($intervento) ? $intervento->rssi : null) }}}" />
							{{ $errors->first('rssi', '<label id="rssi-error" class="control-label" for="inputError">:message</label>') }}
						</div>
					</div>
				</div>
				<!-- ./ rssi -->

				<!-- cmri -->
				<div class="row">
					<div class="form-group {{ $errors->first('cmri', 'has-error') }}">
						<div class="col-xs-12">
							<label class="control-label" for="content">CMRI</label>
							<input type='text' class="form-control" name="cmri" value="{{{ Input::old('cmri', isset($intervento) ? $intervento->cmri : null) }}}" />
							{{ $errors->first('cmri', '<label id="cmri-error" class="control-label" for="inputError">:message</label>') }}
						</div>
					</div>
				</div>
				<!-- ./ cmri -->

				<div class="row">
					<!-- Note -->
					<div class="form-group {{{ $errors->has('noteBene') ? 'error' : '' }}}">
						<div class="col-xs-12">
							<label class="control-label" for="content">noteBene</label>
							<textarea class="form-control" name="noteBene" id="noteBene" rows="3" placeholder="Mancanza di segnale">{{{ Input::old('noteBene', isset($intervento) ? $intervento->noteBene : null) }}}</textarea>
							{{{ $errors->first('noteBene', '<span class="help-inline">:message</span>') }}}
						</div>
					</div>
					<!-- ./ Data di intervento -->
					{{ $errors->first('noteBene', '<label id="noteBene-error" class="control-label" for="inputError">:message</label>') }}
				</div>
			</div>

			<!-- Form Actions -->
			<div class="form-group">
				<div class="col-md-12">
					<element class="btn btn-default close_popup">Indietro</element>
					<button type="reset" class="btn btn-cancel">Annulla</button>
					<button type="submit" class="btn btn-success" onClick="return confirm('Una volta confermati i dati non sarà più possibile modificarli. Continui?');">Salva</button>
				</div>
			</div>
			<!-- ./ form actions -->
		</div>
	</form>

		@stop

@section('scripts')
<script type="text/javascript">

$(document).ready(function(){

	$('.drop-down-show-hide').hide();

	if ($('#dropDown').val() == 'div1'){ 
		$('#div2').hide();
		$('#div1').show();
	}
	if ($('#dropDown').val() == 'div2'){ 
		$('#div2').hide();
		$('#div2').show();
	}
	$('#dropDown').change(function(){
		$('#sorgente-error').hide();
		$(this).find("option").each(function()
		{
			$('#' + this.value).hide();
		});
		$('#' + this.value).show();
	});	
});

jQuery(function($){
	$("#bsid").mask("**:**:**:**:**:**");
});

jQuery(function($){
	$("#ip").mask("9?.9?.9?.9?");
});

</script>

@stop
