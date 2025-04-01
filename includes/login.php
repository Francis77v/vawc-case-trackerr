<?php
session_start();
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && $password === $user['password']) {


            // Optional: Check if account is inactive
            // if ($user['status'] === 'Inactive') {
            //     $_SESSION['error'] = "Your account has been deactivated.";
            //     header("Location: index.php");
            //     exit();
            // }

            // Store session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Optional: Update login status
            // $updateStmt = $conn->prepare("UPDATE tbl_users SET is_logged_in = 1, last_activity = NOW() WHERE user_id = ?");
            // $updateStmt->bind_param("i", $user['user_id']);
            // $updateStmt->execute();
            // $updateStmt->close();

            // Optional: Log successful login
            // $action = "Successful login for user: $username";
            // $logStmt = $conn->prepare("INSERT INTO tbl_audit_logs (user_id, username, action, userlevel, ip_address, user_agent, date_audited)
            //     VALUES (?, ?, ?, ?, ?, ?, NOW())");
            // $logStmt->bind_param("isssss", $user['user_id'], $username, $action, $user['userlevel'], $ip_address, $user_agent);
            // $logStmt->execute();
            // $logStmt->close();

            // ✅ Redirect directly to admin dashboard
            header("Location: ../admin/admin_dashboard.php");
            exit();

        } else {
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Database error: " . $conn->error;
        header("Location: index.php");
        exit();
    }
}
