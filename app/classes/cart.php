<?php
session_start();
require_once('../../config/database.php');
class Cart{
    private $product_id;
    private $product_name;
    private $product_price;
    private $product_quantity;
    private $product_image;
    private $product_total_price = 0;
    private $total_price = 0;

    public function __construct($product_id=null, $product_name=null, $product_price=null, $product_quantity=null, $product_image=null){
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->product_price = $product_price;
        $this->product_quantity = $product_quantity;
        $this->product_image = $product_image;
    }
    public function setProductId($product_id) {
        $this->product_id = $product_id;
    }
    
    public function setProductName($product_name) {
        $this->product_name = $product_name;
    }
    
    public function setProductPrice($product_price) {
        $this->product_price = $product_price;
    }
    
    public function setProductQuantity($product_quantity) {
        $this->product_quantity = $product_quantity;
    }
    

    public function addCart($product_id, $product_name, $product_price, $product_quantity, $product_image) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $product_quantity;
            $_SESSION['cart'][$product_id]['subtotal'] = $_SESSION['cart'][$product_id]['quantity'] * $_SESSION['cart'][$product_id]['price'];
        } else {
            $product = array(
                'id' => $product_id,
                'name' => $product_name,
                'price' => $product_price,
                'quantity' => $product_quantity,
                'image' => $product_image,
                'subtotal' => $product_quantity * $product_price
            );
            $_SESSION['cart'][$product_id] = $product;
        }
        // Calculate total amount for cart
        $total_amount = 0;
        foreach ($_SESSION['cart'] as $product) {
            $total_amount += $product['subtotal'];
        }
        $_SESSION['total_amount'] = $total_amount;
        return true;
    }
    

    public function updateCart($product_id, $quantity){
        foreach ($_SESSION['cart'] as $key => $value){
            if ($value['id'] == $product_id){
                $_SESSION['cart'][$key]['quantity'] = $quantity;
                break;
            }
        }
    }

    public function deleteCart($product_id){
        foreach ($_SESSION['cart'] as $key => $value){
            if ($value['id'] == $product_id){
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        if(empty($_SESSION['cart'])) {
            unset($_SESSION['total_items']);
            unset($_SESSION['total_amount']);
        } else {
            $total_items = 0;
            $total_amount = 0;
            foreach ($_SESSION['cart'] as $item) {
                $total_items += $item['quantity'];
                $total_amount += $item['quantity'] * $item['price'];
            }
            $_SESSION['total_items'] = $total_items;
            $_SESSION['total_amount'] = $total_amount;
        }
    }
    
    

}