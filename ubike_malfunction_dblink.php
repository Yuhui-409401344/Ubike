<input type="hidden" name="ubike_news_time" value="<?php $ubike_news_time = date('Y-m-d G:i:s', strtotime('+8HOUR'));;
                                                                                                echo $ubike_news_time ?>"
<?php
$method = $_POST["method"];
$ubike_user_id = $_POST["ubike_user_id"];
$ubike_malfunction_name = $_POST['ubike_malfunction_name'];
$ubike_malfunction_phone = $_POST["ubike_malfunction_phone"];
$ubike_bike_id = $_POST["ubike_bike_id"];
$ubike_malfunction_status = "待處理";
$ubike_malfunction_info = $_POST["ubike_malfunction_info"];
$ubike_station_id = $_POST["ubike_station_id"];
$ubike_bike_status = "異常";
$link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");

if ($method == "malfunction_insert") {

    $sql = "insert into ubike_malfunction
     (ubike_user_id, ubike_malfunction_name, ubike_malfunction_phone, ubike_bike_id, ubike_malfunction_status, ubike_malfunction_info, ubike_station_id, ubike_malfunction_time) values
     ('$ubike_user_id', '$ubike_malfunction_name','$ubike_malfunction_phone','$ubike_bike_id','$ubike_malfunction_status','$ubike_malfunction_info', '$ubike_station_id', '$ubike_news_time')";
    if (mysqli_query($link, $sql)) {
        $sql2 = "insert into ubike_news (ubike_news_type, ubike_news_content, ubike_news_user, ubike_news_time)
        values ('單車故障', '來自 $ubike_malfunction_name 的一項回報！', '使用者', '$ubike_news_time')";
        if (mysqli_query($link, $sql2)) {
            header('location: map.php');
        }
    }
}

if ($method == "malfunction_insert") {
    $sql_2 = "update ubike_bike set ubike_bike_status = '$ubike_bike_status' where ubike_bike_id = '$ubike_bike_id' ";

    if (mysqli_query($link, $sql_2)) {

        header('location:map.php');
    }
}
