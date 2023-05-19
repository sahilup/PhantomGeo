<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folderName = $_POST['folderName'];
    $fileName = $_POST['fileName'];
    $imageData = $_POST['imageData'];

    // Create the folder if it doesn't exist
    if (!is_dir('../'.$folderName)) {
        mkdir('../'.$folderName, 0777, true);
    }

    // Decode the base64 image data and save it to the specified folder
    $decodedImage = base64_decode($imageData);
    file_put_contents('../'.$folderName . '/' . $fileName, $decodedImage);

    // Return a response indicating success or failure
    echo json_encode(['status' => 'success']);
} else {
    // Return an error response for invalid requests
    echo json_encode(['status' => 'error']);
    }
    ?>
