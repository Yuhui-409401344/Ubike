<?php
$filename = $_FILES["uploadfile"]["name"];
if ($_FILES["uploadfile"]["error"] > 0) {
    if ($_FILES["uploadfile"]["error"] == 1) {
        $fileError2 = "<span style='color:red; font-weight:bold;'>上傳失敗，檔案超過可上傳的大小。<br></span>";
        header("location:ubike_accident_upload.php?fileError2=$fileError2");
    }else if($_FILES["uploadfile"]["error"] == 2){
        $fileError2 = "<span style='color:red; font-weight:bold;'>上傳失敗，檔案超過可接受的檔案大小。<br></span>";
        header("location:ubike_accident_upload.php?fileError2=$fileError2");
    }else if($_FILES["uploadfile"]["error"] == 3){
        $fileError2 = "<span style='color:red; font-weight:bold;'>上傳失敗，僅上傳部分檔案。<br></span>";
        header("location:ubike_accident_upload.php?fileError2=$fileError2");
    }else if($_FILES["uploadfile"]["error"] == 4){
        $fileError2 = "<span style='color:red; font-weight:bold;'>上傳失敗，未有檔案上傳。<br></span>";
        header("location:ubike_accident_upload.php?fileError2=$fileError2");
    }else if($_FILES["uploadfile"]["error"] == 6){
        $fileError2 = "<span style='color:red; font-weight:bold;'>上傳失敗，上傳所需資料遺失。<br></span>";
        header("location:ubike_accident_upload.php?fileError2=$fileError2");
    }else if($_FILES["uploadfile"]["error"] == 7){
        $fileError2 = "<span style='color:red; font-weight:bold;'>上傳失敗，檔案寫入磁碟時發生錯誤。<br></span>";
        header("location:ubike_accident_upload.php?fileError2=$fileError2");
    }else if($_FILES["uploadfile"]["error"] == 8){
        $fileError2 = "<span style='color:red; font-weight:bold;'>上傳失敗，此版本不適用。<br></span>";
        header("location:ubike_accident_upload.php?fileError2=$fileError2");
    }
} else {
    echo "檔案名稱: " . $_FILES["uploadfile"]["name"] . "<br>";
    echo "檔案類型: " .  $_FILES["uploadfile"]["type"] . "<br>";
    echo "檔案大小: " . ($_FILES["uploadfile"]["size"] / 1024) . " Kb<br>";
    echo "暫存名稱: " .  $_FILES["uploadfile"]["tmp_name"];
    if (file_exists("../upload/" .  $_FILES["uploadfile"]["name"])) {
        $fileError = "<span style='color:red; font-weight:bold;'>檔案已經存在，請勿重覆上傳相同檔案。</span>";
        header("location:ubike_accident_upload.php?fileError=$fileError");
    } else {
        move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "../upload/" .  $_FILES["uploadfile"]["name"]);
        $fileRight = "<span style='color:red; font-weight:bold;'>上傳成功。<br></span>";
        header("location:ubike_accident_upload.php?filename=$filename&fileRight=$fileRight");
    }
}
?>