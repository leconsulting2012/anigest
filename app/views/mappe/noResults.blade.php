@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
{{{ $title }}}
@stop

@section('keywords')antenne @stop
@section('author')Mauro Gallo @stop
@section('description')gestione delle interventi anenne @stop

@section('bodyOnLoad')
<body onload="initMap()" class="skin-blue fixed">
@stop

{{-- Content --}}
@section('content')
<div class="col-xs-12">
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Mappa dei tuoi Interventi non Completati</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <h5>Nessun Intervento programmato.</h5>
    </div>
  </div>
</div>
@stop


