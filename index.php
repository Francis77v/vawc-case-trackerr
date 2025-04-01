
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | VAWC Case Tracker System</title>

  <!-- ✅ Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Font Awesome (for icons) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- SweetAlert2 Theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Custom Style -->
  <style>
    body {
      background: linear-gradient(135deg, #f2f4f7, #dbe9f4);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .login-container {
      max-width: 420px;
      width: 100%;
      padding: 2rem;
      border-radius: 15px;
      background-color: #ffffff;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.08);
    }

    .navbar-brand {
      font-size: 1.4rem;
      font-weight: bold;
      color: #1d3557;
    }

    .password-container {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 1rem;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
    }

    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand mx-auto" href="#">
        VAWC Case Tracker System
      </a>
    </div>
  </nav>

  <!-- Login Section -->
  <div class="container d-flex justify-content-center align-items-center flex-grow-1 py-5">
    <div class="login-container">

      <div class="text-center mb-4">
        <h4 class="text-primary">Sign In</h4>
        <?php if (!empty($_SESSION['error'])): ?>
          <div class="alert alert-danger py-2 px-3">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
          </div>
        <?php endif; ?>
      </div>

      <form method="POST" action="includes/login.php" novalidate>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="username" required autofocus>
        </div>

        <div class="mb-3 password-container">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password" required>
          <span class="toggle-password"><i class="fas fa-eye" id="toggleIcon"></i></span>
        </div>

        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Password Toggle Script -->
  <script>
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    togglePassword.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      toggleIcon.classList.toggle('fa-eye-slash');
    });
  </script>

</body>
</html>
