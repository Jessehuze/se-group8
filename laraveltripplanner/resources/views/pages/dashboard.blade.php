<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard</title>
    <!-- Page Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    @include('includes.bootstrap')

    <!-- Style Sheet For This Page -->
    <link href="./css/pages/dashboard.css" rel="stylesheet" type="text/css">

    <!-- Javascript Pages -->
    <script src="http://maps.google.com/maps/api/js?libraries=places&callback=init"
      type="text/javascript"
      async defer></script>

    <script src="./js/pages/dashboard.js" 
      type="text/javascript"
      async defer></script>



<!--     <script src="https://maps.googleapis.com/maps/api/js?callback=init"
      async defer></script> -->
  </head>
  <body>
    <!-- Navigation Bar -->
    @include('includes.header')
    <!-- Contains Everything Below Navbar -->
    <div class="row">
      <!-- Left Column Which Contains Google Map -->
      <input id="map-input" class="controls" type="text" placeholder="Search Box">
      <div class="col-sm-9 title content">
        <div id="map"></div>
      </div>
      <!-- Right Column Sidebar -->
      <div class="col-sm-3">
          <!-- Start Accordion Panel -->
          <div class="panel-group" id="accordion">
            <!-- My Routes Accordion -->
            <div class="panel panel-default">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                <div class="panel-heading panelheaders">
                  <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list"></span>
                    My Routes
                  </h4>
                </div>
              </a>
              <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body sidebar-panel">
                  <!-- Data From Controller Goes Here -->
                  <!-- foreach($data['routes'] as $route) -->
                  <div class="sidebar-row row" onclick=sidebarClick(this)>
                    <div class="col-sm-6">
                      Colorado to Timbucktoo
                      <!-- @echo $name;      @echo $route['name']; -->
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        5 Hr 30 Min<!-- @echo $route['time']; -->
                      </div>
                      <div class="row">
                        9000 Miles<!-- @echo $route['distance']; -->
                      </div>
                    </div>
                  </div>
                  <!-- endforeach -->
                  <!-- DIV TO BE REMOVED, USED FOR TESTING VIEW -->
                  <div class="row sidebar-row" onclick=sidebarClick(this)>
                    <div class="col-sm-6">
                      Colorado to Timbucktoo<!-- @echo $route['name']; -->
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        5 Hr 30 Min<!-- @echo $route['time']; -->
                      </div>
                      <div class="row">
                        9000 Miles<!-- @echo $route['distance']; -->
                      </div>
                    </div>
                  </div>
                  <!-- END OF DIV TO BE REMOVED -->
                </div>
              </div>
            </div>
            <!-- Shared Routes Accordion -->
            <div class="panel panel-default">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                <div class="panel-heading panelheaders">
                  <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list"></span>
                    Shared Routes
                  </h4>
                </div>
              </a>
              <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body sidebar-panel">
                  <!-- Data From Controller Goes Here -->
                  <!-- foreach($data['routes'] as $route) -->
                  <div class="sidebar-row row" onclick=sidebarClick(this)>
                    <div class="col-sm-6">
                      Colorado to Timbucktoo<!-- @echo $route['name']; -->
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        5 Hr 30 Min<!-- @echo $route['time']; -->
                      </div>
                      <div class="row">
                        9000 Miles<!-- @echo $route['distance']; -->
                      </div>
                    </div>
                  </div>
                  <!-- endforeach -->
                  <!-- DIV TO BE REMOVED, USED FOR TESTING VIEW -->
                  <div class="row sidebar-row" onclick=sidebarClick(this)>
                    <div class="col-sm-6">
                      Colorado to Timbucktoo<!-- @echo $route['name']; -->
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        5 Hr 30 Min<!-- @echo $route['time']; -->
                      </div>
                      <div class="row">
                        9000 Miles<!-- @echo $route['distance']; -->
                      </div>
                    </div>
                  </div>
                  <!-- END OF DIV TO BE REMOVED -->
                </div>
              </div>
            </div>
            <!-- Routes Shared With You Accordion  -->
            <div class="panel panel-default">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                <div class="panel-heading panelheaders">
                  <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list"></span>
                    Routes Shared With You
                  </h4>
                </div>
              </a>
              <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">Data From Controller Goes Here</div>
              </div>
            </div>
            <!-- Groups Accordion -->
            <div class="panel panel-default">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                <div class="panel-heading panelheaders">
                  <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list"></span>
                    Groups
                  </h4>
                </div>
              </a>
              <div id="collapse4" class="panel-collapse collapse">
                <div class="panel-body">Data From Controller Goes Here</div>
              </div>
            </div>
          </div>
          <!-- End Accordion Panel -->
        </div>
    </div>
  </body>
</html>
