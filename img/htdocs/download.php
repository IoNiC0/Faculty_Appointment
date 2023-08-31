<?php
function downloadFile($url, $destination) {
    $fileContent = file_get_contents($url);

    if ($fileContent !== false) {
        $result = file_put_contents($destination, $fileContent);

        if ($result !== false) {
            return true; 
        } else {
            return false; 
        }
    } else {
        return false; 
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $downloadUrl = $_POST['download_link'];
    
    $destinationPath = 'Downloads'; // Replace this with the path where you want to save the downloaded file
    // $destinationPath = getenv('USERPROFILE') . DIRECTORY_SEPARATOR . 'Downloads';

    $downloadResult = downloadFile($downloadUrl, $destinationPath);

    if ($downloadResult) {
        echo '<script>';
        echo 'alert("File downloaded successfully");';
        echo 'window.location="index.php";';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Failed to download");';
        echo 'window.location="index.php";';
        echo '</script>';
    }
}
?>