

  <!-- Include Header -->
  <?php 
  include('includes/session.php'); 
  include('includes/header.php'); 
  include('includes/topbar.php'); 
  require_once '../includes/connection.php';
  
  ?>


  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-lg-3 col-xl-2 p-0 bg-light" id="sidebar">
        <?php include('includes/sidebar.php'); ?>
      </div>

      <!-- Main Content -->
      <div class="col-lg-9 col-xl-10" id="main">
        <div class="p-4">
          <h3>Welcome, <?= $_SESSION['username']; ?>!</h3>
          <p class="text-muted">You are logged in as <strong><?= $_SESSION['userlevel']; ?></strong>.</p>

          <!-- Add more dashboard widgets/content here -->
        </div>
      </div>
    </div>
  </div>

    <!-- Include footer -->
    <?php include('includes/footer.php'); ?>