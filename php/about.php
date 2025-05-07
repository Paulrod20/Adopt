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
    <title>About Us | Adopt</title>
    <link rel="stylesheet" href="/CSS files/styles.css">
    <link rel="stylesheet" href="/CSS files/about.css">
    <style>
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: transparent;
            z-index: 10;
            padding: 20px 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        nav .logo {
            width: 80px;
        }

        nav .nav-links {
            display: flex;
            align-items: center;
            list-style: none;
        }

        .dropdown {
            position: relative;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #08C2FF;
            cursor: pointer;
        }

        .dropdown-menu {
            position: absolute;
            top: 50px;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            padding: 0;
            border-radius: 8px;
            display: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 100;
            width: 150px;
        }

        .dropdown:hover .dropdown-menu,
        .dropdown-menu:hover {
            display: block;
        }

        .dropdown-menu li {
            list-style: none;
            padding: 10px;
            text-align: center;
        }

        .dropdown-menu li a {
            text-decoration: none;
            color: black;
            display: block;
        }
    </style>
</head>
<body class="about-page">

<nav>
    <a href="/index.php">
        <img src="/assets/a.png" class="logo" alt="Adopt Logo">
    </a>

    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <ul class="nav-links">
        <li><a href="/shelters.php">SHELTERS</a></li>
        <li><a href="/php/about.php">ABOUT US</a></li>
        <li><a href="/php/donate.php">DONATE</a></li>
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

<section class="about-hero">
    <div class="about-hero-left">
        <h1>Adopt was born from experience</h1>
    </div>
    <div class="about-hero-right">
        <p>We are a family-driven organization on a mission to connect loving pets with their forever homes using technology and compassion.</p>
        <br>
        <p>Adopt became an idea when founders Paul and Makayla Rodriguez were looking to adopt a new dog. Going to each shelter's website was a hit or miss.
            After driving for hours, they finally met Scooby! This service is meant to save people time, money, gas, and frustration.</p>
        <br>
        <p>Paul and Makayla always had a passion for helping pets get out of shelters and into loving homes. Adopt was created to also create a better
            opportunity for animals to live a better life while improving our lives!</p>
        <br>
        <strong><p>It all began from a real experience. Your best friend is a click away.</p></strong>
    </div>
</section>

<div class="top-container">
    <div class="bio-section">
        <div class="bio-card">
            <img src="/assets/paul.jpg" alt="Person 1">
            <h3>Paul Rodriguez</h3>
            <p>Paul is a co-founder and CEO of Adopt. Originally from Secaucus, New Jersey, Paul moved to North Carolina in 2017.</p>
            <br>
            <p>Growing up, Paul has always had a pet in the house. It first began with a yorki terrier named Coco, to a Chihuahua named Max, to the dog that became his best friend, Scooby. Scooby and Paul were best of friends. Their relationship birthed the idea of Adopt.</p>
            <br>
            <p>Paul has an associate's degree in IT: Computer Science and App Developer at Catawba Valley Community College (CVCC).</p>
        </div>
        <div class="bio-card">
            <img src="/assets/Mak.png" alt="Brown hair woman">
            <h3>Makayla Rodriguez</h3>
            <p>Makayla is a co-founder and Head of Finances of Adopt. Makayla was born and raised in Newton, North Carolina.</p>
            <br>
            <p>Makayla has loved dogs from the start. Her first pet was named Buttons, to her lifelong family dog adopted in 2008 named Grady, an Australian Shepherd who passed in 2024, to Scooby, a pitbull terrier mutt. While Makayla was pregnant with Micaiah, Scooby always laid his head on her belly.</p>
            <br>
            <p>Makayla is also the International Commercial Accounts Manager at MDI in Hickory, NC.</p>
        </div>
        <div class="bio-card">
            <img src="/assets/Mic.png" alt="CEO's son">
            <h3>Micaiah Rodriguez</h3>
            <p>Micaiah is the heart and soul of Adopt. Micaiah was born and raised in Hickory, North Carolina in 2021.</p>
            <br>
            <p>Micaiah brightens up everyone's day. Whether it is his off the wall comments on the most random things, his extremely funny questions, his spontaneous dance moves, or his contagious laugh, Micaiah is the heart and soul of Adopt. Micaiah loves petting every dog or cat he comes across.</p>
            <br>
            <p>Micaiah is the future of the company and his passion for animals will take Adopt to the next level!</p>
        </div>
        <div class="bio-card">
            <img src="/assets/scooby.jpg" alt="Tan Pitbull Terrier named Scooby">
            <h3>Scooby</h3>
            <p>Scooby is a pitbull terrier mutt from Morganton, North Carolina. Scooby was adopted from a shelter in 2019.</p>
            <br>
            <p>Scooby was one of the most energetic dogs on this planet. He was extremely strong and fast. Paul and Makayla knew Scooby was the one for them when he jumped and did a backflop off of Makayla. She was frightened, but Paul was sold.</p>
            <br>
            <p>Scooby is no longer with us, but without Scooby, Adopt would have never existed. According to Paul, he was the best dog he ever had.</p>
        </div>
    </div>
</div>

<script src="/JS Files/index.js"></script>
</body>
</html>
