@extends('layouts.modal')

{{-- Content --}}
@section('content')

    {{-- Delete Post Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($intervento)){{ URL::to('interventi/' . $intervento->id . '/delete') }}@endif" autocomplete="off">
        <p>Sei davvero sicuro di eliminare l'intervento </b>?</p>
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $intervento->id }}" />
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="control-group">
            <div class="controls">
                <element class="btn btn-default close_popup">Indietro</element>
                <button type="submit" class="btn btn-danger">Elimina</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop