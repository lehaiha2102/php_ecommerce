<?php
require_once('../../config/database.php');
class Product{
    private $product_id;
    private $product_name;
    private $product_price;
    private $product_quantity;
    private $product_import_price;
    private $product_promotion_price;
    private $product_image_1;
    private $product_image_2;
    private $product_image_3;
    private $product_description;
    private $category_id;

    public function __construct($product_id = null, $product_name = null, $product_price = null, $product_import_price = null, $product_promotion_price = null, $product_image_1 = null, $product_image_2 = null, $product_image_3 = null, $product_quantity = null, $product_description = null, $category_id = null){
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->product_price = $product_price;
        $this->product_import_price = $product_import_price;
        $this->product_promotion_price = $product_promotion_price;
        $this->product_image_1 = $product_image_1;
        $this->product_image_2 = $product_image_2;
        $this->product_image_3 = $product_image_3;
        $this->product_price = $product_price;
        $this->product_quantity = $product_quantity;
        $this->product_description = $product_description;
        $this->category_id = $category_id;
    }

    public function getproductId(){
        return $this->product_id;
    }

    public function getProductName(){
        return $this->product_name;
    }

    public function getProductPrice(){
        return $this->product_price;
    }
    public function getProductImportPrice(){
        return $this->product_import_price;
    }
    public function getProductPromotionPrice(){
        return $this->product_promotion_price;
    }
    public function getProductImage1(){
        return $this->product_image_1;
    }
    public function getProductImage2(){
        return $this->product_image_2;
    }
    public function getProductImage3(){
        return $this->product_image_3;
    }
    public function getProductQuantity(){
        return $this->product_quantity;
    }
    public function getProductDescription(){
        return $this->product_description;
    }
    public function getCategoryId(){
        return $this->category_id;
    }

    public function setProductId($product_id){
        $this->product_id = $product_id;
    }

    public function setProductName($product_name){
        $this->product_name = $product_name;
    }

    public function setProductPrice($product_price){
        $this->product_price = $product_price;
    }
    public function setProductImportPrice($product_import_price){
        $this->product_import_price = $product_import_price;
    }
    public function setProductPromotionPrice($product_promotion_price){
        $this->product_promotion_price = $product_promotion_price;
    }
    public function setProductQuantity($product_quantity){
        $this->product_quantity = $product_quantity;
    }
    public function setProductImage1($product_image_1){
        $this->product_image_1 = $product_image_1;
    }
    public function setProductImage2($product_image_2){
        $this->product_image_2 = $product_image_2;
    }
    public function setProductImage3($product_image_3){
        $this->product_image_3 = $product_image_3;
    }
    public function setProductDescription($product_description){
        $this->product_description = $product_description;
    }
    public function setCategoryId($category_id){
        $this->category_id = $category_id;
    }
    
    public function addProduct($product_name, $product_import_price, $product_price, $product_promotion_price, $product_quantity, $product_image_1, $product_image_2, $product_image_3, $product_description, $category_id){
        global $connection;
        $sql_product = 'INSERT INTO products(product_name, product_import_price, product_price, product_promotion_price, product_quantity, product_image_1, product_image_2, product_image_3, product_description, category_id) VALUES(?,?,?,?,?,?,?,?,?,?)';
        $stmt_product = $connection->prepare($sql_product);
        $stmt_product->bind_param('siiiissssi', $product_name, $product_import_price, $product_price, $product_promotion_price, $product_quantity, $product_image_1, $product_image_2, $product_image_3, $product_description, $category_id);
        if($stmt_product->execute()){
            return 'add product success';
        } else{
            return 'add product failed';
        }
    }

    public function deleteProduct($product_id){
        global $connection;
        $sql_delete_product = 'DELETE FROM products WHERE product_id = ?';
        $stmt_delete_product = $connection->prepare($sql_delete_product);
        $stmt_delete_product->bind_param('i', $product_id);
        if($stmt_delete_product->execute()){
            return 'Delete product success';
        } else{
            return 'Delete product failed';
        }
    }

    public function updateProduct($product_id, $product_name, $product_import_price, $product_price, $product_promotion_price, $product_quantity, $product_image_1, $product_image_2, $product_image_3, $product_description, $category_id){
        global $connection;
        $sql_update_product = 'UPDATE products SET product_name = ?, product_import_price = ?, product_price = ?, product_promotion_price = ?, product_quantity = ?, product_image_1 = ?, product_image_2 = ?, product_image_3 = ?, product_description = ?, category_id = ? WHERE product_id = ?';
        $stmt_update_product = $connection->prepare($sql_update_product);
        $stmt_update_product->bind_param('siiiissssii', $product_name, $product_import_price, $product_price, $product_promotion_price, $product_quantity, $product_image_1, $product_image_2, $product_image_3, $product_description, $category_id, $product_id);
        if($stmt_update_product->execute()){
            return 'Upload success';
        } else{
            return 'Upload failed';
        }
    }
}