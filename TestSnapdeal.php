<?php
set_time_limit(0);
include_once('../simple_html_dom.php');
//http://www.snapdeal.com/products/mobiles-tablets#bcrumbLabelId:175
$innerHtml = file_get_html("http://www.snapdeal.com/products/mobiles");
echo $innerHtml;
?>