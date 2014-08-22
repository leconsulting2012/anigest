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
			<div class="col-md-7">
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
							<table id="tabellaNonAssegnatiA" class="table table-condensed">
								<thead>
									<tr>
										<th>MAC</th>
										<th>Seriale</th>
										<th>Modello</th>
										<th>Data Ricezione</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
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
								<table id="tabellaNonAssegnatiR" class="table table-condensed">
									<tbody>
										<tr>
											<th>MAC</th>
											<th>Seriale</th>
											<th>Modello</th>
											<th>Data Ricezione</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
					</div>
					<div class="col-md-5">
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

function ElencoNonAssegnatiMagazzino(tipo){
	if (tipo == 'R'){
		var URL = '{{ URL::to('/') }}/magazzino/nonAssegnatiA';
	} else {
		var URL = '{{ URL::to('/') }}/magazzino/nonAssegnatiR';
	}	
	$.ajax({ 
		url: URL,
		context: document.body,
		success: function(resp) {
			for(i in resp) {
				var tableRow = '<tr><td><a class="nonAssegnati" href="{{ URL::to("interventi/") }}/' + resp[i].id + '/edit" >' + resp[i].mac + '</a></td><td>' + resp[i].seriale + '</a></td><td>' + resp[i].nome + '</a></td><td>' + resp[i].dataRicezione + '</a></td></tr>';
				$("#tabellaNonAssegnati" + tipo + " tbody").append(tableRow);
			};
		}  
	});	
}



function ElencoMioMagazzino(tipo){
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
				$("#tabellaMioMateriale tbody").append(tableRow);
			}
		}  
	});	
}



$(document).ready(function(){

	$(".nonAssegnati").colorbox({width:"90%", height:"90%", iframe:true});

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
	AggiornaBoxInstallatore('A', {{ $riga->id }} );
	AggiornaBoxInstallatore('R', {{ $riga->id }} );
	@endforeach

	ElencoNonAssegnatiMagazzino('R');
	ElencoNonAssegnatiMagazzino('A');
	ElencoMioMagazzino('A');
	ElencoMioMagazzino('R');	
});

$(document).bind('cbox_closed',
	function(){
			location.reload();
	});
</script>

@stop
