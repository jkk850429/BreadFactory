<?php 
require ('dbconnect.php');
global $conn;
$sID = (int)$_POST["sid"];
echo '分店：'.$sID."<br>";
// 抓
//問題是，數量會增加

// 先想資料庫處理
// 步驟：V商品、V數量、V單價、V算出銷售額
//      庫存數量變化、  User金額更新

$pID = rand(1,3); //	「產品編號1,2,3隨機選一個」
//		變形p__Num名稱 如下
$PID = 'p'.$pID.'Num'; 
$sellNum = rand(1,2); //	「賣出數量」

//原本庫存
$sql_1 = "select $PID from substore where sID = $sID"; //某家分店的某商品庫存
//		語法邏輯  字串內放$PID  不用單引號

$res_1 = mysqli_query($conn,$sql_1) or die("db error"); 
$row_1 = mysqli_fetch_assoc($res_1) ;
//已抓到賣出前庫存數量
echo '銷售前庫存數量：'.$row_1[$PID]."<br>";
if ($row_1[$PID] > 0) {
	$newNum = $row_1[$PID] - $sellNum;

	if ($newNum >= 0){
		$sql_2= "UPDATE substore SET $PID = '$newNum' WHERE sID = $sID";//更新庫存數量
		$res_2 = mysqli_query($conn,$sql_2) or die("db error"); 
		echo '銷售後庫存數量：'.$newNum."<br>";

		// 「抓出商品單價
		$sql_3 = "select price from product where pID = '$pID'" ;
		// 語法邏輯  字串內放$pID數字  要單引號，  他會依據"先成為數字，後依據'成為純字串
		$res_3 = mysqli_query($conn,$sql_3) or die("db error") ; 
		$row_3 = mysqli_fetch_assoc($res_3) ;
		echo '商品單價：'.$row_3['price']."<br>";
		$price = $row_3['price'];
		// 已抓出商品單價」

		// 「計算銷售額 與 更新資料庫內總現金
		//		計算銷售額 $sales 
		$sales = $price * $sellNum; 
		echo '銷售額：'.$sales."<br>";

		//		銷售前，玩家總現金
		$sql_4 = "select cash from user where user_id = 'jc'" ; 
		$res_4 = mysqli_query($conn,$sql_4) or die("db error") ; 
		$row_4 = mysqli_fetch_assoc($res_4) ;
		//		已抓到銷售前玩家總現金
		echo '銷售前玩家總現金：'.$row_4['cash']."<br>";

		$newCash = $row_4['cash'] + $sales ;
		echo '銷售後玩家總現金：'.$newCash."<br>";

		$sql_5 = "UPDATE user SET cash = '$newCash' WHERE user_id = 'jc'";//更新金錢
		$res_5 = mysqli_query($conn,$sql_5) or die("db error"); //之後重新select cash

	}
} 
//		銷售後，玩家總現金
$sql_6 = "select cash from user where user_id = 'jc'" ; 
$res_6 = mysqli_query($conn,$sql_6) or die("db error") ; 
$row_6 = mysqli_fetch_assoc($res_6) ;
return $row_6['cash'];
// 計算銷售額完成、更新資料庫完成」




/* Debug專用
echo '商品編號：'.$pID."<br>";
echo $PID."<br>";//是否變形成功
echo '賣出前數量：'.$row_1[$PID]; //印出抓出的欄位值
echo "<br>";
print_r($row_1);
*/