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

            <!-- ======= 整個版面 ======= -->
            <section id="blog" class="blog" style="margin-left: 15%;">
                <div class="container" data-aos="fade-up">
                    <div class="row">

                        <!-- 右側新增卡片區 -->
                        <div class="col-lg-10 entries">
                            <article class="entry">
                                <center>
                                    <h1 class="entry-title" style="margin-bottom:30px; font-size: 50px; ">
                                        <a href="#">新增卡片</a>
                                    </h1>
                                </center>
                                <!-- ======= 卡片選項 ======= -->
                                <section id="featured" class="featured">
                                    <div class="container">

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <center>
                                                    <?php echo "<a href=ubike_card_num.php?method=ubike_card_num&ubike_card_type=悠遊卡>" ?>
                                                    <div class="icon-box">
                                                        <img style="height: 52px; margin-bottom: 10px;" src="./assets/img/card1.png" alt="">
                                                        <h3 style="color: #545454;">悠遊卡</h3>
                                                        <p></p>
                                                    </div>
                                                    </a>
                                                </center>
                                            </div>
                                            <div class="col-lg-4 mt-4 mt-lg-0">
                                                <center>
                                                    <?php echo "<a href=ubike_card_num.php?method=ubike_card_num&ubike_card_type=一卡通>" ?>
                                                    <div class="icon-box">
                                                        <img style="height: 43px; margin-bottom: 15px;" src="./assets/img/card2.png" alt="">
                                                        <h3 style="color: #545454;">一卡通</h3>
                                                        <p></p>
                                                    </div>
                                                    </a>
                                                </center>
                                            </div>
                                            <div class="col-lg-4 mt-4 mt-lg-0">
                                                <center>
                                                    <?php echo "<a href=ubike_card_num.php?method=ubike_card_num&ubike_card_type=信用卡>" ?>
                                                    <div class="icon-box">
                                                        <img style="height: 43px; margin-bottom: 15px;" src="./assets/img/card3.png" alt="">
                                                        <h3 style="color: #545454;">信用卡</h3>
                                                        <p></p>
                                                    </div>
                                                    </a>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <br>

                                <div class="entry-content">

                                    <div class="read-more">
                                        <a href="ubike_card_manage.php">返回卡片管理</a>
                                    </div>
                                </div>

                            </article>
                        </div>
                    </div>
                </div>
            </section>

        </main>
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