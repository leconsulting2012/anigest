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
	<form class="form-horizontal" method="post" action="@if (isset($antenna)){{ URL::to('antenne/' . $antenna->id . '/edit') }}@endif" autocomplete="off">
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
						<input class="form-control" type="text" name="mac" id="mac" value="{{{ Input::old('mac', isset($antenna) ? $antenna->mac : null) }}}" />
						{{ $errors->first('mac', '<label id="mac-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ mac antenna -->

				<!-- Seriale -->
				<div class="form-group {{ $errors->first('seriale', 'has-error') }}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Seriale</label>
						<input class="form-control" type="text" name="seriale" id="seriale" value="{{{ Input::old('seriale', isset($antenna) ? $antenna->seriale : null) }}}" />
						{{ $errors->first('seriale', '<label id="seriale-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ seriale antenna -->

				<!-- Modello -->
				<div class="form-group {{ $errors->first('modelloAntenna_id', 'has-error') }}">
					<div class="col-md-12">
	                	<label class="control-label" for="modelloAntenna_id">Modello Antenna</label>
	                	@if ($mode == 'edit')
		                <select class="col-md-6 form-control" name="modelloAntenna_id" id="modelloAntenna_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($modelliAntenna as $modello)
		                        		<option value="{{{ $modello->id }}}" {{{ ( ($modello->id == $antenna->modelloAntenna_id) ? ' selected="selected"' : '') }}}>{{{ $modello->nome }}}</option>
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
	            	{{ $errors->first('modelloAntenna_id', '<label id="modelloAntenna-error" class="control-label" for="inputError">:message</label>') }}
				</div>
				<!-- ./ modello antenna -->	

				<!-- Data di Ricezione -->
				<div class="form-group {{ $errors->first('dataRicezione', 'has-error') }}">
					<div class="col-md-6">
						<label class="control-label" for="content">Data Di Ricezione dal Corriere</label>
							<div class='input-group date' id='datetimepicker2'>
								<input type='text' class="form-control" name="dataRicezione" id="dataRicezione" value="{{{ Input::old('dataRicezione', isset($antenna) ? $antenna->dataRicezione : null) }}}" />
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						
						</div>
						{{ $errors->first('dataRicezione', '<label id="dataRicezione-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ Data di ricezione -->

				<!-- Data di Consegna -->
				<div class="form-group {{ $errors->first('dataConsegna', 'has-error') }}">
					<div class="col-md-6">
						<label class="control-label" for="content">Data di Consegna all'Installatore</label>
							<div class='input-group date' id='datetimepicker2'>
								<input type='text' class="form-control" name="dataConsegna" id="dataConsegna" value="{{{ Input::old('dataConsegna', isset($antenna) ? $antenna->dataConsegna : null) }}}" />
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						
						</div>
						{{ $errors->first('dataConsegna', '<label id="dataConsegna-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ Data di consegna -->					

				<!-- Data di Montaggio -->
				<div class="form-group {{ $errors->first('dataMontaggio', 'has-error') }}">
					<div class="col-md-6">
						<label class="control-label" for="content">Data di Montaggio</label>
							<div class='input-group date' id='datetimepicker2'>
								<input type='text' class="form-control" name="dataMontaggio" id="dataMontaggio" value="{{{ Input::old('dataMontaggio', isset($antenna) ? $antenna->dataMontaggio : null) }}}" />
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						
						</div>
						{{ $errors->first('dataMontaggio', '<label id="dataMontaggio-error" class="control-label" for="inputError">:message</label>') }}
					</div>
				</div>
				<!-- ./ Data di Montaggio -->
										
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

@section('scripts')
        <script type="text/javascript">
            $(function () {
                $('.date').datetimepicker({
                    language: 'it'
                });
            });
        </script>
@stop
