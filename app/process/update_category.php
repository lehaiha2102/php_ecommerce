<?php 
    require_once('../../app/classes/category.php');

     if(isset($_POST['category_slug']) && isset($_POST['category_name'])){
        $category_slug = $_POST['category_slug'];
        $category_name = $_POST['category_name'];
        $category = new Category();
        $result = $category->updateCategory( $category_slug, $category_name );
        echo $result;
        if($result == 'Upload success'){
            header('Location: ../views/admin/category.php');
            exit;
        }
    }
?>