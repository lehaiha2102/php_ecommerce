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
                                <div>Products
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Add product
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 card">
                        <div class="card-body">
                            <h5 class="card-title">Products list</h5>
                                        <table class="mb-0 table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product name</th>
                                                <th>Product price</th>
                                                <th>Product quantity</th>
                                                <th>Product image</th>
                                                <th>Product description</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    require('../../process/show_product.php');
                                                    
                                                    foreach($products as $index => $product){?>
                                                    <tr>
                                                        <th scope="row"><?php echo ++$index; ?></th>
                                                        <td><?php echo $product['product_name'];?></td>
                                                        <td>
                                                            <span class="text-nowrap">Import price: <p class="text-dark"><?php echo $product['product_import_price'];?></p></span> 
                                                            <span class="text-nowrap">Price: <p class="text-primary"><?php echo $product['product_price'];?></p></span>   
                                                        </td>
                                                        <td><?php echo $product['product_quantity'];?></td>
                                                        <td>
                                                            <img src="../../../public/image/<?php echo $product['product_image_1'];?>" alt="<?php echo $product['product_image_1'];?>" style="width:100px; height:50px;">
                                                
                                                            </td>
                                                        <td><?php echo $product['product_description'];?></td>
                                                        <td>
                                                            <button type="button" class="btn mr-2 mb-2 btn-warning" data-toggle="modal" data-target="#exampleModalUpdate<?php echo $product['product_id']?>">
                                                                <i class="pe-7s-pen"> </i>
                                                            </button>

                                                            <button type="button" class="btn mr-2 mb-2 btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $product['product_id']?>">
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
</body>   <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../process/add_product.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product name</label>
                                    <input name="product_name" placeholder="Enter product name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product quantity</label>
                                    <input name="product_quantity" min="1" placeholder="Enter product quantity" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleSelect" class="">Category</label>
                                    <select name="category_id" id="exampleSelect" class="form-control">
                                    <?php $sql = "SELECT * FROM categories";
                                        $result = $connection->query($sql);
                                        $categories = array();
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $categories[] = $row;
                                            }
                                        }            
                                        foreach($categories as $index => $category){?>
                                            <option value="<?php echo $category['category_id']?>"><?php echo $category['category_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product import price</label>
                                    <input name="product_import_price" placeholder="Enter price" min="1000" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product price</label>
                                    <input name="product_price" placeholder="Enter price" min="1000" type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product image</label>
                                    <input name="product_image_1" placeholder="Enter image 1" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product image</label>
                                    <input name="product_image_2" placeholder="Enter price" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product image</label>
                                    <input name="product_image_3" placeholder="Enter price" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product description</label><br>
                                    <textarea name="product_description" id="" cols="60" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <button name="product_add" type="submit" class="mt-1 btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

    <!-- delete modal -->
    <?php foreach($products as $product){?>
    <div class="modal fade" id="exampleModal<?php echo $product['product_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
                    <br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p>Are you sure you want to delete this product?</p>
                <h6>
                <?php echo $product['product_name']?>
                </h6>
                    <form action="../../process/delete_product.php" method="POST">
                        <div class="position-relative form-group">
                            <input name="product_id" value="<?php echo $product['product_id']?>" placeholder="Enter product name" type="hidden" class="form-control">
                        </div>
                        
                        <button name="product_delete" type="submit" class="mt-1 btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- end delete modal -->

     <!-- Update modal -->
     <?php foreach($products as $product){?>
    <div class="modal fade" id="exampleModalUpdate<?php echo $product['product_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update product</h5>
                    <br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
        
                <h6>
                </h6>
                    <form id="update-form" action="../../process/update_product.php" method="POST"  enctype="multipart/form-data">
                    <div class="row">
                            <div class="col-md-4">
                            <input name="product_id" value="<?php echo $product['product_id']?>" placeholder="Enter product name" type="hidden" class="form-control">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product name</label>
                                    <input name="product_name" value="<?php echo $product['product_name']?>" placeholder="Enter product name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product quantity</label>
                                    <input name="product_quantity" value="<?php echo $product['product_quantity']?>" min="1" placeholder="Enter product quantity" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleSelect" class="">Category</label>
                                    <select name="category_id" value="<?php echo $product['category_id']?>" id="exampleSelect" class="form-control">
                                    <?php $sql = "SELECT * FROM categories";
                                        $result = $connection->query($sql);
                                        $categories = array();
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $categories[] = $row;
                                            }
                                        }            
                                        foreach($categories as $index => $category){?>
                                            <option value="<?php echo $category['category_id']?>"><?php echo $category['category_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product import price</label>
                                    <input name="product_import_price" value="<?php echo $product['product_import_price']?>" placeholder="Enter price" min="1000" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product price</label>
                                    <input name="product_price" value="<?php echo $product['product_price']?>" placeholder="Enter price" min="1000" type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                <input type="hidden" name="existing_image_1" value="<?php echo $product['product_image_1'] ?>">
                                <input type="hidden" name="existing_image_2" value="<?php echo $product['product_image_2'] ?>">
                                <input type="hidden" name="existing_image_3" value="<?php echo $product['product_image_3'] ?>">
                                    <label for="exampleEmail" class="">Product image</label>
                                    <input name="product_image_1" value="<?php echo $product['product_image_1']?>" placeholder="Enter image 1" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product image</label>
                                    <input name="product_image_2" value="<?php echo $product['product_image_2']?>" placeholder="Enter price" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product image</label>
                                    <input name="product_image_3" value="<?php echo $product['product_image_3']?>" placeholder="Enter price" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Product description</label><br>
                                    <textarea name="product_description" value="" id="" cols="60" rows="5"><?php echo $product['product_description']?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        
                        <button type="submit" name="update-product" class="btn btn-warning" id="update-btn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</html>