<?php
session_start();
include_once "php/config.php";

// Check if the user is logged in
if (!isset($_SESSION['unique_id'])) {
    header("Location: login.php");
    exit();
}

// Handle status submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status_text = mysqli_real_escape_string($conn, $_POST['status']);
    $user_id = $_SESSION['unique_id'];
    $image_path = null;

    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $image_name = basename($_FILES['image']['name']);
        $image_path = $target_dir . $image_name;

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image_path = null;
        }
    }

    // Insert into the database
    $sql = "INSERT INTO statuses (user_id, status_text, image) VALUES ('$user_id', '$status_text', '$image_path')";
    if (mysqli_query($conn, $sql)) {
        echo "Status updated successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Status Update</title>
</head>
<body>
    <div class="wrapper">
        <h1>Update Status</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="status">Status:</label>
            <textarea name="status" id="status" placeholder="Enter your status..." required></textarea>

            <label for="image">Attach Image (optional):</label>
            <input type="file" name="image" id="image" accept="image/*">

            <button type="submit">Post Status</button>
        </form>
    </div>
</body>
</html>
