@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
{{{ $title }}}
@stop

@section('keywords')antenne @stop
@section('author')Mauro Gallo @stop
@section('description')gestione delle interventi anenne @stop


@section('cssEsterni')
{{ HTML::style('css/colorbox.css') }}
{{ HTML::style('css/fullcalendar/fullcalendar.css') }}
{{ HTML::style('css/fullcalendar/fullcalendar.print.css') }}
@stop

@section('jsEsterni')
{{ HTML::script('js/jquery.colorbox-min.js') }}
{{ HTML::script('js/plugins/fullcalendar/fullcalendar.min.js') }}
{{ HTML::script('js/plugins/fullcalendar/lang/it.js') }}
@stop

@section('bodyOnLoad')
<body class="skin-blue fixed">
@stop

{{-- Content --}}
@section('content')

<div class="col-xs-12">
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Calendario degli Interventi</h3>
    </div><!-- /.box-header -->
    <div class="box-body">



      <div id='calendar'></div>
    </div>
  </div>
</div>

@stop


@section('scripts')

<script type='text/javascript'>
$(document).ready(function() {


  
  $('#calendar').fullCalendar({
    lang: 'it',
    day: 'dddd, MMM d, yyyy',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    editable: true, 
    droppable: true,
    eventDurationEditable: true,	
    events: "calendario/getEventi",
    eventClick: function(calEvent, jsEvent, view) {
    $.colorbox({href:"interventi/" + calEvent.id + "/edit", width:"90%", height:"90%",iframe:true});
  },
    eventDrop: function(event, delta, revertFunc) {
      alert(event.title + ' modificato ');
      $.ajax({  
       url: "calendario/update",  
       type: 'GET',  
       data: {  
        id: event.id,
        desrizione: event.title,  
        data: event.start.format() 
      }
    })

    },
    loading: function(bool) { 
      if (bool) $('#loading').show(); 
      else $('#loading').hide();
    } 
  });
});

</script>

@stop

