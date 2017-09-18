<?php
if(!empty($_FILES)){
    
    //database configuration
   

    
    $targetDir = "uploads/";
    $fileName = $_FILES['file']['name'];
    $targetFile = $targetDir.$fileName;
    
   move_uploaded_file($_FILES['file']['tmp_name'],$targetFile);

    
}
?>