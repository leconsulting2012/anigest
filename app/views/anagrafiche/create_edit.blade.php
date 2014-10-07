@extends('layouts.modal')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Generale</a></li>
			<li><a href="#tab-meta-data" data-toggle="tab">Interventi</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Blog Form --}}
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
                    <div class="col-md-12">
                        <label class="control-label" for="mac">Cognome</label>
						<input class="form-control" type="text" name="cognome" id="mac" value="{{{ Input::old('cognome', isset($anagrafica) ? $anagrafica->cognome : null) }}}" {{{ $abilitaModifica }}} />
						{{{ $errors->first('cognome', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ cognome-->

				<!-- Nome -->
				<div class="form-group {{{ $errors->has('nome') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Nome</label>
						<input class="form-control" type="text" name="nome" id="nome" value="{{{ Input::old('nome', isset($anagrafica) ? $anagrafica->nome : null) }}}"  {{{ $abilitaModifica }}}/>
						{{{ $errors->first('nome', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ Nome -->

				<!-- indirizzo1 -->
				<div class="form-group {{{ $errors->has('indirizzo1') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Indirizzo 1a riga</label>
						<input class="form-control" type="text" name="indirizzo1" id="indirizzo1" value="{{{ Input::old('indirizzo1', isset($anagrafica) ? $anagrafica->indirizzo1 : null) }}}"  {{{ $abilitaModifica }}}/>
						{{{ $errors->first('indirizzo1', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ indirizzo1-->

				<!-- indirizzo2 -->
				<div class="form-group {{{ $errors->has('indirizzo2') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Indirzzo 2a riga</label>
						<input class="form-control" type="text" name="indirizzo2" id="indirizzo2" value="{{{ Input::old('indirizzo2', isset($anagrafica) ? $anagrafica->indirizzo2 : null) }}}"  {{{ $abilitaModifica }}} />
						{{{ $errors->first('indirizzo2', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ indirizzo2 -->	

				<!-- cap -->
				<div class="form-group {{{ $errors->has('cap') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">CAP</label>
						<input class="form-control" type="text" name="cap" id="cap" value="{{{ Input::old('cap', isset($anagrafica) ? $anagrafica->cap : null) }}}"  {{{ $abilitaModifica }}} />
						{{{ $errors->first('cap', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ cap -->

				<!-- citta -->
				<div class="form-group {{{ $errors->has('citta') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Città</label>
						<input class="form-control" data-provide="typeahead" type="text" name="citta" id="citta" value="{{{ Input::old('citta', isset($anagrafica) ? $anagrafica->citta : null) }}}"  {{{ $abilitaModifica }}} />
						{{{ $errors->first('citta', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ citta anagrafica -->	

				<!-- provincia -->
				<div class="form-group {{{ $errors->has('provincia') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Provincia</label>
						<input class="form-control" type="text" name="provincia" id="provincia" value="{{{ Input::old('provincia', isset($anagrafica) ? $anagrafica->provincia : null) }}}"  {{{ $abilitaModifica }}} />
						{{{ $errors->first('provincia', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ provincia anagrafica -->

				<!-- telefono -->
				<div class="form-group {{{ $errors->has('telefono') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Telefono Fisso</label>
						<input class="form-control" type="text" name="telefono" id="telefono" value="{{{ Input::old('telefono', isset($anagrafica) ? $anagrafica->telefono : null) }}}"  {{{ $abilitaModifica }}} />
						{{{ $errors->first('telefono', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ telefono anagrafica -->

				<!-- fax -->
				<div class="form-group {{{ $errors->has('fax') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Fax</label>
						<input class="form-control" type="text" name="fax" id="fax" value="{{{ Input::old('fax', isset($anagrafica) ? $anagrafica->fax : null) }}}"  {{{ $abilitaModifica }}} />
						{{{ $errors->first('fax', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ fax anagrafica -->

				<!-- cellulare -->
				<div class="form-group {{{ $errors->has('cellulare') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Cellulare</label>
						<input class="form-control" type="text" name="cellulare" id="cellulare" value="{{{ Input::old('cellulare', isset($anagrafica) ? $anagrafica->cellulare : null) }}}"  {{{ $abilitaModifica }}}/>
						{{{ $errors->first('cellulare', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ cellulare anagrafica -->	
				
				<!-- email -->
				<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Email</label>
						<input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', isset($anagrafica) ? $anagrafica->email : null) }}}"  {{{ $abilitaModifica }}} />
						{{{ $errors->first('email', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ email anagrafica -->	
				
				<!-- piva -->
				<div class="form-group {{{ $errors->has('piva') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Partita IVA</label>
						<input class="form-control" type="text" name="piva" id="piva" value="{{{ Input::old('piva', isset($anagrafica) ? $anagrafica->piva : null) }}}"  {{{ $abilitaModifica }}} />
						{{{ $errors->first('piva', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ piva anagrafica -->

				<!-- cfiscale -->
				<div class="form-group {{{ $errors->has('cfiscale') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Codice Fiscale</label>
						<input class="form-control" type="text" name="cfiscale" id="cfiscale" value="{{{ Input::old('cfiscale', isset($anagrafica) ? $anagrafica->cfiscale : null) }}}"  {{{ $abilitaModifica }}} />
						{{{ $errors->first('cfiscale', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ cfiscale anagrafica -->				

			</div>
			<!-- ./ general tab -->

			<!-- Meta Data tab -->
			<div class="tab-pane" id="tab-meta-data">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Data Assegnazione</th>
							<th>Data Intervento</th>
							<th>Installatore</th>
							<th>Tipo Intervento</th>
							<th>Stato</th>
						</tr>
					</thead>
					@foreach ($interventi as $i)
					<tr>
						<td>{{ $i->dataAssegnazione }}</td>
						<td> {{ $i->dataIntervento }}</td>
						<td> {{ $i->installatore }}</td>
						<td> {{ $i->tipoIntervento }}</td>
						<td>
							@if ($i->stato == 1)
							Chiuso
							@else
							Aperto
							@endif
						</td>
					</tr>
					@endforeach
				</table>
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
 var availableTags = [
      "ActionScript",
      "AppleScript",
      "AppleScript2",
      "AppleScript3",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];

 $("#citta").autocomplete({
		source: "/cercaCitta?term="+ $('#citta').val(),
		appendTo: $("form:first")
	});

	$("#citta").data( "ui-autocomplete" )._renderMenu = function( ul, items ) {
		var that = this;		
		ul.attr("class", "nav nav-pills nav-stacked");
		$.each( items, function( index, item ) {
			that._renderItemData( ul, item );
		});
	};	

</script>
@stop
