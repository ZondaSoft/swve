<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SWNov') }}</title>

    <!-- Scripts
    <script src="{{ asset('js/app.js') }}" defer></script>-->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Angle -->
    <meta name="description" content="SWNov (Sistema web de Novedades)">
    <meta name="keywords" content="SWNov, Novedades personal, sueldos">

    <!-- =============== VENDOR STYLES ===============-->
    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <!-- SIMPLE LINE ICONS-->
    <link rel="stylesheet" href="{{ asset('css/simple-line-icons.css') }}">
    <!-- ANIMATE.CSS-->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- WHIRL (spinners)-->
    <link rel="stylesheet" href="{{ asset('css/whirl.css') }}">
    <!-- TAGS INPUT
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}"> -->

    <!-- =============== PAGE VENDOR STYLES ===============-->

    <!-- WHIRL (spinners)
    <link rel="stylesheet" href="vendor/whirl/dist/whirl.css">
    <!-- =============== PAGE VENDOR STYLES ===============-->
    <!-- FULLCALENDAR-->
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">

    <!-- DATETIMEPICKER-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" id="bscss">
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" id="maincss">
    <link rel="stylesheet" href="{{ asset('css/theme-h.css') }}" id="maincss">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-colorpicker.css') }}" id="maincss">

    <!-- AUTOCOMPLETE-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/easy-autocomplete.css') }}">

    @yield('styles')

    <?php
      # Iniciando la variable de control que permitirá mostrar o no el modal
      $exibirModal = true;
      # Verificando si existe o no la cookie
      if(!isset($_COOKIE["mostrarModal"]))
      {
        # Caso no exista la cookie entra aqui
        # Creamos la cookie con la duración que queramos

        //$expirar = 3600; // muestra cada 1 hora
        //$expirar = 10800; // muestra cada 3 horas
        //$expirar = 21600; //muestra cada 6 horas
        $expirar = 43200; //muestra cada 12 horas
        //$expirar = 86400;  // muestra cada 24 horas
        setcookie('mostrarModal', 'SI', (time() + $expirar)); // mostrará cada 12 horas.
        # Ahora nuestra variable de control pasará a tener el valor TRUE (Verdadero)
        $exibirModal = true;
      }
    ?>
</head>
<body>
    <!-- Angle -->
    <div class="wrapper">
      <!-- top navbar-->
      <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header">
               <a class="navbar-brand" href="#/">
                  <div class="brand-logo">
                     <img class="img-fluid" src="/img/logo_af.bmp" alt="Agrotecnica Fueguina">
                  </div>
                  <div class="brand-logo-collapsed">
                     <img class="img-fluid" src="/img/logo_af.bmp" alt="App Logo">
                  </div>
               </a>
            </div>
            <!-- END navbar header-->
            <!-- START Left navbar-->
            <ul class="navbar-nav mr-auto flex-row">
               <li class="nav-item">
                  <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                  <a class="nav-link d-none d-md-block d-lg-block d-xl-block" href="#" data-trigger-resize="" data-toggle-state="aside-collapsed">
                     <em class="fa fa-navicon"></em>
                  </a>
                  <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                  <a class="nav-link sidebar-toggle d-md-none" href="#" data-toggle-state="aside-toggled" data-no-persist="true">
                     <em class="fa fa-navicon"></em>
                  </a>
               </li>
               <!-- START User avatar toggle-->
               <li class="nav-item d-none d-md-block">
                  <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                  <a class="nav-link" id="user-block-toggle" href="#user-block" data-toggle="collapse">
                     <em class="icon-user"></em>
                  </a>
               </li>
               <!-- END User avatar toggle-->
               <!-- START lock screen-->
               <li class="nav-item d-none d-md-block">
                  <a class="nav-link" href="/logout" title="Cerrar sesión">
                     <em class="icon-lock"></em>
                  </a>
               </li>
               <!-- END lock screen-->
            </ul>
            <!-- END Left navbar-->
            <!-- START Right Navbar-->
            <ul class="navbar-nav flex-row">
               <!-- Search icon-->
               <li class="nav-item">
                  <a class="nav-link" href="{{ url()->current() }}/search" >  <!-- data-search-open=""         url()->current()   -->
                     <em class="icon-magnifier"></em>
                  </a>
               </li>
               <!-- Fullscreen (only desktops)-->
               <li class="nav-item d-none d-md-block">
                  <a class="nav-link" href="#" data-toggle-fullscreen="">
                     <em class="fa fa-expand"></em>
                  </a>
               </li>


               <!-- START Alert menu-->
               <li class="nav-item dropdown dropdown-list">
                  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-toggle="dropdown">
                     <em class="icon-bell"></em>
                     <!--
                     <span class="badge badge-danger">11</span> -->
                  </a>
                  <!-- START Dropdown menu-->
                  <div class="dropdown-menu dropdown-menu-right animated flipInX">
                     <div class="dropdown-item">
                        <!-- START list group-->
                        <div class="list-group">
                           <!-- list item-->
                           <div class="list-group-item list-group-item-action">
                              <div class="media">
                                 <div class="align-self-start mr-2">
                                    <em class="fa fa-envelope fa-2x text-info"></em>
                                 </div>
                                 <div class="media-body">
                                    <p class="m-0">Sin vencimientos de R.T.O.</p>
                                    <p class="m-0 text-muted text-sm">...</p>
                                 </div>
                              </div>
                           </div>
                           <!-- list item-->
                           <div class="list-group-item list-group-item-action">
                              <div class="media">
                                 <div class="align-self-start mr-2">
                                    <em class="fa fa-envelope fa-2x text-warning"></em>
                                 </div>
                                 <div class="media-body">
                                    <p class="m-0">Sin siniestros pendientes</p>
                                    <p class="m-0 text-muted text-sm">...</p>
                                 </div>
                              </div>
                           </div>
                           <!-- list item-->
                           <div class="list-group-item list-group-item-action">
                              <div class="media">
                                 <div class="align-self-start mr-2">
                                    <em class="fa fa-envelope fa-2x text-success"></em>
                                 </div>
                                 <div class="media-body">
                                    <p class="m-0">Sin bajas pendientes</p>
                                    <p class="m-0 text-muted text-sm">...</p>
                                 </div>
                              </div>
                           </div>
                           <!-- last list item
                           <div class="list-group-item list-group-item-action">
                              <span class="d-flex align-items-center">
                                 <span class="text-sm">More notifications</span>
                                 <span class="badge badge-danger ml-auto">14</span>
                              </span>
                           </div> -->
                        </div>
                        <!-- END list group-->
                     </div>
                  </div>
                  <!-- END Dropdown menu-->
               </li>
               <!-- END Alert menu-->



               <!-- START Offsidebar button-->
               <!-- <li class="nav-item">
                  <a class="nav-link" href="#" data-toggle-state="offsidebar-open" data-no-persist="true">
                     <em class="icon-notebook"></em>
                  </a>
               </li> -->
               <!-- END Offsidebar menu-->
            </ul>
            <!-- END Right Navbar-->
            <!-- START Search form-->
            <form class="navbar-form" role="search" action="/home/search">
               <div class="form-group">
                  <input class="form-control" type="text" placeholder="Type and hit enter ...">
                  <div class="fa fa-times navbar-form-close" data-search-dismiss=""></div>
               </div>
               <button class="d-none" type="submit">Submit</button>
            </form>
            <!-- END Search form-->
         </nav>
         <!-- END Top Navbar-->
      </header>
      <!-- sidebar-->
      <aside class="aside-container">
         <!-- START Sidebar (left)-->
         <div class="aside-inner">
            <nav class="sidebar" data-sidebar-anyclick-close="">
               <!-- START sidebar nav-->
               <ul class="sidebar-nav">
                  <!-- START user info-->
                  <li class="has-user-block">
                     <div class="collapse" id="user-block">
                        <div class="item user-block">
                           <!-- User picture-->
                           <div class="user-block-picture">
                              <div class="user-block-status">
                                 <img class="img-thumbnail rounded-circle" src="{{ asset('img/user/15.jpg') }}" alt="Avatar" width="60" height="60">
                                 <div class="circle bg-success circle-lg"></div>
                              </div>
                           </div>
                           <!-- Name and Job-->
                           <div class="user-block-info">
                              <span class="user-block-name">Hola, </span>
                              {{ auth()->user()?auth()->user()->name:'Usuario' }}
                              <!-- <span class="user-block-role">Designer</span> -->
                           </div>
                        </div>
                     </div>
                  </li>
                  <!-- END user info-->
                  <!-- Iterates over all sidebar items-->
                  <li class="nav-heading">
                     <span data-localize="">Vehículos</span>  <!-- data-localize="sidebar.heading.HEADER" -->
                  </li>
                  <li class=" {{ $active==1?'active':' ' }} ">
                     <a href="/home" title="Legajos" title="legajos">
                        <!-- <div class="float-right badge badge-success">3</div> -->
                        <em class="icon-user"></em>
                        <span>Vehículos activos</span> <!-- <span data-localize="sidebar.nav.DASHBOARD">  -->
                     </a>
                  </li>
                  <li class=" {{ ($active==2)?'active':' ' }} ">
                    <a href="/bajas" title="Bajas" title="bajas">
                        <!-- <div class="float-right badge badge-success">3</div> -->
                        <em class="icon-user-unfollow"></em>
                        <span>Vehículos de baja</span>    <!-- <span data-localize="sidebar.nav.DASHBOARD">Legajos de baja</span> -->
                     </a>
                  </li>

                  <li class=" ">
                     <a href="#layout" title="Parámetros especiales del sistema" data-toggle="collapse">
                        <em class="icon-layers"></em>
                        <span>Parámetros ...</span>
                     </a>
                     <ul class="sidebar-nav sidebar-subnav collapse {{ ($active>=3 and $active<=22)?'show':' ' }}" id="layout">
                        <li class="sidebar-subnav-header">Layouts</li>
                        <li class=" {{ $active==7?'active':' ' }} ">
                           <a href="/tipos" title="Tipos de Vehículos">
                              <span>Tipos de Vehículos</span>
                           </a>
                        </li>
                     </ul>
                  </li>


                  <li class="nav-heading">
                     <span data-localize="sidebar.heading.COMPONENTS">Novedades</span>
                     <!-- Novedades -->
                  </li>


                  <li class=" ">
                     <a href="#tables" title="Tables" data-toggle="collapse">
                        <em class="icon-printer  {{ $active==100?'active':' ' }} "></em>
                        <span data-localize="sidebar.nav.table.TABLE">Informes</span>
                     </a>
                     <ul class="sidebar-nav sidebar-subnav collapse {{ ($active>=100 and $active<=150)?'show':' ' }}" id="tables">
                        <li class=" {{ $active==100?'active':' ' }} ">
                           <a href="/infvehiculo" title="Legajos">
                              <span data-localize="sidebar.nav.table.STANDARD">Vehículos</span>
                           </a>
                        </li>
                        <li class=" {{ $active==120?'active':' ' }} ">
                           <a href="/infnovedades" title="Novedades">
                              <span data-localize="sidebar.nav.table.EXTENDED">Novedades</span>
                           </a>
                        </li>
                        <li class=" {{ $active==140?'active':' ' }} ">
                           <a href="/infpagos" title="Pagos a realizar">
                              <span data-localize="sidebar.nav.table.EXTENDED">Pagos a realizar</span>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <!-- <li class=" ">
                     <a href="#maps" title="Maps" data-toggle="collapse">
                        <em class="icon-map"></em>
                        <span data-localize="sidebar.nav.map.MAP">Importación/Exportación</span>
                     </a>
                     <ul class="sidebar-nav sidebar-subnav collapse" id="maps">
                        <li class="sidebar-subnav-header">Maps</li>
                        <li class=" ">
                           <a href="maps-google.html" title="Google Maps">
                              <span data-localize="sidebar.nav.map.GOOGLE">Google Maps</span>
                           </a>
                        </li>
                        <li class=" ">
                           <a href="maps-vector.html" title="Vector Maps">
                              <span data-localize="sidebar.nav.map.VECTOR">Vector Maps</span>
                           </a>
                        </li>
                     </ul>
                  </li>-->

               </ul>
               <!-- END sidebar nav-->
            </nav>
         </div>
         <!-- END Sidebar (left)-->
      </aside>
      <!-- offsidebar-->
      <aside class="offsidebar d-none">
         <!-- START Off Sidebar (right)-->
         <nav>
            <div role="tabpanel">
               <!-- Nav tabs-->
               <ul class="nav nav-tabs nav-justified" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active" href="#app-settings" aria-controls="app-settings" role="tab" data-toggle="tab">
                        <em class="icon-equalizer fa-lg"></em>
                     </a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" href="#app-chat" aria-controls="app-chat" role="tab" data-toggle="tab">
                        <em class="icon-user fa-lg"></em>
                     </a>
                  </li>
               </ul>
               <!-- Tab panes-->
               <div class="tab-content">
                  <div class="tab-pane fade active show" id="app-settings" role="tabpanel">
                     <h3 class="text-center text-thin mt-4">Settings</h3>
                     <div class="p-2">
                        <h4 class="text-muted text-thin">Themes</h4>
                        <div class="row row-flush mb-2">
                           <div class="col mb-2">
                              <div class="setting-color">
                                 <label data-load-css="css/theme-a.css">
                                    <input type="radio" name="setting-theme" checked="checked">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-info"></span>
                                       <span class="color bg-info-light"></span>
                                    </span>
                                    <span class="color bg-white"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb-2">
                              <div class="setting-color">
                                 <label data-load-css="css/theme-b.css">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-green"></span>
                                       <span class="color bg-green-light"></span>
                                    </span>
                                    <span class="color bg-white"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb-2">
                              <div class="setting-color">
                                 <label data-load-css="{{ asset('css/theme-c.css') }}">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-purple"></span>
                                       <span class="color bg-purple-light"></span>
                                    </span>
                                    <span class="color bg-white"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb-2">
                              <div class="setting-color">
                                 <label data-load-css="{{ asset('css/theme-d.css') }}">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-danger"></span>
                                       <span class="color bg-danger-light"></span>
                                    </span>
                                    <span class="color bg-white"></span>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="row row-flush mb-2">
                           <div class="col mb-2">
                              <div class="setting-color">
                                 <label data-load-css="{{ asset('css/theme-e.css') }}">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-info-dark"></span>
                                       <span class="color bg-info"></span>
                                    </span>
                                    <span class="color bg-gray-dark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb-2">
                              <div class="setting-color">
                                 <label data-load-css="{{ asset('css/theme-f.css') }}">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-green-dark"></span>
                                       <span class="color bg-green"></span>
                                    </span>
                                    <span class="color bg-gray-dark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb-2">
                              <div class="setting-color">
                                 <label data-load-css="{{ asset('css/theme-g.css') }}">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-purple-dark"></span>
                                       <span class="color bg-purple"></span>
                                    </span>
                                    <span class="color bg-gray-dark"></span>
                                 </label>
                              </div>
                           </div>
                           <div class="col mb-2">
                              <div class="setting-color">
                                 <label data-load-css="{{ asset('css/theme-h.css') }}">
                                    <input type="radio" name="setting-theme">
                                    <span class="icon-check"></span>
                                    <span class="split">
                                       <span class="color bg-danger-dark"></span>
                                       <span class="color bg-danger"></span>
                                    </span>
                                    <span class="color bg-gray-dark"></span>
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="p-2">
                        <h4 class="text-muted text-thin">Layout</h4>
                        <div class="clearfix">
                           <p class="float-left">Fixed</p>
                           <div class="float-right">
                              <label class="switch">
                                 <input id="chk-fixed" type="checkbox" data-toggle-state="layout-fixed">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="float-left">Boxed</p>
                           <div class="float-right">
                              <label class="switch">
                                 <input id="chk-boxed" type="checkbox" data-toggle-state="layout-boxed">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="float-left">RTL</p>
                           <div class="float-right">
                              <label class="switch">
                                 <input id="chk-rtl" type="checkbox">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="p-2">
                        <h4 class="text-muted text-thin">Aside</h4>
                        <div class="clearfix">
                           <p class="float-left">Collapsed</p>
                           <div class="float-right">
                              <label class="switch">
                                 <input id="chk-collapsed" type="checkbox" data-toggle-state="aside-collapsed">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="float-left">Collapsed Text</p>
                           <div class="float-right">
                              <label class="switch">
                                 <input id="chk-collapsed-text" type="checkbox" data-toggle-state="aside-collapsed-text">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="float-left">Float</p>
                           <div class="float-right">
                              <label class="switch">
                                 <input id="chk-float" type="checkbox" data-toggle-state="aside-float">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="float-left">Hover</p>
                           <div class="float-right">
                              <label class="switch">
                                 <input id="chk-hover" type="checkbox" data-toggle-state="aside-hover">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                        <div class="clearfix">
                           <p class="float-left">Show Scrollbar</p>
                           <div class="float-right">
                              <label class="switch">
                                 <input id="chk-scroll" type="checkbox" data-toggle-state="show-scrollbar" data-target=".sidebar">
                                 <span></span>
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="app-chat" role="tabpanel">
                     <h3 class="text-center text-thin mt-4">Connections</h3>
                     <div class="list-group">
                        <!-- START list title-->
                        <div class="list-group-item border-0">
                           <small class="text-muted">ONLINE</small>
                        </div>
                        <!-- END list title-->
                        <div class="list-group-item list-group-item-action border-0">
                           <div class="media">
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="/img/user/05.jpg" alt="Image">
                              <div class="media-body text-truncate">
                                 <a href="#">
                                    <strong>Juan Sims</strong>
                                 </a>
                                 <br>
                                 <small class="text-muted">Designeer</small>
                              </div>
                              <div class="ml-auto">
                                 <span class="circle bg-success circle-lg"></span>
                              </div>
                           </div>
                        </div>
                        <div class="list-group-item list-group-item-action border-0">
                           <div class="media">
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="/img/user/06.jpg" alt="Image">
                              <div class="media-body text-truncate">
                                 <a href="#">
                                    <strong>Maureen Jenkins</strong>
                                 </a>
                                 <br>
                                 <small class="text-muted">Designeer</small>
                              </div>
                              <div class="ml-auto">
                                 <span class="circle bg-success circle-lg"></span>
                              </div>
                           </div>
                        </div>
                        <div class="list-group-item list-group-item-action border-0">
                           <div class="media">
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="/img/user/07.jpg" alt="Image">
                              <div class="media-body text-truncate">
                                 <a href="#">
                                    <strong>Billie Dunn</strong>
                                 </a>
                                 <br>
                                 <small class="text-muted">Designeer</small>
                              </div>
                              <div class="ml-auto">
                                 <span class="circle bg-danger circle-lg"></span>
                              </div>
                           </div>
                        </div>
                        <div class="list-group-item list-group-item-action border-0">
                           <div class="media">
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="/img/user/08.jpg" alt="Image">
                              <div class="media-body text-truncate">
                                 <a href="#">
                                    <strong>Tomothy Roberts</strong>
                                 </a>
                                 <br>
                                 <small class="text-muted">Designeer</small>
                              </div>
                              <div class="ml-auto">
                                 <span class="circle bg-warning circle-lg"></span>
                              </div>
                           </div>
                        </div>
                        <!-- START list title-->
                        <div class="list-group-item border-0">
                           <small class="text-muted">OFFLINE</small>
                        </div>
                        <!-- END list title-->
                        <div class="list-group-item list-group-item-action border-0">
                           <div class="media">
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="/img/user/09.jpg" alt="Image">
                              <div class="media-body text-truncate">
                                 <a href="#">
                                    <strong>Lawrence Robinson</strong>
                                 </a>
                                 <br>
                                 <small class="text-muted">Designeer</small>
                              </div>
                              <div class="ml-auto">
                                 <span class="circle bg-warning circle-lg"></span>
                              </div>
                           </div>
                        </div>
                        <div class="list-group-item list-group-item-action border-0">
                           <div class="media">
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="/img/user/10.jpg" alt="Image">
                              <div class="media-body text-truncate">
                                 <a href="#">
                                    <strong>Tyrone Owens</strong>
                                 </a>
                                 <br>
                                 <small class="text-muted">Designeer</small>
                              </div>
                              <div class="ml-auto">
                                 <span class="circle bg-warning circle-lg"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="px-3 py-4 text-center">
                        <!-- Optional link to list more users-->
                        <a class="btn btn-purple btn-sm" href="#" title="See more contacts">
                           <strong>Load more..</strong>
                        </a>
                     </div>
                     <!-- Extra items-->
                     <div class="px-3 py-2">
                        <p>
                           <small class="text-muted">Tasks completion</small>
                        </p>
                        <div class="progress progress-xs m-0">
                           <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                              <span class="sr-only">80% Complete</span>
                           </div>
                        </div>
                     </div>
                     <div class="px-3 py-2">
                        <p>
                           <small class="text-muted">Upload quota</small>
                        </p>
                        <div class="progress progress-xs m-0">
                           <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                              <span class="sr-only">40% Complete</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </nav>
         <!-- END Off Sidebar (right)-->
      </aside>
      <!-- Main section-->
      <section class="section-container">
         <!-- Page content-->
         <div class="content-wrapper">


            <!-- END row-->
            <!-- START row-->
            <!-- <div class="row"> -->
               <!-- <div class="col-lg-12"> -->



                    <!-- Codigo pre-existente -->
                    <!-- <div id="app"> -->
                        <!-- <main class="py-4"> -->
                            @yield('content')
                        <!-- </main> -->
                    <!-- </div> -->
                    <!-- Fin:Codigo pre-existente -->


               <!-- </div> -->
            <!-- </div> -->
            <!-- END row-->
         </div>
      </section>
      <!-- Page footer-->
      <footer class="footer-container">
         <span>&copy; 2021 - Zonda Software - v. 1.07</span>
      </footer>
   </div>



   <!-- =============== Angle->VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="{{ asset('js/modernizr.custom.js') }}"></script>
   <!-- JQUERY-->
   <script src="{{ asset('js/jquery.js') }}"></script>
   <!-- BOOTSTRAP-->
   <script src="{{ asset('/js/popper.js') }}"></script>
   <script src="{{ asset('/js/bootstrap.js') }}"></script>
   <!-- STORAGE API-->
   <script src="{{ asset('js/js.storage.js') }}"></script>
   <!-- JQUERY EASING-->
   <script src="{{ asset('js/jquery.easing.js') }}"></script>
   <!-- ANIMO-->
   <script src="{{ asset('js/animo.js') }}"></script>
   <!-- SCREENFULL-->
   <script src="{{ asset('js/screenfull.js') }}"></script>
   <!-- LOCALIZE-->
   <script src="{{ asset('js/jquery.localize.js') }}"></script>

   <!-- INPUT MASK-->
   <script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>

   <!-- JQUERY UI Carga en app.blade.php -->
   <script src="{{ asset('vendor/components-jqueryui/jquery-ui.js') }}"></script>
   <script src="{{ asset('vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
   <!-- MOMENT JS-->
   <script src="{{ asset('vendor/moment/min/moment-with-locales.js') }}"></script>
   <!-- FULLCALENDAR-->
   <script src="{{ asset('vendor/fullcalendar/dist/fullcalendar.js') }}"></script>
   <script src="{{ asset('vendor/fullcalendar/dist/gcal.js') }}"></script>
   <!-- TAGS INPUT
   <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>   -->


   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- =============== PAGE VENDOR SCRIPTS ===============-->
   <!-- CHOSEN-->
   <script src="{{ asset('js/chosen.jquery.js') }}"></script>
   <!-- SLIDER CTRL
   <script src="{{ asset('js/bootstrap-slider.js') }}"></script>-->
   <!-- MOMENT JS-->
   <script src="{{ asset('js/moment-with-locales.js') }}"></script>
   <!-- DATETIMEPICKER-->
   <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

   <!-- =============== APP SCRIPTS ===============-->
   <script src="{{ asset('js/app.js') }}"></script>
   <script src="{{ asset('js/jquery.easy-autocomplete.js') }}"></script>

   <script src="{{ asset('js/bootstrap-colorpicker.js') }}"></script>

   <script>
      $(function () {
        $('#cp2, #cp3a, #cp3b').colorpicker();
        $('#cp4').colorpicker({"color": "#16813D"});
      });
   </script>

   <script>
       // Funcion que se ejecuta cada vez que se pulsa una tecla en cualquier input
       // Tiene que recibir el "event" (evento generado) y el siguiente id donde poner
       // el foco. Si ese id es "submit" se envia el formulario
       function saltar(e,id)
       {
        // Obtenemos la tecla pulsada
        (e.keyCode)?k=e.keyCode:k=e.which;

        // Si la tecla pulsada es enter (codigo ascii 13)
        if(k==13)
        {
          // Si la variable id contiene "submit" enviamos el formulario
          if(id=="submit")
          {
            document.forms[0].submit();
          }else{
            // nos posicionamos en el siguiente input
            document.getElementById(id).focus();
          }
        }
       }

       // Funcion que se carga al comienzo usado en easyAutocomplete
       $(document).ready(function () {
            var options = {
                url: "/autocomplete/users",
                getValue: "CONCAT(codigo)",
                template: {
                    type: "description",
                    fields: {
                        description: "detalle"
                    }
                },
                list: {
                    onSelectItemEvent: function() {
                      var value1 = $("#dni").getSelectedItemData().detalle;
                      var value2 = $("#dni").getSelectedItemData().nombres;
                      var value3 = $("#dni").getSelectedItemData().funcion;
                      var value4 = $("#dni").getSelectedItemData().cuil;
                      var value5 = $("#dni").getSelectedItemData().domici;

                      $("#ape_nom").val(value1).trigger("change");
                      $("#detalle").val(value1).trigger("change");
                      $("#razonsoc").val(value1).trigger("change");
                      $("#domici").val(value5).trigger("change");
                      $("#tarea").val(value3).trigger("change");
                      $("#calificacion").val(value3).trigger("change");
                      $("#cuil").val(value4).trigger("change");
                    },
                    match: {
                        enabled: true
                    }
                },
                theme: "bootstrap",
            };
            var optionsAjax = {
                url: "/autocomplete/users",
                getValue: "CONCAT(codigo)",
                template: {
                    type: "description",
                    fields: {
                        description: "detalle"
                    }
                },
                list: {
                  onSelectItemEvent: function() {
                    var value1 = $("#dni").getSelectedItemData().detalle;
                    var value2 = $("#dni").getSelectedItemData().nombres;
                    var value3 = $("#dni").getSelectedItemData().funcion;
                    var value4 = $("#dni").getSelectedItemData().cuil;

                    $("#ape_nom").val(value1).trigger("change");
                    $("#detalle").val(value1).trigger("change");
                    $("#razonsoc").val(value1).trigger("change");
                    $("#domic").val(value2).trigger("change");
                    $("#tarea").val(value3).trigger("change");
                    $("#cuil").val(value4).trigger("change");
                  },
                    match: {
                        enabled: true
                    }
                },
                theme: "bootstrap",
                ajaxSettings: {
                    dataType: "json",
                    method: "GET",
                    data: {
                    }
                },
                preparePostData: function(data) {
                    data.term = $("#dni").val();
                    return data;
                },
                requestDelay: 500
            };
            $("#dni").easyAutocomplete(options);

            //-----------------------------------------
            // Busqueda de codigos de novedad
            //-----------------------------------------
            var optionsNoved = {
                url: "/autocomplete/novedades",
                getValue: "codigo",
                template: {
                    type: "description",
                    fields: {
                        description: "detalle"
                    }
                },
                list: {
                    onSelectItemEvent: function() {
                      var value1 = $("#cod_nov").getSelectedItemData().detalle;
                      //var value2 = $("#dni").getSelectedItemData().nombres;
                      //var value3 = $("#dni").getSelectedItemData().funcion;
                      //var value4 = $("#dni").getSelectedItemData().cuil;
                      //var value5 = $("#dni").getSelectedItemData().domici;

                      $("#CodNovName").val(value1).trigger("change");
                      //$("#detalle").val(value1).trigger("change");
                      //$("#razonsoc").val(value1).trigger("change");
                      //$("#domici").val(value5).trigger("change");
                      //$("#tarea").val(value3).trigger("change");
                      //$("#calificacion").val(value3).trigger("change");
                      //$("#cuil").val(value4).trigger("change");
                    },
                    match: {
                        enabled: true
                    }
                },
                theme: "bootstrap",
            };
            var optionsNovedAjax = {
                url: "/autocomplete/novedades",
                getValue: "codigo",
                template: {
                    type: "description",
                    fields: {
                        description: "detalle"
                    }
                },
                list: {
                  onSelectItemEvent: function() {
                    var value1 = $("#cod_nov").getSelectedItemData().detalle;
                    //var value2 = $("#dni").getSelectedItemData().nombres;
                    //var value3 = $("#dni").getSelectedItemData().funcion;
                    //var value4 = $("#dni").getSelectedItemData().cuil;

                    $("#CodNovName").val(value1).trigger("change");
                    //$("#detalle").val(value1).trigger("change");
                    //$("#razonsoc").val(value1).trigger("change");
                    //$("#domic").val(value2).trigger("change");
                    //$("#tarea").val(value3).trigger("change");
                    //$("#cuil").val(value4).trigger("change");
                  },
                    match: {
                        enabled: true
                    }
                },
                theme: "bootstrap",
                ajaxSettings: {
                    dataType: "json",
                    method: "GET",
                    data: {
                    }
                },
                preparePostData: function(data) {
                    data.term = $("#cod_nov").val();
                    return data;
                },
                requestDelay: 500
            };
            $("#cod_nov").easyAutocomplete(optionsNoved);
        });

        $(":input").inputmask();
        $("#phone").inputmask({"mask": "(999) 999-9999"});

   function calcularDias() {
            var fecha1 = document.getElementById("fecha");
            var fecha2 = document.getElementById("fecha2");

            let f1 = fecha1.value
            let f2 = fecha2.value

            var aFecha1 = f1.split('/');
            var aFecha2 = f2.split('/');
            var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
            var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
            var dif = fFecha2 - fFecha1;
            var dias = Math.floor(dif / (1000 * 60 * 60 * 24));

            dias++;

            //alert(dias);

            $("#dias").val(dias).trigger("change");


        }

        function tipoNovedad(e) {
            var novedad = e.value;
            //alert(novedad);
            switch (novedad) {
              case "LNACIM":
                 //alert('24-Volver a consultorio y fecha de retorno = fecha hasta');
                 $("#lblfecha2").show();
                 $("#fecha2").show();
                 $("#lbldias").show();
                 $("#dias").show();

                 $("#lblconcepto").hide();
                 $("#concepto").hide();

                 break;
              case "VACAC":
                 //alert('22-Volver a lugar de trabajo y fecha de retorno = fecha hasta + 1');
                 $("#lblfecha2").show();
                 $("#fecha2").show();
                 $("#lbldias").show();
                 $("#dias").show();

                 document.getElementById('lblconcepto').innerHTML= 'Año a imputar';
                 $("#lblconcepto").show();
                 $("#concepto").show();

                 break;
               case "VAVIEJ":
                  //alert('22-Volver a lugar de trabajo y fecha de retorno = fecha hasta + 1');
                  $("#lblfecha2").show();
                  $("#fecha2").show();
                  $("#lbldias").show();
                  $("#dias").show();

                  document.getElementById('lblconcepto').innerHTML= 'Año a imputar';
                  $("#lblconcepto").show();
                  $("#concepto").show();

                  break;
              case "LMATRIM":
                 //alert('40-Volver a lugar de trabajo y fecha de retorno = fecha hasta + 1');
                 $("#lblfecha2").show();
                 $("#fecha2").show();
                 $("#lbldias").show();
                 $("#dias").show();

                 $("#lblconcepto").hide();
                 $("#concepto").hide();

                 break;
              case "ADART":
                 //alert('42-Volver a consultorio y fecha de retorno = fecha hasta');
                 $("#lblfecha2").show();
                 $("#fecha2").show();
                 $("#lbldias").show();
                 $("#dias").show();

                 document.getElementById('lblconcepto').innerHTML= 'Nro.Siniestro';
                 $("#lblconcepto").show();
                 $("#concepto").show();

                 break;
              case "ACCNUE":
                 //alert('30-Volver a lugar de trabajo y fecha de retorno = fecha hasta + 1 (dia = 0)');
                 $("#lblfecha2").show();
                 $("#fecha2").show();
                 $("#lbldias").show();
                 $("#dias").show();

                 document.getElementById('lblconcepto').innerHTML= 'Nro.Siniestro';
                 $("#lblconcepto").show();
                 $("#concepto").show();

                 break;
              case "APREV":
                 //alert('4-dia 0');
                 $("#lblfecha2").show();
                 $("#fecha2").show();
                 $("#lbldias").show();
                 $("#dias").show();

                 document.getElementById('lblconcepto').innerHTML= 'Nro.Siniestro';
                 $("#lblconcepto").show();
                 $("#concepto").show();

                 break;
              case "AUSVAC":
                 //alert('46-Volver a lugar de trabajo y fecha de retorno = fecha hasta + 1 (dia = 0)');
                 $("#lblfecha2").show();
                 $("#fecha2").show();
                 $("#lbldias").show();
                 $("#dias").show();

                 document.getElementById('lblconcepto').innerHTML= 'Año a imputar';
                 $("#lblconcepto").show();
                 $("#concepto").show();

                 break;
             case "GUARDA":
                //alert('46-Volver a lugar de trabajo y fecha de retorno = fecha hasta + 1 (dia = 0)');
                $("#lblfecha2").show();
                $("#fecha2").show();
                $("#lbldias").show();
                $("#dias").show();

                $("#lblconcepto").hide();
                $("#concepto").hide();

                break;
              default:
                 $("#lblfecha2").hide();
                 $("#fecha2").hide();
                 $("#btncalendar2").hide();
                 $("#lbldias").hide();
                 $("#dias").hide();

                 $("#lblconcepto").hide();
                 $("#concepto").hide();

                 break;
          }
        }
   </script>


   @yield('scripts')

</body>
</html>
