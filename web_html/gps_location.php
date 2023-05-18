<!DOCTYPE html>
<html>
<head>
    <title>GPS Location Permission</title>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var timestamp = new Date().toLocaleString();
            
            // Create an AJAX request to save the coordinates, IP address, and timestamp to a file
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "save_coordinates.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send("latitude=" + latitude + "&longitude=" + longitude + "&timestamp=" + encodeURIComponent(timestamp));
        }
        
        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>
    <style>
        body {
            background-color: #000;
            color: #0F0;
            text-align: center;
            font-family: monospace;
        }
        
        h1 {
            font-size: 24px;
        }
        
        button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #111;
            color: #0F0;
            border: none;
            cursor: pointer;
        }
        
        button:hover {
            background-color: #222;
        }
    </style>
</head>
<body>
    <h1>GPS Location Permission</h1>
    <button onclick="getLocation()">Allow GPS Location</button>
</body>
</html>
