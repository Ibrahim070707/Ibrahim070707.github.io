<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/"; // Directory where uploaded files will be stored
        $targetFile = $targetDir . basename($_FILES["file"]["name"]);
        $uploadOk = true;

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "File already exists.";
            $uploadOk = false;
        }

        // Check file size (here, we'll limit it to 5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
        if ($_FILES["file"]["size"] > $maxFileSize) {
            echo "File size is too large. Max file size allowed is 5MB.";
            $uploadOk = false;
        }

        // Limit file types to specific extensions (you can customize this based on your needs)
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = false;
        }

        // If everything is ok, try to upload the file
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded successfully.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Error: " . $_FILES["file"]["error"];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>File Upload</title>
</head>

<body>
    <h1>File Upload Example</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Select a file:</label>
        <input type="file" name="file" id="file">
        <input type="submit" name="submit" value="Upload File">
    </form>
</body>

</html>