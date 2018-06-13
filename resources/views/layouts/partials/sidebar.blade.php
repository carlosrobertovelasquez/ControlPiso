<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/avatar_plusis.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU PRINCIPAL</li>
            <!-- Optionally, you can add icons to the links -->
     
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>MAESTROS</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href={{url('Equipo')}}>Centro Costos</a></li>
                    <li><a href={{url('Turno')}}>Turnos</a></li>
                    <li><a href="">Ficha Tecnica </a>
                     <ul class="treeview-menu">
                        <li><a href="{{url('insertado')}}">INSERTADO</a></li>
                        <li><a href="{{url('bolillos')}}">BOLILLOS</a></li>
                        <li><a href="{{url('extrusion')}}">EXTRUSION</a></li>
                        <li><a href="{{url('inyeccion')}}">INYECCION</a></li>
                        <li><a href="{{url('pala')}}">PALA</a></li>
                     </ul>
                    </li>

                    
                     <li><a href="{{url('clave')}}">Clave</a></li>
                </ul>
            </li>
<li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>TRANSACCIONES</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Produccion')}}">Ordenes de Produccion</a></li>
                    <li><a href="{{url('planificador')}}">Planificador</a></li>
                    <li><a href="{{url('Calendario')}}">Calendario</a></li>
                    <li><a href="{{url('registro')}}">Registro MO-MA</a></li>
                    <li><a href="#">Ficha Tecnica</a></li>
                    
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>CONSULTA</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('ventas')}}">Pedidos</a></li>
                     <li><a href="{{url('Ticket')}}">Ticket</a></li>
                     <li><a href="{{url('gantt')}}">Gantt</a></li>
                     <li><a href="{{url('scheduler')}}">Calendario Horizontal</a></li>
                    <li><a href="{{url('ConsultaProduccion')}}">Ordenes de Produccion</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>REPORTE&GRAFICAS </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Ordenes de produccion</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>ADMINISTRACION</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('listado_usuarios') }}">Listado Usuarios</a></li>
                    <li><a href="{{url('listado_correo')}}">Envio de Correo</a></li>
                </ul>
            </li>
                

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
