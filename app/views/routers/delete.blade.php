@extends('layouts.modal')

{{-- Content --}}
@section('content')
    <p>
        Elimino il router con seriale <b>{{ $router->seriale }}</b>?
    </p>
    {{-- Delete User Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($router)){{ URL::to('routers/' . $router->id . '/delete') }}@endif" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $router->id }}" />
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="control-group">
            <div class="controls">
                <element class="btn-cancel close_popup">Annulla</element>
                <button type="submit" class="btn btn-danger">Elimina</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop