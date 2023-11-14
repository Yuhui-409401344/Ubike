<?php
$filename = $_GET['filename'];
$fileError = $_GET['fileError'];
$fileError2 = $_GET['fileError2'];
$fileRight = $_GET['fileRight'];
?>
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
            <section id="blog" class="blog" style="margin-left: 15%;">
                <div class="container" data-aos="fade-up">
                    <div class="row">

                        <!-- 交通意外協助 -->
                        <div class="col-lg-10 entries">
                            <article class="entry">
                                <center>
                                    <h1 class="entry-title" style="margin-bottom:30px; font-size: 50px; ">
                                        <a href="#">車禍事後上傳文件</a>
                                    </h1>
                                </center>
                                <!-- ======= 選項 ======= -->
                                <section id="featured" class="featured">
                                    <div class="container">

                                        <div class="row">
                                            <div>
                                                <h5>請填妥以下資料：</h5>
                                                <br>
                                                <div class="input-group" style="margin-left: 8%; margin-right: 8%">
                                                    <form method="post" action="./upload.php" enctype="multipart/form-data">
                                                        <table>
                                                            <tr>
                                                                <td><input type="file" name="uploadfile" accept=".pdf,.docx,.png,.jpeg" class="form-control" id="inputGroupFile01" style="margin-right: 10px; color: #808080; width: 120%"></td>
                                                                <td><input class="form-control" onclick="myFunction()" class="submit" type="submit" value="上傳" style="color: white; text-transform: uppercase; width: 155px; background-color:#e96b56; margin-left: 80px"></td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </div>
                                                <script>
                                                    function myFunction() {
                                                        alert("關閉視窗以查看上傳結果。");
                                                    }
                                                </script>
                                                <br>
                                                <form action="ubike_accident_dblink.php" method="post" style="margin-left: 8%; margin-right: 8%">
                                                    <input type="hidden" name="method" value="upload_insert">
                                                    <?php
                                                    if (isset($fileError)) {
                                                        echo "<center>$fileError</center>", "<br>";
                                                    } else if (isset($fileError2)) {
                                                        echo "
                                                        <center>
                                                        $fileError2
                                                        </center>
                                                        <br>
                                                        ";
                                                    } else if (isset($fileRight)) {
                                                        echo "<center>$fileRight</center>", "<br>";
                                                    }
                                                    ?>

                                                    <div class="input-group">
                                                        <input class="form-control" type="text" style="color: grey; text-transform: uppercase; width: 300px" name="" placeholder="請先上傳檔案" value="<?php if (isset($filename)) {
                                                                                                                                                                                                        echo $filename;
                                                                                                                                                                                                    } ?>" readonly>
                                                    </div>
                                                    <br>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="ubike_accident_name" style="color: grey; text-transform: uppercase; width: 300px" placeholder="請輸入回報者姓名">
                                                    </div>
                                                    <br>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="ubike_accident_phone" style="color: grey; text-transform: uppercase; width: 300px" placeholder="請輸入回報者電話">
                                                    </div>
                                                    <br>
                                                    <center>
                                                        <h6><b>備註</b></h6>
                                                        <div class="form-floating" style="width: 100%;">
                                                            <textarea name="ubike_accident_remark" class="form-control" id="floatingTextarea" style="height: 100px" value="<?php echo $ubike_accident_remark ?>>"></textarea>
                                                            <label for="floatingTextarea">(限100字)</label>
                                                        </div>
                                                    </center>
                                                    <div class="input-group">
                                                        <input type="hidden" class="form-control" name="ubike_accident_file" style="color: grey; text-transform: uppercase; width: 300px; margin-left: 5px;" value="<?php echo "<a href=download.php?filename=$filename>", $filename, "</a>"; ?>"> <br>
                                                        <input type="hidden" class="form-control" name="ubike_accident_status" style="color: grey; text-transform: uppercase; width: 300px; margin-left: 5px;" value="待處理"> <br>
                                                    </div>
                                                    <br>
                                                    <center>
                                                        <table>
                                                            <tr>
                                                                <td style="width: 158px;"><a href="ubike_accident_upload.php"><input class="form-control" type="reset" value="重新輸入" style="color: white; text-transform: uppercase; width: 180px; background-color: #858796"></a></td>
                                                                <td>
                                                                    <input class="form-control" onclick="myFunction2()" class="submit" type="submit" value="送出" style="color: white; text-transform: uppercase; width: 180px; background-color:#e96b56; margin-left: 10px">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <script>
                                                            function myFunction2() {
                                                                alert("感謝您的回報，我們將盡快處理！");
                                                            }
                                                        </script>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>


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