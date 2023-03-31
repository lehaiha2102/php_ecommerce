<?php 
    require_once('../../app/classes/category.php');

    if(isset($_POST['category_name']) && $_POST['category_name']){
        $category_name = $_POST['category_name'];

        $category = new Category();
        $result = $category->addCategory( $category_name );
        if($result == 'add category success'){
            header('Location: ../views/admin/category.php');
            exit;
        }
    } else{
        echo '<script>
            alert("Category is require");
            window.location.replace("../views/admin/category.php");
            </script>';
    }
?>