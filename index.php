<?php
session_start();
$loggedIn = isset($_SESSION['user']);
$profilePic = $loggedIn && isset($_SESSION['user']['profile_pic']) ? $_SESSION['user']['profile_pic'] : '/assets/default-user.png';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="/assets/favicon-32x32.png">
    <link rel="stylesheet" href="/CSS files/styles.css">
    <title>Adopt | Home</title>
</head>

<body>
    <div class="hero">

        <div class="video-container">
            <video autoplay muted loop id="myVideo">
                <source src="./assets/Timeline 1.mov" type="video/mp4">
            </video>
            <div class="color-overlay"></div>
        </div>

        <nav>
            <a href="./index.php">
                <img src="./assets/a.png" class="logo" alt="Adopt Logo">
            </a>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links">
                <li><a href="/shelters.html">SHELTERS</a></li>
                <li><a href="/HTML files/about.html">ABOUT US</a></li>
                <li><a href="/HTML files/donate.html">DONATE</a></li>
                <?php if (!$loggedIn): ?>
                <li><a href="/HTML files/signin.php" id="nav-button">Log In</a></li>
                <?php else: ?>
                <li class="dropdown">
                    <img src="<?= htmlspecialchars($profilePic) ?>" alt="Profile" class="profile-icon">
                    <ul class="dropdown-menu">
                        <li><a href="/HTML files/profile.php">Edit Profile</a></li>
                        <li><a href="/logout.php">Sign Out</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="content">
            <h1>Your Best Friend Is One Click Away.</h1>
            <a href="/shelters.html">Explore</a>
        </div>
    </div>

    <script src="/JS Files/index.js"></script>
</body>

</html>