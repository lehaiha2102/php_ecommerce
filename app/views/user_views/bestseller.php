<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'php_ecommerce';

$connection = new mysqli($servername, $username, $password, $database);

if($connection->connect_error){
    die('Connect error'.$connection->connect_error);
}

 $sql = "SELECT product_id, SUM(product_quantity) as total_quantity
        FROM order_detail
        WHERE YEAR(create_at) = YEAR(CURRENT_DATE)
        AND QUARTER(create_at) = QUARTER(CURRENT_DATE)
        GROUP BY product_id
        ORDER BY total_quantity DESC
        LIMIT 5";
        $result = $connection->query($sql);

        $products_seller = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products_seller[] = $row;
            }
        } ?>
						<div class="container clearfix">

							<div class="fancy-title title-border topmargin-sm mb-4 title-center">
								<h4>
                                    Best seller products
								</h4>
							</div>

							<div class="row grid-6">
								<?php
								foreach ($products_seller as $product_seller) {
				?>
										<div class="col-lg-2 col-md-3 col-6 px-2">
											<div class="product">
												<div class="product-image">
													<a
														href="../../views/user_views/single_product_page.php?product_id=<?php echo $product['product_id'] ?>"><img
															src="../../../public/image/<?php echo $product_seller['product_image_1'] ?>"
															alt="Image 1"></a>
													<a
														href="../../views/user_views/single_product_page.php?product_id=<?php echo $product_seller['product_id'] ?>"><img
															src="../../../public/image/<?php echo $product_seller['product_image_2'] ?>"
															alt="Image 1"></a>
													<?php if (!empty($product_seller['product_promotion_price'])) { ?>
														<div class="sale-flash badge bg-danger p-2">Sale!</div>
													<?php } ?>
													<div class="bg-overlay">
														<div class="bg-overlay-content align-items-end justify-content-between"
															data-hover-animate="fadeIn" data-hover-speed="400">
															<a onclick="AddCart(<?php echo $product_seller['product_id']; ?>)"
																href="javascript:" class="btn btn-dark me-2"><i
																	class="icon-shopping-basket"></i></a>
															<a onclick="AddFavourite(<?php echo $product_seller['product_id']; ?>)"
																href="javascript:" class="btn btn-dark"><i
																	class="icon-line-heart"></i></a>
														</div>
														<div class="bg-overlay-bg bg-transparent"></div>
													</div>
												</div>
												<div class="product-desc">
													<div class="product-title mb-1">
														<h3><a
																href="../../views/user_views/single_product_page.php?product_id=<?php echo $product_seller['product_id'] ?>">
																<?php echo $product_seller['product_name'] ?>
															</a></h3>
													</div>
													<?php if (!empty($product_seller['product_promotion_price'])) { ?>
														<div class="product-price font-primary">
															<del class="me-1">

																$
																<?php echo number_format($product_seller['product_price'], 0, '.', ','); ?>
															</del>
															<ins>
																$
																<?php echo number_format($product_seller['product_promotion_price'], 0, '.', ','); ?>
															</ins>
														</div>
													<?php } else { ?>
														<div class="product-price font-primary">

															<ins>
																$
																<?php echo number_format($product_seller['product_price'], 0, '.', ','); ?>
															</ins>
														</div>
													<?php } ?>
												</div>
											</div>
										</div>

									<?php }
								?>
							</div>

						</div>
						<div style="display: flex; justify-content: center; margin-top: 20px;">
							<a
								href="../../views/user_views/product.php?category_slug=<?php echo $category['category_slug'] ?>">Show
								more</a>
						</div>
					<div class="clear"></div>