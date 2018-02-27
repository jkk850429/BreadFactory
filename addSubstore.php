<?php
require("dbconnect.php");
require("function.php");
global $conn;

//抓user全部資料
global $conn;
$sql_u ="select * from user"; 
$result_u = mysqli_query($conn,$sql_u);  //SQL真正執行
$row_u=mysqli_fetch_assoc($result_u); //抓到現金

echo '新增分店前總金額：'.$row_u['Cash']."\n"; // undefine
$newSubCo = rand(50000,100000); //新增分店花費
echo '新增分店所需費用：'.$newSubCo."\n";
if($row_u['Cash'] > $newSubCo){ //可否順利新增的判斷 //undefine
	$cashafter = $row_u['Cash'] - $newSubCo; //新增分店後總金額估算變數－$cashafter
} else {
	exit(0);
}

//1. update總金額  為  $cashafter = $row['cash'] > $newSubCo;

$sql_sub = "UPDATE user SET Cash = '$cashafter' WHERE user_id = 'jc'";
$result_sub = mysqli_query($conn,$sql_sub);
// 總金額update完成
$row_newCash = checkCash();//重新select User資料，特抓cash一次確認
echo '新增分店後總金額：'.$row_newCash['Cash']."\n";

//2. 新增分店資料
$sql ="insert into substore (p1Num, p2Num, p3num, p1lim, p2lim, p3lim) values (0,0,0,70,70,70)"; //insert 一筆新的
if ($result = mysqli_query($conn,$sql)){
	return "success";
} //SQL真正執行

?>










