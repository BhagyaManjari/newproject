<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/28/19
 * Time: 9:05 AM
 */

require ('utils/database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $orders = getOrders($link);
    echo $orders;
}

function getOrders($link) {
    $username = $_POST['username'];

    if (!empty($username)) {
        $query = "SELECT * FROM orders WHERE buyer_username = '".$username."'";

        $result = mysqli_query($link, $query);

        $temp_array  = array();

        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $temp_array[] = $row;
            }
        }

        header('Content-Type: application/json');
        echo json_encode(array("orders"=>$temp_array));
    }


}

?>