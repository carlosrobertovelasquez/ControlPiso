@extends('layouts.app')

@section('htmlheader_title')
    Calendario
@endsection


@section('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection



@section('main-content')

<div class="panel panel-default">
    <!-- Content Header (Page header) -->
    <div class="panel-heading"><h2> Calendario   </h2>  </div>
    <div class="panel-body">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
   </div><!-- /.panel-body -->
  </div><!-- /.panel -->
</div>
</div>
@endsection



@section('script2')
//<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
//<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<script>
    $(function () {
      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function () {
          // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          };
  
          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject);
  
          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex: 1070,
            revert: true, // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
          });
  
        });
      }
  
      ini_events($('#external-events div.external-event'));
  
      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
          m = date.getMonth(),
          y = date.getFullYear();
    //while(reload==false){
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
          today: 'hoy',
          month: 'mes',
          week: 'semana',
          day: 'dia'
        },
  
        events: { url:"cargaEventos"},
  
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!

        eventResize: function(event) {
            var start = event.start.format("YYYY-MM-DD HH:mm");
            var back=event.backgroundColor;
            var allDay=event.allDay;
            if(event.end){
              var end = event.end.format("YYYY-MM-DD HH:mm");
            }else{var end="NULL";
            }
            crsfToken = document.getElementsByName("_token")[0].value;
              $.ajax({
                url: 'actualizaEventos',
                data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id+'&background='+back+'&allday='+allDay,
                type: "POST",
                headers: {
                      "X-CSRF-TOKEN": crsfToken
                  },
                  success: function(json) {
                    console.log("Updated Successfully");
                  },
                  error: function(json){
                    console.log("Error al actualizar evento");
                  }
              });
        },
  
      
      });
    });
  </script>
  




@endsection







