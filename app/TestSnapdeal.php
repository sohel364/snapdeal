<?php
set_time_limit(0);
include_once('../simple_html_dom.php');
include_once ('../objects/clsProduct.php');
include_once ('../Manager/clsProductsManager.php');

$url="file:///E:/Dropbox/SnapDeal/snapdeal/target/try.html";
$innerHtml = file_get_html($url);
$ProductArray=NULL;
$SingleProduct=NULL;


//echo 'Now:       '. date('Y-m-d') ."\n";

$counter =0;
	//echo "TEST";
foreach($innerHtml->find('div[id=products] section[class=js-section clearfix]') as $mitem)
 {        
		//echo "TEST";
	foreach($mitem->find('div[class=col-xs-6  product-tuple-listing js-tuple]') as $item)
    {
        //echo $item;

         $SingleProduct=new product();
         /**
         * PLease add the category & SubCategory
         */
        
        //echo "URL ::". $innerHtml->find("div[class=productWrapper] a",0)->href;
		
		
        $SingleProduct->SetProductCategory("Mobiles & Tablets");
        $SingleProduct->SetProductSubCategory("Mobile Cases & Covers");
        
         
 
		$SingleProduct->SetProductDetailUrl($item->find("div[class=product-tuple-image] a",0)->href);
		$SingleProduct->SetImgUrl($item->find("div[class=product-tuple-image] a img[class=product-image]",0)->src);     
		echo "TEST";
		echo '<pre>';
		print_r($SingleProduct);
		echo '<pre>';
		echo "TEST";
		//return;
		
		foreach($item->find('div[class=product-tuple-description]') as $productDetailsData)
		{
			// here i left
			echo $productDetailsData->find('a p[class=product-title]');			
			$SingleProduct->SetProductName($productDetailsData->find('p[class=product-title]')->plaintext);
		}
		
		
		
			foreach($item->find('div[class=product-price]') as $priceData){	

				$price = $priceData->find("p",0)->plaintext;
				$SingleProduct->SetProductPrice($price);
				if($priceData->find("p",1)!=NULL){
				$before_dis_price=$priceData->find("strike",0)->plaintext;
						$dis_percent=$priceData->find("span[class=percDesc]",0)->plaintext;

						$SingleProduct->SetProductBeforeDiscounePrice($before_dis_price);
						$SingleProduct->SetDiscountDetails($dis_percent);
				}
				else{
						$SingleProduct->SetProductBeforeDiscounePrice("NA");
						$SingleProduct->SetDiscountDetails("NA");
				}

				if($priceData->find("p[class=emiMonthsHoverGrid]",0)!=NULL){
						$SingleProduct->SetEmi("1");
						$emidetails=$priceData->find("p[class=emiMonthsHoverGrid]",0)->plaintext;
						$SingleProduct->SetEmiDetails($emidetails);
						//echo $priceData->find("p[class=emiMonthsHoverGrid]",0)->plaintext;
				}
				else{
						$SingleProduct->SetEmi("NA");			
						$SingleProduct->SetEmiDetails("NA");
				}

				if($priceData->find("div[class=ratingStarsSmall corrClass8] span[class=lfloat fnt12 ratingCount]",0)!=NULL){
						$SingleProduct->SetProductRating($priceData->find("div[class=ratingStarsSmall corrClass8] span[class=lfloat fnt12 ratingCount]",0)->plaintext);
						//echo $SingleProduct->GetProductRating();
				}
				else{
						$SingleProduct->SetProductRating("NA");
				}
			} 
		$features=$item->find("div[class=lfloat product_list_view_highlights]",0);        
		if($features!=NULL){
			//echo $features;
			$i=0;
			$conDataAll="";
			foreach ($features->find('ul[id=highLights] li') as $feature_item){
					//echo "item ".$i."-->".$feature_item."</br>";
					if($i==0){
						$conDataAll.=$feature_item->plaintext;
					}
					else{
						$conDataAll.=",".$feature_item->plaintext;
					}
					$i++;
			}
			//echo $conDataAll."</br>";        
			$SingleProduct->SetProductFeatures($conDataAll);
		}
		else{
			$SingleProduct->SetProductFeatures("NA");
		}
		
		/*        echo 'This is NOT SOLD OUT PRODUCT';
		echo '<pre>';
		print_r($SingleProduct);         
		echo '<pre>';
		*/
		//echo $SingleProduct->GetProductDetailUrl();
		
		echo "<hr></br>";
		echo $SingleProduct->GetProductPrice()."dis-price".$SingleProduct->GetProductBeforeDiscounePrice()."dis_percen".$SingleProduct->GetDiscountDetails()."</br>"."EMI Has:".$SingleProduct->GetEmi()."EMI Details".$SingleProduct->GetEmiDetails()."Features : ".$SingleProduct->GetProductFeatures()."HREF: ".$SingleProduct->GetProductDetailUrl();       
		echo "<hr></br>";

    
      
       $DataAccess = new DataaccessHelper();     
       clsProductsManager::InsertProducts($SingleProduct);
	   }
	   
	   $counter++;
      
}

//echo "Total inserted :".$counter*3;

//echo 'Last :       '. date('Y-m-d') ."\n";




?>
