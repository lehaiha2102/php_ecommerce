<?php 
session_start();
if(empty($_SESSION['user'])){
	header('Location: ../../views/auth/index.php');
	exit;
}
?>
<!doctype html>
<html lang="en">

<?php require_once('../../../app/views/admin/components/head.php')?>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php require_once('../../../app/views/admin/components/pageHead.php')?>
        <div class="app-main">
            <?php require_once('../../../app/views/admin/components/sidebar.php')?>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Categories
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Add category
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 card">
                        <div class="card-body">
                            <h5 class="card-title">Categories list</h5>
                                        <table class="mb-0 table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    require('../../process/show_category.php');
                                                    
                                                    foreach($categories as $index => $category){?>
                                                    <tr>
                                                        <th scope="row"><?php echo ++$index; ?></th>
                                                        <td id="category_name<?php echo $category['category_slug'] . '-' . $index; ?>"><?php echo $category['category_name']; ?></td>

                                                        <td>
                                                            <button type="button" class="btn mr-2 mb-2 btn-warning" data-toggle="modal" data-target="#exampleModalUpdate<?php echo $category['category_slug']?>">
                                                                <i class="pe-7s-pen"> </i>
                                                            </button>

                                                            <button type="button" class="btn mr-2 mb-2 btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $category['category_slug']?>">
                                                                <i class="pe-7s-trash"> </i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 1
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('../../../app/views/admin/components/footer.php')?>
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../process/add_category.php" method="POST">
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="">Category name</label>
                            <input name="category_name" id="exampleEmail" placeholder="Enter category name" type="text" class="form-control">
                        </div>
                        
                        <button name="category_add" type="submit" class="mt-1 btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

    <!-- delete modal -->
    <?php foreach($categories as $category){?>
    <div class="modal fade" id="exampleModal<?php echo $category['category_slug']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete category</h5>
                    <br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p>Are you sure you want to delete this category?</p>
                <h6>
                <?php echo $category['category_name']?>
                </h6>
                    <form action="../../process/delete_category.php" method="POST">
                        <div class="position-relative form-group">
                            <input name="category_slug" id="exampleEmail" value="<?php echo $category['category_slug']?>" placeholder="Enter category name" type="hidden" class="form-control">
                        </div>
                        
                        <button name="category_delete" type="submit" class="mt-1 btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- end delete modal -->

     <!-- Update modal -->
     <?php foreach($categories as $category){?>
    <div class="modal fade" id="exampleModalUpdate<?php echo $category['category_slug']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update category</h5>
                    <br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
        
                <h6>
                </h6>
                    <form id="update-form" action="../../process/update_category.php" method="POST">
                        <div class="position-relative form-group">
                            <input name="category_slug" id="exampleEmail" value="<?php echo $category['category_slug']?>" placeholder="Enter category name" type="hidden" class="form-control">
                            <input name="category_name" value="<?php echo $category['category_name']?>" placeholder="Enter category name" type="text" class="form-control">
                        </div>
                        
                        <button type="submit" class="btn btn-warning" id="update-btn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- end update modal -->

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#update-form').submit(function(e) {
            e.preventDefault();
            var categoryName = $('#update-form input[name="category_name"]').val(); 
            $.ajax({
                url: '../../process/update_category.php',
                type: 'POST',
                data: $('#update-form').serialize(),
                success: function(data) {
                        if (data == 'success') { 
                            $(this).closest('tr').find('td:eq(1)').text(categoryName);
                            $('#exampleModalUpdate<?php echo $category['category_slug']?>').modal('hide');
                        } else {
                            alert(data); // Hiển thị thông báo lỗi
                        }

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                }
            });
        });
    });
    </script> -->


</body>

</html>