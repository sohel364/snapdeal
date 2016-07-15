<?php
set_time_limit(0);
include_once('../simple_html_dom.php');
include_once ('../objects/cls_product_spec.php');
include_once ('../Manager/clsProductSpecManager.php');

$url="file:///E:/xampp/htdocs/snapdeal/target/try.html";
$innerHtml = file_get_html($url);
$ProductArray=NULL;
$SingleProduct=NULL;
//echo $innerHtml;
//return;
//echo 'Now:       '. date('Y-m-d') ."\n";

$counter =0;

foreach($innerHtml->find('div class="comp comp-product-specs"') as $mitem)
 {     
		$SingleProduct=new product();
		 $SingleProduct->SetProductID(101);
	foreach($mitem->find('div [class=spec-section expanded]') as $item)
    {	
			$tmp_type_lidata="";
        
		$SingleProduct->SetProductSpecType($item->find('div [class=spec-title-wrp]')->plaintext);
		if($item->find('div [class=spec-body]ul')!=NULL)
		{
				$tmp_type_lidata = ($item->find('div [class=spec-body]ul')->plaintext);
		}
				
		else
		{
				
			foreach($item->find(ul li) as item_type_li)
			{
				$tmp_type_lidata = item_type_li;
			}
		}
			$SingleProduct->SetProductData($tmp_type_lidata);        
                                
				
	}
        
                           
 
    
      
       $DataAccess = new DataaccessHelper();     
       clsProductSpecManager::InsertProducts($SingleProduct);
}
	   
	   
      






?>
