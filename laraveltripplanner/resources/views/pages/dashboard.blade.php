<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <!-- Bootstrap -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 40px;
                margin: 0;

            }

            .profilename {
                font-size: 30px;
                text-align: right;
            }

            .header {
                background-color: #333333;
                color: white;
            }

            .panelheaders {
                background-color: #6a6a6a !important;
                color: white !important;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse header">
            <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand title" href="#">OnYourWay</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
          </div>
        </nav>
        <div class="row">
            <div class="col-sm-9 title content">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d25772073.93684879!2d-91.74201645!3d37.95366644999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1460519843390" width="90%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-sm-3">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading panelheaders">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                        My Routes</a>
                      </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                      <div class="panel-body">Data From Controller Goes Here</div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading panelheaders">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                        Shared Routes</a>
                      </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                      <div class="panel-body">Data From Controller Goes Here</div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading panelheaders">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                        Routes Shared With You</a>
                      </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                      <div class="panel-body">Data From Controller Goes Here</div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading panelheaders">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                        Groups</a>
                      </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                      <div class="panel-body">Data From Controller Goes Here</div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </body>
</html>
