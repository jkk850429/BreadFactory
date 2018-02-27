<?php
require("dbconnect.php");
function checkUser($uID, $Pwd) {
	global $conn;
	$uID = mysqli_real_escape_string($conn,$uID); // 防止SQL注入攻擊 
	$sql = "SELECT pwd FROM user WHERE user_id='$uID'";
	if ($result = mysqli_query($conn,$sql)) { //SQL真正執行
		if ($row=mysqli_fetch_assoc($result)) {
			if ($row['pwd'] === $Pwd) {
				return 1; //藉由User.php去判斷User角色
			} 
		}
	}
	//-1 ==> fail
	return -1;
}

?>