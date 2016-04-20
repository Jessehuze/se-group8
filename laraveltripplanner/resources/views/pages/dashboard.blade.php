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
    <script src="./js/pages/dashboard.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
        async defer></script>
  </head>
  <body>
    <!-- Navigation Bar -->
    @include('includes.header')
    <!-- Contains Everything Below Navbar -->
    <div class="row">
      <!-- Left Column Which Contains Google Map -->
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
                <div class="panel-body">Data From Controller Goes Here</div>
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
                <div class="panel-body">Data From Controller Goes Here</div>
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
