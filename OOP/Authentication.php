<?php include "./database/dbConnection.php"; ?>
<?php include "./inc/header.php"; ?>
<?php 

    class Authentication {

        private $name;
        private $email;
        private $password;
        private $errors = [];

        function __construct($name,$email, $password) {
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }

        public function isEmail($email){
            $pattern = "^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$^";
            $check = preg_match($pattern, $email);

            if($check){
                return true;
            }else{
                return false;
            }
        }

        public function exists($email){
            global $pdo;
            $users = [];

            $sql = "SELECT * FROM `users`";
            $statement = $pdo->query($sql);
    
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $users[] = $row;
            }

            if(!in_array($email, $users)){
                return false;
            }
            return true;
        }

        public function addUser($id, $name, $email, $hashed_password) {
            global $pdo;
            $sql = "INSERT INTO `users` (`id`, `full_name`, `email`, `password`) VALUES (?, ?, ?, ?)"; 
            $statement = $pdo->prepare($sql);
            
            $statement->execute([$id, $name, $email, $hashed_password]);
        }

        public function signUp($id, $name, $email, $password, $confirmPassword) {
            if(strlen($name) > 3 && $name != ""){
                if($this->isEmail($email)){
                    if(!$this->exists($email)){
                        if(strlen($password) > 4){
                            if($password == $confirmPassword){
                
                                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                                $this->addUser($id, $name, $email, $hashed_password);
                            
                            }else{
                                $errors[] = "Passwords does not match";
                            }
                        }else{
                            $errors[] = "Password must be longer";
                        }
                    }else{
                        $errors[] = "A user with this email address already exists";
                    }
                }else{
                    $errors[] = "Invalid Email";
                }
            }else{
                $errors[] = "Name must be longer than 3 characters and shouldn't me empty";
            }
        }

        public function getUser($email) {
            global $pdo;
            $sql = "SELECT * FROM `users` WHERE `email` = ?";
            $statement = $pdo->prepare($sql);
            $statement->execute([$email]);

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function getUserById($id){
            global $pdo;
            $sql = "SELECT * FROM `users` WHERE `id` = ?";
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function login($email, $password) {
            $user = $this->getUser($email);
            $hashedPassword = $user["password"];

            if($user != null){
                if(password_verify($password, $hashedPassword)){
                    $_SESSION["logged_in"] = true;
                    $_SESSION["user_id"] = $user["id"];
                    $_SESSION["user_name"] = $user["full_name"];
                    $_SESSION["is_admin"] = $user["is_admin"];
                    header("Location: index.php");
                }else{
                    $errors[] = "Password is incorrect";
                }
            }else{
                $errors[] = "User doesn't exist";
            }
        } 
    }
?>