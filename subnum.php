<?php
require("dbconnect.php");
function subNum() {
    global $conn;
    $sql ="select * from substore";
    if ($result = mysqli_query($conn,$sql)) { //SQL真正執行
        if ($row=mysqli_fetch_assoc($result)) {
        return $row;
        }
    }
}
?>