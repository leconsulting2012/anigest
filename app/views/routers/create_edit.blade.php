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
				<div class="form-group {{ $errors->first('mac', 'has-error') }}">
                    <div class="col-md-12">
                        <label class="control-label" for="mac">MAC</label>
						<input class="form-control" type="text" name="mac" id="mac" value="{{{ Input::old('mac', isset($router) ? $router->mac : null) }}}" {{{ $abilitaModifica }}}/>
						{{ $errors->first('mac', '<label id="mac-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ mac router -->

				<!-- Seriale -->
				<div class="form-group {{ $errors->first('seriale', 'has-error') }}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Seriale</label>
						<input class="form-control" type="text" name="seriale" id="seriale" value="{{{ Input::old('seriale', isset($router) ? $router->seriale : null) }}}" {{{ $abilitaModifica }}}/>
						{{ $errors->first('seriale', '<label id="seriale-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ seriale router -->

				<!-- Modello -->
				<div class="form-group {{ $errors->first('modelliRouter_id', 'has-error') }}">
					<div class="col-md-12">
	                	<label class="control-label" for="modelliRouter_id">Modello Router</label>
	                	<select class="col-md-6 form-control" name="modelliRouter_id" id="modelliRouter_id" {{{ $abilitaModifica }}}>
	                	@if ($mode == 'edit')
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($modelliRouter as $modello)
		                        		<option value="{{{ $modello->id }}}" {{{ ( ($modello->id == $router->modelliRouter_id) ? ' selected="selected"' : '') }}}>{{{ $modello->nome }}}</option>
		                        @endforeach
						@else
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($modelliRouter as $modello)
		                        		<option value="{{{ $modello->id }}}" >{{{ $modello->nome }}}</option>
		                        @endforeach
						@endif
						</select>
	            	</div>
	            	{{ $errors->first('modelliRouter_id', '<label id="modelliRouter_id-error" class="control-label" for="inputError">:message</label>') }}
				</div>
				<!-- ./ modello router -->	

				<!-- Data di Ricezione -->
				<div class="form-group {{ $errors->first('dataRicezione', 'has-error') }}">
					<div class="col-md-6">
						<label class="control-label" for="content">Data Di Ricezione dal Corriere</label>
							<div class='input-group date' id='datetimepicker2'>
								<input type='text' class="form-control" name="dataRicezione" id="dataRicezione" value="{{{ Input::old('dataRicezione', isset($router) ? $router->dataRicezione : null) }}}" {{{ $abilitaModifica }}}/>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						
						</div>
						{{ $errors->first('dataRicezione', '<label id="dataRicezione-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ Data di ricezione -->				
							
			</div>
			<!-- ./ general tab -->

			<!-- Meta Data tab -->
			<div class="tab-pane" id="tab-meta-data">
				<!-- Meta Title -->
				<div class="form-group {{{ $errors->has('meta-title') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-title">Meta Title</label>
						<input class="form-control" type="text" name="meta-title" id="meta-title" value="{{{ Input::old('meta-title', isset($post) ? $post->meta_title : null) }}}" {{{ $abilitaModifica }}}/>
						{{{ $errors->first('meta-title', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ meta title -->

				<!-- Meta Description -->
				<div class="form-group {{{ $errors->has('meta-description') ? 'error' : '' }}}">
					<div class="col-md-12 controls">
                        <label class="control-label" for="meta-description">Meta Description</label>
						<input class="form-control" type="text" name="meta-description" id="meta-description" value="{{{ Input::old('meta-description', isset($post) ? $post->meta_description : null) }}}" {{{ $abilitaModifica }}}/>
						{{{ $errors->first('meta-description', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ meta description -->

				<!-- Meta Keywords -->
				<div class="form-group {{{ $errors->has('meta-keywords') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-keywords">Meta Keywords</label>
						<input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{{ Input::old('meta-keywords', isset($post) ? $post->meta_keywords : null) }}}" {{{ $abilitaModifica }}}/>
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

@section('scripts')
<script type="text/javascript">
jQuery(function($){
   $("#mac").mask("**:**:**:**:**:**");
});
</script>
@stop
