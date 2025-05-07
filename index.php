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
    <style>
        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #08C2FF;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 50px;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            display: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 100;
            width: 160px; /* set a fixed or max width */
            padding: 0;
            text-align: center;
        }

        .dropdown-menu li {
            list-style: none;
            margin: 0;
        }

        .dropdown-menu li a {
            display: block;
            padding: 10px 0;
            text-decoration: none;
            color: black;
            width: 100%;
            transition: background-color 0.2s ease;
        }

        .dropdown-menu li a:hover {
            background-color: #f0f0f0;
        }


        .dropdown:hover .dropdown-menu,
        .dropdown-menu:hover {
            display: block;
        }

</style>

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
                <li><a href="/php/about.html">ABOUT US</a></li>
                <li><a href="/php/donate.html">DONATE</a></li>
                <?php if (!$loggedIn): ?>
                <li><a href="/php/signin.php" id="nav-button">Log In</a></li>
                <?php else: ?>
                <li class="dropdown">
                    <img src="<?= htmlspecialchars($profilePic) ?>" alt="Profile" class="profile-icon">
                    <ul class="dropdown-menu">
                        <li><a href="/php/profile.php">Edit Profile</a></li>
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
