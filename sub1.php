<?php
session_start();
require("dbconnect.php");
require("function.php");
// $id = $_GET['ID']; 蘇or崇浩吧
if (! isset($_SESSION["uID"]))
	$_SESSION["uID"] = "";
//echo $_SESSION["uID"];
if ( $_SESSION["uID"] < " ") {
	//header("Location: login.php");
	echo "Please Login. <a href='loginForm.php'>Login</a>";
	exit(0);
}
$a=$_POST['substore1'];
//$a=$_GET['getsID'];
$number=subNum($a); //宣告一變數存字串
$num=checkNum(); //宣告一變數存字串
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">
</script>
<head>分店<?php echo "$a"?></head>
<?php  
	/* 崇浩區
	for($i = 0 ;$i < arr.length;$i++)
	{
		$tmp = $i+1;
		echo "<p>store "$tmp"</p>";
		echo product a product b 
		echo product num 
		echo <input type="button" value="訂購商品" onclick="location.href='buy.php?id=".$i."'">
	} */
?>
<table border="1" width="500">

<tr><td>商品</td><td>目前庫存</td><td>上限</td><td>總店庫存</td><td>售價</td></tr>
<tr><td>草莓甜甜圈</td><td><?php echo $number['p1Num']?></td><td><?php echo $number['p1lim']?></td><td><?php echo $num['p1Num']?></td><td>90</td></tr>
<tr><td>香蒜麵包</td><td><?php echo $number['p2Num']?></td><td><?php echo $number['p2lim']?></td><td><?php echo $num['p2Num']?></td><td>100</td></tr>
<tr><td>波蘿麵包</td><td><?php echo $number['p3Num']?></td><td><?php echo $number['p3lim']?></td><td><?php echo $num['p3Num']?></td><td>85</td></tr>
</table>

<br/><input type="button" value="訂購商品" onclick="location.href='buy.php?id=<?php echo "$a"?>'">
     <input type="button" value="回到上頁" onclick="location.href='index.php'">
</html>