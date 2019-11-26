<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/28/19
 * Time: 9:41 PM
 */

require ('utils/database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $orders = updateStatus($link);
    echo $orders;
}

function updateStatus($link) {

    $status = $_POST['status'];
    $id = $_POST['id'];

    $query = "UPDATE orders SET confirm_status = '" .$status. "' WHERE id = '" . $id . "'";

    if (mysqli_query($link, $query)) {
        return true;
    }

    return false;

}

?>