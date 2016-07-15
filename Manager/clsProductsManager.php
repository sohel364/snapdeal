<?php
error_reporting(0);
include_once('../objects/clsProduct.php');
include_once('databaseHelper.php');
class clsProductsManager{
	public $DataBaseHelper=NULL;
	public static function InsertProducts($ProductsObject){         
                 
               // echo '<pre>';
               // print_r($ProductsObject);
               // echo '</pre>';
                //echo "i am here";
		$DataBaseHelper=new DataAccessHelper();
		$sql="INSERT INTO `products` (`product_id`,`product_name`, `product_price`, `dis_percentange`,`before_dis_price`,`emi_availablity`,`emi_rate`,`features`,`img_url`,`category_name`,`sub_category_name`,`product_details_url`,`product_rating`) VALUES ('".NULL ."','".safe($ProductsObject->GetProductName())."','".safe($ProductsObject->GetProductPrice())."', '".safe($ProductsObject->GetDiscountDetails())."','".safe($ProductsObject->GetProductBeforeDiscounePrice())."','".safe($ProductsObject->GetEmi())."','".safe($ProductsObject->GetEmiDetails())."','".safe($ProductsObject->GetProductFeatures())."','".safe($ProductsObject->GetImgUrl())."','".safe($ProductsObject->GetProductCategory())."','".safe($ProductsObject->GetProductSubCategory())."','".safe($ProductsObject->GetProductDetailUrl())."','".safe($ProductsObject->GetProductRating())."')";  		
		//echo $sql."<br/>";
		return $DataBaseHelper->ExecuteInsertReturnID($sql);
	}	
}




function safe($value){
	return mysql_real_escape_string($value);
}

?>
