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

<div class="col-xs-12 box-body">
	<div id="p" class="box box-info">
		<h4 class="page-header">
			AniGEST - Gestione del Magazzino
		</h4>
		<div class="box-body col-xs-12">
			<div class="box box-solid box-success">
				<div class="box-header">
					<h3 class="box-title">Materiale Assegnato da Consegnare</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">


					<div class="row">
						@foreach ($operatori as $riga)
						<div id="box{{ $riga->id }}" class="col-md-6">
							<!-- Blue tile -->
							<div class="box col-md-6 box-success">
								<div class="box-header">
									<h3 class="box-title">Consegnare a {{ $riga->username }}:</h3>
								</div>
								<div class="box-body">
									<div class="box-body table-responsive no-padding">
										<table id="tabella{{ $riga->id }}" class="table table-hover daConsegnare">
											<tbody><tr>
												<th>Modello</th>
												<th>Seriale</th>
												<th>Mac</th>
												<th>Azione</th>
											</tr>
										</tbody></table>
									</div>
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</div>
						@endforeach	
					</div>
				</div><!-- /.box-body -->
			</div>
		</div>

		<div class="box-body col-xs-12">
			<div class="col-md-8">
				<!-- Danger box -->
				<div class="box box-danger">
					<div class="box-header">
						<h3 class="box-title">Antenne non Assegnate in Magazzino</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="box-body no-padding">
							<table class="table table-condensed">
								<tbody>
									<tr>
										<th>MAC</th>
										<th>Seriale</th>
										<th>Modello</th>
										<th>Consegnatario</th>
										<th>Data Ricezione</th>
									</tr>
									@foreach ($totAntenneMagazzino as $riga)
									<tr>
										<td><a href="{{ URL::to("interventi/". $riga->id . "/edit") }}" width:"90%", height:"90%", iframe:true>{{ $riga->mac }}</a></td>
										<td>{{ $riga->seriale }}</a></td>
										<td>{{ $riga->nome }}</a></td>
										<td>{{ $riga->username }}</a></td>
										<td>{{ formato($riga->dataRicezione) }}</a></td>
									</tr>
									@endforeach

								</tbody></table>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->

					<!-- Danger box -->
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Router non Assegnati in Magazzino</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="box-body no-padding">
								<table class="table table-condensed">
									<tbody>
										<tr>
											<th>MAC</th>
											<th>Seriale</th>
											<th>Modello</th>
											<th>Consegnatario</th>
											<th>Data Ricezione</th>
										</tr>
										@foreach ($totRoutersMagazzino as $riga)
										<tr>
											<td><a href="{{ URL::to("interventi/". $riga->id . "/edit") }}" width:"90%", height:"90%", iframe:true>{{ $riga->mac }}</a></td>
											<td>{{ $riga->seriale }}</a></td>
											<td>{{ $riga->nome }}</a></td>
											<td>{{ $riga->username }}</a></td>
											<td>{{ formato($riga->dataRicezione) }}</a></td>
										</tr>
										@endforeach

									</tbody></table>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>
					<div class="col-md-4">
						<!-- Danger box -->
						<div class="box box-info">
							<div class="box-header">
								<h3 class="box-title">Materiale nel tuo Magazzino</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="box-body no-padding">
									<table id="tabellaMioMateriale" class="table table-condensed">
										<thead>
											<tr>
												<th>Seriale</th>
												<th>Modello</th>
												<th>Data Ricezione</th>
											</tr>
										</thead>
										<tbody id="tabellaMioMaterialeBody">
										</tbody></table>
									</div>
								</div><!-- /.box-body -->
							</div><!-- /.box -->			
						</div>
					</div>

		</div>
	</div>	
</div>

@stop

@section('scripts')
<script type="text/javascript">

function AggiornaBoxInstallatore(tipo, installatore,aggiorna) {
	if (tipo == 'A'){
		var URL = '{{ URL::to('/') }}/magazzino/' + installatore + '/getElencoConosciutoAntenne';
	} else {
		var URL = '{{ URL::to('/') }}/magazzino/' + installatore + '/getElencoConosciutoRouters';
	}	
	$.ajax({ 
		url: URL,
		context: document.body,
		success: function(resp) {
			for(i in resp) {
				var tableRow = '<tr id="#riga' + tipo + resp[i].id + '"><td>' + resp[i].modello + "</td><td>" + resp[i].seriale + "</td><td>" + resp[i].mac + '</td><td><button id="#pulsanteAntenna' + resp[i].id + '" class="eseguiConsegna btn btn-success btn-sm" tipo="' + tipo + '" installatore="' + installatore + '" elemento="' + resp[i].id + '">Consegna</button></td></tr>';
				if (aggiorna == 'si')
				$('#tabella' + installatore + ' tbody').append(tableRow);
				else $('#tabella' + installatore + ' tbody').replaceWith(tableRow);
			}
		}  
	});
}

function ElencoMioMagazzino(tipo, aggiorna){
	if (tipo == 'A'){
		var URL = '{{ URL::to('/') }}/magazzino/getMioMagazzinoAntenne';
	} else {
		var URL = '{{ URL::to('/') }}/magazzino/getMioMagazzinoRouters';
	}	
	$.ajax({ 
		url: URL,
		context: document.body,
		success: function(resp) {
			for(i in resp) {
				var tableRow = "<tr><td>" + resp[i].seriale + "</td><td>" + resp[i].modello + "</td><td>" + resp[i].dataRicezione + "</td></tr>";
				if (aggiorna == 'si') $("#tabellaMioMateriale tbody").append(tableRow);
				else $("#tabellaMioMateriale tbody").replaceWith(tableRow);
			}
		}  
	});	
}



$(document).ready(function(){

	$(".daConsegnare").on('click', '.eseguiConsegna', function( evt ) {
		var ID = $(this).attr('elemento');
		var INST = $(this).attr('installatore');
		var TIPO = $(this).attr('tipo');
		var IDE = $(this).attr('id');
		var indirizzo = '{{ URL::to('/') }}/magazzino/' + INST +  '/' + ID + '/consegna' + TIPO + '/';

		$.ajax({ 
			url: indirizzo,
			success: function(resp) {
				$("#tabellaMioMaterialeBody").empty();
				ElencoMioMagazzino('A', 'si');
				ElencoMioMagazzino('R', 'si');
			}
		});	
		var tableRow = $(this).closest('tr');
		tableRow.find('td').fadeOut('fast', 
			function(){ 
				tableRow.remove();
			}
			);
	});

	@foreach ($operatori as $riga)
	AggiornaBoxInstallatore('A', {{ $riga->id }}, 'si');
	AggiornaBoxInstallatore('R', {{ $riga->id }}, 'si');
	@endforeach
	ElencoMioMagazzino('A', 'si');
	ElencoMioMagazzino('R', 'si');	
});
</script>

@stop
