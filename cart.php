<?php
include "partials/head.php";
include "partials/header.php";
?>

<script type="text/javascript">
	var productStr = getCookie("products");
	/*console.log(productStr);*/
	
</script>
<?php
$prodId = $_COOKIE['products'];
?>


<section class="main" id="main">
		<div class="cms-block">			
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>Cart</h2>
						<div class="cms-sec cart-sec">
							<table width="100%" border="1" cellspacing="0" cellpadding="0">
								<tr>
									<th align="left" valign="top">Product</th>
									<th align="left" valign="top">Price</th>
									<th align="left" valign="top">Quantity</th>
									<th align="left" valign="top">Total</th>
								</tr>
								<?php 
									$prodId = json_decode($prodId, true);
									$prodId = implode(',',$prodId);
									$query = "SELECT * FROM products WHERE id IN (" . $prodId . ")";
									$result = mysqli_query($con, $query);
									while ($row = mysqli_fetch_assoc($result)) {
								?> 
								
								<tr>
									<td align="left" valign="top"><a href="product-details.html"><img src="uploads/products/product6.jpg" alt="no img"></a> <?php echo $row["name"]; ?></td>
									<td align="left" valign="middle"><?php echo $row["price"]; ?></td>
									<td align="left" valign="middle">
										<select>
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
											<option>6</option>
										</select>
										<span class="remove"><i class="fa fa-trash deleteFromCart" aria-hidden="true" data-id="<?php echo $row["id"]; ?>" title="delete"></i></span>
									</td>
									<td align="left" valign="middle"><?php echo $row["price"]; ?></td>
								</tr>
								<?php
									}	
								?>
								<tr>
									<td align="right" valign="middle" colspan="3"><strong>Total Order</strong></td>
									<td align="left" valign="middle">$200</td>
								</tr>
							</table>
							<div class="continue-shoping">
								<a href="product-listing.html" class="button1">Continue Shopping <i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a>
								<a href="success.html" class="button1">Checkout <i class="fa fa-check" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(document).ready(function(){
			$("body").on("click", ".deleteFromCart", deleteFromCartClickHandler);
		});


		function deleteFromCartClickHandler(e) {
			e.preventDefault();
			var $element = $(e.currentTarget);
			var product_id = $element.data("id");
			console.log(product_id);
		}
	</script>

<?php
include "partials/footer.php";
?>