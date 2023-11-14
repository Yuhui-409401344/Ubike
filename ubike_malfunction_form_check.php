<?php
$error = $_GET['error'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="https://kit.fontawesome.com/874fe894d1.js" crossorigin="anonymous"></script>
    <title>YouBike&nbsp;微笑單車</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <div style="display: flex; flex-direction: row">
        <?php include 'navigation.php' ?>
        <main id="main" style="width: 100%; height: 100%">
            <form method="post" action="ubike_malfunction_dblink.php">
                <?php
                $method = "malfunction_insert";
                $ubike_malfunction_id = $_POST["ubike_malfunction_id"];
                $ubike_user_id = $_SESSION["ubike_user_id"];
                $ubike_malfunction_name = $_POST["ubike_malfunction_name"];
                $ubike_malfunction_phone = $_POST["ubike_malfunction_phone"];
                $ubike_bike_id = $_POST["ubike_bike_id"];
                $ubike_malfunction_status = $_POST["ubike_malfunction_status"];
                $ubike_malfunction_info = $_POST["ubike_malfunction_info"];
                $ubike_malfunction_check = "未處理";
                $ubike_station_id = $_POST["ubike_station_id"];
                $ubike_user_name = $_SESSION["ubike_user_name"];
                $ubike_user_account = $_SESSION["ubike_user_account"];
                $ubike_user_phone = $_SESSION["ubike_user_phone"];
                ?>
                <input type=hidden name="method" value="<?php echo $method ?>">
                <input type=hidden name="ubike_user_id" value="<?php echo $ubike_user_id ?>">
                <input type=hidden name="ubike_malfunction_check" value="<?php echo $ubike_malfunction_check ?>">
                <main id="main">
                    <!-- ======= 整個版面 ======= -->
                    <section id="blog" class="blog" style="margin-left: 15%;">
                        <div class=" container" data-aos="fade-up">
                            <div class="row">

                                <!-- 右側故障回報區 -->
                                <div class="col-lg-10 entries">
                                    <article class="entry">
                                        <center>
                                            <h1 class="entry-title" style="margin-bottom:30px; font-size: 50px; ">
                                                單車故障回報表單
                                            </h1>
                                        </center>
                                        <div class="container">
                                            <!-- 輸入訊息 -->
                                            <section id="contact" class="contact">
                                                <div class="container">
                                                    <div class="row">
                                                        <div>

                                                            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                                                                <h5>請確認以下資料：</h5>
                                                                <br>
                                                                <center>
                                                                    <div class="input-group mb-3" style="width:80%;">
                                                                        <input readonly name="ubike_malfunction_name" value="<?php echo $ubike_malfunction_name ?>" type="text" class="form-control" aria-describedby="basic-addon1" required>
                                                                    </div>
                                                                </center>
                                                                <center>
                                                                    <div class="input-group mb-3" style="width:80%;">
                                                                        <input readonly name="ubike_malfunction_phone" value="<?php echo $ubike_malfunction_phone ?>" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required>

                                                                    </div>
                                                                </center>
                                                                <center>
                                                                    <div class="input-group mb-3" style="width:80%;">
                                                                        <input readonly name="ubike_bike_id" type="text" value="<?php echo $ubike_bike_id ?>" class="form-control" aria-label="Amount (to the nearest dollar)" required>

                                                                    </div>
                                                                </center>
                                                                <!-- 站點名稱 -->
                                                                <center>
                                                                    <?php
                                                                    $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
                                                                    if (!$link) {
                                                                        echo "連接失敗" . mysqli_connect_error();
                                                                    }
                                                                    mysqli_query($link, "set names utf8");

                                                                    $sql = "SELECT * FROM ubike_station WHERE ubike_station_id = '$ubike_station_id'";
                                                                    $result = mysqli_query($link, $sql);

                                                                    while ($record = mysqli_fetch_row($result)) {
                                                                    ?>
                                                                        <div class="input-group mb-3" style="width:80%;">
                                                                            <input readonly value="<?php echo $record[1] ?>" name="ubike_station_name" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </center>
                                                                <!-- 站點id不顯示給使用者看 -->
                                                                <center>
                                                                    <div class="input-group mb-3" style="width:80%;">
                                                                        <input type="hidden" value="<?php echo $ubike_station_id ?>" name="ubike_station_id" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                                                                    </div>
                                                                </center>

                                                                <center>
                                                                    <h6><b>請說明故障情況</b></h6>
                                                                    <div class="form-floating" style="width:80%;">
                                                                        <textarea readonly name="ubike_malfunction_info" class="form-control" id="floatingTextarea" style="height: 100px" required><?php echo $ubike_malfunction_info ?></textarea>
                                                                        <label for="floatingTextarea">(限100字)</label>
                                                                    </div>
                                                                </center>
                                                                <div style="color: red; text-align:center">
                                                                    <b><?php echo $error ?></b>
                                                                </div>
                                                                <br>
                                                                <center>
                                                                    <a href="ubike_malfunction_form.php"><button type="button" style="background-color: #e96b56;color: #fff;padding: 6px 20px;transition: 0.3s;font-size: 14px;border-radius: 4px; border: none;">
                                                                            重新填寫
                                                                        </button></a>

                                                                    <button type="button" style="background-color: #e96b56;color: #fff;padding: 6px 20px;transition: 0.3s;font-size: 14px;border-radius: 4px; border: none;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                        確認
                                                                    </button>
                                                                </center>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel" style="color: #e96b56;"><b>回報成功</b></h5>
                                                                            </div>
                                                                            <div class="modal-body" style="text-align: center; letter-spacing:2px ; ">
                                                                                <img width="10%" src="assets/img/lin/folder.gif">
                                                                                <b>感謝您的回報，我們將盡快處理！</b>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-primary">確定</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>

            </form>
    </div>


    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/js/main.js"></script>
</body>
<?php include 'footer.php' ?>

</html>