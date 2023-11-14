<input type="hidden" name="ubike_news_time" value="<?php $ubike_news_time = date('Y-m-d G:i:s', strtotime('+8HOUR'));;
                                                                                                echo $ubike_news_time ?>"
<?php
$method = $_POST["method"];
$ubike_accident_file = $_POST["ubike_accident_file"];
$ubike_accident_name = $_POST["ubike_accident_name"];
$ubike_accident_phone = $_POST["ubike_accident_phone"];
$ubike_accident_remark = $_POST["ubike_accident_remark"];
$ubike_accident_status = $_POST["ubike_accident_status"];

$link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");

if ($method == "upload_insert") {
    $sql = "insert into ubike_accident (ubike_accident_file, ubike_accident_name, ubike_accident_phone, ubike_accident_remark, ubike_accident_status, ubike_accident_time)
    values('$ubike_accident_file', '$ubike_accident_name', '$ubike_accident_phone', '$ubike_accident_remark', '$ubike_accident_status', '$ubike_news_time')";
  
    if (mysqli_query($link, $sql)) {
        $sql2 = "insert into ubike_news (ubike_news_type, ubike_news_content, ubike_news_user, ubike_news_time)
        values ('交通意外', '來自 $ubike_accident_name 的一項回報！', '使用者', '$ubike_news_time')";
        if (mysqli_query($link, $sql2)) {
            header('location: indexF.php');
        }
    }
} 

?>