    <?php include("../controller/loginController.php") ?>
    
    <section class="login">
        <div class="login-content">
            <form action="" class="form" method="POST">
                <div class="login-header">
                    <img src="../images/logo.png" alt="">
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
                    <p><a href="signup.php" class="create-account">Create An Account</a></p>
                </div>
                
            </form>
        </div>
    </section>

    <script src="../assets/js/main.js"></script>
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