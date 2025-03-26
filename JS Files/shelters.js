let map;
let service;
let userMarker;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 37.7749, lng: -122.4194 }, // Default: San Francisco
        zoom: 12,
    });
}
window.initMap = initMap; // Ensures the API can call this function


function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    const userLocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };

    map.setCenter(userLocation);
    userMarker = new google.maps.Marker({
        position: userLocation,
        map: map,
        title: "Your Location",
        icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
    });

    findShelters(userLocation);
}

function findShelters(location) {
    const request = {
        location: location,
        radius: 5000, // Search within 5km
        type: ["pet_store", "veterinary_care"] // Google's categories for pet-related places
    };

    service = new google.maps.places.PlacesService(map);
    service.nearbySearch(request, displayResults);
}

function displayResults(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
        let infoDiv = document.getElementById("info");
        infoDiv.innerHTML = "<h3>Nearest Dog Shelters:</h3>";

        results.forEach((place) => {
            let marker = new google.maps.Marker({
                position: place.geometry.location,
                map: map,
                title: place.name
            });

            infoDiv.innerHTML += `<p><strong>${place.name}</strong><br>Address: ${place.vicinity}</p>`;
        });
    } else {
        alert("No shelters found nearby.");
    }
}

function showError(error) {
    let errorMessage = "";
    switch (error.code) {
        case error.PERMISSION_DENIED:
            errorMessage = "User denied the request for Geolocation.";
            break;
        case error.POSITION_UNAVAILABLE:
            errorMessage = "Location information is unavailable.";
            break;
        case error.TIMEOUT:
            errorMessage = "The request to get user location timed out.";
            break;
        case error.UNKNOWN_ERROR:
            errorMessage = "An unknown error occurred.";
            break;
    }
    alert(errorMessage);
}
