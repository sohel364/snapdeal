<?php
set_time_limit(0);
include_once('../simple_html_dom.php');
include_once ('../objects/cls_product_spec.php');
include_once ('../Manager/clsProductSpecManager.php');



//$url="file:///C:/xampp/htdocs/repo_orny/basic/snapdeal/app/try.html";
//file:///C:/xampp/htdocs/repo_orny/basic/snapdeal/app/try.html

$html_snippet =$_POST['value'];
$table_name =$_POST['tablename'];//."_&_collectibles";  // have to use it later. this is used for spec table
//$table_name_currenttable ="bicycles"; // this will come from the post later
$product_id =$_POST['id'];
//$innerHtml = file_get_html($url);
$innerHtml = str_get_html($html_snippet);


$DataAccess = new DataaccessHelper();
clsProductSpecManager::UpdateIsCompletedFailed($table_name,$product_id);		

echo "FAILED";
?>