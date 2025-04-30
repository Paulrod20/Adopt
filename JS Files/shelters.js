let map;
let infoWindow;
let userLocation;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 35.7796, lng: -78.6382 }, // Default center (Raleigh, NC)
        zoom: 12,
    });
    infoWindow = new google.maps.InfoWindow();
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            map.setCenter(userLocation);

            // Search for nearby shelters
            const service = new google.maps.places.PlacesService(map);
            service.nearbySearch({
                location: userLocation,
                radius: 10000, // 10km
                keyword: "dog shelter"
            }, displayResults);
        }, () => {
            alert("Geolocation failed. Please allow location access.");
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function displayResults(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
        results.forEach(place => {
            createMarker(place);
        });
    }
}

function createMarker(place) {
    const marker = new google.maps.Marker({
        map,
        position: place.geometry.location
    });

    google.maps.event.addListener(marker, "click", () => {
        const request = {
            placeId: place.place_id,
            fields: ["name", "formatted_address", "formatted_phone_number", "website", "rating"]
        };

        const service = new google.maps.places.PlacesService(map);
        service.getDetails(request, (placeDetails, status) => {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                infoWindow.setContent(`
                    <div>
                        <strong>${placeDetails.name}</strong><br>
                        ${placeDetails.formatted_address}<br>
                        ${placeDetails.formatted_phone_number || ""}<br>
                        ${placeDetails.website ? `<a href="${placeDetails.website}" target="_blank">Website</a><br>` : ""}
                        ${placeDetails.rating ? `Rating: ${placeDetails.rating}/5` : ""}
                    </div>
                `);
                infoWindow.open(map, marker);
            }
        });
    });
}
