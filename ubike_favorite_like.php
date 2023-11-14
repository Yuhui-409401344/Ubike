<?php
    session_start();

    if (!isset($_SESSION['ubike_user_id'])) {
        header("Location: login.php");
    }

    $ubike_user_id = $_SESSION['ubike_user_id'];
    $ubike_station_id = $_GET["ubike_station_id"];

    $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");

    if(!$link){
        echo "連接失敗" . mysqli_connect_error(); 
    }

    mysqli_query($link, "set names utf8");

    if (isset($ubike_user_id) && isset($ubike_station_id)) {
        $sql = "insert into ubike_favorite (ubike_user_id, ubike_station_id) values ('$ubike_user_id', '$ubike_station_id')";
    }

    $URL = 'http://localhost/Ubike/googlemap_search.php';

    if (mysqli_query($link, $sql)) {
        header("Location:index.php");
    }

    // if (mysqli_query($link, $sql) && ($_SERVER['HTTP_REFERER'] === $URL)) {
    //     header('Location:googlemap_search.php');
    // }
    // else {
    //     header('Location: index.php');
    // }

?>