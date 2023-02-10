<?php include("OOP/Authentication.php"); ?>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
</head>
<body>
    <section class="login">
        <div class="login-content">
            <form action="" class="form" method="POST">
                <div class="login-header">
                    <img src="images/logo.png" alt="">
                </div>

                <div class="fields">
                    <div class="inputField">
                        <span>E-mail</span>
                        <input type="text" name="email" class="email">
                        <i class="fa fa-envelope"></i>
                    </div>

                    <div class="inputField">
                        <span>Password</span>
                        <input type="password" name="password" class="password">
                        <i class="fa fa-lock"></i>
                    </div>
    
                    <button type="submit" name="login-btn" class="login">Log in</button>
                    <p>Forget your password?</p>
                    <p><a href="signup.html" class="create-account">Create An Account</a></p>
                </div>
                
            </form>
        </div>
    </section>

    <script src="assets/js/main.js"></script>
    <script>
        const emailField = document.querySelector(".email");
        const passwordField = document.querySelector(".password");
        const loginBtn = document.querySelector(".login");
        const form = document.querySelector(".form");            

        form.addEventListener("submit", () => {
            validateForm([emailField, passwordField]);
        })
    </script>
    
</body>
</html>