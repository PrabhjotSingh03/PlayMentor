<?php
//$servername = 'localhost'; // or 127.0.0.1
//$username = 'root'; // default username for XAMPP
//$password = ''; // default password is empty

// If we would like to use InfinityFree phpMyAdmin
$hostname = 'sql109.epizy.com';
$username = 'epiz_34301171';
$password = 'JtQuL2g5nw';
$database = 'epiz_34301171_playmentor';
$con = mysqli_connect($hostname, $username, $password, $database);

// Create a connection
//$con = new mysqli($servername, $username, $password);
if ($con->connect_error) {
    die('Connection ERROR:');
    echo 'Connection Failed';
}

?>