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
    <script>
        function myFunction() {
            alert("卡片已刪除。");
        }
    </script>
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <div style="display: flex; flex-direction: row">
        <?php include 'navigation.php' ?>
        <main id="main" style="width: 100%; height: 100%">

            <!-- ======= 整個版面 ======= -->
            <section id="blog" class="blog" style="margin-left: 10%;">
                <div class="container" data-aos="fade-up">


                    <div class="row">

                        <!-- 右側已綁定卡片區 -->
                        <div class="col-lg-11 entries">


                            <article class="entry">

                                <center>
                                    <h1 class="entry-title" style="margin-bottom:30px; font-size: 50px; ">
                                        <a href="#">卡片管理</a>
                                    </h1>
                                </center>
                                <div class="entry-content">
                                    <div class="read-more">
                                        <a href="ubike_card_add.php" style="font-size: 17px; margin-right: 2.5%; width: 130px; padding-right: 3.4%">新增卡片</a>
                                    </div>
                                </div>
                                <br>
                                <!-- ======= 已綁定卡片選項 ======= -->
                                <?php
                                $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
                                if (!$link) {
                                    echo "連接失敗" . mysqli_connect_error();
                                }
                                mysqli_query($link, "set names utf8");
                                $ubike_user_id = $_SESSION['ubike_user_id'];

                                $sql = "SELECT * FROM ubike_card WHERE ubike_user_id = '$ubike_user_id'";
                                $result = mysqli_query($link, $sql);

                                while ($record = mysqli_fetch_row($result)) {
                                    $ubike_card_id = $record[0];
                                ?>

                                    <section id="featured" class="featured">


                                        <div class="container">

                                            <div class="row">
                                                <!-- 已綁定的卡 -->
                                                <div style="padding-bottom: 5px;">

                                                    <div class="icon-box" style="padding-left: 7%;">
                                                        <div style="display: flex; flex-direction: row">
                                                            <div style="padding-top: 40px; width: 100%">
                                                                <h3><a style="font-size: 25px;" href="#"><?php echo $record[1] ?>&nbsp;&nbsp;<span style="font-size: 15px;">卡號：<?php echo $record[0] ?></span></a></h3>
                                                                <p style="padding-bottom: 10px; margin-top: 20px">
                                                                    <!-- 交易紀錄按鈕 -->
                                                                    <a style="margin-right: 10px;" class="btn btn-success" data-bs-toggle="collapse" href="#a<?php echo $record[0] ?>" role="button" aria-expanded="false" aria-controls="<?php echo $record[0] ?>">
                                                                        查看交易紀錄
                                                                    </a>
                                                                    <!-- 刪除綁定卡片按鈕 -->
                                                                    <?php echo "<a href=ubike_card_delete.php?method=ubike_card_delete&ubike_card_id=$record[0]>" ?>
                                                                    <button onclick="myFunction()" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                        刪除卡片
                                                                    </button></a>
                                                                </p>

                                                                <?php
                                                                $sql2 = "SELECT ubike_total_time, ubike_remain_time FROM ubike_discount WHERE ubike_card_id = '$ubike_card_id'";
                                                                $result2 = mysqli_query($link, $sql2);
                                                                while ($record2 = mysqli_fetch_row($result2)) {
                                                                ?>
                                                                    <h3><a style="font-size: 15px;" href="#">總騎乘時數（分鐘）：
                                                                            <span style="font-size: 15px;">
                                                                                <?php echo $record2[0] ?>
                                                                            </span></a></h3>
                                                                    <h3><a style="font-size: 15px;" href="#">下次回饋還需騎乘時數（分鐘）：
                                                                            <span style="font-size: 15px;">
                                                                                <?php
                                                                                if($record2[1] <= 0){
                                                                                    echo "<span style='color: red; font-weight: bold'>已達到回饋門檻。</span>";
                                                                                }
                                                                                else{
                                                                                    echo $record2[1];
                                                                                }
                                                                                ?>
                                                                            </span></a></h3>

                                                            </div>
                                                        <?php
                                                                }
                                                                if ($record[1] == "悠遊卡") {
                                                        ?>
                                                            <img style="margin-left: 5%; width: 100%" src="./assets/img/card1.png" alt="">
                                                        <?php
                                                                } else if ($record[1] == "一卡通") {
                                                        ?>
                                                            <img style="margin-left: 5%; width: 47.7%" src="./assets/img/card2.png" alt="">
                                                        <?php
                                                                } else if ($record[1] == "信用卡") {
                                                        ?>
                                                            <img style="margin-left: 5%; width: 47.7%" src="./assets/img/card3.png" alt="">
                                                        <?php
                                                                }
                                                        ?>
                                                        </div>
                                                        <!-- 交易紀錄裡面的資料 -->

                                                        <br>
                                                        <div class="collapse" id="a<?php echo $record[0] ?>">
                                                            <div class="card card-body">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>

                                                                            <th scope="col" style="width:18%; text-align:center; ">借車站點</th>
                                                                            <th scope="col" style="width:18%; text-align:center; ">借車時間</th>
                                                                            <th scope="col" style="width:18%; text-align:center; ">還車站點</th>
                                                                            <th scope="col" style="width:18%; text-align:center; ">還車時間</th>
                                                                            <th scope="col" style="width:18%; text-align:center; ">單車編號</th>
                                                                            <th scope="col" style="width:5%; text-align:center; ">金額</th>
                                                                            <th scope="col" style="width:5%; text-align:center; ">優惠</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php
                                                                    $ubike_card_id = $record[0];
                                                                    $sql_data = "SELECT * FROM ubike_transaction WHERE ubike_card_id = '$ubike_card_id' order by ubike_transaction_borrow desc";
                                                                    $result_data = mysqli_query($link, $sql_data);
                                                                    while ($record_data = mysqli_fetch_row($result_data)) {

                                                                    ?>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="color:#0066CC; text-align:center;"><b><?php echo $record_data[6] ?></b></td>
                                                                                <td style=" text-align:center;"><?php echo $record_data[4] ?></td>
                                                                                <td style="color:#009100; text-align:center;"><b><?php echo $record_data[7] ?></b></td>
                                                                                <td style=" text-align:center;"><?php echo $record_data[5] ?></td>
                                                                                <td style=" text-align:center;"><?php echo $record_data[3] ?></td>
                                                                                <td style=" text-align:center;">$<?php echo $record_data[8] ?></td>
                                                                                <td style=" text-align:center;"><?php echo $record_data[9] ?></td>
                                                                            </tr>

                                                                        </tbody>
                                                                    <?php }
                                                                    if (mysqli_num_rows($result_data) == 0) {
                                                                    ?>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td colspan="6" ; style="color:red; text-align:center;"><b>尚無交易紀錄</b></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    <?php } ?>


                                                                </table>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>

                                            </div>



                                        </div>

                                    </section>

                                <?php
                                }
                                ?>
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