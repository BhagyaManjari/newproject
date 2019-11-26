<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/26/19
 * Time: 9:38 PM
 */

require ('utils/database_api.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $issuccess = registerUser($link);
    echo $issuccess;
}

function registerUser($link) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $contact_number = $_POST['contact_number'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    if (!empty($username) && !empty($password) && !empty($contact_number) && !empty($city) && !empty($email) && !empty($user_type)) {

        $query = "INSERT INTO users (username, password, contact_number, city, email, user_type) VALUES('".$username."', '".$password."', '".$contact_number."', '".$city."', '".$email."', '".$user_type."')";

        if (mysqli_query($link, $query)) {
            return true;
        }

    }

    return false;
}

?>