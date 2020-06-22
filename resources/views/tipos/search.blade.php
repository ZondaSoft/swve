@extends('layouts.app')

@section('content')

   <!-- Page content-->
   <div class="content-heading">
      <div>Tipos de Vehículos
         <small>Resultados de la búsqueda y filtrado</small>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-9">
        {!! Form::open(['route' => 'tipos.search' , 'method' => 'GET' , 'class' => 'form-group mb-4' , 'role' => 'search']) !!}

           <!-- <input class="form-control mb-2" type="text" placeholder="Texto a buscar..." autofocus=""> -->
           {!! Form::text('name', null, ['class'=>'form-control mb-2', 'placeholder'=>'Texto a buscar...' , 'Value' => $name , 'autocomplete' => 'off', 'autofocus'] ) !!}

           <div class="d-flex">
              <button class="btn btn-secondary" type="submit">Buscar</button>
              <div class="ml-auto">
                 <!-- <label class="c-checkbox">
                    <input id="inlineCheckbox10" type="checkbox" value="option1">
                    <span class="fa fa-check"></span>Products</label>
                 <label class="c-checkbox">
                    <input id="inlineCheckbox20" type="checkbox" value="option2">
                    <span class="fa fa-check"></span>People</label>
                 <label class="c-checkbox">
                    <input id="inlineCheckbox30" type="checkbox" value="option3">
                    <span class="fa fa-check"></span>Apps</label> -->
              </div>
           </div>
        <!-- Cierre del form original (</form>) -->
        {!! Form::close() !!}
         <!-- START card-->
         <div class="card card-default">
            <div class="card-header">
               <a class="float-right" href="#" data-tool="panel-refresh" data-toggle="tooltip" title="Refresh Card">
                  <em class="fa fa-refresh"></em>
               </a>Resultados de la búsqueda</div>
            <!-- START table-responsive-->
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover">
                  <thead>

                  </thead>
                  <tbody>
                     @foreach ($legajos as $legajo)
                        <tr>

                           <td>
                              <div class="media align-items-center">
                                 <div class="media-body d-flex">
                                    <div>
                                       <h4 class="m-0">{{ $legajo->codigo }}</h4>
                                    </div>
                                 </div>
                              </div>
                           </td>

                           <td>
                              <div class="media align-items-center">
                                 <div class="media-body d-flex">
                                    <div>
                                       <h4 class="m-0">{{ $legajo->detalle }}</h4>
                                    </div>
                                    <div class="ml-auto">
                                       <a class="btn btn-info btn-sm" href="\tipos\{{ $legajo->id }}" >
                                       Ver detalles</a>
                                    </div>
                                 </div>
                              </div>
                           </td>

                        </tr>
                     @endforeach
                  </tbody>
               </table>


            </div>
            <!-- END table-responsive-->
            <div class="card-footer">
               <div class="d-flex">
                  <!-- <button class="btn btn-sm btn-secondary">Clear</button> -->
                  <nav class="ml-auto">
                     <ul class="pagination pagination-sm">
                        {{ $legajos->links() }}
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
         <!-- END card-->
      </div>
      <!--
      <div class="col-lg-3">
         <h3 class="m-0 pb-3">Filters</h3>
         <div class="form-group mb-4">
            <label class="col-form-label mb-2">by Text</label>
            <br>
            <select class="chosen-select form-control">
               <optgroup label="NFC EAST">
                  <option>Dallas Cowboys</option>
                  <option>New York Giants</option>
                  <option>Philadelphia Eagles</option>
                  <option>Washington Redskins</option>
               </optgroup>
               <optgroup label="NFC NORTH">
                  <option>Chicago Bears</option>
                  <option>Detroit Lions</option>
                  <option>Green Bay Packers</option>
                  <option>Minnesota Vikings</option>
               </optgroup>
               <optgroup label="NFC SOUTH">
                  <option>Atlanta Falcons</option>
                  <option>Carolina Panthers</option>
                  <option>New Orleans Saints</option>
                  <option>Tampa Bay Buccaneers</option>
               </optgroup>
               <optgroup label="NFC WEST">
                  <option>Arizona Cardinals</option>
                  <option>St. Louis Rams</option>
                  <option>San Francisco 49ers</option>
                  <option>Seattle Seahawks</option>
               </optgroup>
               <optgroup label="AFC EAST">
                  <option>Buffalo Bills</option>
                  <option>Miami Dolphins</option>
                  <option>New England Patriots</option>
                  <option>New York Jets</option>
               </optgroup>
               <optgroup label="AFC NORTH">
                  <option>Baltimore Ravens</option>
                  <option>Cincinnati Bengals</option>
                  <option>Cleveland Browns</option>
                  <option>Pittsburgh Steelers</option>
               </optgroup>
               <optgroup label="AFC SOUTH">
                  <option>Houston Texans</option>
                  <option>Indianapolis Colts</option>
                  <option>Jacksonville Jaguars</option>
                  <option>Tennessee Titans</option>
               </optgroup>
               <optgroup label="AFC WEST">
                  <option>Denver Broncos</option>
                  <option>Kansas City Chiefs</option>
                  <option>Oakland Raiders</option>
                  <option>San Diego Chargers</option>
               </optgroup>
            </select>
         </div>
         <div class="form-group">
            <label class="col-form-label mb-2">by Date</label>
            <br>
            <div class="input-group date" id="datetimepicker">
               <input class="form-control" type="text">
               <span class="input-group-append input-group-addon">
                  <span class="input-group-text fa fa-calendar"></span>
               </span>
            </div>
         </div>
         <div class="form-group mb-4">
            <label class="col-form-label mb-2">by Range</label>
            <br>
            <div class="slider-fw">
               <input class="slider" id="sl2" data-ui-slider="" type="text" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,750]">
            </div>
         </div>
         <button class="btn btn-secondary btn-lg">Apply</button>
      </div> -->
   </div>

@endsection
