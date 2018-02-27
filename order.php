<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">
</script>
</head>

<!-- form 把 name 跟  value都post走 -->
<!-- html是靜態  php是動態 -->
<?php
$id = $_GET['id'];
$price = rand(50,80);
echo '購買商品編號為  '.$id;
echo '<br>';
echo '目前進貨價格：  '.$price;
echo '<br>';
?>
<form action="controller.php?id=<?php echo"$id"?>" method="post">
<input type="hidden" name="act" value="purchase"> 


<input type="hidden" name="pID" value="<?php  echo $id ?>">
<input type="hidden" name="price" value="<?php  echo $price ?>">
輸入進貨量：<input type="text" name="quantity"><br>
<input type="submit" value="送出表單"> <!--  submit不用傳-->

</form>