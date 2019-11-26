<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/28/19
 * Time: 2:35 AM
 */

require ('utils/database_api.php');
require ('PHPMailer-master/PHPMailerAutoload.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $issuccess = createOrder($link);
    echo $issuccess;
}

function createOrder($link) {

    $address = $_POST['address'];
    $city = $_POST['city'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $confirm_status = $_POST['confirm_status'];
    $buyer_username = $_POST['buyer_username'];
    $product_id = $_POST['product_id'];
    $email = $_POST['email'];

    if (!empty($address) && !empty($city) && !empty($quantity) && !empty($total_price) && !empty($confirm_status) && !empty($buyer_username) && !empty($product_id)) {

        $query = "INSERT INTO orders (address, city, quantity, total_price, confirm_status, buyer_username, product_id) VALUES ('".$address."', '".$city."', '".$quantity."', '".$total_price."', '".$confirm_status."', '".$buyer_username."', '".$product_id."')";

        if (mysqli_query($link, $query)) {

            $mail = new PHPMailer();

            $email_account = 'janakaranaweerawebtest@gmail.com';
            $email_password = 'Janaka@1234';

            try{

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $email_account;
                $mail->Password = $email_password;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom($email_account, 'Foodies PVT LTD');
                $mail->addAddress($email, 'User');
                $mail->Subject = 'Confirm email';
                $mail->Body    = "Your order is successful.";
                $mail->send();

            }catch (Exception $e) {
                echo "failed ".$e;
            }

            return true;
        }

    }

    return false;
}


?>