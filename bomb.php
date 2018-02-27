<?php
date_default_timezone_set('Asia/Taipei');
 require "dbconnect.php";

 ?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>

<script language="javascript">
/*
function handleBomb(bombID) {
	now= new Date(); //get the current time
	tday=new Date(myArray[bombID]['expire'])
	console.log(now, tday)
	if (tday <= now) {
		//alert('exploded');
		//use jQuery ajax to reset timer
		$.ajax({
			url: "json.php",
			dataType: 'html',
			type: 'POST',
			data: { id: myArray[bombID]['id']}, //optional, you can send field1=10, field2='abc' to URL by this
			error: function(response) { //the call back function when ajax call fails
				alert('Ajax request failed!');
				},
			success: function(txt) { //the call back function when ajax call succeed
				//alert("Bomb" + bombID + ": " + txt);
                myArray[bombID]['expire'] = txt;
				}
		});
	
	} else {
		alert("counting down, be patient.")
	}
}
*/
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

//javascript, to set the timer on windows load event
window.onload = function () {
	//check the bomb status every 1 second
    setInterval(function () {
		checkBomb()
    }, 1000);
};
</script>
</head>

<body >


</body></html>