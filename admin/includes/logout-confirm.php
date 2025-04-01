    <?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Confirm Logout</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Bootstrap 5 (optional for styling) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<script>
Swal.fire({
  title: 'Are you sure you want to logout?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, logout',
  cancelButtonText: 'Cancel',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = 'logout.php';
  } else {
    window.history.back();
  }
});
</script>

</body>
</html>
