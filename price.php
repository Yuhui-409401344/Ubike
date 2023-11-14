<?php
$return_time = $_GET['ubike_transaction_return'];
$ubike_card_id = $_SESSION['ubike_card_id'];

$link = mysqli_connect("localhost","root","12345678","ubike_sa");

$sql1 = "SELECT ubike_transaction_borrow, ubike_transaction_return, ubike_discount FROM ubike_transaction 
         WHERE ubike_card_id = '$ubike_card_id' and ubike_transaction_return ='$return_time'";
$rs1 = mysqli_query($link, $sql1);
while ($record1 = mysqli_fetch_row($rs1)) {
    $ubike_transaction_borrow = $record1[0];
    $ubike_transaction_return = $record1[1];
    $ubike_discount = $record1[2];
}

//計算價格
$time = (strtotime($ubike_transaction_return) - strtotime($ubike_transaction_borrow)) / 60;
if($ubike_discount == '無'){
    if($time <= 30){
        $price = 10;
    }
    else if($time > 30 and $time <= 240){
        $price = round(($time/30)*10);
    }
    else if($time > 240 and $time <= 480){
        $price = round(80 + (($time-240)/30)*20);
    }
    else{
        $price = round(80 + 160 + (($time - 480)/30)*40);
    }
}
else{
    $price = 0;
}

//計算回饋（有回饋則不計算此次時數）
$sql2 = "SELECT ubike_total_time, ubike_remain_time FROM ubike_discount WHERE ubike_card_id = '$ubike_card_id'";
$rs2 = mysqli_query($link, $sql2);
while ($record2 = mysqli_fetch_row($rs2)) {
    $ubike_total_time = $record2[0];
    $ubike_remain_time = $record2[1];
}
echo "total_time1=",$ubike_total_time," ","remain_time=",$ubike_remain_time;

if($ubike_discount == '無'){

    $ubike_total_time += $time;
    $ubike_remain_time -= $time;

    $ubike_total_time = round($ubike_total_time);
    $ubike_remain_time = round($ubike_remain_time);
}
else{
    $ubike_remain_time += 1200;
}
echo "total_time3=",$ubike_total_time," ","remain_time=",$ubike_remain_time;

$sql3 = "UPDATE `ubike_transaction` SET ubike_transaction_charge = '$price'
         WHERE ubike_card_id = '$ubike_card_id' and ubike_transaction_return ='$return_time'"; 

$sql4 = "UPDATE `ubike_discount` SET ubike_total_time = '$ubike_total_time', ubike_remain_time = '$ubike_remain_time' 
         WHERE ubike_card_id = '$ubike_card_id'";


if (mysqli_query($link, $sql3)) {
    if (mysqli_query($link, $sql4)) {
        header("location:map.php");
    }
}

?>