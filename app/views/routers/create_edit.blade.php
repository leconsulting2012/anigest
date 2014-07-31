@extends('layouts.modal')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Generale</a></li>
			<li><a href="#tab-meta-data" data-toggle="tab">#######</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Blog Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($router)){{ URL::to('routers/' . $router->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs MAC -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- Post Title -->
				<div class="form-group {{{ $errors->has('mac') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="mac">MAC</label>
						<input class="form-control" type="text" name="mac" id="mac" value="{{{ Input::old('mac', isset($router) ? $router->mac : null) }}}" />
						{{{ $errors->first('mac', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ mac router -->

				<!-- Seriale -->
				<div class="form-group {{{ $errors->has('seriale') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Seriale</label>
						<input class="form-control" type="text" name="seriale" id="seriale" value="{{{ Input::old('seriale', isset($router) ? $router->seriale : null) }}}" />
						{{{ $errors->first('seriale', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ seriale router -->

				<!-- Modello -->
				<div class="form-group {{{ $errors->has('modelloRouter_id') ? 'error' : '' }}}">
					<div class="col-md-12">
	                	<label class="control-label" for="modelloRouter_id">Modello Router</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control" name="modelloAntenna_id" id="modelloAntenna_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($modelliRouter as $modello)
		                        		<option value="{{{ $modello->id }}}" {{{ ( ($modello->id == $router->modelloRouter_id) ? ' selected="selected"' : '') }}}>{{{ $modello->nome }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control" name="modelloRouter_id" id="modelloRouter_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($modelliRouter as $modello)
		                        		<option value="{{{ $modello->id }}}" >{{{ $modello->nome }}}</option>
		                        @endforeach
						</select>
						@endif
	            	</div>
				</div>
				<!-- ./ modello router -->	
							
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
