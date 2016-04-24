<style>
  .headertitle {
    font-size: 40px;
    margin: 0;
  }
  .header {
    background-color: #333333;
    color: white;
    margin: 0;
    padding: 0;
  }
</style>

<nav class="navbar navbar-inverse header">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand headertitle" href="/">OnYourWay</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <!-- Possibly Only Visible If Logged In -->
              <li><a href="/dashboard"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
              <?php //dd(Auth::guest()); ?>
              <!-- Logout Visible Only If Logged In And Login And Signup If Not-->      
              @if (Auth::guest())
                <li><a href="/signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              @else
                <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
              @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>