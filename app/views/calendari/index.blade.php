@extends('layouts.master')

@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}

		</h3>
	</div>


<style type='text/css'>
#calendar { 
  width: 800px;
  margin: 0 auto;
}
</style>
<div id='calendar'></div>
@stop


@section('scripts')

<script type='text/javascript'>
$(document).ready(function() {
  $('#calendar').fullCalendar({
    day: 'dddd, MMM d, yyyy',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    editable: true, 	
    events: "calendario/getEventi",
    eventDrop: function(event, delta) {
      alert(event.title + ' modificato ');
    }, 
    loading: function(bool) { 
      if (bool) $('#loading').show(); 
      else $('#loading').hide();
    } 
  });
});

</script>

@stop

