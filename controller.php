<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>
</head>
<body>
<script language="javascript">
//應用方式：點一個按鈕，購買：
//  1. 先扣錢  2. 更新資料庫訂單，訂貨時間
//  3. 甲商品數量直接變更

// 1. select到貨時間  如果進貨時間已到的話(javascript計算)，  顯示出東西增加(javascript計算)（還不會，語法上使用上）
//其他問題： 我現在訂單 for時  全部走過？

//onclick時呼叫handleBomb()  按鈕後開始計時一分鐘
//所以這邊 handleBomb似乎沒用到  

// 到貨時，圖片會顯現在controller    按後NaN
//提供一個訂單清空功能

// innerHTML  取得id 並加上onclick
/*
function handleBomb(oID) { 
	now=new Date(); //get the current time
	tday=new Date(myArray[oID]['aTime'])
	console.log(now, tday)  //協助debug 主控台可看
	if (tday <= now) {
		//alert('exploded');
		//use jQuery ajax to reset timer
		$.ajax({
			url: "json.php",
			dataType: 'html',
			type: 'POST',
			//原本 id: myArray[oID]['id']
			data: { id: myArray[oID]['oID']}, //optional, you can send field1=10, field2='abc' to URL by this
			error: function(response) { //the call back function when ajax call fails
				alert('Ajax request failed!');
				},
			success: function(txt) { //the call back function when ajax call succeed
				// json.php執行成功後的傳回值是txt
				// Ajax 應用可以僅向伺服器傳送並取回指定資料
				// 用於"點擊按鈕"時
				alert("order" + oID + ": " + txt);
				//myArray[bombID]['expire']=txt;
				myArray[oID]['aTime']=txt;
				}
		});
	
	} else {
		alert("counting down, be patient.")
	}
}

function checkOrder() {   
	now= new Date(); //get the current time
	//check each bomb with a for loop
	console.log(myArray);
	for (i=0; i < myArray.length;i++) {	
		//convert the date string into date object in javascript
		tday=new Date(myArray[i]['aTime']); 
		//用二維陣列的原因  是因為  一個Bomb有他的各個欄位
		if (tday >= now) { 
			// expired, set the waiting image and text
			$("#order" + i).attr('src',"images/doughnut.jpg");
			$("#timer"+i).html("arrived!"); // 現在沒算時間  直接arrive

		} else {
			//set the bomb image  and calculate count down
			//沒爆炸  給圖  給剩餘時間
			$("#order" + i).attr('src',"images/waiting.jpg");
			$("#timer"+i).html(Math.floor((tday-now)/1000))			
		}
	}
}

//javascript, to set the timer on windows load event
// onload 會在網頁載入完成後立即執行，告訴特定的 function 開始工作
window.onload = function () {
	//check the bomb status every 1 second
	//  持續去 checkBomb 一爆就handle
    setInterval(function () {
		checkOrder()
    }, 1000);
};
			</script>
*/
</body>

<?php
session_start();// 啟用session  可以拿伺服器端的東西
require("dbconnect.php");
require("User.php");
require("function.php");

if(! isset($_POST["act"])) {
	exit(0); //離開PHP程式了，所以下面的程式都不會執行
}
$act =$_POST["act"];

switch($act) {
	case "buy":
		$a=$_POST['substore1'];
		$b=$_GET['id'];
		$number = subNum($a); //宣告一變數存字串 "select * from substore" ; 
        $num = checkNum(); //宣告一變數存字串 "select * from mainstore" ;
		$buy1 = $_POST["buy1"];
	    $buy2 = $_POST["buy2"];
	    $buy3 = $_POST["buy3"];

		if ($buy1>=0 && $buy2>=0 && $buy3>=0) { //if title is not empty
			if (buy($buy1,$buy2,$buy3,$number,$num,$b)) {
				echo( "OK");
				echo "<a href='index.php'>Return HomePage</a>";
			} else {
				echo( "訂貨失敗");
				echo "<a href='index.php'>Return HomePage</a>";
			}
		} else {
			echo "錯誤的數字!!";
		}
		break;
	case "login":
		$loginName = $_POST['id'];
		$password = $_POST['pwd'];
		$role=checkUser($loginName, $password); //loginName
		if ( $role> -1 ) { // User.php內設定  -1代表登入失敗
			//set login session mark
			$_SESSION['uID'] = $loginName;
			$_SESSION['role'] = $role;
			echo "login OK<br>";
			echo "<a href='./'>Home</a>";
		} else {
			//set login mark to empty
			$_SESSION['uID'] = "";
			$_SESSION['role'] = -1;
			echo "Login failed.<br>";
			echo "<a href='loginForm.php'>login</a>";
		}
		break;
	case "purchase":
		$id = $_POST['pID'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
		$uID = $_SESSION['uID'] ;
		$getid=$_GET['id'];
		echo '玩家'.$uID."<br>"; 
		echo '訂購的數量為: '.$quantity."<br>"; 
		echo '單位成本為: '.$price."<br>"; 
		
		//1. $ 「先確認錢夠不夠」    先選使用的錢  然後跟 $quantity * $price 比較
		// 此為 model 成型時用MVC寫
		$sql1 =" select Cash from user where user_id = '$uID' ";
		$result1 = mysqli_query($conn,$sql1); //執行
		/* while ($row1=mysqli_fetch_assoc($result1) ){ //每讀一次  就抓一筆  給row
			//現在沒用，以前是利用while印出一筆一筆的資料，
			} 	
		*/
		$row1 = mysqli_fetch_assoc($result1); //我們只有一筆，直接抓就好  這一筆是顯示Cash
		echo '玩家原本現金為：'.$row1['Cash']."<br>";  ;
		$Tprice = $quantity * $price; // $Tprice 是訂單總金額

		if ($row1['Cash'] >= $Tprice) {
			// Cash - ($quantity * $price)
			$Aprice = $row1['Cash'] - $Tprice; // $Aprice 更新後玩家Cash
			$sql2 = "update user set Cash = $Aprice";
			$result2 = mysqli_query($conn,$sql2); //執行
			
			$sql6 =" select Cash from user where user_id = '$uID' ";
			$result6 = mysqli_query($conn,$sql6); //執行
			$row6 = mysqli_fetch_assoc($result6);
			echo '訂購後，玩家現金為：'.$row6['Cash']."<br>";  
			
			// 2. 新增訂單資料 ， P.S. 到貨時間 = 現在時間 + 固定周期， $newT為到貨時間
			
			// 3.  總店的甲商品數量變更
			//先抓p1Num  再加上$quantity
		if($getid==1)	{
			$newT1 = date("Y-m-d H:i:s",strtotime("+420 minutes 200 seconds"));  
			echo '到貨時間為：'.$newT1."<br>";  // echo $newT到貨時間 測試
			$sql35 = " insert into orderr (pID, number, aTime, amount) values ('$id', '$quantity', '$newT1', $Tprice)";
			$result35 = mysqli_query($conn,$sql35) or die('新增訂單發生錯誤'); // 執行
			$sql45 = "select p1Num from mainstore where loginID = '$uID'";
			$result45 = mysqli_query($conn,$sql45); //執行
			$row45 = mysqli_fetch_assoc($result45); //抓一筆給row4  is  p1Num跟其值
			$Newnum = $row45['p1Num'] + $quantity ;
			$sql55 = "UPDATE mainstore SET p1Num = '$Newnum' where loginID = '$uID'";
			$now = date("Y-m-d H:i:s");
			//if($newT1<=$now){
			$result55 = mysqli_query($conn,$sql55); //執行
			//}
			echo '到貨後，總店草莓甜甜圈數量為：'.$Newnum."<br>"; 
		    header("refresh:5;url=index.php");
        }else if($getid==2) {
		    $newT2 = date("Y-m-d H:i:s",strtotime("+420 minutes 180 seconds"));  
			echo '到貨時間為：'.$newT2."<br>";  // echo $newT到貨時間 測試
			$sql36 = " insert into orderr (pID, number, aTime, amount) values ('$id', '$quantity', '$newT2', $Tprice)";
			$result36 = mysqli_query($conn,$sql36) or die('新增訂單發生錯誤'); // 執行
			$sql86 = "select p2Num from mainstore where loginID = '$uID'";
			$result86 = mysqli_query($conn,$sql86); //執行
			$row86 = mysqli_fetch_assoc($result86); //抓一筆給row4  is  p1Num跟其值
			$Newnum = $row86['p2Num'] + $quantity ;
			$sql96 = "UPDATE mainstore SET p2Num = '$Newnum' where loginID = '$uID'";
			$result96 = mysqli_query($conn,$sql96); //執行
			echo '到貨後，總店香蒜麵包數量為：'.$Newnum."<br>"; 
		    header("refresh:5;url=index.php");
		}else if($getid==3) {
		    $newT3 = date("Y-m-d H:i:s",strtotime("+420 minutes 230 seconds"));  
			echo '到貨時間為：'.$newT3."<br>";  // echo $newT到貨時間 測試
			$sql34 = " insert into orderr (pID, number, aTime, amount) values ('$id', '$quantity', '$newT3', $Tprice)";
			$result34 = mysqli_query($conn,$sql34) or die('新增訂單發生錯誤'); // 執行
			$sql134 = "select p3Num from mainstore where loginID = '$uID'";
			$result134 = mysqli_query($conn,$sql134); //執行
			$row134 = mysqli_fetch_assoc($result134); //抓一筆給row4  is  p1Num跟其值
			$Newnum = $row134['p3Num'] + $quantity ;
			$sql144 = "UPDATE mainstore SET p3Num = '$Newnum' where loginID = '$uID'";
			$result144 = mysqli_query($conn,$sql144); //執行
			echo '到貨後，總店波蘿麵包數量為：'.$Newnum."<br>"; 
		    header("refresh:5;url=index.php");
		}
			?>

			<?php
				//print the bomb array to the web page as a javascript object
				//PHP 的 json_encode() 非常好用，很適合拿來與 JavaScript 協同運作
				//例如直接將資料庫查詢出來的陣列資料，轉換成 JSON 格式，提供給 JavaScript 來存取， 或透過 AJAX 技巧作資料交換等。
				//echo "var myArray=" . json_encode($arr);
				//這一句真正印出陣列內容的動作是在Javascript ，  所以<script></script>包著
			?>
			</script>
        
		<?php
		} else {
			echo "金錢不足";
		}
		break;

}
?>
</html>
<!--header('refresh: 3;url="index.php"')      自動重整頁面  -->