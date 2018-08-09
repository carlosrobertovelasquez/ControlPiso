<!DOCTYPE html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
   

    <script src="dhtmlxGantt/codebase/dhtmlxgantt.js"></script>
    <link href="dhtmlxGantt/codebase/dhtmlxgantt.css" rel="stylesheet">
    <script src="dhtmlxGantt/codebase/ext/dhtmlxgantt_fullscreen.js"></script>
    <script src="dhtmlxGantt/codebase/locale/locale_es.js" charset="utf-8"></script>
    <script src="dhtmlxGantt/codebase/ext/dhtmlxgantt_tooltip.js"></script>
    <script src="http://export.dhtmlx.com/gantt/api.js"></script>  
   <link rel="stylesheet" href="dhtmlxGantt/codebase/skins/dhtmlxgantt_broadway.css?v=4.0" type="text/css" media="screen" title="no title" charset="utf-8">


    <style type="text/css" media="screen">
    .gantt_task_progress {
            text-align: left;
            padding-left: 10px;
            box-sizing: border-box;
            color: white;
            font-weight: bold;
        }
        html, body{
            margin:0px;
            padding:0px;
            height:100%;
            overflow:hidden;
        }
        .sample_header input, .sample_header span, .sample_header strong{
            vertical-align: middle;
        }
        #filter_days, #filter_hours{
            display: inline-block;
        }
        .sample_header input{
            margin: 0 0 0 6px;
        }
        .sample_header label span{
            padding-right: 4px;
        }
        .sample_header label{
            cursor:pointer;
        }
        .project{
            background:#65C16F;
            border-color: #65C16F;
        }
        .project .gantt_task_progress{
            background:#3C9445;
            box-shadow: none;
            border:none;
        }
        .weekend{ background: #f4f7f4 !important;}
        .gantt_selected .weekend{
            background:#FFF3A1 !important;
        }
        .gantt_task_line.project{
            background-image: none;
        }

        .controls_bar{
            border-top:1px solid #bababa;
            border-bottom:1px solid #bababa;
            clear:both;
            margin-top:0px;
            height:28px;
            background:#f1f1f1;
            color:#494949;
            font-family:Arial, sans-serif;
            font-size:13px;
            padding-left:10px;
            line-height:25px
        }


        .red .gantt_cell, .odd.red .gantt_cell,
        .red .gantt_task_cell, .odd.red .gantt_task_cell {
            background-color: #FDE0E0;
        }

        .green .gantt_cell, .odd.green .gantt_cell,
        .green .gantt_task_cell, .odd.green .gantt_task_cell {
            background-color: #BEE4BE;
        }

    </style>
</head>
<body onresize="modSampleHeight()">
  <script>
        function modSampleHeight(){
            var headHeight = 25;

            var sch = document.getElementById("gantt_here");
            sch.style.height = (parseInt(document.body.offsetHeight)-headHeight)+"px";
            
            gantt.setSizes();
        }
    </script>
  



          
        


<div class='controls_bar'>
            <strong> Filtros: &nbsp; </strong>
            <label>
                <input name='filter' onclick='filter_tasks(this);' type='radio' value='' checked='true'>
                <span>Todos</span></label>
            <label>
                <input name='filter' onclick='filter_tasks(this);' type='radio' value='1'>
                <span>Sin Iniciar</span></label>
            <label>
                <input name='filter' onclick='filter_tasks(this);' type='radio' value='2'>
                <span>Iniciados</span></label>
            <span>&nbsp; &nbsp; | &nbsp; &nbsp; </span>
            <strong> Visualizar: &nbsp; </strong>
            <label>
                <input name='scales' onclick='zoom_tasks(this)' type='radio' value='week'>
                <span>Horas</span></label>
            <label>
                <input name='scales' onclick='zoom_tasks(this)' type='radio' value='trplweek'  checked='true'>
                <span>Dias</span></label>
            <label>
                <input name='scales' onclick='zoom_tasks(this)' type='radio' value='year'>
                <span>Meses</span></label>
              <span>&nbsp; &nbsp; | &nbsp; &nbsp; </span>
                <strong> Exportar: &nbsp; </strong>
                <input value="Export to PDF" type="button" onclick='gantt.exportToPDF()'>
            
            <div id="filter_hours">

                <span>&nbsp; &nbsp; | &nbsp; &nbsp; </span>
                <strong> Visualizar: &nbsp; </strong>
                <label>
                    <input name='scales_filter' onclick='set_scale_units(this)' type='radio' value='full_day'>
                    <span>Full day</span>
                </label>
                <label>
                    <input name='scales_filter' onclick='set_scale_units(this)' type='radio' value='work_hours'>
                    <span>Office hours</span>
                </label>
            </div>
            <div id="filter_days">

                <span>&nbsp; &nbsp; | &nbsp; &nbsp; </span>
                <strong> Visualizar: &nbsp; </strong>
                <label>
                    <input name='scales_filter' onclick='set_scale_units(this)' type='radio' value='full_week'>
                    <span>Full week</span>
                </label>
                <label>
                    <input name='scales_filter' onclick='set_scale_units(this)' type='radio' value='work_week'>
                    <span>Workdays</span>
                </label>
            </div>
           
        </div>
    </div>










            



<div id="gantt_here" style='width:100%; height:100%;'></div>

<script type="text/javascript">

gantt.config.grid_width = 380;
    gantt.config.add_column = false;
    gantt.templates.grid_row_class = function (start_date, end_date, task) {
        if (task.progress == 0) return "red";
        if (task.progress >= 1) return "green";
    };
    gantt.templates.task_row_class = function (start_date, end_date, task) {
        if (task.progress == 0) return "red";
        if (task.progress >= 1) return "green";
    };
    gantt.config.columns = [
        {name: "text", label: "Producto", tree: true, width: 300
         
        },
        {
            name: "progress", label: "Progreso", width: 80, align: "center",
            template: function (task) {
                
                if(task.progreso>0.1 && task.progreso<1)
                    return "En Proceso";
                if (task.progress >= 1.0)
                    return "Finalizada";
                if (task.progress == 0.0)
                    return "Sin Iniciar";
               
                return Math.round(task.progress * 100) + "%";
            }
        },
        {
            name: "assigned", label: "Cant.Planificada", align: "center", width: 130,
            template: function (task) {
                if (!task.cantidadplanificada) return "";
                return   task.cantidadplanificada;
            }
        },
        {
            name: "assigned2", label: "Cant.Producida", align: "center", width: 130,
            template: function (task) {
                if (!task.cantidadproduccida) return "";
                return    task.cantidadproduccida;
            }
        }
    ];



//gantt.setNumberFormat("0,000.00",assigned,".",",");

/*
gantt.templates.progress_text = function (start, end, task) {
        return "<span style='text-align:right;'>" + Math.round(task.progress * 100) + "% </span>";
    };
 */   
gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
gantt.config.sort = true;
gantt.config.work_time = true;
    gantt.setWorkTime({hours : [0, 24]});//global working hours. 8:00-12:00, 13:00-17:00

  
    gantt.config.scale_unit = "day";
    gantt.config.date_scale = "%l, %F %d";
    gantt.config.min_column_width = 20;
    gantt.config.duration_unit = "hour";
    gantt.config.scale_height = 20*3;
    
    gantt.templates.task_cell_class = function(task, date){
        var css = [];

        if(date.getHours() == 7){
            css.push("day_start");
        }
        if(date.getHours() == 16){
            css.push("day_end");
        }
        if(!gantt.isWorkTime(date, 'day')){
            css.push("week_end");
        }else if(!gantt.isWorkTime(date, 'hour')){
            css.push("no_work_hour");
        }

        return css.join(" ");
    };



    var weekScaleTemplate = function(date){
        var dateToStr = gantt.date.date_to_str("%d %M");
        var weekNum = gantt.date.date_to_str("(week %W)");
        var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
        return dateToStr(date) + " - " + dateToStr(endDate) + " " + weekNum(date);
    };

    gantt.config.subscales = [
        {unit:"week", step:1, template:weekScaleTemplate},
        {unit:"hour", step:1, date:"%G"}

    ];


    function showAll(){
        gantt.ignore_time = null;
        gantt.render();
    }
    function hideWeekEnds(){
        gantt.ignore_time = function(date){
            return !gantt.isWorkTime(date, "day");
        };
        gantt.render();
    }
    function hideNotWorkingTime(){
        gantt.ignore_time = function(date){
            return !gantt.isWorkTime(date);
        };
        gantt.render();
    }    


    gantt.templates.tooltip_text = function(start,end,task){
    return "<b>Detalle:</b> "+task.text+
            "<br/><b>Cantidad Planificada:</b> " + task.cantidadplanificada+
            "<br/><b>Cantidad Producida:</b> " + task.cantidadproduccida+
            "<br/><b>Porcentaje :</b> " + task.progreso+
            "<br/><b>Estado Consumo:</b> " + task.estadoMA+
            "<br/><b>Estado Produccion:</b> " + task.estadoMO+
            "<br/><b>Operacion:</b> " + task.Proceso+
            "<br/><b>Centro Costo:</b> " + task.centrocosto+
            "<br/><b>Orden Produccion:</b> " + task.ordenproduccion;
};



gantt.attachEvent("onBeforeTaskDisplay", function(id, task){
            if (gantt_filter)
                if (task.priority != gantt_filter)
                    return false;
            
            return true;
        });
gantt.templates.scale_cell_class = function(date){
            if(date.getDay()==0||date.getDay()==6){
                return "weekend";
            }
        };
gantt.templates.task_cell_class = function(item,date){
            if(date.getDay()==0||date.getDay()==6){ 
                return "weekend" ;
            }
        };
var gantt_filter = 0;
        function filter_tasks(node){
            gantt_filter = node.value;
            gantt.refreshData();
        }
function show_scale_options(mode){
            var hourConf = document.getElementById("filter_hours"),
                dayConf = document.getElementById("filter_days");
            if(mode == 'day'){
                hourConf.style.display = "none";
                dayConf.style.display = "";
                dayConf.getElementsByTagName("input")[0].checked = true;
            }else if(mode == "hour"){
                hourConf.style.display = "";
                dayConf.style.display = "none";
                hourConf.getElementsByTagName("input")[0].checked = true;
            }else{
                hourConf.style.display = "none";
                dayConf.style.display = "none";
            }
        }

function set_scale_units(mode){
            if(mode && mode.getAttribute){
                mode = mode.getAttribute("value");
            }

            switch (mode){
                case "work_hours":
                    gantt.config.subscales = [
                        {unit:"hour", step:1, date:"%H"}
                    ];
                    gantt.ignore_time = function(date){
                        if(date.getHours() < 9 || date.getHours() > 16){
                            return true;
                        }else{
                            return false;
                        }
                    };

                    break;
                case "full_day":
                    gantt.config.subscales = [
                        {unit:"hour", step:3, date:"%H"}
                    ];
                    gantt.ignore_time = null;
                    break;
                case "work_week":
                    gantt.ignore_time = function(date){
                        if(date.getDay() == 0 || date.getDay() == 6){
                            return true;
                        }else{
                            return false;
                        }
                    };

                    break;
                default:
                    gantt.ignore_time = null;
                    break;
            }
            gantt.render();
        }

function zoom_tasks(node){
            switch(node.value){
                case "week":
                    gantt.config.scale_unit = "day"; 
                    gantt.config.date_scale = "%d %M"; 

                    gantt.config.scale_height = 60;
                    gantt.config.min_column_width = 30;
                    gantt.config.subscales = [
                          {unit:"hour", step:1, date:"%H"}
                    ];
                    show_scale_options("hour");
                break;
                case "trplweek":
                    gantt.config.min_column_width = 70;
                    gantt.config.scale_unit = "day"; 
                    gantt.config.date_scale = "%d %M"; 
                    gantt.config.subscales = [ ];
                    gantt.config.scale_height = 35;
                    show_scale_options("day");
                break;
                case "month":
                    gantt.config.min_column_width = 70;
                    gantt.config.scale_unit = "week"; 
                    gantt.config.date_scale = "Week #%W"; 
                    gantt.config.subscales = [
                          {unit:"day", step:1, date:"%D"}
                    ];
                    show_scale_options();
                    gantt.config.scale_height = 60;
                break;
                case "year":
                    gantt.config.min_column_width = 70;
                    gantt.config.scale_unit = "month"; 
                    gantt.config.date_scale = "%M"; 
                    gantt.config.scale_height = 60;
                    show_scale_options();
                    gantt.config.subscales = [
                          {unit:"week", step:1, date:"#%W"}
                    ];
                break;
            }
            set_scale_units();
            gantt.render();
        }

show_scale_options("day");
        gantt.config.details_on_create = true;
gantt.templates.task_class = function(start, end, obj){
            return obj.planificador_id ? "project" : "";
        }


gantt.config.grid_width = 390;





gantt.config.tooltip_hide_timeout = 5000;

    gantt.init("gantt_here");
 modSampleHeight();

    gantt.load("gantt/data");
    

</script>
</body>