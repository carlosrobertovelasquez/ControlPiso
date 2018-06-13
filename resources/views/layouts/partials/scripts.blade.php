<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->

<script src="{{ asset('/plugins/jQuery/jquery.min.js') }}"></script>
<script src="{{ asset('/plugins/jQuery/jquery-ui.min.js') }}"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/plusis.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/maskedinput.js') }}" type="text/javascript"></script>

 
<script src="{{  asset('/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript" ></script>
<script src="{{  asset('/plugins/datatables/dataTables.buttons.js') }}" type="text/javascript" ></script>
<script src="{{  asset('/plugins/datatables/buttons.flash.js') }}" type="text/javascript" ></script>
<script src="{{  asset('/plugins/datatables/dataTables.buttons.min.js') }}" type="text/javascript" ></script>
<script src="{{  asset('/plugins/datatables/buttons.html5.js') }}" type="text/javascript" ></script>
 <script src="{{asset('/plugins/datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{  asset('/plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript" ></script>








<script src="{{  asset('/plugins/fullcalendar/lib/moment.min.js') }}"  ></script>
<script src="{{  asset('/plugins/fullcalendar/fullcalendar.min.js') }}"  ></script>
<script src="{{  asset('/plugins/EasyAutocomplete/jquery.easy-autocomplete.min.js')}}"></script>





<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->


<script>
   $(function () {
    $('#example1').DataTable({
       
        "lengthMenu":[[10,25,50,-1],[10,25,50,"All"]],
        buttons:[
             {
            extend: 'csv',
            text: 'Copiar Datos'
        }
        ],
        "language":{
       "lengthMenu":"Mostrar _MENU_ registros por página.",
       "zeroRecords": "Lo sentimos. No se encontraron registros.",
             "info": "Mostrando página _PAGE_ de _PAGES_",
             "infoEmpty": "No hay registros aún.",
             "infoFiltered": "(filtrados de un total de _MAX_ registros)",
             "search" : "Búsqueda",
             "LoadingRecords": "Cargando ...",
             "Processing": "Procesando...",
             "SearchPlaceholder": "Comience a teclear...",
             "paginate": {
     "previous": "Anterior",
     "next": "Siguiente", 
     }
      }

     



    });
    
    $('.input-daterange').datepicker({
    "locale": {
                "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
  
  format: "dd-mm-yyyy",
  autoclose: true

 
 });


 

  })



</script>









  

