<?php include_once "includes/auth.php"; ?>
<?php
    include_once "App/Controller.php"; // Include Controller
    include_once "App/Upload.php"; // Include upload
    include_once "App/Graph.php";
    $controller = new Controller();
?>

<?php include_once "includes/processForms/newProduct.php"; ?>

<?php include_once "includes/layout/header.php"; // Include header ?>
    <?php include_once "includes/layout/nav.php"; // Include navigation ?>

    <?php

        // Get Subject id and page id
        $page_id;
        $subject_id;

        // Get subject id
        if(isset($_GET['subject_id']) && is_numeric($_GET['subject_id'])){
            $subject_id = $_GET['subject_id'];
        }

        // Get page id
        if(isset($_GET['page']) && is_numeric($_GET['page'])){
            $page_id = $_GET['page'];
            // Get page information
            $page = $controller->getItem($page_id);
        }else{
            $controller->redirect("index.php");
        }
    ?>

    <h3>
        <?php
            echo $page['itemName'];
            if(isset($_SESSION['user'])){
                echo "<a href=\"remove.php?subject_id={$id}&page={$page_id}&remove=page\"> <span class=\"glyphicon glyphicon-trash\"></span></a></li>";
            }
        ?>
    </h3>

    <div class="well">
        <?php
            echo nl2br($page['info']);

        ?>
    </div>

    <?php
    if(isset($_SESSION['user'])) {
        echo "    <a class=\"btn btn-primary\" role=\"button\" data-toggle=\"collapse\" href=\"#collapseExample\" aria-expanded=\"false\" aria-controls=\"collapseExample\">
        <span class=\"glyphicon glyphicon-plus\"></span> Mätning
    </a>";
    }
    ?>


    <br/>
    <br/>

    <div class="collapse" id="collapseExample">
        <div class="well">
            <?php include_once "includes/forms/newProduct.php"; ?>
        </div>
    </div>

    <?php
        $products = $controller->getPageProducts($page_id);

        for ($i = 0; $i < count($products); $i++){
            echo "<div class='well'>";
                echo "<h4>";
                    // Link to txt file
                    echo "<a href='{$products[$i][3]}'>{$products[$i][1]}</a>";
                    // Remove product and file
                    if(isset($_SESSION['user'])) {
                        echo "<a href='remove.php?subject_id={$subject_id}&page={$page_id}&product_id={$products[$i][0]}&remove=product'> <span class='glyphicon glyphicon-trash'></span> </a>";
                    }
                echo "</h4>";
                echo nl2br($products[$i][2]) . "<BR/>";

                $graph[$i] = new Graph($products[$i][1],trim($products[$i][2]),"Mätningar","Totalfördröjning",$controller);
                $graph[$i]->getSeries($products[$i][0]);
                $graph[$i]->createGraph($products[$i][0],$products[$i][0]);
            echo "</div>";

            if($i == count($products) - 1){
                // Last one show all graph in one

            }
        }

    ?>

<?php include_once "includes/layout/footer.php"; // Include footer ?>












