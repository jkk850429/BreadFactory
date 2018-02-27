<?php 
require "dbconnect.php";
$i=(int)$_POST["id"];
$newD = date("Y-m-d H:i:s",strtotime("+425 minutes"));
$sql="update orderr set aTime ='$newD' where pID=$i";
$res=mysqli_query($db,$sql) or die("db error");
echo $newD; //;
?>
