<?php
session_start();

if (isset($_SESSION['errors'])){
    foreach($_SESSION['errors'] as $error){
        echo "$error <br>";
    }
}
unset($_SESSION['errors']);


?>

<form action="handle-upload-json.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="Uploaded-file" >
    <br>
    <input type="submit" value="submit" name="submit">
</form>