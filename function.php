<?php
require("dbconnect.php");
function countSub(){ //統計分店數量
    global $conn;
	$sql = "select count(*) as 筆數1 from substore ";
	//筆數正常的是要讓他去處理賣東西
	// 筆數減二的是處理分店按鈕，  那分店按紐一、二可以拉走了
	
	if ($result = mysqli_query($conn,$sql)) { //SQL真正執行
		if ($row=mysqli_fetch_assoc($result)) {
			return $row['筆數1'];
		}
	}
}
function subNum($a) {
    global $conn;
    $sql ="select * from substore where sID='$a'";
    if ($result = mysqli_query($conn,$sql)) { //SQL真正執行
        if ($row=mysqli_fetch_assoc($result)) {
        return $row;
        }
    }
}
function checkNum() {
    global $conn;
    $sql ="select * from mainstore";
    if ($result = mysqli_query($conn,$sql)) { //SQL真正執行
        if ($row=mysqli_fetch_assoc($result)) {
        return $row;
        }
    }
}
function checkCash() {
    global $conn;
    $sql ="select * from user";
    if ($result = mysqli_query($conn,$sql)) { //SQL真正執行
        if ($row=mysqli_fetch_assoc($result)) {
        return $row;
        }
    }
}
function counter() {
    global $conn;
    $sql ="select count(sID) as 筆數 from substore"; //select(查詢)總共筆數
    if ($result = mysqli_query($conn,$sql)) { //SQL真正執行
        if ($row=mysqli_fetch_assoc($result)) {
        return $row['筆數']-2;
        }
    }
}
function search() {
    global $conn;
	$search=$_REQUEST["search"];
    $sql9 = "select * from worklist where skill like '%$search%';";
	return mysqli_query($conn,$sql9);
}

function buy($buy1,$buy2,$buy3,$number,$num,$b) {
    global $conn;
	$uID=$_SESSION['uID'];
	//$buy1 = $_POST["buy1"];
	//$buy2 = $_POST["buy2"];
	//$buy3 = $_POST["buy3"];
    //$number=subNum(); //宣告一變數存字串
    //$num=checkNum(); //宣告一變數存字串
	if($buy1 <= $num['p1Num'] && $buy2 <= $num['p2Num'] && $buy3 <= $num['p3Num']) {
		$sql10 = "update mainstore,substore set mainstore.p1Num =mainstore.p1Num-'$buy1' , mainstore.p2Num =mainstore.p2Num-'$buy2' , mainstore.p3Num=mainstore.p3Num-'$buy3', substore.p1Num=substore.p1Num+'$buy1' , substore.p2Num=substore.p2Num+'$buy2' , substore.p3Num=substore.p3Num+'$buy3' where mainstore.loginID='$uID' && substore.sID='$b'"; 
        //$sql11 = "update substore set p1Num+='$buy1' , p2Num+='$buy2' , p3Num+='$buy3'";		
        //$sql11 = "update substore set p1Num=p1Num+'$buy1' , p2Num=p2Num+'$buy2' , p3Num=p3Num+'$buy3' where sID='0'";
		
		return mysqli_query($conn, $sql10);
		//return mysqli_query($conn, $sql11);
	}else{
	    echo "不能比總店數量還多!";
	    return false;
	}
}
?>