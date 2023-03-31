<?php
    require_once('../classes/cart.php');

    if(isset($_GET['product_id'])){
        global $connection;
        $product_id = htmlspecialchars($_GET['product_id']);
        $sql_product = 'SELECT product_name, product_price, product_image_1 FROM products WHERE product_id = ?';
        $stmt = $connection->prepare($sql_product);
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $product_image = $row['product_image_1'];
            $product_quantity = 1;
            $cart = new Cart();
            $cart->addCart($product_id, $product_name, $product_price, $product_quantity, $product_image);
            foreach($_SESSION['cart'] as $cart){
                $total_quantity += $product_quantity;
                
            }
            if($cart){
                header('Location: ../views/user_views/index.php');
                exit();
            } else{
                echo 'failed';
            }
        }
    }

