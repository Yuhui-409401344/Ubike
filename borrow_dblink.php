<?php
$_SESSION['tag'] = $_POST['tag'];
$ubike_transaction_borrow = $_POST['ubike_borrow_time'];
$_SESSION['ubike_borrow_time'] = $_POST['ubike_borrow_time'];
$ubike_bike_id = $_POST['borrow_bike_id'];
$_SESSION['bike_id'] = $ubike_bike_id;
$ubike_card_id = $_POST['card_id'];
$ubike_user_id = $_SESSION['ubike_user_id'];


$link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");

$sql1 = "SELECT ubike_station_name, ubike_dock_version, d.ubike_station_id FROM ubike_dock as d, ubike_station as s 
         WHERE d.ubike_station_id = s.ubike_station_id and ubike_bike_id = '$ubike_bike_id'";
$rs1 = mysqli_query($link, $sql1);
while ($record1 = mysqli_fetch_row($rs1)) {
    $ubike_station_borrow = $record1[0];
    $version = $record1[1];
    $ubike_station_borrow_id = $record1[2];
}
$_SESSION['bike_version'] = $version;

if (isset($ubike_bike_id)) {
    $sql3 = "INSERT INTO `ubike_transaction` (ubike_user_id, ubike_card_id, ubike_bike_id, ubike_transaction_borrow, ubike_station_borrow) 
             VALUES ('$ubike_user_id', '$ubike_card_id', '$ubike_bike_id', '$ubike_transaction_borrow', '$ubike_station_borrow')";

    $sql4 = "UPDATE `ubike_dock` SET ubike_dock_status = 'empty', ubike_bike_id = NULL 
             WHERE ubike_bike_id = '$ubike_bike_id'";

    $sql5 = "UPDATE `ubike_bike` SET ubike_user_id = '$ubike_user_id', ubike_dock_id = NULL, ubike_station_id = NULL
             WHERE ubike_bike_id = '$ubike_bike_id'";

    if ($version == '1') {
        $sql6 = "UPDATE `ubike_station` SET ubike_station_1_borrow = ubike_station_1_borrow - 1, ubike_station_1_return = ubike_station_1_return + 1 WHERE ubike_station_id = '$ubike_station_borrow_id'";
    }
    else if ($version == '2') {
        $sql6 = "UPDATE `ubike_station` SET ubike_station_2_borrow = ubike_station_2_borrow - 1, ubike_station_2_return = ubike_station_2_return + 1 WHERE ubike_station_id = '$ubike_station_borrow_id'";
    }

    if (mysqli_query($link, $sql3)) {
        if (mysqli_query($link, $sql4)) {
            if (mysqli_query($link, $sql5)) {
                if (mysqli_query($link, $sql6)) {
                    $_SESSION['ubike_card_id'] = $ubike_card_id;
                    header("location:map.php");
                }
            }
        }
    }
}
