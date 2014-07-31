@extends('layouts.public')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.forgot_password') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1>Password Dimenticata</h1>
</div>
<form method="POST" action="{{ (Confide::checkAction('UserController@do_forgot_password')) ?: URL::to('/user/forgot') }}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

    <div class="form-group">
        <label for="email">Indirizzo email</label>
        <div class="input-append input-group">
            <input class="form-control" placeholder="indirizzo email" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
            <span class="input-group-btn">
                <input class="btn btn-default" type="submit" value="Invia">
            </span>
        </div>
    </div>

    @if ( Session::get('error') )
        <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
    @endif

    @if ( Session::get('notice') )
        <div class="alert">{{{ Session::get('notice') }}}</div>
    @endif
</form>
@stop
