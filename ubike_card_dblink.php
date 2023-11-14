<?php
$method = $_POST["method"];

$ubike_card_id = $_POST['ubike_card_id'];
$ubike_card_type = $_POST["ubike_card_type"];
$ubike_user_id = $_POST["ubike_user_id"];

$link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");

if ($method == "card_insert") {

    $sql = "insert into ubike_card
     (ubike_card_id, ubike_card_type, ubike_user_id) values
     ('$ubike_card_id', '$ubike_card_type','$ubike_user_id')";

    $sql2 = "insert into ubike_discount (ubike_card_id, ubike_total_time, ubike_remain_time) 
             values ('$ubike_card_id', '0', '1200')";

    if (mysqli_query($link, $sql)) {
        if (mysqli_query($link, $sql2)) {
            header('location:ubike_card_manage.php');
        }
    } else {
        $error = "此卡號已經存在";
        header("location:ubike_card_num.php?error=$error&ubike_card_type=$ubike_card_type");
    }
}
