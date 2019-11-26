<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/28/19
 * Time: 7:59 PM
 */

require ('utils/database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $orders = getOrder($link);
    echo $orders;
}

function getOrder($link) {
    $id = $_POST['id'];
    if (!empty($id)) {
        $query = "SELECT * FROM orders WHERE id = '" . $id ."'";

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