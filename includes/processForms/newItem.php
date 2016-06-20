<?php
/**
 * Created by PhpStorm.
 * User: Elise
 * Date: 18/06/16
 * Time: 13:11
 */


$subject_id;

if(!isset($_GET['subject_id']) || !is_numeric($_GET['subject_id'])){
    $controller->redirect("index.php");
}else{
    $subject_id = $_GET['subject_id'];
}

if(isset($_POST['newItemBtn'])){

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


    if(empty($errors)){

        $controller->addItem($subject_id, $name, $info);
        $page = $controller->insertId();
        $controller->redirect("page.php?subject_id={$subject_id}&page={$page}");

    }else{
        // Show errors

        echo "<div class='well-sm alert-danger'>";
        echo "<h3> Vänligen åtgärda följande fel </h3>";
            echo "<ul class=''>";
                foreach ($errors as $error){

                        echo "<li>" . $error . "</li>";
                }
            echo "</ul>";
        echo "</div>";

    }

}