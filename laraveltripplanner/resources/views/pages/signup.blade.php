<!DOCTYPE html>
<html>
  <head>
    <title>OnYourWay - Signup</title>

    <!-- Page Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    @include('includes.bootstrap')

    <!-- Style Sheet For This Page -->
    <link href="./css/pages/signup.css" rel="stylesheet" type="text/css"> 

  </head>
  <body>
    <!-- Navigation Bar -->
    @include('includes.header')
    <div class="row">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-6 content">
        <div class="welcometitle">Signup</div>
      </div>
      <div class="col-sm-3">
      </div>
    </div>
    <!-- Sign Up Form -->
    <form class="form-horizontal" role="form">
      <div class="form-group">
        <label class="col-sm-offset-2 control-label col-sm-2">Username:</label>
        <div class="col-sm-4">
          <input type="username" class="form-control" id="username" placeholder="Enter username">
        </div>
        <div class="col-sm-6"></div>
      </div>
      <div class="form-group">
        <label class=" col-sm-offset-2 control-label col-sm-2">Password:</label>
        <div class="col-sm-4"> 
          <input type="password" class="form-control" id="pwd" placeholder="Enter password">
        </div>
        <div class="col-sm-6"></div>
      </div>
      <div class="form-group">
        <label class=" col-sm-offset-2 control-label col-sm-2">First Name:</label>
        <div class="col-sm-4"> 
          <input type="password" class="form-control" id="pwd" placeholder="Enter first name">
        </div>
        <div class="col-sm-6"></div>
      </div>
      <div class="form-group">
        <label class=" col-sm-offset-2 control-label col-sm-2">Last Name:</label>
        <div class="col-sm-4"> 
          <input type="password" class="form-control" id="pwd" placeholder="Enter last name">
        </div>
        <div class="col-sm-6"></div>
      </div>
      <div class="form-group"> 
        <div class="col-sm-offset-4 col-sm-8">
          <button type="submit" class="btn btn-default">Submit</button>
        </div>
      </div>
    </form>
    <!-- End Sign Up Form -->
  </body>
</html>