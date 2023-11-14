<?php
$error = $_GET['error'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
            <form method="post" action="ubike_malfunction_form_check.php">
                <?php
                $method = "malfunction_insert";
                $ubike_malfunction_id = "";
                $ubike_user_id = $_SESSION["ubike_user_id"];
                $ubike_malfunction_name = "";
                $ubike_malfunction_phone = "";
                $ubike_bike_id = "";
                $ubike_malfunction_status = "";
                $ubike_malfunction_info = "";
                $ubike_malfunction_check = "未處理";
                $ubike_station_id = "";
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
                                                                <h5>請填妥以下資料：</h5>
                                                                <br>
                                                                <center>
                                                                    <div class="input-group mb-3" style="width:80%;">

                                                                        <input placeholder="請輸入回報者姓名" name="ubike_malfunction_name" value="<?php echo $ubike_user_name ?>" type="text" class="form-control" aria-describedby="basic-addon1" required>
                                                                    </div>
                                                                </center>
                                                                <center>
                                                                    <div class="input-group mb-3" style="width:80%;">
                                                                        <input placeholder="請輸入回報者電話" name="ubike_malfunction_phone" value="<?php echo $ubike_user_phone ?>" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required>

                                                                    </div>
                                                                </center>
                                                                <center>
                                                                    <div class="input-group mb-3" style="width:80%">
                                                                        <input placeholder="請輸入故障車號" name="ubike_bike_id" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                                                                    </div>
                                                                </center>
                                                                <center>
                                                                    <b style="padding:10%">請選擇所在站點</b>
                                                                    <select required name="ubike_station_id" class="form-select" aria-label="Default select example" style="width:80%; margin-top: 7px">
                                                                        <option disabled selected></option>
                                                                        <?php


                                                                        $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
                                                                        if (!$link) {
                                                                            echo "連接失敗" . mysqli_connect_error();
                                                                        }
                                                                        mysqli_query($link, "set names utf8");
                                                                        $sql = "SELECT * FROM ubike_station ";
                                                                        $result = mysqli_query($link, $sql);

                                                                        while ($record = mysqli_fetch_row($result)) {
                                                                        ?>
                                                                            <option value="<?php echo $record[0] ?>"><?php echo $record[1] ?></option>

                                                                        <?php

                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </center>
                                                                <br>
                                                                <center>
                                                                    <h6><b>請說明故障情況</b></h6>
                                                                    <div class="form-floating" style="width:80%;">
                                                                        <textarea name="ubike_malfunction_info" class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" required></textarea>
                                                                        <label for="floatingTextarea">(限100字)</label>
                                                                    </div>
                                                                </center>
                                                                <div style="color: red; text-align:center">
                                                                    <b><?php echo $error ?></b>
                                                                </div>
                                                                <br>
                                                                <div class="text-center"><button type="submit" style="background-color: #e96b56;color: #fff;padding: 6px 20px;transition: 0.3s;font-size: 14px;border-radius: 4px; border: none;">送出</button></div>


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