<?php
session_start();
include_once "php/config.php";

// Check if the user is logged in
if (!isset($_SESSION['unique_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data
$user_id = $_SESSION['unique_id'];
$sql = "SELECT * FROM users WHERE unique_id = {$user_id}";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "No user data found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main/style.css">
    <title>Profile</title>
</head>
<body>
    <div class="wrapper">
        <h1>Profile</h1>
        <div class="profile-container">
            <img src="php/images/<?php echo $user['img']; ?>" alt="Profile Picture" class="profile-pic-large">
            <h2><?php echo $user['fname'] . " " . $user['lname']; ?></h2>
            <p>Email: <?php echo $user['email']; ?></p>
            <p>Status: <?php echo $user['status']; ?></p>
        </div>
    </div>
</body>
</html>
