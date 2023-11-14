<?php 

$ubike_dock_id = $_POST['return_dock_id'];
$ubike_transaction_return = $_POST['ubike_borrow_time'];
$ubike_bike_id = $_POST['ubike_bike_id'];
$ubike_discount = $_POST['discount'];

$ubike_borrow_time = $_SESSION['ubike_borrow_time'];
$remain_discount_count = $_SESSION['remain_discount_count'];


$link = mysqli_connect("localhost","root","12345678","ubike_sa");

$sql1 = "SELECT s.ubike_station_id, ubike_station_name, d.ubike_dock_version FROM ubike_station as s, ubike_dock as d 
         WHERE s.ubike_station_id = d.ubike_station_id and ubike_dock_id = '$ubike_dock_id'";
$rs1 = mysqli_query($link, $sql1);
while ($record1 = mysqli_fetch_row($rs1)) {
    $return_station_id = $record1[0];
    $return_station_name = $record1[1];
    $return_dock_version = $record1[2];
}

if(isset($ubike_bike_id)){

    if($ubike_discount == '有'){
        $sql2 = "UPDATE `ubike_transaction` SET ubike_transaction_return = '$ubike_transaction_return', ubike_station_return = '$return_station_name', ubike_discount = '有' 
                 WHERE ubike_bike_id = '$ubike_bike_id' and ubike_transaction_borrow = '$ubike_borrow_time'"; 
        
    }
    else{
        $sql2 = "UPDATE `ubike_transaction` SET ubike_transaction_return = '$ubike_transaction_return', ubike_station_return = '$return_station_name', ubike_discount = '無' 
                 WHERE ubike_bike_id = '$ubike_bike_id' and ubike_transaction_borrow = '$ubike_borrow_time'";
    }
      
            
    $sql3 = "UPDATE `ubike_dock` SET ubike_dock_status = 'full' , ubike_bike_id = '$ubike_bike_id' 
             WHERE ubike_dock_id = '$ubike_dock_id'";
    
    $sql4 = "UPDATE `ubike_bike` SET ubike_dock_id = '$ubike_dock_id', ubike_station_id = '$return_station_id', ubike_user_id = NULL 
             WHERE ubike_bike_id = '$ubike_bike_id'";
    
    if ($return_dock_version == '1') {
        $sql5 = "UPDATE `ubike_station` SET ubike_station_1_borrow = ubike_station_1_borrow + 1, ubike_station_1_return = ubike_station_1_return - 1 WHERE ubike_station_id = '$return_station_id'";
    }
    else if ($return_dock_version == '2') {
        $sql5 = "UPDATE `ubike_station` SET ubike_station_2_borrow = ubike_station_2_borrow + 1, ubike_station_2_return = ubike_station_2_return - 1 WHERE ubike_station_id = '$return_station_id'";
    }

    if (mysqli_query($link, $sql2)) {
        if (mysqli_query($link, $sql3)) {
            if (mysqli_query($link, $sql4)) {
                if (mysqli_query($link, $sql5)) {
                    $_SESSION['tag'] = 0;
                    header("location:price.php?ubike_transaction_return=$ubike_transaction_return");
                }
            }
        }
    }
}
?>