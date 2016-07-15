<?php
error_reporting(0);
include_once('databaseHelper.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Grabber</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://raw.githubusercontent.com/padolsey/jquery.fn/master/cross-domain-ajax/jquery.xdomainajax.js"></script>
	<script type="text/javascript"> //<![CDATA[ 
	
		function ontableselect(table) {
			//var element = document.getElementById("url");
			//element.value = language;
			//element.innerHTML = language;
			//alert(table);
			window.location = "DataGrabberHelper.php?tablename=" + table;								
		}
		
		function getURLParameter(name) {
		return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
		}
	
		function GetSourceFromURL(url,id){
			$.get(url, function(data) {    
				//$('#container').html(data);
				ShowData(data.responseText,id);	
			});
		}
		
		function ShowData(data,theid)
		{
		  //alert(data);
		  //document.getElementById('debug').value = data;
		  
		  var parser=new DOMParser();
		  var xmlDoc=parser.parseFromString(data,"text/html");
		  var datafound = xmlDoc.getElementsByClassName("pdp-section product-specs");
		  var iden = theid.charAt(theid.length-1);
		  //var elements = data.getElementsByClassName('comp comp-product-specs');
		 // for(var i=0;i<datafound.length;i++){
		  
			document.getElementById('id'+iden).value = datafound[0].innerHTML;
			//$('id'+iden).html(datafound[i].innerHTML)
		 // }  
		}
	
		function SaveData(id)
		{
			  //GetSourceFromURL(url,id);
			  var tablename = getURLParameter('tablename');  // this thing will come from the html in final version
			  //alert(tablename);
			  var idName = "id"+id;
			  var idNameProdContainer = "prod_container"+id;	
			  var postvalue= document.getElementById(idName).value;
			  var classNameprod="prod"+id;
			  var elementProductID = document.getElementsByClassName(classNameprod);

			  
			  var postProdID = "";
			  //for(var i=0;i<element.length;i++)
			  // {
			     //alert(element[i].value);
			     //postValue = element[i].value;
			  // }
			   for(var i=0;i<elementProductID.length;i++)
			   {
			   	 postProdID = elementProductID[i].innerHTML;
			   }
			
			if(!tablename || !postvalue)
			{
				//!postvalue ||
			    //alert("Table name or Post value is empty !");
				
				var xhttp = new XMLHttpRequest();
					var params = 'value=' + encodeURIComponent(postvalue) +'&tablename=' + tablename +'&id='+ postProdID;			
					xhttp.open("POST", 'spec_crawler_fail.php?', true);   
				 
					//Send the proper header information along with the request
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.setRequestHeader("Content-length", params.length);
					xhttp.setRequestHeader("Connection", "close");

				  
					xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
					 var response = xhttp.responseText;
					 //alert(xhttp.responseText);
					 //alert(postProdID+" ->Saved successfully!");
					 // if(response!=null)
					 // {
						document.getElementById(idNameProdContainer).style.backgroundColor="#793862";
						document.getElementById(id).disabled = true;					
					//  }
					 }
				   };
				  xhttp.send(params);
				
			}
			else
			{
					var xhttp = new XMLHttpRequest();
					var params = 'value=' + encodeURIComponent(postvalue) +'&tablename=' + tablename +'&id='+ postProdID;			
					xhttp.open("POST", 'spec_crawler.php?', true);   
				 
					//Send the proper header information along with the request
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.setRequestHeader("Content-length", params.length);
					xhttp.setRequestHeader("Connection", "close");

				  
					xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
					 var response = xhttp.responseText;
					 //alert(xhttp.responseText);
					 //alert(postProdID+" ->Saved successfully!");
					 // if(response!=null)
					 // {
						document.getElementById(idNameProdContainer).style.backgroundColor="#D4FFAA";
						document.getElementById(id).disabled = true;					
					//  }
					 }
				   };
				  xhttp.send(params);
			}
			  //xhttp.open("GET", 'spec_crawler.php?value='+encodeURIComponent(postvalue)+'&tablename='+encodeURIComponent(tablename)+'&id='+encodeURIComponent(postProdID), true);
			  //xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     		  //xhttp.send();	 			
		}

		//]]> 
	</script>
</head>
<body>

     <select onchange="ontableselect(this.value)">

         <option value="Choose one" selected="selected">Choose one</option>

        <?php
		$i=1;
        // A sample product array
        $listTables = GetTables();
        // Iterating through the product array
        foreach($listTables as $item){
			echo $item;
        ?>
        <option value="<?php echo strtolower($item); ?>"><?php echo $item; ?></option>
        <?php
			$i++;
        }

        ?>

    </select>

<?php
include_once('databaseHelper.php');
$products = GetData($_GET["tablename"]);
//echo "<pre>";
//print_r();
//echo "</pre>";
$i=0;
foreach ($products as $singleProduct) {
	if($singleProduct!=null)
	{	echo "<pre>";
		//print_r($singleProduct);
		echo "</pre>";
?>
		<div id="<?php echo "prod_container".$i;?>" style="border-top: 1px solid;border-bottom: 1px solid;background-color:#FF557F;">
			<div>
				<div class="<?php echo "prod".$i;?>"><?php echo $singleProduct["product_id"]; ?></div>
				<div><?php echo $singleProduct["product_name"]; ?></div>
				<div><?php echo $singleProduct["product_details_url"]; ?></div>
					<a href="<?php echo $singleProduct["product_details_url"];?>"> Open Spec </a>
				<div><textarea id="<?php echo "id".$i;?>" rows="4" cols="50"></textarea>				
				<div><button id="<?php echo $i;?>" onclick="SaveData(this.id);">Save Spec</button></textarea>				
				<div style="float: left;">
					<button id="<?php echo "btn".$i; $i++; ?>" onclick="GetSourceFromURL('<?php echo $singleProduct["product_details_url"];?>',this.id)">Click me</button> 
					<!--<textarea id="<?php //echo "debug".$i;?>"></textarea>-->
				</div>
			</div> 
		</div>	
<?php
	}
}

//GetTables();

function GetTables()
{
//	$dbHelper = new DataaccessHelper();
//	$sql = "SHOW TABLES FROM fn_sd";
//	$result = $dbHelper->ExecuteDataSet($sql);	

	
//	return $result;

	$tables = array("books", "fitness", "food","health_care","hobbies","household_essentials","nutrition","personal_care","sports","sportswear");
	return $tables;
}

//The function below is used for getting the target list
function GetData($table_name)
{	$dbHelper = new DataaccessHelper();
	$sql= "SELECT product_id,product_name,product_details_url FROM ".$table_name." where iscompleted=0 LIMIT 10";
	//$sql = mysql_query("show tables");
	return $dbHelper->ExecuteDataSet($sql);
}

?>


</body>
</html>