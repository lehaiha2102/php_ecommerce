<?php
session_start();
if (empty($_SESSION['user'])) {
    header('Location: ../../views/auth/index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">

<?php require_once('../../../app/views/admin/components/head.php') ?>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php require_once('../../../app/views/admin/components/pageHead.php') ?>
        <div class="app-main">
            <?php require_once('../../../app/views/admin/components/sidebar.php') ?>
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
                            <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Add category
                            </button>
                        </div>
                        <div class="col-md-3">
                            <div class="dropdown d-inline-block">
                                <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                                    class="mb-2 mr-2 dropdown-toggle btn btn-outline-primary">Filter
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check dropdown-item" for="category"
                                                onclick="document.getElementById('category').click();">
                                                <input type="radio" name="value" id="category"
                                                    class="form-check-input value" value="category">
                                                <label class="form-check-label" for="category">
                                                    Category
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check dropdown-item" for="Default"
                                                onclick="document.getElementById('Default').click();">

                                                <input type="radio" name="arrangement" id="Default"
                                                    class="form-check-input arrangement" value="Default">
                                                <label class="form-check-label" for="Default">
                                                    Default
                                                </label>
                                            </div>
                                            <div class="form-check dropdown-item" for="Ascending"
                                                onclick="document.getElementById('Ascending').click();">

                                                <input type="radio" name="arrangement" id="Ascending"
                                                    class="form-check-input arrangement" value="Ascending">
                                                <label class="form-check-label" for="Ascending">
                                                    Ascending
                                                </label>
                                            </div>
                                            <div class="form-check dropdown-item" for="Decrease"
                                                onclick="document.getElementById('Decrease').click();">

                                                <input type="radio" name="arrangement" id="Decrease"
                                                    class="form-check-input arrangement" value="Decrease">
                                                <label class="form-check-label" for="Decrease">
                                                    Decrease
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="center"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <a class="btn btn-primary" href="#" id="filterBtn">Submit</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <form action="" id="search-category">
                                <div class="position-relative form-group">
                                    <input type="text" id="keyword" name="keyword" placeholder="Enter..."
                                        class="form-control" style="display: inline-block;">
                                    <button class="btn btn-primary" type="submit" style="display: inline-block;"> <i
                                            class="pe-7s-search"></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 card">
                            <div class="card-body">
                                <h5 class="card-title">Categories list</h5>
                                <table class="mb-0 table" id="category-table">
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

                                        foreach ($categories as $index => $category) { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo ++$index; ?>
                                                </th>
                                                <td
                                                    id="category_name<?php echo $category['category_slug'] . '-' . $index; ?>">
                                                    <?php echo $category['category_name']; ?></td>

                                                <td>
                                                    <button type="button" class="btn mr-2 mb-2 btn-warning"
                                                        data-toggle="modal"
                                                        data-target="#exampleModalUpdate<?php echo $category['category_slug'] ?>">
                                                        <i class="pe-7s-pen"> </i>
                                                    </button>

                                                    <button type="button" class="btn mr-2 mb-2 btn-danger"
                                                        data-toggle="modal"
                                                        data-target="#exampleModal<?php echo $category['category_slug'] ?>">
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
    <?php require_once('../../../app/views/admin/components/footer.php') ?>
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                            <input name="category_name" id="exampleEmail" placeholder="Enter category name" type="text"
                                class="form-control">
                        </div>

                        <button name="category_add" type="submit" class="mt-1 btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

    <!-- delete modal -->
    <?php foreach ($categories as $category) { ?>
        <div class="modal fade" id="exampleModal<?php echo $category['category_slug'] ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <?php echo $category['category_name'] ?>
                        </h6>
                        <form action="../../process/delete_category.php" method="POST">
                            <div class="position-relative form-group">
                                <input name="category_slug" id="exampleEmail"
                                    value="<?php echo $category['category_slug'] ?>" placeholder="Enter category name"
                                    type="hidden" class="form-control">
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
    <?php foreach ($categories as $category) { ?>
        <div class="modal fade" id="exampleModalUpdate<?php echo $category['category_slug'] ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input name="category_slug" id="exampleEmail"
                                    value="<?php echo $category['category_slug'] ?>" placeholder="Enter category name"
                                    type="hidden" class="form-control">
                                <input name="category_name" value="<?php echo $category['category_name'] ?>"
                                    placeholder="Enter category name" type="text" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-warning" id="update-btn">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <script>
        // Get the dropdown button
        var dropdownBtn = document.querySelector(".dropbtn");

        // Add an event listener to the button
        dropdownBtn.addEventListener("click", function () {
            // Toggle the dropdown content
            var dropdownContent = this.nextElementSibling;
            dropdownContent.classList.toggle("show");
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener("click", function (event) {
            if (!event.target.matches(".dropbtn")) {
                var dropdowns = document.querySelectorAll(".dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var dropdown = dropdowns[i];
                    if (dropdown.classList.contains("show")) {
                        dropdown.classList.remove("show");
                    }
                }
            }
        });

    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#search-category').submit(function (e) {
                e.preventDefault();
                keyword = $('#keyword').val();
                index = 1;
                $.ajax({
                    url: '../../process/admin_category_search.php',
                    type: 'POST',
                    data: { keyword: keyword },
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success) {
                            $('#category-table tbody').empty();
                            $.each(response.data, function (index, category) {
    var row = $('<tr>');
    $('<td>').text(index+1).appendTo(row);
    $('<td>').text(category.category_name).appendTo(row);
    var actionsHtml =
        '<a type="button" class="btn mr-2 mb-2 btn-warning" href="../../views/admin/editcategory.php?category_slug=' + category.category_slug + '"><i class="pe-7s-pen"> </i></a>' +
        '<button type="button" class="btn mr-2 mb-2 btn-danger" data-toggle="modal" data-target="#exampleModal' + category.category_slug + '"><i class="pe-7s-trash"> </i></button>';
    $('<td>').html(actionsHtml).appendTo(row);
    $('#category-table tbody').append(row);
});
                            $('#category-table').show();
                        } else {
                            alert(response.message);
                            console.log(response.message);
                        }
                    },
                    error: function (response) {
                        console.log(JSON.stringify(response))
                    }

                })
            })
        })

    </script>
    <script>
        $(document).ready(function () {
            $('#filterBtn').on('click', function (e) {
                e.preventDefault();
                index = 1;
                var value = $('input[name=value]:checked').val();
                var arrangement = $('input[name=arrangement]:checked').val();
                $.ajax({
                    url: '../../process/category_filter.php',
                    type: 'POST',
                    data: {
                        value: value,
                        arrangement: arrangement
                    },

                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success) {
                            $('#category-table tbody').empty();
                            var categories = response.data;
                            for (var i = 0; i < categories.length; i++) {
                                var category = categories[i];
                                var row = $('<tr>');
                                $('<td>').text(index++).appendTo(row);
                                $('<td>').text(category.category_name).appendTo(row);
                                var actionsHtml =
                                    '<a type="button" class="btn mr-2 mb-2 btn-warning" href="../../views/admin/editcategory.php?category_slug=' + category.category_slug + '"><i class="pe-7s-pen"> </i></a>' +
                                    '<button type="button" class="btn mr-2 mb-2 btn-danger" data-toggle="modal" data-target="#exampleModal' + category.category_slug + '"><i class="pe-7s-trash"> </i></button>';
                                $('<td>').html(actionsHtml).appendTo(row);

                                $('#category-table tbody').append(row);
                            }
                            $('#category-table').show();
                        } else {
                            alert(response.message);
                            console.log(response.message);
                        }
                    },
                    error: function (response) {
                        // alert(response.message);
                        console.log(response)
                    }
                })
            });
        });
    </script>
</body>

</html>