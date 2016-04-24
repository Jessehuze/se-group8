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

    <!-- Login Form New-->
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
      {!! csrf_field() !!}
      <!-- Email Input-->
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="form-group">
          <label class="col-sm-offset-2 control-label col-sm-2" for="email">E-Mail Address:</label>
          <div class="col-sm-4">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="col-sm-6"></div>
        </div>
      </div>

      <!-- Password Input-->
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="form-group">
          <label class=" col-sm-offset-2 control-label col-sm-2" for="pwd">Password:</label>
          <div class="col-sm-4"> 
            <input type="password" class="form-control" name="password">
            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>
          <div class="col-sm-6"></div>
        </div>
      </div>

      <div class="form-group"> 
        <div class="col-sm-offset-4 col-sm-8">
          <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
          </div>
        </div>
      </div>
      <div class="form-group"> 
        <div class="col-sm-offset-4 col-sm-8">
          <button type="submit" class="btn btn-primary">Login</button>
          <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
        </div>
      </div>
    </form>
  </body>
</html>
