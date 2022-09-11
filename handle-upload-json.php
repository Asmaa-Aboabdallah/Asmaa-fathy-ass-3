<?php

session_start();
if(isset($_POST['submit'])){
    $file = $_FILES['Uploaded-file'];


    // echo "<pre>";
    // print_r($file);
    // echo "</pre>";


    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];  
    $fileError = $file['error'];
    $fileSize = $file['size'];  
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);



    $errors = [];


     // Validation file:
     if(empty($file)){
        $errors = "You must Upload file";
    }
    elseif ($fileError != 0 ){
        $errors[] = "Error While Uploading file";
    }elseif(! in_array($ext, ['json'])){
        $errors[] = "File must be json";
    }elseif($fileSize < 0){
        $errors[] = "File Size must be > 0";
    }



    if(empty($errors)){
        $radomStr = uniqid();
        $fileNewName = "$radomStr.$ext";
        move_uploaded_file($fileTmpName, "uploads/$fileNewName");

        $testFile = fopen("uploads/$fileNewName" , "r"); 
        $testFileSize = $fileSize;
        $testFileData = fread($testFile, $testFileSize ); // Read all the file
        //echo $testFileData;
        fclose($testFile);

        // Get the contents of the JSON file
        $strJsonFileContents = file_get_contents("uploads/$fileNewName");
        // Convert to array 
        $array = json_decode($strJsonFileContents, true);

        // echo "<pre>";
        // print_r($array); // print array
        // echo "<pre>";

        $_SESSION['json-array'] = $array;
        header("location: display.php");

    }else{
        // Store in Session errors arr
        $_SESSION['errors'] = $errors;
        // redirect to add-user
        header("location: upload-json.php");
    }



}




?>