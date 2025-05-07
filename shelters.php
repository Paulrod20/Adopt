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
    <link rel="stylesheet" href="/CSS files/shelters.css">
    <title>Adopt | Shelters</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f9f9f9;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: var(--accent-color);
            z-index: 10;
            padding: 20px 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        nav .logo {
            width: 80px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            align-items: center;
        }

        .nav-links li {
            margin-left: 40px;
        }

        .nav-links li a {
            text-decoration: none;
            color: white;
            font-size: 17px;
            transition: 0.2s;
        }

        .nav-links li a:hover {
            letter-spacing: 1px;
            color: white;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
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
            width: 160px;
            padding: 0;
            text-align: center;
        }

        .dropdown:hover .dropdown-menu,
        .dropdown-menu:hover {
            display: block;
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

        #map {
            margin-top: 10px;
            height: 75vh;
            width: 90%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            margin-top: 150px;
            color: #2E2B41;
        }
    </style>

</head>
<body>
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
            <li><a href="/php/shelters.php">SHELTERS</a></li>
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

    <h1>Find Nearby Dog Shelters</h1>
    <div id="map"></div>

    <script>
        let map;
        let userLocation;

        async function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    map = new google.maps.Map(document.getElementById("map"), {
                        center: userLocation,
                        zoom: 12
                    });

                    new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: "Your location"
                    });

                    findShelters();
                }, function () {
                    alert("Geolocation failed or user denied access.");
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        async function findShelters() {
            const request = {
                location: userLocation,
                radius: 5000,  // Search within 5km radius
                type: ['animal_shelter']
            };

            const placesService = new google.maps.places.PlacesService(map);

            try {
                const results = await new Promise((resolve, reject) => {
                    placesService.nearbySearch(request, (results, status) => {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            resolve(results);
                        } else {
                            reject(status);
                        }
                    });
                });

                // If the search is successful, place markers for each shelter
                results.forEach(shelter => {
                    new google.maps.Marker({
                        position: shelter.geometry.location,
                        map: map,
                        title: shelter.name
                    });
                });
            } catch (error) {
                console.error('Error occurred during nearbySearch:', error);
                if (error === google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
                    console.log("No shelters found.");
                } else if (error === google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT) {
                    console.log("Over query limit: Rate limit exceeded.");
                } else if (error === google.maps.places.PlacesServiceStatus.REQUEST_DENIED) {
                    console.log("Request denied: API key may be invalid or not authorized.");
                } else if (error === google.maps.places.PlacesServiceStatus.INVALID_REQUEST) {
                    console.log("Invalid request: Missing or invalid parameters.");
                }
            }
        }
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhSxCQsxVO5bMdxXpCWaaS-CZZl_ELddg&libraries=places,marker&callback=initMap">
    </script>

</body>

</html>
