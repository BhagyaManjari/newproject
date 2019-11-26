<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/26/19
 * Time: 10:29 PM
 */

require ('utils/database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user = loginUser($link);
    echo $user;
}

function loginUser($link) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {

        $query = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";

        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {

                return json_encode($row);

            }
        }

    }

    return null;
}
?>