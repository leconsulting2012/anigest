@extends('layouts.modal')

{{-- Content --}}
@section('content')
    <p>
        Elimino l'antenna con seriale <b>{{ $antenna->seriale }}</b>?
    </p>

    {{-- Delete User Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($antenna)){{ URL::to('antenne/' . $antenna->id . '/delete') }}@endif" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $antenna->id }}" />
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="control-group">
            <div class="controls">
                <element class="btn-cancel close_popup">Cancel</element>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop