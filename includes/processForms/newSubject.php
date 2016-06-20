<?php
/**
 * Created by PhpStorm.
 * User: Elise
 * Date: 18/06/16
 * Time: 13:11
 */

if(isset($_POST['newSubjectBtn'])){

    $errors = array();

    if(isset($_POST['name']) && $_POST['name'] != ""){
        $name = $_POST['name'];
    }else{
        $errors[] = "- Namn";
    }


    if(empty($errors)){

        if($controller->addSubject($name)){
            $controller->redirect("index.php");
        }
    }

}