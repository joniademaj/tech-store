<?php include("../model/Authentication.php"); ?>
<?php 
    if(isset($_POST["login-btn"])){

        if(isset($_POST["email"]) && !empty($_POST["email"]) 
        && isset($_POST["password"]) && !empty($_POST["password"])){

            $name = "j";
            $email = $_POST["email"];
            $password = $_POST["password"];
    
            $auth = new Authentication($name, $email, $password);
            $auth->login($email, $password);
        
        }
    }

?>