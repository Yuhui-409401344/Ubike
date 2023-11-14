<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">



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
            <section id="blog" class="blog" style="margin-left: 15%; margin-top: 3%">
                <div class="container" data-aos="fade-up">
                    <div class="row">

                        <!-- 交通意外協助 -->
                        <div class="col-lg-10 entries">
                            <article class="entry">
                                <center>
                                    <h1 class="entry-title" style="margin-bottom:30px; font-size: 50px; ">
                                        <a href="#">交通意外協助</a>
                                    </h1>
                                </center>
                                <!-- ======= 選項 ======= -->
                                <section id="featured" class="featured">
                                    <div class="container">

                                        <div class="row">
                                            <div class="col-lg-6 mt-6 mt-lg-0">
                                                <center>
                                                    <?php echo "<a href=# data-bs-toggle=modal data-bs-target=#phonecall>" ?>
                                                    <div class="icon-box">
                                                        <img style="width: 30%; margin-bottom: 10px;" src="assets/img/lin/call.png">
                                                        <br>
                                                        <h3 style="color: #545454;">點我！撥打服務專線</h3>
                                                        <p></p>
                                                    </div>
                                                    </a>
                                                </center>
                                            </div>

                                            <div class="col-lg-6 mt-6 mt-lg-0">
                                                <center>
                                                    <?php echo "<a href=ubike_accident_upload.php>" ?>
                                                    <div class="icon-box">
                                                        <img style="width: 30%; margin-bottom: 10px;" src="assets/img/lin/checklist.png">
                                                        <br>
                                                        <h3 style="color: #545454;">車禍事後上傳文件</h3>
                                                        <p></p>
                                                    </div>
                                                    </a>
                                                </center>
                                            </div>

                                        </div>
                                    </div>
                                </section>
                                <div class="modal fade" id="phonecall" tabindex="-1" aria-labelledby="phonecall" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel" style="color: #e96b56;"><b>服務專線</b></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="text-align:center ;letter-spacing: 2px;">
                                                <b>撥打：09-12312312</b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">確定</button>

                                            </div>
                                        </div>
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