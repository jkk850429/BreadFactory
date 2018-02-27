<?php
date_default_timezone_set('Asia/Taipei');
session_start();
require("dbconnect.php");
require("function.php");
//require("bomb.php");
if (! isset($_SESSION["uID"]))
    $_SESSION["uID"] = "";
//echo $_SESSION["uID"];
if ( $_SESSION["uID"] < " ") {
    //header("Location: login.php");
    echo "Please Login. <a href='loginForm.php'>Login</a>";
    exit(0);
}

$num=checkNum(); //宣告一變數存字串
$cash=checkCash(); //宣告一變數存字串
$pen=counter();

$totalSub = countSub(); //分店總數

//$x=0;  //counter for bombs
$sql_1="select * from substore";//DB內所有Bomb資料   select all bomb information from DB
$res_1=mysqli_query($conn,$sql_1) or die("db error");
$arr_1 = array();  //define an array for bombs

while($row_1=mysqli_fetch_assoc($res_1)) {  
    //抓資料，把資料一筆筆存入陣列裡面
    $arr_1[] = $row_1; 
    // 每一個Bomb配一個  計數$i ，衍生出 bomb$i、timer$i
    //$x++;  // $i為計數，在 id編號 和 傳入都用（這看法是結果論）
}
?>
<script>
<?php
    //print the bomb array to the web page as a javascript object
    echo "var myArray_1=" . json_encode($arr_1);
?>
</script>


<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
  <script language="javascript">
  function clic(){
        $.ajax({
        url: 'addSubstore.php',
        data: {}, //我要丟出去的data
        type:"POST",
        dataType:'text',
        success: function(txt){
            //alert(txt);
            $('#ex').append('<form action="sub1.php" method="post"><input type="hidden" name="substore1" value="'+<?php echo $pen ?>+'"><input type="submit" value="分店'+(i+3)+'"></form>');
            //$('#ex').append('<input type="button" value="分店'+ (i+3) +'" onclick=location.href="sub1.php?getsID=3">');
        },

        error: function(xhr, ajaxOptions, thrownError){ 
            alert(xhr.status); 
            alert(thrownError); 
        }
        });

  }
</script>
<script language="javascript">
    $( document ).ready(function() {
        for (i=0; i<<?php echo $pen ?>; i++){
            $('#ex').append('<form action="sub1.php" method="post"><input type="hidden" name="substore1" value="'+(i+3)+'"><input type="submit" value="分店'+(i+3)+'"></form>');
            //$('#ex').append('<input type="button" value="分店'+ (i+3) +'" onclick="location.href=sub1.php?getsID=3">');
        }
    });
</script>
<script>
  
  function sell() { //用傳入編號i的方式嗎？，         //特定分店賣出的想法來想的話？
	//alert('exploded');
	//use jQuery ajax to call sell.php 賣東西(資料庫處理) ，  回傳"現在金額"
	//每幾秒  for一次分店
	for (x=0; x < myArray_1.length;x++) {
		$.ajax({
			url: "sell.php",
			dataType: 'html',
			type: 'POST',
			data: { sid : myArray_1[x]['sID']}, //分店編號要傳進去sell.php裡面
			error: function(response) { //the call back function when ajax call fails
				alert('Ajax request failed!');
				},
			success: function(cashNumber) { 
				// the call back function when ajax call succeed
				// Ajax 應用可以僅向伺服器傳送並取回指定資料
				//如何更動金額
				
				<?php $cash=checkCash(); ?>
				$("#cash").html("總財產：<?php echo $cash['Cash']?>元");
				//$('#cash').show()
				history.go(0);
				}
		});
	}
	
}	
function checkBomb() {
	now= new Date(); //get the current time
	
	//check each bomb with a for loop
	//array length: number of items in the global array: myArray
	for (i=0; i < myArray.length;i++) {	
		
		tday=new Date(myArray[i]['aTime']); 
		//alert(tday);//convert the date string into date object in javascript
		if (tday <= now) { 
			//expired, set the explode image and text
			//$("#bomb" + i).attr('src',"images/explode.jpg");
			$("#timer"+i).html("0")
		} else {
			//set the bomb image  and calculate count down
			//$("#bomb" + i).attr('src',"images/bomb.jpg");
			$("#timer"+i).html(Math.floor((tday-now)/1000))			
		}
	}
}

window.onload =   function() {setInterval(function () {sell()}, 6000);
                              setInterval(function () {checkBomb()}, 1000);
				};

</script>


</head>
<h1>麵包零售賣場</h1>
總財產：<?php echo $cash['Cash']?>元
<table width="600" border="1" >

<td rowspan = 3> 總店庫存商品</td>
<td>草莓甜甜圈：<?php echo $num['p1Num']?>單位</td><td><input type="button" value="訂購草莓甜甜圈" onclick="location.href='order.php?id=1'"></td><td>到貨剩餘時間：

<?php                        
$sql="select * from orderr ;"; //select all bomb information from DB
$res=mysqli_query($conn,$sql) or die("db error");
$arr = array(); //define an array for bombs
while($row=mysqli_fetch_assoc($res)) {
    $arr[] = $row; //store the row into the array
    for($i=0;$i<=0;$i++) {
        echo "<div id='timer$i' style='display:inline'></div>";
        //$sql20="delete from orderr";
        //$result20 = mysqli_query($conn,$sql20);
    }
}  
?>秒</td>
</tr>


<td>香蒜麵包：<?php echo $num['p2Num']?>單位</td><td><input type="button" value="訂購香蒜麵包" onclick="location.href='order.php?id=2'"></td><td>到貨剩餘時間：
<?php
$sql1="select * from orderr ;"; //select all bomb information from DB
$res1=mysqli_query($conn,$sql1) or die("db error");
$arr = array(); //define an array for bombs
while($row1=mysqli_fetch_assoc($res1)) {
    $arr1[] = $row1; //store the row into the array
    for($i=1;$i<=1;$i++) {
        echo "<div id='timer$i' style='display:inline'></div>";
        //$sql20="delete from orderr";
        //$result20 = mysqli_query($conn,$sql20);
    }
}?>秒</td>
</tr>



<td>波蘿麵包：<?php echo $num['p3Num']?>單位</td><td><input type="button" value="訂購波蘿麵包" onclick="location.href='order.php?id=3'"></td><td>到貨剩餘時間：
<?php
$sql="select * from orderr  ;"; //select all bomb information from DB
$res=mysqli_query($conn,$sql) or die("db error");
$arr = array(); //define an array for bombs
while($row=mysqli_fetch_assoc($res)) {
    $arr[] = $row; //store the row into the array
    for($i=2;$i<=2;$i++) {
        echo "<div id='timer$i' style='display:inline'></div>";
        //$sql20="delete from orderr where pID=1";
        //$result20 = mysqli_query($conn,$sql20);
    }
}?>秒</td>
<script>
<?php
//print the bomb array to the web page as a javascript object
echo "var myArray=" . json_encode($arr);
?>  
</script>
</tr>
</table>
<td><input type="button" value="新增分店" onclick="clic()"></td><h2></h2>
<tr><td><form action='sub1.php' method='post'>
 <input type='hidden' name='substore1' value='1'>
 <input type='submit' value='分店1'></form></td>

 <td><form action='sub1.php' method='post'>
 <input type='hidden' name='substore1' value='2'>
 <input type='submit' value='分店2'></form></td>

<div id="ex"></div> <!-- id:#  class:. -->
</html>