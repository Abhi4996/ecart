<?php
include "partials/head.php";
include "partials/header.php";
?>

<section class="main" id="main">
		<div class="cms-block">			
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>Product Details</h2>
						<div class="cms-sec product-details">
							<div class="row">
								<div class="col-md-6 product-details-left">
									<div class="item">
										<div class="img-holder"><img src="uploads/product6.jpg" alt="no img"></div>
									</div>
								</div>
								<div class="col-md-6 product-details-right">
									<div class="item">
										<div class="clearfix">
											<h3>Product name</h3>
											<span class="price">$100</span>
										</div>
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
										<p class="qty-sec">
											<span>Qty: </span>
											<select>
												<option>1</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>
												<option>6</option>
											</select>
											<span>Size: </span>
											<select>
												<option>Small</option>
												<option>Medium</option>
												<option>Large</option>
											</select>
										</p>
										<p><a href="cart.php" class="button1">Add To Cart</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
include "partials/footer.php";
?>