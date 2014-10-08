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
<body class="skin-blue fixed">
	@stop

	{{-- Content --}}
	@section('content')

	<div class="col-xs-12">
		<div class="box box-info">
			<h4 class="page-header">
				AniGEST - Pannello di Controllo
				

			</h4>

			@if ((Auth::user()->hasRole('admin'))  or (Auth::user()->hasRole('gestore')))
			<div class="row">

					<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>
								{{ $totAnagrafiche }}
							</h3>
							<p>
								Clienti Registrati
							</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="{{{ URL::to('anagrafiche') }}}" class="small-box-footer">
							Vai alla Scheda <i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div><!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3>
								{{ $totInterventi }}
							</h3>
							<p>
								Totale Interventi
							</p>
						</div>
						<div class="icon">
							<i class="ion ion-clock"></i>
						</div>
						<a href="{{{ URL::to('interventi') }}}" class="small-box-footer">
							Vai alla Scheda <i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div><!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-blue">
						<div class="inner">
							<h3>
								{{ $totInterventiNonAssegnati }}
							</h3>
							<p>
								Interventi non Assegnati
							</p>
						</div>
						<div class="icon">
							<i class="fa fa-exclamation"></i>
						</div>
						@if ($totInterventiNonAssegnati != 0)
						<a href="{{{ URL::to('interventi') }}}" class="small-box-footer">
							Maggiori Informazioni <i class="fa fa-arrow-circle-right"></i>
						</a>
						@else
						<a href="#" class="small-box-footer">
							Nessuna Informazione </i>
						</a>
						@endif
					</div>
				</div><!-- ./col -->				
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3>
								{{ $totInterventiScoperti }}
							</h3>
							<p>
								Interventi non Programmati
							</p>
						</div>
						<div class="icon">
							<i class="fa fa-calendar-o"></i>
						</div>
						@if ($totInterventiScoperti != 0)
						<a href="{{{ URL::to('interventi') }}}" class="small-box-footer">
							Maggiori Informazioni <i class="fa fa-arrow-circle-right"></i>
						</a>
						@else
						<a href="#" class="small-box-footer">
							Nessuna Informazione </i>
						</a>
						@endif
					</div>
				</div><!-- ./col -->
			</div>
			@endif

			<style>
			.hiddenRow {
				padding: 0 !important;
			}
			</style>

			<div class="row">
				<div class="col-md-6">
					<!-- Danger box -->
					<div class="box box-danger">
						<div class="box-header">
							<h3 class="box-title">Prossimi Interventi</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
								<button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="box-body no-padding">
								<table class="table table-condensed" style="border-collapse:collapse;">
									<thead><tr>
										<th style="width: 10px">#</th>
										<th>Anagrafica</th>
										<th>Telefono</th>
										<th style="width: 40px">Tipo</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($interventi as $riga)
									<tr data-toggle="collapse" data-target="#riga{{$riga['n']}}" class="accordion-toggle">
										<td>{{$riga['n']}}</td>
										<td>{{$riga['anagrafica'] }}</td>
										<td><a href="tel:{{$riga['telefono']}}">{{$riga['telefono']}}</a> <a href="tel:{{$riga['cellulare']}}">{{$riga['cellulare']}}</a></td>
  										<td><span class="badge bg-{{ $riga['livello'] }}">{{$riga['livTesto']}}</span></td>
  									</tr>
  									<tr>
  										<td class="hiddenRow" colspan="4">
  											<div class="accordian-body collapse" id="riga{{$riga['n']}}"> 
  												<table class="table">
													<tr>
														<td class="col-sx-12 col-md 3"><button class="apriIntervento" intervento="{{ $riga['id'] }}"><b>{{$riga['tipo']}}</b></buton></td>
														<td class="col-sx-12 col-md 6">{{$riga['indirizzo']}}<br>{{$riga['citta']}}</td>
														<td class="col-sx-12 col-md 3">{{$riga['dataIntervento']}}</td>
													</tr>

  												</table>
  													
  													
  											</div>
  										</td>
  									</tr>
									@endforeach
	
								</tbody></table>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			@if ((Auth::user()->hasRole('admin'))  or (Auth::user()->hasRole('gestore')))
				<div class="col-md-6">
					<!-- Danger box -->
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title">Pezzi in Magazzino</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
								<button class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="box-body no-padding">
								<a class="btn btn-app">
									<span class="badge bg-yellow">{{ $totAntenneMagazzino}}</span>
									<i class="fa fa-signal"></i> Antenne
								</a>
								<a class="btn btn-app">
									<span class="badge bg-teal">{{ $totRoutersMagazzino}}</span>
									<i class="fa fa-hdd-o"></i> Routers
								</a>
							</div>
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>	
@stop

@section('scripts')
<script>
	$("body").on("click", ".apriIntervento", function() {
  		$.colorbox({href:"interventi/" + $( this ).attr('intervento') + "/edit", width:"90%", height:"90%",iframe:true});
});

	</script>
@stop