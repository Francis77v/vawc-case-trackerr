  <?php
  include('includes/session.php'); 
  include('includes/header.php'); 
  include('includes/topbar.php'); 
  require_once '../includes/connection.php';

  if (isset($_POST['add_user'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $full_name = $_POST['full_name'];
    $position = $_POST['position'];
    $office = $_POST['office'];
    $role = "Staff";

    // 1. Check if passwords match
    if ($password !== $confirm_password) {
      echo "<script>alert('Passwords do not match.'); window.location.href='manage_users.php';</script>";
      exit();
    }

    // 2. Check if username already exists
    $check = $conn->prepare("SELECT user_id FROM tbl_users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      echo "<script>alert('Username already exists. Choose another.'); window.location.href='manage_users.php';</script>";
      $check->close();
      exit();
    }
    $check->close();

    // 3. Hash password and insert
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO tbl_users (username, password, full_name, position, office, role) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $hashed_password, $full_name, $position, $office, $role);

    if ($stmt->execute()) {
      echo "<script>alert('User added successfully!'); window.location.href='manage_users.php';</script>";
    } else {
      echo "<script>alert('Error adding user: " . $stmt->error . "');</script>";
    }

    $stmt->close();
  }

  // 🔹 Fetch all users (move SELECT to top for performance & clarity)
  $query = "SELECT user_id, username, full_name, position, office, role FROM tbl_users";
  $result = $conn->query($query);

  ?>

  <!-- 🔸 HTML layout starts -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 p-0 bg-light">
        <?php include('includes/sidebar.php'); ?>
      </div>

      <div class="col-lg-9 p-4">
        <div class="d-flex justify-content-between mb-3">
          <h4>User Management</h4>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-user-plus me-1"></i> Add User
          </button>
        </div>

        <table class="table table-bordered table-striped">
          <thead class="table-primary">
            <tr>
              <th>User ID</th>
              <th>Username</th>
              <th>Full Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Role</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['user_id']; ?></td>
              <td><?= htmlspecialchars($row['username']); ?></td>
              <td><?= htmlspecialchars($row['full_name']); ?></td>
              <td><?= htmlspecialchars($row['position']); ?></td>
              <td><?= htmlspecialchars($row['office']); ?></td>
              <td><?= htmlspecialchars($row['role']); ?></td>
              <td>
                <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- 🔹 Add User Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Wider modal -->
      <form method="POST" action="manage_users.php" id="addUserForm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="row g-3">
          
              <div class="col-md-6">
    <label for="username" class="form-label">Username</label>
    <input type="text" name="username" id="username" class="form-control" required>
    <div id="usernameFeedback" class="form-text text-danger d-none">Username already exists.</div>
  </div>

              <div class="col-md-6">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" name="full_name" id="full_name" class="form-control" required>
              </div>

              <div class="col-md-6 position-relative">
  <label for="password" class="form-label">Password</label>
  <input type="password" name="password" id="password" class="form-control" required>
  <i class="fas fa-eye toggle-password" toggle="#password" style="position:absolute; top:38px; right:15px; cursor:pointer;"></i>
</div>

<div class="col-md-6 position-relative">
  <label for="confirm_password" class="form-label">Confirm Password</label>
  <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
  <i class="fas fa-eye toggle-password" toggle="#confirm_password" style="position:absolute; top:38px; right:15px; cursor:pointer;"></i>
  <div id="passwordHelp" class="form-text text-danger d-none">Passwords do not match.</div>
</div>


              <div class="col-md-6">
                <label for="position" class="form-label">Position</label>
                <input type="text" name="position" id="position" class="form-control">
              </div>
              <div class="col-md-6">
                <label for="office" class="form-label">Office</label>
                <input type="text" name="office" id="office" class="form-control">
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="add_user" class="btn btn-success">Save User</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirm_password');
  const passwordHelp = document.getElementById('passwordHelp');
  const form = document.getElementById('addUserForm');

  // Live password match validation
  function checkPasswordMatch() {
    if (password.value !== confirmPassword.value) {
      confirmPassword.classList.add('is-invalid');
      passwordHelp.classList.remove('d-none');
    } else {
      confirmPassword.classList.remove('is-invalid');
      passwordHelp.classList.add('d-none');
    }
  }

  password.addEventListener('input', checkPasswordMatch);
  confirmPassword.addEventListener('input', checkPasswordMatch);

  const usernameInput = document.getElementById('username');
  const usernameFeedback = document.getElementById('usernameFeedback');

  usernameInput.addEventListener('input', function () {
    const username = this.value.trim();
    if (username.length === 0) {
      usernameFeedback.classList.add('d-none');
      usernameInput.classList.remove('is-invalid');
      return;
    }

    // Send AJAX request
    fetch('includes/check_username.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'username=' + encodeURIComponent(username)
    })
    .then(response => response.text())
    .then(data => {
      if (data === 'exists') {
        usernameInput.classList.add('is-invalid');
        usernameFeedback.classList.remove('d-none');
      } else {
        usernameInput.classList.remove('is-invalid');
        usernameFeedback.classList.add('d-none');
      }
    });
  });


  // Prevent form submission if passwords don't match
  form.addEventListener('submit', function (e) {
    if (password.value !== confirmPassword.value) {
      e.preventDefault();
      confirmPassword.focus();
      passwordHelp.classList.remove('d-none');
      confirmPassword.classList.add('is-invalid');
    }

    if (usernameInput.classList.contains('is-invalid')) {
      e.preventDefault();
      usernameInput.focus();
      usernameFeedback.classList.remove('d-none');
    }
  });
  document.querySelectorAll('.toggle-password').forEach(function (icon) {
  icon.addEventListener('click', function () {
    const target = document.querySelector(this.getAttribute('toggle'));
    const type = target.getAttribute('type') === 'password' ? 'text' : 'password';
    target.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });
});

  </script>


  <!-- 🔚 Footer -->
  <?php include('../includes/footer.php'); ?>
