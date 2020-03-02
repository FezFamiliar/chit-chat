<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
  <a class="navbar-brand" href="/">{{ config('app.name') }}</a>

  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Timeline <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/profile">Profile</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="/about">About</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="/service">Service</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/posts">Blog</a>
      </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li class="nav-item"><a class="nav-link" href="#"> Sign Up</a></li>
      <li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>