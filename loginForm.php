<?php
session_start();
//set the login mark to empty
$_SESSION['uID'] = "";
?>
<h1>Login Form</h1><hr />
<form method="post" action="controller.php">
<input type="hidden" name="act" value="login">
User Name: <input type="text" name="id" value="jc"><br />
Password : <input type="password" name="pwd" value="123"><br /> 
<!--  type="password" 會把輸入的字檔起來 -->
<input type="submit">
</form>