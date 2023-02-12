<?php include("../inc/header.php") ?>

<?php 
    $db = new Database("localhost", "techstore", "root", "");

    $products = $db->getProducts();

    $orders = $db->getOrders();

    if(isset($_GET["action"])){
        $action = $_GET["action"];

        switch($action){
            case "products":
                echo "
                    <div class='add-product-section'>
                        <a href='?action=add-product' name='add-product' class='add-product'>Add Product</a>
                    </div>
                ";
                echo "
                    <table class='dashboard-table'>
                    <thead>
                        <tr>
                            <th scope='row'>ID</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                if(!isset($_GET['add-product'])){
                    foreach($products as $index => $product){
                        $id = ($index + 1);
                        echo "<tr>";
                        echo "<td>" . $id . "</td>";
                        echo "<td>" . $product["product_name"] . "</td>";
                        echo "<td>" . $product["description"] . "</td>";
                        echo "<td> <img src='../images/$product[product_img]' class='table-img' /> </td>";
                        echo "<td>" . $product["price"] . "$</td>";
                        echo "<td> 
                            <a href='?action=delete-product&id=$product[product_id]'>Delete</a> 
                            <a href='?action=edit-product&id=$product[product_id]'>Edit</a> 
                        </td>";
                        echo "</tr>";
                    }
                    echo "
                        </tbody>
                    </table>";
                }
            break;

            case "orders":
                echo "
                    <table class='dashboard-table'>
                    <thead>
                        <tr>
                            <th scope='row'>ID</th>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Product</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                if(!isset($_GET['add-product'])){
                    foreach($orders as $index => $order){
                        $user = $db->getUserById($order["user_id"]);
                        $product = $db->getProductById($order["product_id"]);
                        $id = ($index + 1);
                        $product_img = strval($product[0]['product_img']);
                        echo "<tr>";
                        echo "<td>" . $id . "</td>";
                        echo "<td>" . $order["id"] . "</td>";
                        echo "<td>" . $order["user_id"] . "</td>";
                        echo "<td>" . $user["full_name"] . "</td>";
                        echo "<td>" . $user["email"] . "</td>";
                        echo "<td> 
                                <img src='../images/$product_img' class='table-img'/> 
                            </td>";
                        echo "<td> 
                            <a href='?action=delete-order&id=$order[id]'>Delete</a> 
                        </td>";
                        echo "</tr>";
                    }
                    echo "
                        </tbody>
                    </table>";
                }

            break;

            case "delete-order":
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                    $db->deleteOrder($id);
                }
            break;

            case "add-product":
                echo "
                    <div class='add-product-form'>
                        <form enctype='multipart/form-data' method='POST'>
                           <input type='text' name='product-name' placeholder='Product Name'>
                           <input type='text' name='description' placeholder='Product Description'>
                           <input type='text' name='product-price' placeholder='Price'>
                           <input type='file' name='image'>
                           <button type='submit' name='add'>Add</button>
                        </form>
                    </div>
                ";

                if(isset($_POST["add"])){
                    if(isset($_POST["product-name"]) && !empty($_POST["product-name"])
                    && isset($_POST["description"]) && !empty($_POST["description"])
                    && isset($_POST["product-price"]) && !empty($_POST["product-price"])){
                        
                        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "webp" => "image/webp");
                            $filename = $_FILES["image"]["name"];
                            $filetype = $_FILES["image"]["type"];
                            $filesize = $_FILES["image"]["size"];

                            echo $filename;
                          
                            // Verify file extension
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                            if (!array_key_exists($ext, $allowed)) {
                              die("Error: Please select a valid file format.");
                            }
                          
                            // Verify file size - 5MB maximum
                            $maxsize = 5 * 1024 * 1024;
                            if ($filesize > $maxsize) {
                              die("Error: File size is larger than the allowed limit.");
                            }
                          
                            // Verify MYME type of the file
                            if (in_array($filetype, $allowed)) {
                              // Check whether file exists before uploading it
                              if (file_exists("../images/" . $_FILES["image"]["name"])) {
                                echo $_FILES["image"]["name"] . " is already exists.";
                              } else {
                                move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $_FILES["image"]["name"]);
                                echo "Your file was uploaded successfully.";
                              }
                            } else {
                              echo "Error: There was a problem uploading your file. Please try again.";
                            }
                          } else {
                            echo "Error: " . $_FILES["image"]["error"];
                          }

                        $productName = $_POST["product-name"];
                        $description = $_POST["description"];
                        $price = $_POST["product-price"];
                        $image = $_FILES['image']['name'];
                        echo $image;

                        // $image = file_get_contents("images/", $filename);
                        // $image_data = addslashes($image);
                        $id = rand(100,999) . strlen($_POST["product-name"]) . strlen($_POST["description"]);

                        $db->addProduct($id, $productName, $description, $price, $filename);
                    }
                }
            break;

            case "delete-product":
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                    $db->deleteProductById($id);
                }
            break;

            case "edit-product":
                if(isset($_GET["id"])){
                    $id = $_GET["id"];

                    foreach($db->getProductById($id) as $product){
                        echo "
                            <div class='add-product-form'>
                                <form enctype='multipart/form-data' method='POST'>
                                   <input type='text' name='product-name' value='$product[product_name]'>
                                   <input type='text' name='description' value='$product[description]'>
                                   <input type='text' name='product-price' value='$product[price]'>
                                   <input type='file' name='image'>
                                   <br>
                                   <br>
                                   <br>
                                   <br>
                                   <img src='../images/$product[product_img]' class='edit-img'>
                                   <button type='submit' name='edit'>Update</button>
                                </form>
                            </div>
                        ";
                    }

                    if(isset($_POST["product-name"]) && !empty($_POST["product-name"])
                    && isset($_POST["description"]) && !empty($_POST["description"])
                    && isset($_POST["product-price"]) && !empty($_POST["product-price"])){
                    
                        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "webp" => "image/webp");
                            $filename = $_FILES["image"]["name"];
                            $filetype = $_FILES["image"]["type"];
                            $filesize = $_FILES["image"]["size"];

                            echo $filename;
                          
                            // Verify file extension
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                            if (!array_key_exists($ext, $allowed)) {
                              die("Error: Please select a valid file format.");
                            }
                          
                            // Verify file size - 5MB maximum
                            $maxsize = 5 * 1024 * 1024;
                            if ($filesize > $maxsize) {
                              die("Error: File size is larger than the allowed limit.");
                            }
                          
                            // Verify MYME type of the file
                            if (in_array($filetype, $allowed)) {
                              // Check whether file exists before uploading it
                              if (file_exists("../images/" . $_FILES["image"]["name"])) {
                                echo $_FILES["image"]["name"] . " is already exists.";
                              } else {
                                move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $_FILES["image"]["name"]);
                                echo "Your file was uploaded successfully.";
                              }
                            } else {
                              echo "Error: There was a problem uploading your file. Please try again.";
                            }
                          } else {
                            echo "Error: " . $_FILES["image"]["error"];
                          }  
                          
                            $productName = $_POST["product-name"];
                            $description = $_POST["description"];
                            $price = $_POST["product-price"];
                            $image = $_FILES['image']['name'];

                        $db->editProductById($id, $productName, $description, $price, $image);
                    }
                }
            break;

        }
    }
?>