<?php 
set_time_limit(0);
include_once('simple_html_dom.php');
// Create DOM from URL or file
$html = file_get_html('http://www.google.com/');

//echo $html;
//0,1,2
foreach ($html->find('span[id=footer] p a') as $data){
	echo $data->plaintext;
}



/*
// Find all images
foreach($html->find('img') as $element)
       echo $element->src . '<br>';

// Find all links
foreach($html->find('a') as $element)
       echo $element->href . '<br>';
*/
?>