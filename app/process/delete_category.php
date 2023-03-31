<?php 
    require_once('../../app/classes/category.php');

    if(isset($_POST['category_delete'])){
        $category_id = $_POST['category_id'];
        $category = new Category();
        $result = $category->deleteCategory( $category_id );
        if($result == 'Delete category success'){
            header('Location: ../views/admin/category.php');
            exit;
        }else{
            echo '<script>
            alert("It\'s possible that your category is in an order, so you can\'t delete it now. If you want to remove this category, please delete the invoices that contain this category");
            window.location.replace("../views/admin/category.php");
            </script>';
        }
    }
?>