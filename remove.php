<?php include_once "includes/auth.php"; ?>


<?php

include_once "App/Controller.php"; // Include Controller
$controller = new Controller();




if(isset($_GET['subject_id']) && is_numeric($_GET['subject_id'])){
    $subject_id = $_GET['subject_id'];
}

if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $page_id    = $_GET['page'];
}

if(isset($_GET['product_id']) && is_numeric($_GET['product_id'])){
    $product_id    = $_GET['product_id'];
}

// Check what to remove
if(isset($_GET['remove'])){
    $remove = $_GET['remove'];

    switch ($remove){
        case "subject":
            // Remove subject
            $controller->delete($subject_id,"subjects");
            $controller->redirect("index.php");
        case "page":
            // Remove page
            $controller->delete($page_id,"items");
            $products = $controller->getPageProducts($page_id);
            // Remove all products for that page
            foreach ($products as $product){
                $controller->delete($product[0],"products");
                unlink($product[0]);

                // Remove all measurement for each product
                $measurements = $controller->getProductMeasurements($product[0]);
                foreach ($measurements as $measurement){
                    $controller->delete($measurement[0],"measurements");
                }
            }

            $controller->redirect("index.php?subject_id={$subject_id}");
        case "product":
            // Remove product
            $controller->delete($product_id,"products");
            // Remove all connected measurements
            $measurements = $controller->getProductMeasurements($product_id);
            foreach ($measurements as $measurement){
                $controller->delete($measurement[0],"measurements");
            }
            $controller->redirect("page.php?subject_id={$subject_id}&page={$page_id}");
    }
}




