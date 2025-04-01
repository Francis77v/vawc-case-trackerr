<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">VAWC Case Tracker System</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav"
      aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="topNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-user"></i> <?= $_SESSION['username']; ?></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="includes/logout-confirm.php"><i class="fas fa-sign-out-alt"></i> Logout</a>

        </li>
      </ul>
    </div>
  </div>
</nav>  