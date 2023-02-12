<?php include("../controller/registerController.php"); ?>

    <section class="signup">
        <div class="signup-content">
            <form action="" class="form" method="POST">
                <div class="signup-header">
                    <img src="../images/logo.png" alt="">
                </div>

                <div class="fields">
                    <div class="inputField">
                        <span>Name</span>
                        <input type="text" name="name" class="name">
                        <i class="fa fa-user"></i>
                    </div>

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

                    <div class="inputField">
                        <span>Confirm Password</span>
                        <input type="password" name="confirm-password" class="confirm-password">
                        <i class="fa fa-lock"></i>
                    </div>
    
                    <button type="submit" name="signup-btn" class="signup-btn">Register</button>
                    <p><a href="login.php" class="have-account">Already Have An Account</a></p>
                </div>
                
            </form>
        </div>
    </section>

    <script src="assets/js/main.js"></script>
    <script>
        const nameField = document.querySelector(".name");
        const emailField = document.querySelector(".email");
        const passwordField = document.querySelector(".password");
        const confirmPasswordField = document.querySelector(".confirm-password");
        const signUpBtn = document.querySelector(".signup-btn");
        const form = document.querySelector(".form");            

        form.addEventListener("submit", () => {
            validateForm([nameField, emailField, passwordField, confirmPasswordField]);
        })
    </script>
</body>
</html>