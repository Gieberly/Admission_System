<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOTP = $_POST['otp'];
    $email = $_SESSION['registered_email'];

    $stmt = $conn->prepare("SELECT otp, otp_expiry FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($storedOTP, $otpExpiry);
    $stmt->fetch();
    $stmt->close();

    if ($storedOTP === $enteredOTP && strtotime($otpExpiry) > time()) {
        // OTP is valid, update user status to 'approved'
        $stmtUpdateStatus = $conn->prepare("UPDATE users SET status = 'approved' WHERE email = ?");
        $stmtUpdateStatus->bind_param("s", $email);
        $stmtUpdateStatus->execute();
        $stmtUpdateStatus->close();

        // Redirect to login page
        header("Location: loginpage.php");
        exit();
    } else {
        echo "Invalid OTP or OTP expired. Please try again.";
    }
}

$conn->close();
?>
