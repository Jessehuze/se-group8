<!DOCTYPE html>
<html>
  <head>
    <title>OnYourWay - Login</title>
    <!-- Page Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    @include('includes.bootstrap')

    <!-- Style Sheet For This Page -->
    <link href="./css/pages/login.css" rel="stylesheet" type="text/css">

  </head>
  <body>
    <!-- Navigation Bar -->
    @include('includes.header')
    <div class="row">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-6 content">
        <div class="welcometitle">Login</div>
      </div>
      <div class="col-sm-3">
        </div>
      </div>
    <div>
    <!-- Login Form -->
    <form class="form-horizontal" role="form">
      <div class="form-group">
        <label class="col-sm-offset-2 control-label col-sm-2" for="email">Username:</label>
        <div class="col-sm-4">
          <input type="username" class="form-control" id="username" placeholder="Enter username">
        </div>
        <div class="col-sm-6"></div>
      </div>
      <div class="form-group">
        <label class=" col-sm-offset-2 control-label col-sm-2" for="pwd">Password:</label>
        <div class="col-sm-4"> 
          <input type="password" class="form-control" id="pwd" placeholder="Enter password">
        </div>
        <div class="col-sm-6"></div>
      </div>
      <div class="form-group"> 
        <div class="col-sm-offset-4 col-sm-8">
          <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
          </div>
        </div>
      </div>
      <div class="form-group"> 
        <div class="col-sm-offset-4 col-sm-8">
          <button type="submit" class="btn btn-default">Submit</button>
        </div>
      </div>
    </form>
    <!-- End Login Form -->
  </body>
</html>
