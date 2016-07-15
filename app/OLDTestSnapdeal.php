<?php
set_time_limit(0);
include_once('../simple_html_dom.php');
include_once ('../objects/clsProduct.php');
include_once ('../Manager/clsProductsManager.php');

$url="file:///E:/Dropbox/SnapDeal/snapdeal/target/try.html";
$innerHtml = file_get_html($url);
$ProductArray=NULL;
$SingleProduct=NULL;
echo $innerHtml;
return;

//echo 'Now:       '. date('Y-m-d') ."\n";

$counter =0;

foreach($innerHtml->find('div[class=product_grid_row]') as $mitem)
 {        
	
	foreach($mitem->find('div[class=productWrapper]') as $item)
    {
        //echo $item;

         $SingleProduct=new product();
         /**
         * PLease add the category & SubCategory
         */
        
        //echo "URL ::". $innerHtml->find("div[class=productWrapper] a",0)->href;
		
        $SingleProduct->SetProductCategory("Mobiles & Tablets");
        $SingleProduct->SetProductSubCategory("Mobile Cases & Covers");
        
        if($item->find('div[class=product-image prodSoldout]')){
//product-image
                            $SingleProduct->SetProductDetailUrl($item->find("a",0)->href);
                            $SingleProduct->SetImgUrl($item->find("div[class=productWrapper] div[class=product-image prodSoldout] a img",0)->src);        
                            foreach($item->find('p[class=product-title]') as $title){	
                                            $SingleProduct->SetProductName($title->plaintext);
                                            //echo $SingleProduct->GetProductName();
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

    /*        echo 'This is SOLD OUT PRODUCT';
            echo '<pre>';
            print_r($SingleProduct);         
            echo '<pre>';
	*/
        }
       
        else{                
                            $SingleProduct->SetProductDetailUrl($item->find("a",0)->href);
                            $SingleProduct->SetImgUrl($item->find("img[class=gridViewImage]",0)->src);        
                            foreach($item->find('p[class=product-title]') as $title){	
                                            $SingleProduct->SetProductName($title->plaintext);
                                            //echo $SingleProduct->GetProductName();
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
       }
    
      
       $DataAccess = new DataaccessHelper();     
       clsProductsManager::InsertProducts($SingleProduct);
	   }
	   
	   $counter++;
      
}

echo "Total inserted :".$counter*3;

//echo 'Last :       '. date('Y-m-d') ."\n";




?>
