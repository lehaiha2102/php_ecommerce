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
                        <div class="col-md-3">
                        <div class="dropdown">
                                <button class="dropbtn btn">Filter with category</button>
                                <div class="dropdown-content">
                                <button id="sort-category-az" type="button" tabindex="0"
                                        class="dropdown-item">A-Z</button>
                                    <button type="button" tabindex="0" class="dropdown-item"
                                        id="sort-category-za">Z-A</button>

                                    <button type="button" tabindex="0" class="dropdown-item"
                                        id="sort-category-default">Default</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 card">
                        <div class="card-body">
                            <h5 class="card-title">Categories list</h5>
                            <input type="text" id="search-input" name="searchValue" placeholder="Type to search">
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
const categoryTable = document.getElementById('category-table');
const sortCategoryAZBtn = document.getElementById('sort-category-az');
const sortCategoryZABtn = document.getElementById('sort-category-za');
const sortCategoryDefaultBtn = document.getElementById('sort-category-default');

let currentSortOrder = 'default';

function sortCategoryAZ() {
  const rows = Array.from(categoryTable.querySelectorAll('tbody tr'));
  rows.sort((a, b) => a.querySelector('td:nth-child(2)').innerText.localeCompare(b.querySelector('td:nth-child(2)').innerText));
  categoryTable.tBodies[0].append(...rows);
  currentSortOrder = 'az';
}

function sortCategoryZA() {
  const rows = Array.from(categoryTable.querySelectorAll('tbody tr'));
  rows.sort((a, b) => b.querySelector('td:nth-child(2)').innerText.localeCompare(a.querySelector('td:nth-child(2)').innerText));
  categoryTable.tBodies[0].append(...rows);
  currentSortOrder = 'za';
}

function sortCategoryDefault() {
  const rows = Array.from(categoryTable.querySelectorAll('tbody tr'));
  rows.sort((a, b) => a.querySelector('td:first-child').innerText - b.querySelector('td:first-child').innerText);
  categoryTable.tBodies[0].append(...rows);
  currentSortOrder = 'default';
}

sortCategoryAZBtn.addEventListener('click', sortCategoryAZ);
sortCategoryZABtn.addEventListener('click', sortCategoryZA);
sortCategoryDefaultBtn.addEventListener('click', sortCategoryDefault);

</script>
<script>
    const searchInput = document.getElementById('search-input');
    const tableBody = document.querySelector('.table tbody');
    const rows = tableBody.querySelectorAll('tr');

    searchInput.addEventListener('keyup', function(event) {
        const searchTerm = event.target.value.toLowerCase();

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            let found = false;

            cells.forEach(cell => {
                const cellValue = cell.textContent.toLowerCase();

                if (cellValue.includes(searchTerm)) {
                    found = true;
                }
            });

            if (found) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

</body>

</html>