<?php

if(isset($_FILES['fichier'])){
    $errors= array();
    $file_name = $_FILES['fichier']['name'];
    $file_size =$_FILES['fichier']['size'];
    $file_tmp =$_FILES['fichier']['tmp_name'];
    $file_type=$_FILES['fichier']['type'];
    $tab = explode('.',$_FILES['fichier']['name']);
    $file_ext=strtolower(end($tab));
    $expensions= array("jpeg","jpg","png", "mp3",
        "acc", "wav", "3gpp", "mp4", "3gp", "m4a", "amr", "avi",
        "flv", "gif"); //Peut être des extensions en trop...

    if(in_array($file_ext,$expensions)=== false){
        $errors[]="Extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152666655){
        $errors[]='File size must be excately 2 MB';
    }

    if(empty($errors)==true){
        move_uploaded_file($file_tmp,'.\\'.$file_name);
        echo "Success <img src='$file_name'>";
    } else{
        print_r($errors);
    }
}
?>
