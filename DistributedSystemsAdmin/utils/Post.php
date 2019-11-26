<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/28/19
 * Time: 2:50 PM
 */

function createPostRequest($url, $params) {
//open connection
    $ch = curl_init();

//set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute post
    $result = curl_exec($ch);

//close connection
    curl_close($ch);

    return $result;
}

?>