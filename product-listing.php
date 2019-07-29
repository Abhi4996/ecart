<?php
include "partials/head.php";
include "partials/header.php";
	$prices=[];
	$query = "SELECT DISTINCT price FROM products ORDER BY price ASC";
	$result = mysqli_query($con, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($prices, $row["price"]);
		}
		$length=count($prices);
		$low=$prices['0'];
		$high=$prices[$length-1];
		$interval=ceil(($high-$low)/3);
?>

<?php include "partials/message.php"; ?>
	<section class="main" id="main">
		<div class="cms-block">			
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<form action="">
							<div class="filter-sec">
								<h2>Size</h2>
								<ul>
									<li><input type="checkbox" name="n1" value="large" id="large" class="size"></input> Big</li>
									<li><input type="checkbox" name="n1" value="medium" id="medium" class="size"></input> Medium</li>
									<li><input type="checkbox" name="n1" value="small" id="small" class="size"></input> Small</li>
								</ul>
							</div>
							<div class="filter-sec">
								<h2>Price</h2>
								<ul>
									<li><input type="checkbox" name="n1" value="<?php echo $low . '-' . ($low + 1*$interval)?>" class="price"></input> <?php echo '$' . $low . '-' . '$' . ($low + 1*$interval) ?> </li>
									<li><input type="checkbox" name="n1" value="<?php echo ($low + 1*$interval) . '-' . ($low + 2*$interval)?>" class="price"></input> <?php echo '$' . ($low + 1*$interval) . '-' . '$' . ($low + 2*$interval) ?> </li>
									<li><input type="checkbox" name="n1" value="<?php echo ($low + 2*$interval) . '-' . ($low + 3*$interval)?>" class="price"></input> <?php echo '$' . ($low + 2*$interval) . '-' . '$' . ($low + 3*$interval) ?> </li>
								</ul>
							</div>
							<div class="filter-sec star-sec">
								<h2>Star</h2>
								<ul>
									<li><input type="checkbox" class="rating" name="n1" value="1"></input> <i class="fa fa-star" aria-hidden="true"></i></li>
									<li><input type="checkbox" class="rating" name="n1" value="2"></input> <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><input type="checkbox" class="rating" name="n1" value="3"></input> <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><input type="checkbox" class="rating" name="n1" value="4"></input> <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></li>
									<li><input type="checkbox" class="rating" name="n1" value="5"></input> <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></li>
								</ul>
							</div>
							<div class="filter-sec">
								<h2>Brand</h2>
								<ul>
									<li><input type="checkbox" name="n1" class="brand" value="nikey"></input> Nikey</li>
									<li><input type="checkbox" name="n1" class="brand" value="pepe"></input> Pepe</li>
									<li><input type="checkbox" name="n1" class="brand" value="titan"></input> Titan</li>
								</ul>
							</div>
						</form>
					</div>
					<div class="col-md-9">
						<h2>Product Listing</h2>

						<?php 
						$query = "SELECT * FROM products";
						$result = mysqli_query($con, $query);
						?>
							<div class="cms-sec product-listing">

							<div class="row">
						<?php

						if(mysqli_num_rows($result) > 0)
						{
					 		while ($row = mysqli_fetch_assoc($result)) {
					 		?>
								<div class="col-md-4 col-sm-6 product-sec">
									<form method="post" action="product-listing.php?action=add&id=<?php echo $row["id"]; ?>">
									<div class="item">
										<div class="img-holder"><a href="product-details.php"><img src="uploads/product6.jpg" alt="no img"></a></div>
										<div class="pro-details-sec">
											<div class="clearfix">
												<h3><a href="product-details.php"><?php echo $row["name"]; ?></a></h3>

												<span class="price"><?php echo '$' . $row["price"]; ?></span>

												<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

												<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
											</div>

											<input type="submit" name="add_to_cart" value="Add to Cart" class="button1 addToCart" data-id="<?php echo $row["id"]; ?>">
										</div>
									</div>
								</form>
								</div>
							<?php 
							} 
						}
						?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<script type="text/javascript">
	var products = getCookie("products");
	if (products) {
		products = JSON.parse(products);
	} else {
		products = [];
	}
	var sizeFilter = [];
	var priceFilter = [];
	var brandFilter = [];
	var ratingFilter = [];
	$(document).ready(function(){
		$( ".size" ).on('change', sizeChangeHandler);
		$( ".price" ).on('change', priceChangeHandler);
		$( ".brand" ).on('change', brandChangeHandler);
		$( ".rating" ).on('change', ratingChangeHandler);
		$("body").on("click", ".addToCart", addToCartClickHandler);
	});

	function sizeChangeHandler(e) {
		var $this = $(this);
		//var $this = $(e.currentTarget);

		/*var size = $this.val();
		var existance = $.inArray(size, sizeFilter);
		if ($this.is(":checked")) { // When checked
			if (existance === -1) {
				sizeFilter.push(size);
			}
		} else { // When unchecked
			if (existance !== -1) {
				sizeFilter.splice(existance, 1);
			}
		}*/

		sizeFilter = [];
		$(".size").each(function (index, item) {
			if ($(item).is(":checked")) {
				var size = $(item).val();
				sizeFilter.push('"' + size + '"');
			}
		});

		//console.log(sizeFilter);

		fetchProducts();
	}

	function priceChangeHandler(e) {
		var $this = $(this);

		priceFilter = [];
		$(".price").each(function (index, item) {
			if ($(item).is(":checked")) {
				var price = $(item).val();
				priceFilter.push(price);
			}
		});

		//console.log(priceFilter);
		
		fetchProducts();
	}

	function brandChangeHandler(e) {
		var $this = $(this);

		brandFilter = [];
		$(".brand").each(function (index, item) {
			if ($(item).is(":checked")) {
				var brand = $(item).val();
				brandFilter.push('"' + brand + '"');
			}
		});

		//console.log(priceFilter);
		
		fetchProducts();
	}

	function ratingChangeHandler(e) {
		var $this = $(this);
		
		ratingFilter = [];
		$(".rating").each(function (index, item) {
			if ($(item).is(":checked")) {
				var rating = $(item).val();
				ratingFilter.push('"' + rating + '"');
			}
		});


		fetchProducts();
	}


	function fetchProducts() {
		$.ajax({
			url: "productlisting_ajax.php",
			type: "post",
			data: {
				size: sizeFilter,
				price: priceFilter,
				brand: brandFilter,
				rating: ratingFilter
			},
			dataType: "json",
			success: function(response) {
				console.log(response);
				if (response.status) {
					var html = '';
					if (response.data.products.length) {
						$.each(response.data.products, function(index, item) {
							html += '<div class="col-md-4 col-sm-6 product-sec">';
							html += '	<form method="post" action="product-listing.php?action=add&id='+item.id+'">';
							html += '		<div class="item">';
							html += '			<div class="img-holder"><a href="product-details.php"><img src="uploads/product6.jpg" alt="no img"></a></div>';
							html += '			<div class="pro-details-sec">';
							html += '				<div class="clearfix">';
							html += '					<h3><a href="product-details.php">'+item.name+'</a></h3>';
							html += '					<span class="price">$'+item.price+'</span>';
							html += '					<input type="hidden" name="hidden_name" value="'+item.name+'" />';
							html += '					<input type="hidden" name="hidden_price" value="'+item.price+'" />';
							html += '				</div>';
							html += '			<input type="submit" name="add_to_cart" value="Add to Cart" class="button1 addToCart" data-id="'+item.id+'">';
							html += '			</div>';
							html += '		</div>';
							html += '	</form>';
							html += '</div>';
						});
					} else {
						html = 'No data found';
					}
					$('.product-listing>.row').html(html);
				}
			},
			error: function(response) {
				console.log(response);
			}
		});
	}

	function addToCartClickHandler(e) {
		e.preventDefault();
		var $element = $(e.currentTarget);
		var product_id = $element.data("id");
		if($.inArray(product_id, products) === -1){
			products.push(product_id);
			var productsStr = JSON.stringify(products);
			setCookie("products", productsStr, 10);
		}
	}

</script>

<?php
include "partials/footer.php";
?>