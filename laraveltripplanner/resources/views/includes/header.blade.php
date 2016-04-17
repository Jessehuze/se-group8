<style>
  .headertitle {
    font-size: 40px;
    margin: 0;
  }
  .header {
    background-color: #333333;
    color: white;
  }
</style>

<!-- Navigation Bar -->
<nav class="navbar navbar-inverse header">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand headertitle" href="/">OnYourWay</a>
    </div>
    <ul class="nav navbar-nav navbar-right">

      <!-- Possibly Only Visible If Logged In -->
      <li><a href="/dashboard"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>

      <!-- Visible Only If Logged In -->      
        <!-- Logout Button Goes Here -->

      <!-- Hidden If Logged In -->
      <li><a href="/signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

    </ul>
  </div>
</nav>