@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
{{{ $title }}}
@stop

@section('keywords')antenne @stop
@section('author')Mauro Gallo @stop
@section('description')gestione delle interventi anenne @stop


@section('cssEsterni')
{{ HTML::style('css/datatables/dataTables.bootstrap.css') }}
{{ HTML::style('css/colorbox.css') }}
@stop

@section('jsEsterni')
{{ HTML::script('js/jquery.colorbox-min.js') }}
{{ HTML::script('js/plugins/datatables/jquery.dataTables.js') }}.
{{ HTML::script('js/plugins/datatables/dataTables.bootstrap.js') }} 
@stop

@section('bodyOnLoad')
<body class="skin-blue fixed" >
	@stop

{{-- Content --}}
@section('content')

	<div class="col-xs-12">
		<div class="box box-info">
			<h4 class="page-header">
				AniGEST - Gestione del Magazzino
			</h4>
			<div class="box-body">
				<div class="box box-solid box-success">
					<div class="box-header">
						<h3 class="box-title">Materiale Assegnato da Consegnare</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">

					@foreach ($operatori as $riga)
						<div class="col-md-6">
							<!-- Blue tile -->
							<div class="box box-solid">
								<div class="box-header">
									<h3 class="box-title">Consegnare a {{ $riga->username }}:</h3>
								</div>
								<div class="box-body">
									<div class="box-body table-responsive no-padding">
                                    <table id="tabella{{ $riga->id }}" class="table table-hover">
                                        <tbody><tr>
                                            <th>Modello</th>
                                            <th>Seriale</th>
                                            <th>Mac</th>
                                            <th>Cliente</th>
                                        </tr>

                                    </tbody></table>
                                </div>
									<button class="btn btn-success">Consegna</button>
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</div>
					@endforeach	

					</div><!-- /.box-body -->
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<div class="col-md-12">

					<!-- Danger box -->
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Antenne in Magazzino</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="box-body no-padding">
								<table class="table table-condensed">
									<tbody><tr>
										<th style="width: 10px"></th>
										<th style="width: 10px">#</th>
										<th>Anagrafica</th>
										<th>Telefono</th>
										<th style="width: 40px">Tipo</th>
									</tr>
									@foreach ($interventi as $riga)
									<tr>
										<td>
<div class="icheckbox"><input type="checkbox" ></div>
										</td>
										<td>{{$riga['n']}}</td>
										<td>{{$riga['anagrafica'] }}</td>
										<td><a href="tel:{{$riga['telefono']}}">{{$riga['telefono']}}</a></td>
  										<td><span class="badge bg-{{ $riga['livello'] }}">{{$riga['livTesto']}}</span></td>
  									</tr>
									@endforeach
	
								</tbody></table>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->

					<!-- Danger box -->
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Routers in Magazzino</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="box-body no-padding">
								<table class="table table-condensed">
									<tbody><tr>
										<th style="width: 10px">#</th>
										<th>Anagrafica</th>
										<th>Telefono</th>
										<th style="width: 40px">Tipo</th>
									</tr>
									@foreach ($interventi as $riga)
									<tr>
										<td>{{$riga['n']}}</td>
										<td>{{$riga['anagrafica'] }}</td>
										<td><a href="tel:{{$riga['telefono']}}">{{$riga['telefono']}}</a></td>
  										<td><span class="badge bg-{{ $riga['livello'] }}">{{$riga['livTesto']}}</span></td>
  									</tr>
									@endforeach
	
								</tbody></table>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
					</div>
				</div>

				<div class="col-md-4">
					<!-- Danger box -->
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title">Installatori a cui Consegnare</h3>
						</div>
						<div class="row">
							@foreach ($operatori as $riga)
									<tr>
							<div class="box-body col-md-4">
								<div class="box-body no-padding">
									<a class="btn btn-app">
										<i class="fa fa-play"></i> Assegna
									</a>
								</div>
							</div>
							<div class="col-md-8">
								<div class="callout callout-warning">
                                        <h4>{{ $riga->username }}</h4>
                                        <p>{{ $riga->username }}</p>
                                    </div>
							</div>										
  									</tr>
							@endforeach
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>	
</div>

@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		@foreach ($operatori as $riga)
		$.ajax({ 
			url: 'magazzino/{{ $riga->id }}/getElencoConosciuto',
			context: document.body,
			success: function(resp) {
				for(var i = 1; i <=resp.lenght; i++){
					var tableRow = "<tr><td>" + resp[i].modello + "</td><td>" + resp[i].mac + "</td><td>" + resp[i].seriale + "</td></tr>";
					$("tabella{{ $riga->id }}").append(tableRow);
				}
				//console.log(resp.resp);
			}  
		});
		@endforeach
	});
</script>

@stop
