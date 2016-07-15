<?php
error_reporting(0);
include_once('../objects/clsProducts.php');
include_once('../Manager/clsProductsManager.php');

$products = new products("salwar","1500","10","yes","20","cotton","2","abcd","absc","dress","womens");


UTC_Createproducts($products);
UTCInsertProducts($products);

function UTC_Createproducts($products){
	echo "<pre>";
		print_r($products);
	echo "</pre>";
}


function UTCInsertProducts($products){
	clsProductsManager::InsertProducts($products);
}

?>