<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/28/19
 * Time: 11:58 AM
 */

$url = 'http://localhost/DistributedSystemsMiddleware/getproductbyid.php';

//url-ify the data for the POST
$fields_string = "id=1";

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

echo $result;
?>