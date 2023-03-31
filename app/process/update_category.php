<?php 
    require_once('../../app/classes/category.php');

     if(isset($_POST['category_id']) && isset($_POST['category_name'])){
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $category = new Category();
        $result = $category->updateCategory( $category_id, $category_name );
        echo $result;
        if($result == 'Upload success'){
            header('Location: ../views/admin/category.php');
            exit;
        }
    }
?>