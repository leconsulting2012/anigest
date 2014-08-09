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



                        <div class="col-xs-3">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h4 class="box-title">Installazioni da Programmare</h4>
                                </div>
                                <div class="box-body">
                                    <!-- the events -->
                                    <div id='external-events'>

                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /. box -->
                          </div>



<div class="col-xs-8">
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
                var gid = 1; // event.id == 0 considered to be undefined (boo) 
                var dragged = null;
                $('#external-events div.external-event').each(function() {
                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                                title: $.trim($(this).text()), // use the element's text as the event title
                                id: gid ++
                        };
                        
                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject);
                        
                        // make the event draggable using jQuery UI
                        $(this).draggable({
                                zIndex: 999,
                                revert: true,      // will cause the event to go back to its
                                revertDuration: 0  //  original position after the drag
                        });
                });
                
                $('#external-events').droppable({
                        drop: function( event, ui ) {
                                if ( dragged && ui.helper && ui.helper[0] === dragged[0] ) {
                                        var event = dragged[1];
                                //$('#calendar').fullCalendar('removeEvent',id );
                                calendar.fullCalendar('removeEvents',event.id);
                                var el = $( "<div class='external-event'>" ).appendTo( this ).text( event.title );
                                el.draggable({
                                                zIndex: 999,
                                                revert: true,      // will cause the event to go back to its
                                                revertDuration: 0  //  original position after the drag
                                        });
                                el.data('eventObject', { title: event.title, id :event.id });
                                }
                        }
                });


  
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

