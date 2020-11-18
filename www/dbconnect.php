<?php

ini_set('display_errors','1');

$server='localhost';
$user='root';
$password='';
$database='event_management';


$conn=mysqli_connect($server,$user,$password,$database);

if(mysqli_connect_errno())
{
echo "Connection failed";
exit();
}
?>