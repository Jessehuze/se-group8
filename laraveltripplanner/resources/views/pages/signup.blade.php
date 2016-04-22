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
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
      {!! csrf_field() !!}
      
      <!-- Name Input-->
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-offset-2 control-label col-sm-2">Name</label>
          <div class="col-md-4">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>
          <div class="col-sm-4"></div>
      </div>

      <!-- Email Input-->
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="col-sm-offset-2 control-label col-sm-2">E-Mail Address</label>
        <div class="col-md-4">
          <input type="email" class="form-control" name="email" value="{{ old('email') }}">
          @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
        <div class="col-sm-4"></div>
      </div>

      <!-- Password Input-->
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="col-sm-offset-2 control-label col-sm-2">Password</label>
        <div class="col-md-4">
          <input type="password" class="form-control" name="password">
          @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
        <div class="col-sm-4"></div>
      </div>

      <!-- Confirm Password Input-->
      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label class="col-sm-offset-2 control-label col-sm-2">Confirm Password</label>
        <div class="col-md-4">
          <input type="password" class="form-control" name="password_confirmation">
          @if ($errors->has('password_confirmation'))
            <span class="help-block">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
          @endif
        </div>
        <div class="col-sm-4"></div>
      </div>

      <!-- Register Button -->
      <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i>Register
          </button>
        </div>
      </div>

    </form>
    <!-- End Sign Up Form -->
  </body>
</html>