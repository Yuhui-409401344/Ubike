<?php
session_start();
$_SESSION['LostObjectId'] = $_GET['LostObjectId'];
$_SESSION['Status'] = $_GET['Status'];
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

            <section id="blog" class="blog" style="margin-left: 10%;">
                <div class="container" data-aos="fade-up">


                    <div class="row">
                        <div class="col-lg-11 entries">
                            <article class="entry">

                                <center>
                                    <h1 class="entry-title" style="margin-bottom:30px; font-size: 50px; ">
                                        <a href="#">遺失物清單</a>
                                    </h1>
                                </center>

                                <section id="featured" class="featured">                                                           
                                    <div class="container">
                                        <!-- 搜尋條件 -->   
                                        <form class="form-horizontal search-form" enctype="multipart/form-data" method="get" role="form">    
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>失物分類</label>
                                                    <select class="form-select product-vender" id="LostObjectId" name="LostObjectId">
                                                        <option value="請選擇">請選擇</option>
                                                        <?php
                                                            $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
                                                            $sql = "SELECT ubike_lost_class_type FROM ubike_lost_class";
                                                            $rs = mysqli_query($link, $sql);
                                                            
                                                            while($record = mysqli_fetch_row($rs)){
                                                        ?>
                                                                <option value="<?php echo $record[0]; ?>"><?php echo $record[0]; ?></option>
                                                        <?php
                                                            }
                                                            mysqli_close($link);
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label>失物狀態</label>
                                                    <select class="form-select" id="Status" name="Status">
                                                            <option value="請選擇">請選擇</option>
                                                            <option value="招領中">招領中</option>
                                                            <option value="已領回">已領回</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label>拾獲日期</label>
                                                    <input class="form-control" id="LostSDate" name="LostSDate" type="date">
                                                </div>  

                                                <br>

                                                <div class="col-md-2" style="padding-top:24px">
                                                    <button type="submit" class="shadow_btn" style="width:100%;">搜尋</button>
                                                </div> 

                                            </div>
                                        </form><!-- END 搜尋條件-->

                                        <?php
                                        if($_SESSION['LostObjectId'] != NULL){
                                        ?>
                                            <script type="text/javascript">
                                                document.getElementById('LostObjectId').value = "<?php echo $_GET['LostObjectId'];?>";
                                            </script>
                                        <?php
                                        }
                                        if($_SESSION['Status'] != NULL){
                                        ?>
                                            <script type="text/javascript">
                                                document.getElementById('Status').value = "<?php echo $_GET['Status'];?>";
                                            </script>
                                        <?php
                                        }
                                        ?>
                                        


                                        <style>
                                            .form-select, .form-control{
                                                outline: none;
                                                box-shadow: none;
                                            }
                                            .form-select:focus, .form-control:focus{
                                                outline: none;
                                                box-shadow: none;
                                            }

                                            .shadow_btn {
                                                height: 40px;
                                                width: 100%;
                                                border-radius: 10px;
                                                font-size: 18px;
                                                background-color: #e96b56;
                                                transition: 0.8s;
                                                color: white;
                                                border: none;
                                            }

                                            
                                            .shadow_btn:hover {
                                                background-color: #064635;
                                            } 
                                        </style>


                                        <form class="form-horizontal" style="width: 100%; ">
                                            <div>
                                                <br>
                                                <div id="table-responsive">
                                                    <table style="text-align: center; color: #808080;" class="table table-hover">
                                                        <thead>
                                                            <tr style="background-color: #ffae35; color: white; ">
                                                                <th>編號</th>
                                                                <th>類型</th>
                                                                <th>名稱</th>
                                                                <th>狀態</th>
                                                                <th>拾獲時間</th>
                                                                <th>拾獲地點</th>
                                                                <th>備註</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $LostObjectId = $_GET['LostObjectId'];
                                                            $Status = $_GET['Status'];
                                                            $LostSDate = $_GET['LostSDate'];

                                                            $LostSDate = str_replace("T"," ",$LostSDate);

                                                            $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");

                                                            if($_SESSION['LostObjectId'] == NULL and $_SESSION['Status'] == NULL){
                                                                $sql = "select * from ubike_lost";
                                                            }
                                                            else if ($LostObjectId == '請選擇') {
                                                                if($Status == '請選擇'){
                                                                    if($LostSDate == NULL){
                                                                        $sql = "select * from ubike_lost";
                                                                    }
                                                                    else{
                                                                        $sql = "select * from ubike_lost 
                                                                        where ubike_lost_found_time like '%$LostSDate%'";
                                                                    }
                                                                }
                                                                else{
                                                                    if($LostSDate == NULL){
                                                                        $sql = "select * from ubike_lost
                                                                                where ubike_lost_status = '$Status'";
                                                                    }
                                                                    else{
                                                                        $sql = "select * from ubike_lost 
                                                                        where ubike_lost_status = '$Status' and ubike_lost_found_time like '%$LostSDate%'";
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($Status == '請選擇'){
                                                                    if($LostSDate == NULL){
                                                                        $sql = "select * from ubike_lost
                                                                                where ubike_lost_type = '$LostObjectId'";
                                                                    }
                                                                    else{
                                                                        $sql = "select * from ubike_lost 
                                                                        where ubike_lost_type = '$LostObjectId' and ubike_lost_found_time like '%$LostSDate%'";
                                                                    }
                                                                }
                                                                else{
                                                                    if($LostSDate == NULL){
                                                                        $sql = "select * from ubike_lost
                                                                                where ubike_lost_type = '$LostObjectId' and ubike_lost_status = '$Status'";
                                                                    }
                                                                    else{
                                                                        $sql = "select * from ubike_lost 
                                                                        where ubike_lost_type = '$LostObjectId' and ubike_lost_status = '$Status' and ubike_lost_found_time like '%$LostSDate%'";
                                                                    }
                                                                }
                                                            }
                                                        


                                                            $rs = mysqli_query($link, $sql);

                                                            while ($record = mysqli_fetch_row($rs)) {
                                                            ?>
                                                                <tr class="tr_color">
                                                            <?php
                                                                echo"
                                                                    <td>$record[0]</td>
                                                                    <td>$record[1]</td>
                                                                    <td>$record[2]</td>
                                                                    <td>$record[3]</td>
                                                                    <td>$record[4]</td>
                                                                    <td>$record[5]</td>
                                                                    <td>$record[6]</td>
                                                                    </tr>";
                                                            }

                                                            mysqli_close($link);
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </form>
                                        

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

</html>