<?php include("../model/Authentication.php"); ?>
<?php 
    if(isset($_POST["signup-btn"])){
        
        if(isset($_POST["name"]) && !empty($_POST["name"])
        && isset($_POST["email"]) && !empty($_POST["email"])
        && isset($_POST["password"]) && !empty($_POST["password"])
        && isset($_POST["confirm-password"]) && !empty($_POST["confirm-password"])){

            $id = rand(100,999) . strlen($_POST["name"]) . strlen($_POST["email"]);
            $name = $_POST["name"];   
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm-password"];
    
            $auth = new Authentication($name, $email, $password);
            $auth->signUp($id, $name, $email, $password, $confirmPassword);
        
        }
    }
?>