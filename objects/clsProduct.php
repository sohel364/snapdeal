<?php 

class product{

private $_product_id;
private $_product_name;	
private $_product_price;
private $_product_price_before_discount;
private $_product_discount_details;
private $_product_has_emi;
private $_product_emai_details;
private $_product_features;
private $_img_url;
private $_product_category;
private $_product_sub_category;
private $_product_detail_url;
private $_rating;

public function SetProductId($_product_id){
	$this->_product_id=$_product_id;
}
public function getProductId(){
	return $this->_product_id;
}

public function SetProductName($_product_name){
	$this->_product_name=$_product_name;
}
public function GetProductName(){
	return $this->_product_name;
}
	
public function SetProductPrice($_product_price){
	$this->_product_price=$_product_price;
}
public function GetProductPrice(){
	return $this->_product_price;
}

public function SetProductBeforeDiscounePrice($_product_price_before_discount){
	$this->_product_price_before_discount=$_product_price_before_discount;
}
public function GetProductBeforeDiscounePrice(){
	return $this->_product_price_before_discount;
}

public function SetDiscountDetails($_product_discount_details){
	$this->_product_discount_details=$_product_discount_details;
}
public function GetDiscountDetails(){
	return $this->_product_discount_details;
}

public function SetEmi($_product_has_emi){
	$this->_product_has_emi=$_product_has_emi;
}
public function GetEmi(){
	return $this->_product_has_emi; 
}

public function SetEmiDetails($_product_emai_details){
	return $this->_product_emai_details=$_product_emai_details;
}
public function GetEmiDetails(){
	return $this->_product_emai_details;

}

public function SetProductFeatures($_product_features){
	$this->_product_features=$_product_features;
}
public function GetProductFeatures(){
	return $this->_product_features;
}

public function SetImgUrl($_img_url){
	return $this->_img_url=$_img_url;
}
public function GetImgUrl(){
	return $this->_img_url;
}


public function SetProductCategory($_product_category){
	$this->_product_category=$_product_category;
}
public function GetProductCategory(){
	return $this->_product_category;
}

public function SetProductSubCategory($_product_sub_category){
	$this->_product_sub_category=$_product_sub_category;
}
public function GetProductSubCategory(){
	return $this->_product_sub_category;
}

public function SetProductDetailUrl($_product_detail_url){
	$this->_product_detail_url=$_product_detail_url;
}
public function GetProductDetailUrl(){
	return $this->_product_detail_url;
}

public function SetProductRating($_product_rating){
	$this->_rating=$_product_rating;
}
public function GetProductRating(){
	return $this->_rating;
}

function __construct(){
	
}


}

?>