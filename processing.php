<?php

if (isset($_FILES['files'])) {
    $paths = $_FILES['files']['tmp_name'];
    $names = $_FILES['files']['name'];
    $fileName = $_POST['file-name'];
    $fileExt = $_POST['extention'];
    
    try {
        $listing = new Listing($names, $paths, $fileName, $fileExt);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    
    $listing->processing();
    $listing->downloadFile();
}
