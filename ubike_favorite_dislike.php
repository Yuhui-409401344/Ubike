<?php
    session_start();

    if (!isset($_SESSION['ubike_user_id'])) {
        header("Location: login.php");
    }

    $ubike_user_id = $_SESSION['ubike_user_id'];

    $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");

    if(!$link){
        echo "連接失敗" . mysqli_connect_error(); 
    }

    mysqli_query($link, "set names utf8");


    $ubike_station_id = $_GET["ubike_station_id"];
    $sql = "delete from ubike_favorite where ubike_station_id = '$ubike_station_id' and ubike_user_id = '$ubike_user_id'";

    if (mysqli_query($link, $sql)) {
        header("Location:index.php");
    }

    $URL = 'http://localhost/ubike/ubike_favorite.php';

    if (mysqli_query($link, $sql) && ($_SERVER['HTTP_REFERER'] === $URL)) {
        header('Location:ubike_favorite.php');
    }
    else {
        header('Location: index.php');
    }
?>