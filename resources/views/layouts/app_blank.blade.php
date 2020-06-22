<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SWNov') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

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
    <!-- =============== PAGE VENDOR STYLES ===============-->
    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" id="bscss">
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" id="maincss">
    <link rel="stylesheet" href="{{ asset('css/theme-h.css') }}" id="maincss">
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
                     <img class="img-fluid" src="img/logo_af.bmp" alt="Agrotecnica Fueguina">
                  </div>
                  <div class="brand-logo-collapsed">
                     <img class="img-fluid" src="img/logo_af.bmp" alt="App Logo">
                  </div>
               </a>
            </div>
            <!-- END navbar header-->
            <!-- START Left navbar-->

            <!-- END Left navbar-->
            <!-- START Right Navbar-->

            <!-- END Right Navbar-->
            <!-- START Search form-->
            <form class="navbar-form" role="search" action="search.html">
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
                                 <label data-load-css="css/theme-c.css">
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
                                 <label data-load-css="css/theme-d.css">
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
                                 <label data-load-css="css/theme-e.css">
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
                                 <label data-load-css="css/theme-f.css">
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
                                 <label data-load-css="css/theme-g.css">
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
                                 <label data-load-css="css/theme-h.css">
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
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="img/user/05.jpg" alt="Image">
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
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="img/user/06.jpg" alt="Image">
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
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="img/user/07.jpg" alt="Image">
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
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="img/user/08.jpg" alt="Image">
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
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="img/user/09.jpg" alt="Image">
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
                              <img class="align-self-center mr-3 rounded-circle thumb48" src="img/user/10.jpg" alt="Image">
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
         <span>&copy; 2018 - Zonda Software</span>
      </footer>
   </div>



    <!-- =============== Angle->VENDOR SCRIPTS ===============-->
    <!-- MODERNIZR-->
    <script src="{{ asset('js/modernizr.custom.js') }}"></script>
   <!-- JQUERY-->
   <script src="{{ asset('js/jquery.js') }}"></script>
   <!-- BOOTSTRAP-->
   <script src="{{ asset('js/popper.js') }}"></script>
   <script src="{{ asset('js/bootstrap.js') }}"></script>
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
   <!-- =============== PAGE VENDOR SCRIPTS ===============-->
   <!-- PARSLEY-->
   <script src="{{ asset('js/parsley.js') }}"></script>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
