<?php include_once("App/Controller.php") ?>
<?php include_once("includes/layout/header.php")            // HTML header ?>
<?php $controller = new Controller(); ?>

<?php include_once("includes/layout/nav.php")               // Navigation  ?>
<?php


// Process login
if(isset($_POST['loginBtn'])){
    $errors = array();
    if(isset($_POST['username']) && $_POST['username'] !=""){
        $username = $_POST['username'];
    }else{
        $errors[] = "Username";
    }
    if(isset($_POST['password']) && $_POST['password'] !=""){
        $password = $_POST['password'];
    }else{
        $errors[] = "Password";
    }
    if(count($errors) == 0){
        echo "No errors";

        if($controller->login($username,$password)){
            $message = "You are now logged in";
            $_SESSION['user'] = "Loged in";
        }else{
            echo "Could not find user";
        }

    }else{
        echo "Pleace check following: " . "<BR/>";
        foreach($errors as $error){
            echo $error . "<BR/>";
        }
    }
}

?>
<div class="container">
    <div class="starter-template">
        <?php
        if(isset($message)){
            echo "<h2>$message</h2>";
        }
        ?>
        <h1>Login</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Login" name="loginBtn">
        </form>

    </div>
</div><!-- /.container -->
<?php include_once("includes/layout/footer.php")            // HTML Footer ?>
