<?php 
    require_once('../../app/classes/category.php');

    if(isset($_POST['category_delete'])){
        $category_id = $_POST['category_id'];
        $category = new Category();
        $result = $category->deleteCategory( $category_id );
        if($result == 'Delete category success'){
            header('Location: ../views/admin/category.php');
            exit;
        }
    }
?>