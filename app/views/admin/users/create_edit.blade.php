@extends('layouts.modal')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Generale</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Create User Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('admin/users/' . $user->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- username -->
				<div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="username">Username</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="username" id="username" value="{{{ Input::old('username', isset($user) ? $user->username : null) }}}" />
						{{{ $errors->first('username', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ username -->

				<!-- Email -->
				<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="email">Email</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', isset($user) ? $user->email : null) }}}" />
						{{{ $errors->first('email', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ email -->

				<!-- Password -->
				<div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="password">Password</label>
					<div class="col-md-10">
						<input class="form-control" type="password" name="password" id="password" value="" />
						{{{ $errors->first('password', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ password -->

				<!-- Password Confirm -->
				<div class="form-group {{{ $errors->has('password_confirmation') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="password_confirmation">Conferma Password</label>
					<div class="col-md-10">
						<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" />
						{{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ password confirm -->

				<!-- Activation Status -->
				<div class="form-group {{{ $errors->has('activated') || $errors->has('confirm') ? 'error' : '' }}}">
					<label class="col-md-2 control-label" for="confirm">Utente Attivo?</label>
					<div class="col-md-6">
						@if ($mode == 'create')
							<select class="form-control" name="confirm" id="confirm">
								<option value="1"{{{ (Input::old('confirm', 0) === 1 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
								<option value="0"{{{ (Input::old('confirm', 0) === 0 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
							</select>
						@else
							<select class="form-control" {{{ ($user->id === Confide::user()->id ? ' disabled="disabled"' : '') }}} name="confirm" id="confirm">
								<option value="1"{{{ ($user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
								<option value="0"{{{ ( ! $user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
							</select>
						@endif
						{{{ $errors->first('confirm', '<span class="help-inline">:message</span>') }}}
					</div>
				</div>
				<!-- ./ activation status -->

				<!-- Azienda -->
				<div class="form-group {{{ $errors->has('azienda_id') ? 'error' : '' }}}">
	                <label class="col-md-2 control-label" for="azienda_id">Azienda</label>
	                <div class="col-md-6">
	                	@if ($mode == 'edit')
		                <select class="form-control" name="azienda_id" id="azienda_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($aziende as $a)
		                        		<option value="{{{ $a->id }}}" {{{ ( ($a->id == $user->azienda_id) ? ' selected="selected"' : '') }}}>{{{ $a->nome }}}</option>
		                        @endforeach
						</select>
						@else
		                <select class="col-md-6 form-control" name="azienda_id" id="azienda_id">
		                	<option value="">-- SELEZIONA --</option>
		                        @foreach ($aziende as $a)
		                        		<option value="{{{ $a->id }}}" >{{{ $a->nome }}}</option>
		                        @endforeach
						</select>
						@endif
					</div>
				</div>
				<!-- ./ Azienda -->

				<!-- Groups -->
				<div class="form-group {{{ $errors->has('roles') ? 'error' : '' }}}">
	                <label class="col-md-2 control-label" for="roles">Ruoli</label>
	                <div class="col-md-6">
		                <select class="form-control" name="roles[]" id="roles[]" multiple>
		                        @foreach ($roles as $role)
									@if ($mode == 'create')
		                        		<option value="{{{ $role->id }}}"{{{ ( in_array($role->id, $selectedRoles) ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
		                        	@else
										<option value="{{{ $role->id }}}"{{{ ( array_search($role->id, $user->currentRoleIds()) !== false && array_search($role->id, $user->currentRoleIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
									@endif
		                        @endforeach
						</select>

						<span class="help-block">
							Select a group to assign to the user, remember that a user takes on the permissions of the group they are assigned.
						</span>
	            	</div>
				</div>
				<!-- ./ groups -->
			</div>
			<!-- ./ general tab -->

		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-offset-2 col-md-10">
				<element class="btn-cancel close_popup">Annulla</element>
				<button type="reset" class="btn btn-default">Cancella</button>
				<button type="submit" class="btn btn-success">Salva</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop