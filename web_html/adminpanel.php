<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hacker Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="panel.css">
</head>

<body>
    <div class="panel">
        <div class="main">
            <div class="top-bar">
                <h1>Admin Panel &nbsp;</h1>
                <form action="logout.php">
                    <button>logout</button>
                </form>
            </div>
            <div class="input-container">
                <span>$</span>
                <input type="text" id="username-input" placeholder="Enter username">
                <button class="enter-button" onclick="fetchUserInfo();changeBorderColour();">Enter</button>
            </div>
            <div class="terminal">
                <div id="user-details" class="user-details"></div>
            </div>
        </div>
    </div>






    <script>
        function fetchUserInfo() {
            var username = document.getElementById('username-input').value;

            // Create an AJAX request to fetch user information
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "coordinates.txt", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var coordinates = xhr.responseText;

                    var userDetails = document.getElementById('user-details');
                    userDetails.innerHTML = '';

                    var lines = coordinates.split('------------------------------');
                    for (var i = 0; i < lines.length; i++) {
                        var line = lines[i].trim();
                        if (line.includes("Username: " + username)) {
                            var ipLine = line.match(/IP Address: (.+)/);
                            var mapsUrlLine = line.match(/Google Maps URL: (.+)/);
                            var timestampLine = line.match(/Timestamp: (.+)/);
                            var userAgentLine = line.match(/User Agent: (.+)/);
                            var platformLine = line.match(/Platform: (.+)/);

                            if (ipLine && mapsUrlLine && timestampLine && userAgentLine && platformLine) {
                                var ipAddress = ipLine[1].trim();
                                var googleMapsUrl = mapsUrlLine[1].trim();
                                var timestamp = timestampLine[1].trim();
                                var userAgent = userAgentLine[1].trim();
                                var platform = platformLine[1].trim();
                                // userDetails.innerHTML+="<div class='userssss'>";


                                // var userBox=document.createElement('div');
                                // userBox.className="user-box";
                                // userBox.innerHTML+="<p>Username: <span>" + username + "</span></p>";
                                // userDetails.appendChild(userBox);
                                // userDetails.innerHTML += "<p>Username: <span>" + username + "</span></p>";
                                // userDetails.innerHTML += "<p>IP Address: <span>" + ipAddress + "</span></p>";
                                // userDetails.innerHTML += "<p>Timestamp: <span>" + timestamp + "</span></p>";
                                // userDetails.innerHTML += "<p>Google Maps URL: <a href='" + googleMapsUrl + "' target='_blank'>" + googleMapsUrl + "</a></p>";
                                // userDetails.innerHTML += "<p>User Agent: <span>" + userAgent + "</span></p>";
                                // userDetails.innerHTML += "<p>Platform: <span>" + platform + "</span></p>";
                                // userDetails.innerHTML += "<hr>";


                                var userBox=document.createElement('div');
                                userBox.className="user-box";
                               // userBox.innerHTML+="<p>Username: <span>" + username + "</span></p>";
                                userBox.innerHTML += "<p>Username: <span>" + username + "</span></p>";
                                userBox.innerHTML += "<p>IP Address: <span>" + ipAddress + "</span></p>";
                                userBox.innerHTML += "<p>Timestamp: <span>" + timestamp + "</span></p>";
                                userBox.innerHTML += "<p>Google Maps URL: <a href='" + googleMapsUrl + "' target='_blank'>" + googleMapsUrl + "</a></p>";
                                userBox.innerHTML += "<p>User Agent: <span>" + userAgent + "</span></p>";
                                userBox.innerHTML += "<p>Platform: <span>" + platform + "</span></p>";
                                userBox.innerHTML += "<hr>";
                                userDetails.appendChild(userBox);



                                // userDetails.appendChild(var);
                            }
                        }
                    }

                    if (userDetails.innerHTML === '') {
                        userDetails.innerHTML = "<p>No user found with the username '" + username + "'</p>";
                    }
                }
            };
            xhr.send();
        }
        function changeBorderColour() {
            var box = document.querySelector(".terminal");
            box.style.border="2px solid #0f0";
            box.style.borderStyle="none solid solid solid";
            box.style.marginRight="40px";
            box.style.marginBottom="50px";
            box.style.marginLeft="40px";
            
        }

    </script>
</body>

</html>