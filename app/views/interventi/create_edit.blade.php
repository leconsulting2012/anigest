@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Generale</a></li>
			<li><a href="#tab-meta-data" data-toggle="tab">#######</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Blog Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($installazione)){{ URL::to('installazioni/' . $installazione->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs MAC -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<!-- Anagrafica -->
				<div class="form-group {{{ $errors->has('anagrafica_id') ? 'error' : '' }}}">
					<div class="col-md-12">
	                	<label class="control-label" for="anagrafica_id">Anagrafica</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control" name="anagrafica_id" id="anagrafica_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($anagrafiche as $a)
		                        		<option value="{{{ $a->id }}}" {{{ ( ($a->id == $installazione->anagrafica_id) ? ' selected="selected"' : '') }}}>{{{ $a->cognome }}} {{{ $a->nome }}} - {{{ $a->indirizzo1 }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control" name="anagrafica_id" id="anagrafica_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($anagrafiche as $a)
		                        		<option value="{{{ $a->id }}}" >{{{ $a->cognome }}} {{{ $a->nome }}} - {{{ $a->indirizzo1 }}}</option>
		                        @endforeach
						</select>
						@endif
	            	</div>
				</div>
				<!-- ./ Anagrafica -->	

				<!-- Antenna -->
				<div class="form-group {{{ $errors->has('antenna_id') ? 'error' : '' }}}">
					<div class="col-md-12">
	                	<label class="control-label" for="antenna_id">Antenna</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control" name="antenna_id" id="antenna_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($antenne as $a)
		                        		<option value="{{{ $a->id }}}" {{{ ( ($a->id == $installazione->antenna_id) ? ' selected="selected"' : '') }}}>{{{ $a->seriale }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control" name="antenna_id" id="antenna_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($antenne as $a)
		                        		<option value="{{{ $a->id }}}" >{{{ $a->seriale }}}</option>
		                        @endforeach
						</select>
						@endif
	            	</div>
				</div>
				<!-- ./ modello antenna -->	

				<!-- Router -->
				<div class="form-group {{{ $errors->has('router_id') ? 'error' : '' }}}">
					<div class="col-md-12">
	                	<label class="control-label" for="router_id">Router</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control" name="router_id" id="router_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($routers as $a)
		                        		<option value="{{{ $a->id }}}" {{{ ( ($a->id == $installazione->router_id) ? ' selected="selected"' : '') }}}>{{{ $a->seriale }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control" name="router_id" id="router_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($routers as $a)
		                        		<option value="{{{ $a->id }}}" >{{{ $a->seriale }}}</option>
		                        @endforeach
						</select>
						@endif
	            	</div>
				</div>
				<!-- ./ Router -->	

				<!-- Data di Installazione -->
				<div class="form-group {{{ $errors->has('dataInstallazione') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Data di Installazione</label>
						<input class="form-control" type="text" name="dataInstallazione" id="dataInstallazione" value="{{{ Input::old('dataInstallazione', isset($installazione) ? $antenna->dataInstallazione : null) }}}" />
						{{{ $errors->first('dataInstallazione', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ Data di installazione -->

				<!-- Installatore -->
				<div class="form-group {{{ $errors->has('user_id') ? 'error' : '' }}}">
					<div class="col-md-12">
	                	<label class="control-label" for="userid_id">Installatore</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control" name="user_id" id="user_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($users as $a)
		                        		<option value="{{{ $a->id }}}" {{{ ( ($a->id == $installazione->user_id) ? ' selected="selected"' : '') }}}>{{{ $a->username }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control" name="user_id" id="user_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($users as $a)
		                        		<option value="{{{ $a->id }}}" >{{{ $a->username }}}</option>
		                        @endforeach
						</select>
						@endif
	            	</div>
				</div>
				<!-- ./ Installatore -->		

			</div>
			<!-- ./ general tab -->

			<!-- Meta Data tab -->
			<div class="tab-pane" id="tab-meta-data">
				<!-- Meta Title -->
				<div class="form-group {{{ $errors->has('meta-title') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-title">Meta Title</label>
						<input class="form-control" type="text" name="meta-title" id="meta-title" value="{{{ Input::old('meta-title', isset($post) ? $post->meta_title : null) }}}" />
						{{{ $errors->first('meta-title', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ meta title -->

				<!-- Meta Description -->
				<div class="form-group {{{ $errors->has('meta-description') ? 'error' : '' }}}">
					<div class="col-md-12 controls">
                        <label class="control-label" for="meta-description">Meta Description</label>
						<input class="form-control" type="text" name="meta-description" id="meta-description" value="{{{ Input::old('meta-description', isset($post) ? $post->meta_description : null) }}}" />
						{{{ $errors->first('meta-description', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ meta description -->

				<!-- Meta Keywords -->
				<div class="form-group {{{ $errors->has('meta-keywords') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-keywords">Meta Keywords</label>
						<input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{{ Input::old('meta-keywords', isset($post) ? $post->meta_keywords : null) }}}" />
						{{{ $errors->first('meta-keywords', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ meta keywords -->
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
