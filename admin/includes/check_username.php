<?php
require_once '../../includes/connection.php';

if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    $stmt = $conn->prepare("SELECT user_id FROM tbl_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    echo $stmt->num_rows > 0 ? 'exists' : 'available';
    $stmt->close();
}
?>
