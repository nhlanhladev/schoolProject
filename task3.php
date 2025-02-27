<!DOCTYPE html>

<html lang="EN" xml:lang="en">

<head>
    <title>Task 3</title>
</head>

<body>

    <?php include 'menu.inc'; ?>

    <h2>File Upload</h2>
    <form method="POST" enctype="multipart/form-data" action="upload.php">
        <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
        <input type="submit" value="Upload" name="submit"><br><br>

    </form>

    <?php
 ////////////////// Task3 (a) //////////////////////////
  
  // Check if a file was uploaded
    if (isset($_FILES['fileToUpload'])) {
        $file = $_FILES['fileToUpload'];

        // Check if there was no error during the upload
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Read the contents of the uploaded file
            $content = file_get_contents($file['tmp_name']);

            // Display the content
            echo "<pre>" . htmlspecialchars($content) . "</pre><br><br>";
        }
    }

    //  section b
    ////////////////////////////// Task3 (b) //////////////////////////

    echo "<h2>accessing and display files and folders</h2>";

   $folderPath = "/Users/nhlanhlaeric/Desktop/learn"; 
    // Check if the folder exists and is a directory
    if (is_dir($folderPath)) {
        // Open the directory and get the contents
        if ($handle = opendir($folderPath)) {
            echo "<ul>";

            // Loop through the files and folders
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $entryPath = $folderPath . DIRECTORY_SEPARATOR . $entry;
                    if (is_dir($entryPath)) {
                        // Display folder name
                        echo "<ul><li><strong>Folder:</strong> $entry</li></ul><br>";
                    
                    } else {
                        // Display file name
                        echo "<ul><li><strong>File:</strong> $entry<li></ol>";
                    }
                }
            }

            echo "</ul>";

            // Close the directory handle
            closedir($handle);
        } else {
            echo "Error opening the directory.";
        }
    } else {
        echo "The specified folder does not exist or is not a directory.";
    }

?>

</body>

</html>
<iframe title="" src="task3.txt" height="400" width="1200px">
    <p>Your browser does not support iframe.</p>
</iframe>