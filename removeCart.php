<?php
	include "partials/head.php";
	foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			/*echo "<pre>";
			print_r($_SESSION["shopping_cart"]);
			die();*/
				unset($_SESSION["shopping_cart"]);
				unset($_SESSION["shopping_cart"][$keys]);
				header("Location: cart.php");
			
		}

?>