<!DOCTYPE html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
 
    
 
    <script src="dhtmlxGantt/codebase/dhtmlxgantt.js"></script>
    <link href="dhtmlxGantt/codebase/dhtmlxgantt.css" rel="stylesheet">
    <script src="dhtmlxGantt/codebase/ext/dhtmlxgantt_fullscreen.js"></script>
    <script src="dhtmlxGantt/codebase/locale/locale_es.js" charset="utf-8"></script>
    <script src="dhtmlxGantt/codebase/ext/dhtmlxgantt_tooltip.js"></script>


    <style type="text/css">
        html, body{
            height:100%;
            padding:0px;
            margin:0px;
            overflow: hidden;
        }

    </style>
</head>
<body>

        
            <div class="container">
                    <form class="navbar-form" role="search"  action="{{route('planificador.index',[$anio])}}">  
                            <div class="row">
                             <div class="col-xs-12">
                                     <label style="text-align:center" > Selecionar Sector :</label>
                                     <select   id="id" name="id" class="form-control select2" style="width: 100%;">
                                             <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
                                             <option value="">TODOS</option>
                                         @foreach($TipoEquipo as $TipoEquipo)
                                         <option value="{{ $TipoEquipo->TIPO_EQUIPO }}">{{ $TipoEquipo->TIPO_EQUIPO }} </option>
                                         @endforeach
                                          </select>
                                         
                                 </div>
                 
                                  <div>
                                         <input name="buscar"  value="Buscar" class="btn btn-info active" type="submit"/>
                                     </div> 
                            </div>
                           </form>
            </div>
            



<div id="gantt_here" style='width:100%; height:90%;'></div>

<script type="text/javascript">


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
    return "<b>Detalle:</b> "+task.text+"<br/><b>Duration:</b> " + task.duration;
};








gantt.config.tooltip_hide_timeout = 5000;
    gantt.init("gantt_here");
    gantt.load("gantt/data");

</script>
</body>