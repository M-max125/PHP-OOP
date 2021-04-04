<?php

include_once('autoloader.inc.php');
Session::init();

$cuser = new Auth();
$cemail =  $_SESSION['user'];
$data = $cuser->currentUser($cemail);
$cid = $data['id'];



if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){

    $title = $cuser->test_input($_POST['title']);
    $instruction = $cuser->test_input($_POST['instruction']);
    $ing = $cuser->test_input($_POST['ing']);
    

    if(empty($title) || empty($instruction) || empty($ing)){
        echo $cuser->alert('red','Please fill all the fields.');
    }else{
        if(isset($_FILES['file'])){
            $file = $_FILES['file'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];
            

            $fileExt = explode('.',$fileName);
            $fileActualExtension = strtolower(end($fileExt));

            $allowed = ['jpg','jpeg','png'];

            if(in_array($fileActualExtension,$allowed)){
                if($fileError === 0){
                    $fileNameNew = uniqid('',true).".".$fileActualExtension;
                    $fileDestination = 'uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);

                    $cuser->addRecipe($cid,$title,$instruction,$ing,$fileNameNew);
                    echo 'add';
                }else{
                    echo $cuser->alert('red','There was an error while uploading your file.'); 
                }
            }else{
                echo $cuser->alert('red','Files of jpg,jpeg or png extension required');
            }

        }else{
            echo $cuser->alert('red','Please choose file.');
        }
    }
   
}

?>
