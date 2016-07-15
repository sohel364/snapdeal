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

//echo $html_snippet;
//echo $table_name;
//echo $product_id;

$ProductArray=NULL;
$SingleProduct=NULL;
$counter =0;

foreach($innerHtml->find('div[class=comp comp-product-specs]') as $mitem)
 {
  $SingleProduct=new productspec();
  $SingleProduct->SetProductID($product_id);        
	foreach($mitem->find('div[class=spec-section expanded]') as $item)
    {      
        foreach($item->find('div[class=spec-title-wrp]') as $item_title){
          //echo $item_title;
          $SingleProduct->SetProductSpecType($item_title->plaintext);
        }

        foreach ($item->find('div[class=spec-body]') as $item_body){

						if($item_body->find('ul'))
						{
									$type_list_data_combined="";
							
									 foreach ($item_body->find('ul li') as $item_spec_li_data) {
												  //echo "This list data: ". $item_spec_li_data;
										$type_list_data_combined.=$item_spec_li_data->plaintext .",";
									 }                                          
									 //echo "List Combined data : ". $type_list_data_combined;     
									 $SingleProduct->SetProductData(rtrim($type_list_data_combined, ","));                                        
						}
						//else {
							  //echo "this is full tex :".$item_body;              
						if($item_body->find('tbody table'))
						{
							//$SingleProduct->SetProductData($item_body->plaintext);
							$type_list_data_combined2="";
							foreach($item_body->find('table[class=product-spec]') as $specInnerType)
							{		 echo $specInnerType."<br>";
									 $specTypeStringCollector = "";
									 $specTypeStringCollector.=$specInnerType->find("tr",0)->plaintext." :";
									 //echo $specInnerType->find('tr th')->plaintext.'<br>';
																						 
									 foreach($specInnerType->find('tr') as $Typevalue)
									 {
										$pairString = "";
										//echo $Typevalue.'<br>';
										//$i=0;
										$pairString.= trim($Typevalue->find("td",0)->plaintext).":".trim($Typevalue->find("td",1)->plaintext.',');
										
										/*foreach($Typevalue->find('td') as $Perl)
										{
											 if($i>0)
											 {$pairString.=":";}
											 
											 $pairString.= trim($Perl);
											 $i++;
										}*/
										$specTypeStringCollector.=$pairString;
									 }
									
									$type_list_data_combined2.=trim($specTypeStringCollector,',');
							}				
							//echo $type_list_data_combined2.'<br>';
							$SingleProduct->SetProductData(trim($type_list_data_combined2, ','));
						 }
						 
						 if($item_body->find('div[class=detailssubbox]')){
								$SingleProduct->SetProductData($item_body->plaintext);
								/*$descriptTionCombined="";
								$CollectionArray1=array();
								$CollectionArray2=array();
								
								foreach($item_body->find('strong') as $subtitle)
								{
									
									array_push($CollectionArray1,$subtitle->plaintext);
								}							
								foreach($item_body->find('p[style]') as $subDet)
								{
									//echo $subDet."</br><hr>";
									array_push($CollectionArray2,$subDet->plaintext);
								}
								 echo "<pre>";
									print_r($CollectionArray1);
									print_r($CollectionArray2);
								 echo "<hr></br>";*/
						 }
			
		//}		
       }
		
	
		
        echo "<pre>";
        print_r($SingleProduct);
        echo "</pre>";
        echo "<hr></br>";
         
       $DataAccess = new DataaccessHelper();     
       $id = clsProductSpecManager::InsertProducts($SingleProduct,$table_name);
	   clsProductSpecManager::UpdateIsCompleted($table_name,$product_id);
	   echo $id;
    }
}

	   
?>