<?php
/**
 * Created by PhpStorm.
 * User: Elise
 * Date: 18/06/16
 * Time: 13:11
 */



$page_id;
$subject_id;

if(!isset($_GET['subject_id']) || !is_numeric($_GET['subject_id'])){
    $controller->redirect("index.php");
}else{
    $subject_id = $_GET['subject_id'];
}


if(!isset($_GET['page']) || !is_numeric($_GET['page'])){
    $controller->redirect("index.php");
}else{
    $page_id = $_GET['page'];
}

if(isset($_POST['newProductBtn'])){

    $errors = array();

    if(isset($_POST['name']) && $_POST['name'] != ""){
        $name = $_POST['name'];
    }else{
        $errors[] = "Titel";
    }

    if(isset($_POST['info']) && $_POST['info'] != ""){
        $info = $_POST['info'];
    }else{
        $errors[] = "Information";
    }

    if(empty($_FILES["fileToUpload"]["name"])){
        $errors[] = "Ingen fil vald";
    }


    if(empty($errors)){
        $upload = new Upload("newProductBtn","uploads/{$page_id}");

        // If the upload was not successful display errors for user
        if(!$upload->upload()){
            foreach($upload->errors() as $error){
                echo "<hr>";
                echo $error . " <BR/>";
            }
        }

        // File link
        $link = "uploads/{$page_id}/" . $upload->getFileName();

        if($controller->addProduct($page_id, $name, $info, $link)){

            // Read file
            $product_id = $controller->insertId();
            $file = fopen($link, "r");
            while(!feof($file)){
                $line = fgets($file);
                # do same stuff with the $line
                $controller->addMeasurement($product_id,$line);

            }
            fclose($file);
            $controller->redirect("page.php?subject_id={$subject_id}&page={$page_id}");
        }
    }else{
        // Show errors

        echo "<div class='well alert-danger'>";
        echo "<h3> Vänligen åtgärda följande fel </h3>";
        echo "<ul class=''>";
        foreach ($errors as $error){

            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        echo "</div>";

    }

}