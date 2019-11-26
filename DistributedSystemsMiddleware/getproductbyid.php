<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/28/19
 * Time: 10:58 AM
 */

require ('utils/database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $orders = getProduct($link);
    echo $orders;
}

function getProduct($link) {
    $id = $_POST['id'];
    if (!empty($id)) {
        $query = "SELECT * FROM products WHERE id = '" . $id ."'";

        $result = mysqli_query($link, $query);

        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                header('Content-Type: application/json');
                echo json_encode($row);
            }
        }
    }
}

?>