<?php
if (isset($_POST['timestamp'])) {
    $timestamp = $_POST['timestamp'];
    $new_username = $_POST['name'];

    // Get the public IP address of the user
    $ipAddress = file_get_contents('https://api.ipify.org');

    // Get the device information
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $platform = $_SERVER['HTTP_USER_AGENT'];

    // Read the last assigned username from the coordinates file
    $file = fopen("coordinates.txt", "r");
 /*   $lastUsername = '';
    if ($file) {
        while (($line = fgets($file)) !== false) {
            if (strpos($line, 'Username: User') === 0) {
                $lastUsername = trim(substr($line, strlen('Username: ')));
            }
        }
        fclose($file);
    }

    // Generate the next username
    $username = 'User1';
    if ($lastUsername !== '') {
        $lastNumber = intval(substr($lastUsername, strlen('User')));
        $username = 'User' . ($lastNumber + 1);
    }
*/
    // Create the Google Maps URL
    $mapsUrl = "https://www.google.com/maps/search/?api=1&query=$_POST[latitude],$_POST[longitude]";

    // Format the data to be written in the coordinates file

    $data = "Username: $new_username\n";
    $data .= "IP Address: $ipAddress\n";
    $data .= "Google Maps URL: $mapsUrl\n";
    $data .= "Timestamp: $timestamp\n";
    $data .= "User Agent: $userAgent\n";
    $data .= "Platform: $platform\n";
    $data .= str_repeat("-", 30) . "\n";

    // Append the data to the coordinates file
    file_put_contents("coordinates.txt", $data, FILE_APPEND);

    echo "Coordinates saved successfully.";
} else {
    echo "Error: Missing coordinates data.";
}
?>
