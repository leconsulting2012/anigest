@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Blogs administration @stop
@section('author')Laravel 4 Bootstrap Starter SIte @stop
@section('description')Blogs administration index @stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h3>
            {{{ $title }}}
        </h3>
    </div>

	<form class="form-horizontal" method="post" action="@if (isset($anagrafica)){{ URL::to('anagrafiche/' . $anagrafica->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs MAC -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- cognome -->
				<div class="form-group {{{ $errors->has('cognome') ? 'error' : '' }}}">
                    <div class="col-md-6">
                        <label class="control-label" for="mac">Cognome</label>
						<input class="form-control" type="text" name="cognome" id="mac" value="{{{ Input::old('cognome', isset($anagrafica) ? $anagrafica->cognome : null) }}}" />
						{{{ $errors->first('cognome', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ cognome-->

				<!-- Nome -->
				<div class="form-group {{{ $errors->has('nome') ? 'error' : '' }}}">
					<div class="col-md-6">
                        <label class="control-label" for="content">Nome</label>
						<input class="form-control" type="text" name="nome" id="nome" value="{{{ Input::old('nome', isset($anagrafica) ? $anagrafica->nome : null) }}}" />
						{{{ $errors->first('nome', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ Nome -->

				<!-- indirizzo1 -->
				<div class="form-group {{{ $errors->has('indirizzo1') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Indirizzo 1a riga</label>
						<input class="form-control" type="text" name="indirizzo1" id="indirizzo1" value="{{{ Input::old('indirizzo1', isset($anagrafica) ? $anagrafica->indirizzo1 : null) }}}" />
						{{{ $errors->first('indirizzo1', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ indirizzo1-->

				<!-- indirizzo2 -->
				<div class="form-group {{{ $errors->has('indirizzo2') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Indirzzo 2a riga</label>
						<input class="form-control" type="text" name="indirizzo2" id="indirizzo2" value="{{{ Input::old('indirizzo2', isset($anagrafica) ? $anagrafica->indirizzo2 : null) }}}" />
						{{{ $errors->first('indirizzo2', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ indirizzo2 -->	

				<!-- cap -->
				<div class="form-group {{{ $errors->has('cap') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">CAP</label>
						<input class="form-control" type="text" name="cap" id="cap" value="{{{ Input::old('cap', isset($anagrafica) ? $anagrafica->cap : null) }}}" />
						{{{ $errors->first('cap', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ cap -->

				<!-- citta -->
				<div class="form-group {{{ $errors->has('citta') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Città</label>
						<input class="form-control" type="text" name="citta" id="citta" value="{{{ Input::old('citta', isset($anagrafica) ? $anagrafica->citta : null) }}}" />
						{{{ $errors->first('citta', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ citta anagrafica -->	

				<!-- provincia -->
				<div class="form-group {{{ $errors->has('provincia') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Provincia</label>
						<input class="form-control" type="text" name="provincia" id="provincia" value="{{{ Input::old('provincia', isset($anagrafica) ? $anagrafica->provincia : null) }}}" />
						{{{ $errors->first('provincia', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ provincia anagrafica -->

				<!-- telefono -->
				<div class="form-group {{{ $errors->has('telefono') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Telefono Fisso</label>
						<input class="form-control" type="text" name="telefono" id="telefono" value="{{{ Input::old('telefono', isset($anagrafica) ? $anagrafica->telefono : null) }}}" />
						{{{ $errors->first('telefono', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ telefono anagrafica -->

				<!-- cellulare -->
				<div class="form-group {{{ $errors->has('cellulare') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Cellulare</label>
						<input class="form-control" type="text" name="cellulare" id="cellulare" value="{{{ Input::old('cellulare', isset($anagrafica) ? $anagrafica->cellulare : null) }}}" />
						{{{ $errors->first('cellulare', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ cellulare anagrafica -->

				<!-- Modello antenna -->
				<div class="form-group {{{ $errors->has('modelloAntenna_id') ? 'error' : '' }}}">
					<div class="col-md-12">
	                	<label class="control-label" for="modelloAntenna_id">Modello Antenna</label>
		                <select class="col-md-6 form-control" name="modelloAntenna_id" id="modelloAntenna_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($modelliAntenna as $modello)
		                        		<option value="{{{ $modello->id }}}" >{{{ $modello->nome }}}</option>
		                        @endforeach
						</select>
	            	</div>
				</div>
				<!-- ./ modello antenna -->	

				<!-- Seriale -->
				<div class="form-group {{{ $errors->has('seriale') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Seriale</label>
						<input class="form-control" type="text" name="seriale" id="seriale" value="{{{ Input::old('seriale', isset($antenna) ? $antenna->seriale : null) }}}" />
						{{{ $errors->first('seriale', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ seriale antenna -->						

			</div>
			<!-- ./ general tab -->

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

{{-- Scripts --}}
@section('scripts')

@stop