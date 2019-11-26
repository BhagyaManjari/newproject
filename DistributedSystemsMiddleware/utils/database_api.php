<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/26/19
 * Time: 9:36 PM
 */

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'distributed_systems_db';
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {
    //echo 'db connected!';
}

?>