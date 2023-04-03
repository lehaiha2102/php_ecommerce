<?php
require_once('../../config/database.php');
class Category{
    private $category_id;
    private $category_name;

    public function __construct($category_id = null, $category_name = null){
        $this->category_id = $category_id;
        $this->category_name = $category_name;
    }

    public function getCategoryId(){
        return $this->category_id;
    }

    public function getCategoryName(){
        return $this->category_name;
    }

    public function setCategoryId($category_id){
        $this->category_id = $category_id;
    }

    public function setCategoryName($category_name){
        $this->category_name = $category_name;
    }

    public function getCategories(){
        global $connection;
        $sql = "SELECT * FROM categories";
        $result = $connection->query($sql);

        $categories = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
    }
    
    public function addCategory($category_name, $category_slug){
        global $connection;
        $sql_categorry = 'INSERT INTO categories(category_name, category_slug) VALUES(?, ?)';
        $stmt_category = $connection->prepare($sql_categorry);
        $stmt_category->bind_param('ss', $category_name, $category_slug);
        if($stmt_category->execute()){
            return 'add category success';
        } else{
            return 'add category failed';
        }
    }

    public function deleteCategory($category_slug){
        global $connection;
        $sql_delete_category = 'DELETE FROM categories WHERE category_slug = ?';
        $stmt_delete_category = $connection->prepare($sql_delete_category);
        $stmt_delete_category->bind_param('s', $category_slug);
        if($stmt_delete_category->execute()){
            return 'Delete category success';
        } else{
            return 'Delete category failed';
        }
    }

    public function updateCategory($category_slug, $category_name){
        global $connection;
        $sql_update_category = 'UPDATE categories SET category_name = ? WHERE category_slug = ?';
        $stmt_update_category = $connection->prepare($sql_update_category);
        $stmt_update_category->bind_param('ss', $category_name, $category_slug);
        if($stmt_update_category->execute()){
            return 'Upload success';
        } else{
            return 'Upload failed';
        }
    }
}