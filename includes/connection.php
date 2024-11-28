<?php 
$hostName ="localhost";
$username ="root";
$password ="";
$dbName ="library_management_system";

$conn = new mysqli($hostName, $username, $password, $dbName);
if(!$conn) {
    die('connection_error');
}
return $conn; 
?>