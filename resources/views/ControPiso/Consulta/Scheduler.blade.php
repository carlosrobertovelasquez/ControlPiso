<!doctype html>
<head>

  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <title>Programacion de Produccion</title>

  <script src='dhtmlxScheduler/dhtmlxscheduler.js'></script>
  <script src='dhtmlxScheduler/ext/dhtmlxscheduler_limit.js'></script>
  <script src='dhtmlxScheduler/ext/dhtmlxscheduler_collision.js'></script>
  <script src='dhtmlxScheduler/ext/dhtmlxscheduler_timeline.js'></script>
  <script src='dhtmlxScheduler/ext/dhtmlxscheduler_editors.js'></script>
  <script src='dhtmlxScheduler/ext/dhtmlxscheduler_minical.js'></script>
  <script src='dhtmlxScheduler/ext/dhtmlxscheduler_tooltip.js'></script>
  <script src="dhtmlxScheduler/locale/locale_es.js" charset="utf-8"></script>

  <link rel='stylesheet' href='dhtmlxScheduler/dhtmlxscheduler_flat.css'>
  <link rel='stylesheet' href='css/styles.css'>
 
  



</head>

<body>


<input type="radio" id="scale1" name="scale" value="1" onclick="dia();" checked /><label for="scale1">Escala Por Dia</label><br>
<input type="radio" id="scale2" name="scale" value="2" onclick="semana();" /><label for="scale2">Escala Por Semana</label><br>
<input type="radio" id="scale3" name="scale" value="3" onclick="mes();" /><label for="scale3">Escala Por Mes</label><br>
<input type="radio" id="scale4" name="scale" value="4" onclick="ano();" /><label for="scale4">Escala Por Año</label><br>


<div id="scheduler_here" class="dhx_cal_container" style="width:96%; height:96%;">
    <div class="dhx_cal_navline">
          <div class="dhx_cal_prev_button">&nbsp;</div>
          <div class="dhx_cal_next_button">&nbsp;</div>
          <div class="dhx_cal_today_button"></div>
          <div class="dhx_cal_date"></div>
         
         
          <select id="room_filter" onchange='showRooms(this.value)'></select>  
    </div>
  <div class="dhx_cal_header"></div>
  <div class="dhx_cal_data"></div>
</div>
<script>
scheduler.config.xml_date = "%Y-%m-%d %h:%i";
//===============
//Configuration

//===============


var list = scheduler.serverList("sections").slice();



scheduler.createTimelineView({
  name: "timeline",
 
  
   y_unit:[
        {key:501, label:"501-INYECTORA SANDRETTO 190"},
        {key:502, label:"502-INYECTORA SANDRETTO"},
        {key:503, label:"503-INYECTORA 503 HAITIAN"},
        {key:504, label:"504-INYECTORA 504"},
        {key:505, label:"505-INYECTORA 505 HAITIAN"},
        {key:506, label:"506-INYECTORA 506"},
        {key:507, label:"507-INYECTORA ROTATIVA 507"},
        {key:508, label:"508-SILO MEZCLADOR 515"},
        {key:509, label:"509-INYECTORA 508  HAITIAN serie MARS II"},
        {key:510, label:"510-Iny. 510 FCS HT30064 (Reciclemos)"},
        {key:520, label:"520-ESTRUSORA COVEMA TRA-60"},
        {key:521, label:"521-EXTRUSORA DE PET 521"},
        {key:522, label:"522-EXTRUSORA DOLCI 110 PELETIZADO 522"},
        {key:523, label:"523-EXTRUSORA DE PET 523"},
        {key:524, label:"524-SILO MEZCLADOR 516 (LINEA PET)"},
        {key:531, label:"531-INSERTADORA BORGHI A2P200 MT 1103"},
        {key:532, label:"532-INSERTADORA BORGHI A2P200 663/1998"},
        {key:533, label:"533-INSERTADORA BORGHI 533 START 32 Mat 3503"},
        {key:534, label:"534-INSERTADORA BORGHI A2P400 670/98"},
        {key:535, label:"535-ENSAMBLADORA 535 MT 2002/184"},
        {key:536, label:"536-INSERTADORA 536"},
        {key:537, label:"537-INSERTADORA 537"},
        {key:538, label:"538-INSERTADORA 538"},
        {key:539, label:"539-INSERTADORA 539 SMART-V2"},
        {key:540, label:"540-INSERTADORA 540 SMART-V2"},
        {key:541, label:"541-CORTADO DE ALAMBRE P-TRAPREADOR"}, 
      {key:542, label:"542-MAQUINA DOBLADORA ALAMBRE"}, 
      {key:543, label:"543-RECORTADORA DE PLANCHITA"}, 
      {key:544, label:"544-RETORCEDORA 535"}, 
      {key:545, label:"545-EMPAQUE 533"}, 
      {key:546, label:"546-MAQUINA INSERTADORA SMART-V2 mt 4353"}, 
      {key:547, label:"547-Insert. 547 START V2 SN 4851"}, 
      {key:548, label:"548-Insert. 548 START V2B SN4034 (Reciclem)"},
      {key:561, label:"561-AGLOMERADORA (COMP. PLASTICOS)"}, 
      {key:562, label:"562-BANDA DE SELECCION RECICLADOS 512"}, 
      {key:563, label:"563-LINEA DE LAVADO No. 2 (507)"}, 
      {key:564, label:"564-LAVADORA SETEFE 508"}, 
      {key:565, label:"565-MOLINO 526"}, 
      {key:566, label:"566-MOLINO 528"}, 
      {key:567, label:"567-MOLINO 529"}, 
      {key:568, label:"568-MOLINO MATEU & SOLE 530"}, 
      {key:569, label:"569-LINEA MOLIDO Y LAV. PAGANI"}, 
      {key:570, label:"570-BANDA DE SELECCION RECICLADOS 511"}, 
      {key:571, label:"571-Separadora Viñetas"},
      {key:580, label:"580-ETIQUETADORA METALICO 556"}, 
      {key:581, label:"581-PINTADORA 555"}, 
      {key:582, label:"582-ROSCADORA Y ETIQUETADORA 550"}, 
      {key:583, label:"583-MESA PARA ENSAMBLE DE CAPUCHONES"}, 
      {key:584, label:"584-ROSCADORA 553"},
      {key:590, label:"590-CENTRO DE SERVICIO DE MANTENIMIENTO IBER"}, 
      {key:591, label:"591-FRESADORA ENCO"}, 
      {key:592, label:"592-SERVICIOS DE MANTENIMIENTO GARBAL"}, 
      {key:593, label:"593-TALADRO DE BANCO"}, 
      {key:594, label:"594-TORNO ONAK"}, 
      {key:595, label:"595-TROQUELADORA HIDRAULICA IMU 29A"},
      {key:999, label:"ND"}    
    ],

 //y_unit:sections,
  y_property: "type_id",
  render:"bar",
  second_scale:{
    x_unit: "day",
    x_date: "%j %F"
  }
  //days:7,
 // event_dy: 48,
  //  section_autoheight: false,
   // round_position: true,
});

var dayScale;

function dia(){
  var timeline = scheduler.matrix.timeline; 
 timeline.x_unit = "minute";
      timeline.x_date = "%H:%i";     
      scheduler.templates.timeline_scale_date = function(date){
         var func=scheduler.date.date_to_str(timeline.x_date);
         return func(date);
      };
      timeline.x_step = 60;
      timeline.x_size = 24;
      timeline.x_start = 16;
      timeline.x_length = 48;
            
      timeline.second_scale = false;       
            
      if (dayScale != 0){
        scheduler.xy.scale_height = scheduler.xy.scale_height/2;
        dayScale = 0;
      } else {
        scheduler.xy.scale_height;
      };
      scheduler.setCurrentView();

};

function semana(){
     var timeline = scheduler.matrix.timeline;
      timeline.x_unit = "day";
      timeline.x_date = "%j %D";    
      scheduler.templates.timeline_scale_date = function(date){
         var func=scheduler.date.date_to_str(timeline.x_date);
         return func(date);
      };
      timeline.x_step = 1;
      timeline.x_size = 7;
      timeline.x_start = 0;
      timeline.x_length = 7; 
                  
      timeline.second_scale = {
        x_unit:"week",
        x_date: "Week %W"
      };   
      setScaleHeight(dayScale);         
      scheduler.setCurrentView();      
 
};

function mes(){
      var timeline = scheduler.matrix.timeline;
      timeline.x_unit = "day";
      timeline.x_date = "%j";  
      scheduler.templates.timeline_scale_date = function(date){
         var func=scheduler.date.date_to_str(timeline.x_date);
         return func(date);
      };
      timeline.x_step = 1;
      timeline.x_size = 30;
      timeline.x_start = 0;
      timeline.x_length = 30;
                  
      timeline.second_scale = {
        x_unit:"month",
        x_date: "%F"
      };
      scheduler.templates.timeline_second_scale_date = function(date){
      var func = scheduler.date.date_to_str(timeline.second_scale.x_date);
          return func(date);
      };      
      setScaleHeight(dayScale);      
      scheduler.setCurrentView();
}

function ano(){
   var timeline = scheduler.matrix.timeline;
   timeline.x_unit = "month";
      timeline.x_date = "%F";  
      scheduler.templates.timeline_scale_date = function(date){
         var func=scheduler.date.date_to_str(timeline.x_date);
         return func(date);
      };
      timeline.x_step = 1;
      timeline.x_size = 12;
      timeline.x_start = 0;
      timeline.x_length = 12; 
                  
      timeline.second_scale = {
        x_unit:"year",
        x_date: "%Y"
      };
      scheduler.templates.timeline_second_scale_date = function(date){
      var func = scheduler.date.date_to_str(timeline.second_scale.x_date);
          return func(date);
      };      
      setScaleHeight();       
      scheduler.setCurrentView();    
}
function updateTimeline(value){
  value=document.getElementById("scale2").value;
  var timeline = scheduler.matrix.timeline; 
  switch (value) {
    case "1":
      timeline.x_unit = "minute";
      timeline.x_date = "%H:%i";     
      scheduler.templates.timeline_scale_date = function(date){
         var func=scheduler.date.date_to_str(timeline.x_date);
         return func(date);
      };
      timeline.x_step = 30;
      timeline.x_size = 24;
      timeline.x_start = 16;
      timeline.x_length = 48;
            
      timeline.second_scale = false;       
            
      if (dayScale != 0){
        scheduler.xy.scale_height = scheduler.xy.scale_height/2;
        dayScale = 0;
      } else {
        scheduler.xy.scale_height;
      };
      scheduler.setCurrentView();      
      break; 
      
    case "2":          
      timeline.x_unit = "day";
      timeline.x_date = "%j %D";    
      scheduler.templates.timeline_scale_date = function(date){
         var func=scheduler.date.date_to_str(timeline.x_date);
         return func(date);
      };
      timeline.x_step = 1;
      timeline.x_size = 7;
      timeline.x_start = 0;
      timeline.x_length = 7; 
                  
      timeline.second_scale = {
        x_unit:"week",
        x_date: "Week %W"
      };   
      setScaleHeight(dayScale);         
      scheduler.setCurrentView();      
      break;
      
    case "3":     
      timeline.x_unit = "day";
      timeline.x_date = "%j";  
      scheduler.templates.timeline_scale_date = function(date){
         var func=scheduler.date.date_to_str(timeline.x_date);
         return func(date);
      };
      timeline.x_step = 1;
      timeline.x_size = 30;
      timeline.x_start = 0;
      timeline.x_length = 30;
                  
      timeline.second_scale = {
        x_unit:"month",
        x_date: "%F"
      };
      scheduler.templates.timeline_second_scale_date = function(date){
      var func = scheduler.date.date_to_str(timeline.second_scale.x_date);
          return func(date);
      };      
      setScaleHeight(dayScale);      
      scheduler.setCurrentView();
      break;
      
    case "4":
      timeline.x_unit = "month";
      timeline.x_date = "%F";  
      scheduler.templates.timeline_scale_date = function(date){
         var func=scheduler.date.date_to_str(timeline.x_date);
         return func(date);
      };
      timeline.x_step = 1;
      timeline.x_size = 12;
      timeline.x_start = 0;
      timeline.x_length = 12; 
                  
      timeline.second_scale = {
        x_unit:"year",
        x_date: "%Y"
      };
      scheduler.templates.timeline_second_scale_date = function(date){
      var func = scheduler.date.date_to_str(timeline.second_scale.x_date);
          return func(date);
      };      
      setScaleHeight();       
      scheduler.setCurrentView();    
      break;
  }
}

function setScaleHeight(){
  if (dayScale != 0){
    scheduler.xy.scale_height;
  } else {
    scheduler.xy.scale_height = scheduler.xy.scale_height*2;
  }
  dayScale = 1; 
}
  
scheduler.init("scheduler_here",new Date(),"timeline");
//scheduler.parse(big_events_list, "json");
scheduler.load("scheduler/data" ,"json");
var func = function(e) {
  e = e || window.event;
  var el = e.target || e.srcElement;
  var value = el.value;
  updateTimeline(value);
};





//scheduler.init('scheduler_here');
//scheduler.load("scheduler/data" ,"json");

 
</script>

</body>