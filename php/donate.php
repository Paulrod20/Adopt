<?php
session_start();
$loggedIn = isset($_SESSION['user']);
$profilePic = $loggedIn && isset($_SESSION['user']['profile_pic']) ? $_SESSION['user']['profile_pic'] : '/assets/default-user.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Donate | Adopt</title>
  <link rel="stylesheet" href="/CSS files/styles.css" />
  <link rel="stylesheet" href="/CSS files/donate.css" />
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
            color: black; !important
            display: block;
        }
  </style>
</head>
<body class="donate-page">

  <nav>
    <a href="/index.php">
      <img src="/assets/a.png" class="logo" alt="Adopt Logo" />
    </a>
    <div class="hamburger">
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

  <section class="donate-hero">
    <div class="donate-hero-left">
        <h1>Giving Back Starts Here</h1>
    </div>
    <div class="donate-hero-right">
        <p>We’ve included trusted places where you can donate—either to Adopt itself or to an animal charity of your choice.</p>
        <br>
        <p>Your generosity helps shelters, improves animal lives, and supports the continued development of this platform.</p>
        <br>
        <p>Every dollar you give brings a pet one step closer to their forever home.</p>
        <br>
        <p>If you want support what Adopt does, you can also donate to Adopt as well! We will continue to innovate to help more pets reach their forever home!</p>
    </div>
  </section>

  <section class="donation-list">
    <h2>Recommended Animal Charities</h2>
    <ul>
      <li><a href="https://bestfriends.org/" target="_blank">Best Friends Animal Society</a></li>
      <li><a href="https://www.aspca.org/" target="_blank">ASPCA - American Society for the Prevention of Cruelty to Animals</a></li>
      <li><a href="https://www.humanesociety.org/" target="_blank">The Humane Society of the United States</a></li>
      <li><a href="https://www.animalhumanesociety.org/" target="_blank">Animal Humane Society</a></li>
      <li><a href="https://aldf.org/" target="_blank">Animal Legal Defense Fund</a></li>
      <li><a href="#" target="_blank">Adopt - Your Best Friend Is A Click Away</a></li>
    </ul>
  </section>

  <script src="/JS Files/index.js"></script>
</body>
</html>
