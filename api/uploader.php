<?php

require_once 'inc/requestchecker.php';

if (!isAjax()) {
    exit;
}

$directory = __DIR__ . "/../uploads/";

if (!file_exists($directory)) {
    mkdir($directory, 0777, true);
}

$maxUploadSize = $_POST['max-upload-size'];

if ($_FILES['files']['name'][0] != '') {

    $message;

    for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

        $filesize = $_FILES['files']['size'][$i] / 1024 / 1024;

        if (($filesize > 0) && ($filesize <= $maxUploadSize)) {
            $extension = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['files']['tmp_name'][$i], $directory . rand() . "." . $extension);

            $message[] = $_FILES['files']['name'][$i];
        } else {
            http_response_code(403);
            echo "Maximum uploaded file size must be less than or equal {$maxUploadSize}mb.";
        }

    }
} else {
    $error = "Upload field cannot be empty.";
}

if (isset($message)) {
    echo json_encode($message);
}

if (isset($error)) {
    http_response_code(403);
    echo $error;
}
