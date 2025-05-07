<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /php/signin.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | Adopt</title>
    <link rel="stylesheet" href="/CSS files/edit-profile.css">
</head>
<body>
    <div class="edit-container">
        <h1>Edit Profile</h1>
        <form action="/php/update-profile.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label for="profile_pic">Profile Picture</label>
            <input type="file" name="profile_pic">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
