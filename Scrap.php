<?php

require 'parser/simple_html_dom.php';

$url = "http://admin.spotloan.com/servicing/loans/5972339";

/*$context = stream_context_create(array(
    'http' => array(
        'header' => array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201'),
    ),
));
*/

echo file_get_html($url)->plaintext; 

// $url = parse_url($url);
// echo $url;
 
// var_dump($url);
 
 
//$html = str_get_html($url, false, $context);

//echo $html;

/*
$loan_info = $html->find('div[class=loan-info]');

foreach ($loan_info as $element) {
    $balnace = $element->find("td.value",0);
    
    echo $balnace."\n";
}
*/

