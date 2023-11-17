<?php
include("config.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $conn->prepare("UPDATE users SET is_verified = 1 WHERE verification_token = ?");
    $stmt->bind_param("s", $token);

    if ($stmt->execute()) {
        echo "Email verified successfully. You can now log in.";
    } else {
        echo "Error verifying email: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid verification link.";
}
?>
