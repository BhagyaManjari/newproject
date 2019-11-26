<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/28/19
 * Time: 10:28 PM
 */

require ('utils/database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $issuccess = addProduct($link);
    echo $issuccess;
}

function addProduct($link) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $query = "INSERT INTO products (product_name, price, product_type, description) VALUES ('".$name."', '".$price."', '".$type."', '".$description."')";

    if (mysqli_query($link, $query)) {
        return true;
    }

    return false;
}

?>