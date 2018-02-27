<?php
session_start();
//require("dbconnect.php");
/*if (! isset($_SESSION["uID"]))
	$_SESSION["uID"] = "";
//echo $_SESSION["uID"];
if ( $_SESSION["uID"] < " ") {
	//header("Location: login.php");
	echo "Please Login. <a href='loginForm.php'>Login</a>";
	exit(0);
}
*/
$id=$_GET['id'];
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">
</script>
<h1>分店<?php echo"$id"?>訂購商品</h1>
p.s.若無輸入代表該項目訂貨數量為0 !! <br/><br/>
<form method="post" action="controller.php?id=<?php echo"$id"?>">
  <input type="hidden" name="act" value="buy">
甲：<input name="buy1" type="text" size="5" maxlength="5" id="$buy1" />個<br/>
乙：<input name="buy2" type="text" size="5" maxlength="5" id="$buy2" />個<br/>
丙：<input name="buy3" type="text" size="5" maxlength="5" id="$buy3" />個<br/>

<input type="Submit" name="buysub" value="送出">
</html>