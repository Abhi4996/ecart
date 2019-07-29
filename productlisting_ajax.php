<?php
	include "includes/sessionStart.php";

	$size = isset($_POST['size']) ? implode(",", $_POST['size']) : null;
	$brand = isset($_POST['brand']) ? implode(",", $_POST['brand']) : null;
	$rating = isset($_POST['rating']) ? implode(",", $_POST['rating']) : null;
	$price = isset($_POST['price']) ? implode("-", $_POST['price']) : null;
	$price_arr = explode("-",$price);

	$priceLow = $price_arr[0];
	$priceHigh = end($price_arr);

	$select = "SELECT *";
	$from = "FROM products";
	$where = "WHERE 1";

	if ($size) {
		$where .= " AND size IN ($size)";
	}

	if ($price) {
		$where .= " AND price BETWEEN $priceLow AND $priceHigh";
	}

	if ($brand) {
		$where .= " AND brand IN ($brand)";
	}

	if ($rating) {
		$where .= " AND rating IN ($rating)";
	}

	$sql = $select . " " . $from . " " . $where;
	$result = mysqli_query($con, $sql);

	$products = [];
	if ($result->num_rows) {
		while ($row = mysqli_fetch_assoc($result)) {
			$product = array(
				"id" => $row["id"],
				"name" => $row["name"],
				"image" => $row["image"],
				"price" => $row["price"],
				"brand" => $row["brand"],
				"size" => $row["size"],
			);
			array_push($products, $product);
		}
	}



	$response = array(
		"status" => true,
		"message" => "Success",
		"data" => array(
			"products" => $products
		)
	);
	echo json_encode($response);
?>