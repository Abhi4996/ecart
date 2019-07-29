	<header class="header">
		<nav class="navbar navbar-default">
		  <div class="container">
			  <div class="row">
				<div class="navbar-header">
				  <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a href="index.php" class="navbar-brand logo" title="ecommerce-website"><span>ecommerce</span> website</a>
				</div>
				<div class="navbar-collapse collapse" id="navbar">
				  <ul class="nav navbar-nav">
				  	<?php
				  		if (isset($_SESSION["user"])) {
				  	?>
						<li class="active">
							<a href="profile.php">Profile</a>
						</li>
					<?php
						}
					?>
					<li>
						<a href="product-listing.php">Product Listing</a>
					</li>
					<li>
						<a href="cart.php">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
						</a>
					</li>
					<li>
					<?php
				  		if (!isset($_SESSION["user"])) {
				  	?>
						<a href="login.php">
							<i class="fa fa-user" aria-hidden="true"></i> Login
						</a>
					</li>
					<?php
						}
					?>
					<li>
					<?php
				  		if (isset($_SESSION["user"])) {
				  	?>
						<a href="logout.php">
							<i class="fa fa-user" aria-hidden="true"></i> Logout
						</a>
					</li>
					<?php
						}
					?>
				  </ul>
				</div>
			</div>
		  </div>
		</nav>
	</header>