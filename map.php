<?php
$ubike_bike_id = $_SESSION['bike_id'];
$borrow_card = $_SESSION['ubike_card_id'];

$tag = $_GET['tag'];
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

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script>
        function initMap2() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position2) {
                    var pos2 = {
                        lat: position2.coords.latitude,
                        lng: position2.coords.longitude
                    };
                    console.log("map", position2.coords);

                    document.getElementById('geoPosition3').value = position2.coords.latitude + "," + position2.coords.longitude;
                    document.getElementById('geoPosition4').value = position2.coords.latitude + "," + position2.coords.longitude;
                    // console.log(position2.coords.latitude + "," + position2.coords.longitude)

                });
            } else {
                // Browser doesn't support Geolocation
                alert("未允許或遭遇錯誤！");
            }
        }
    </script>

</head>


<body>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqGSLbGTcofKwEbU43wB5tap5IjYSeXJI&libraries=places,geometry&v=3&callback=initMap2&v=weekly" defer></script>
    <div style="display: flex; flex-direction: row">
        <?php include 'navigation.php' ?>

        <div style="width:100%; height: 690px">
            <div id="search" style="height: 0px;">
                <div class="search_sub">
                    <form action="googlemap_search.php" method="post" style="width: 50%; z-index: 1; box-shadow: 8px 8px 10px gray;">
                        <input class="form-control" required placeholder="尋找站點..." type="text" id="tags" name="search_station" value="<?php echo $search_station; ?>" style="border: none;">
                        <input type="submit" value="搜尋" id="search" style="font-weight: bold;">

                        <script>
                            $(function() {
                                var terms = [
                                    <?php
                                    $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
                                    $sql = "select * from ubike_station";
                                    $rs = mysqli_query($link, $sql);
                                    while ($record = mysqli_fetch_row($rs)) {
                                        if ($record[2] == '3') {
                                            $record[2] = $bike_type = '1.0／2.0';
                                    ?>

                                            "<?php echo $bike_type, ' ', '-', ' ', $record[1], ' ', '（', $record[5], '）' ?>",

                                        <?php
                                        } else {
                                        ?> "<?php echo $record[2], '.0', ' ', '-', ' ', $record[1], ' ', '（', $record[5], '）' ?>",
                                    <?php
                                        }
                                    }
                                    ?>
                                ];
                                $('#tags').autocomplete({
                                    source: terms
                                });
                            });
                        </script>
                        <style>
                            .ui-widget {
                                color: grey;
                                font-weight: bold;
                                list-style: none;
                                background-color: white;
                                width: 35%;
                                padding: 10px;
                                border-radius: 5px;
                                letter-spacing: 1px;
                                cursor: pointer;
                                line-height: 35px;
                            }
                        </style>
                    </form>
                    <div>
                        <div>
                            <img class="img_icon" src="assets/img/1.0-map-green.svg" style="width: 5.2%; margin-top: 120px">
                            <p class="icon_info" style="margin-top: 160px">1.0</p>
                            <img class="img_icon" src="assets/img/1.0-map-orange.svg" style="width: 5.2%; margin-top: 200px">
                            <p class="icon_info" style="margin-top: 240px">2.0</p>
                            <img class="img_icon" src="assets/img/2.0-map-red.svg" style="width: 5.2%; margin-top: 280px">
                            <p class="icon_info" style="margin-top: 319px; line-height: 14px">1.0<br>2.0</p>
                        </div>
                        <style>
                            .img_icon {
                                z-index: 5;
                                position: absolute;
                                margin-left: 76%;
                                padding: 10px;
                                padding-right: 13px;
                                border-radius: 20px 0 0 20px;
                                background: white;
                                box-shadow: 8px 8px 10px gray;
                            }

                            .icon_info {
                                color: #404040;
                                z-index: 5;
                                font-size: 14px;
                                font-weight: bold;
                                position: absolute;
                                margin-left: 79.3%;
                            }
                        </style>
                        
                        <?php
                        if ($_SESSION['tag'] == 0) {
                        ?>
                            <button class="borr_btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <b>借車</b>
                            </button>
                            <style>
                                .borr_btn {
                                    height: 120px;
                                    width: 120px;
                                    position: absolute;
                                    z-index: 1;
                                    margin-left: 68%;
                                    margin-top: 430px;
                                    border-radius: 100px;
                                    background-color: white;
                                    font-size: 18px;
                                    background-color: #e96b56;
                                    transition: 0.5s;
                                    color: white;
                                    border: none;
                                    box-shadow: 8px 8px 10px gray;
                                }

                                .borr_btn:hover {
                                    background: #da543d;
                                }
                            </style>
                        <?php
                        }
                        ?>
                        <?php
                        if ($_SESSION['tag'] == 1) {
                        ?>
                            <button class="borr_btn" data-bs-toggle="modal" data-bs-target="#Modal">
                                <b>還車</b>
                            </button>
                            <style>
                                .borr_btn {
                                    height: 120px;
                                    width: 120px;
                                    position: absolute;
                                    z-index: 1;
                                    margin-left: 68%;
                                    margin-top: 430px;
                                    border-radius: 100px;
                                    background-color: white;
                                    font-size: 18px;
                                    background-color: #e96b56;
                                    transition: 0.5s;
                                    color: white;
                                    border: none
                                }

                                .borr_btn:hover {
                                    background: #da543d;
                                }
                            </style>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- 規劃路線按鈕(start) -->
                <button class="route_btn" data-bs-toggle="modal" data-bs-target="#routeModal">
                    <b>規劃路線</b>
                </button>
                <style>
                    .route_btn {
                        height: 120px;
                        width: 120px;
                        position: absolute;
                        z-index: 1;
                        margin-left: 60%;
                        margin-top: 430px;
                        border-radius: 100px;
                        background-color: white;
                        font-size: 18px;
                        background-color: #FF9224;
                        transition: 0.5s;
                        color: white;
                        border: none;
                        box-shadow: 8px 8px 10px gray;
                    }

                    .route_btn:hover {
                        background: #EA7500;
                    }
                </style>
                <!-- 規劃路線按鈕(end) -->

                <!-- 規劃路線(start) -->
                <div style="color: #444444;" class="modal fade" id="routeModal" tabindex="-1" aria-labelledby="routeModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="exampleModalLabel">選擇起訖地點</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="route.php" method="post">

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">請選擇起始點：</label>
                                        <select name="start_station" class="form-select" required>
                                            <option value="">請選擇地點</option>
                                            <option id="geoPosition3">你的位置</option>
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
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">請選擇終點站：</label>
                                        <select name="end_station" class="form-select" required>
                                            <option value="">請選擇地點</option>
                                            <option id="geoPosition4">你的位置</option>
                                            <?php
                                            $sql = "SELECT * FROM ubike_station ";
                                            $result = mysqli_query($link, $sql);

                                            while ($record = mysqli_fetch_row($result)) {
                                            ?>
                                                <option value="<?php echo $record[0] ?>"><?php echo $record[1] ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                        <button type="submit" class="btn btn-primary">確定</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- 規劃路線(end) -->

                <?php
                if (isset($_SESSION['ubike_user_level'])) {
                ?>
                    <!-- 借車(start) -->
                    <div style="color: #444444;" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 id="exampleModalLabel">請輸入借車資訊</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form action="borrow_dblink.php" method="post" name="myForm">

                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">1.請選擇卡號：</label>
                                            <select name="card_id" class="form-select" required>
                                                <option value="">請選擇卡號</option>
                                                <?php
                                                $ubike_user_id = $_SESSION['ubike_user_id'];

                                                $link1 = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
                                                $sql1 = "SELECT * FROM ubike_card where ubike_user_id = '$ubike_user_id'";
                                                $rs1 = mysqli_query($link1, $sql1);

                                                while ($record1 = mysqli_fetch_row($rs1)) {
                                                ?>
                                                    <option value="<?php echo $record1[0]; ?>"><?php echo $record1[0]; ?></option>
                                                <?php
                                                }
                                                mysqli_close($link1);
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">2.請選擇借車站點 & 車號：</label>
                                            <select name="borrow_bike_id" class="form-select" required>
                                                <option value="">請選擇借車站點 & 車號</option>
                                                <?php
                                                $sql2 = "SELECT DISTINCT s.ubike_station_id, ubike_station_name, ubike_station_version, ubike_dock_status, b.ubike_bike_id, ubike_bike_status  
                                                             FROM ubike_station as s, ubike_dock as d, ubike_bike as b
                                                             WHERE s.ubike_station_id = d.ubike_station_id and d.ubike_station_id = b.ubike_station_id and ubike_dock_status = 'full' and ubike_bike_status = '正常'";
                                                $rs2 = mysqli_query($link, $sql2);

                                                while ($record2 = mysqli_fetch_row($rs2)) {
                                                    if ($record2[2] == '1') {
                                                ?>
                                                        <option value="<?php echo $record2[4]; ?>"><?php echo $record2[1], '(1.0) - ', $record2[4]; ?></option>
                                                    <?php
                                                    } else if ($record2[2] == '2') {
                                                    ?>
                                                        <option value="<?php echo $record2[4]; ?>"><?php echo $record2[1], '(2.0) - ', $record2[4]; ?></option>
                                                        <?php
                                                    } else if ($record2[2] == '3') {
                                                        if ($record2[6] == '1') {
                                                        ?>
                                                            <option value="<?php echo $record2[4]; ?>"><?php echo $record2[1], '(1.0) - ', $record2[4]; ?></option>
                                                        <?php
                                                        } else if ($record2[6] == '2') {
                                                        ?>
                                                            <option value="<?php echo $record2[4]; ?>"><?php echo $record2[1], '(2.0) - ', $record2[4]; ?></option>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>

                                            </select>

                                            <input type="hidden" name="tag" value="1">
                                            <input type="hidden" name="ubike_borrow_time" value="<?php $ubike_borrow_time = date('Y-m-d G:i:s', strtotime('+8HOUR'));
                                                                                                    echo $ubike_borrow_time ?>">

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                            <button type="submit" class="btn btn-primary">確定</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- 借車(end) -->


                    <!-- 還車(start) -->
                    <div style="color: #444444;" class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>請輸入還車資訊</h5>
                                    <button target="ifr_index" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="return_dblink.php" method="post">

                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">1.請選擇還車站點 & 車柱：</label>
                                            <select name="return_dock_id" class="form-select" required>
                                                <option value="">請選擇還車站點 & 車柱</option>
                                                <?php
                                                $bike_version = $_SESSION['bike_version'];

                                                $sql3 = "SELECT DISTINCT s.ubike_station_id, ubike_station_name, ubike_station_version, ubike_dock_status, ubike_dock_id, ubike_dock_version 
                                                         FROM ubike_station as s, ubike_dock as d 
                                                         WHERE s.ubike_station_id = d.ubike_station_id and ubike_dock_status = 'empty'";
                                                $rs3 = mysqli_query($link, $sql3);

                                                while ($record3 = mysqli_fetch_row($rs3)) {
                                                    if ($bike_version == '1') {
                                                        if ($record3[2] == '1') {
                                                ?>
                                                            <option value="<?php echo $record3[4]; ?>"><?php echo $record3[1], '(1.0) - ', $record3[4]; ?></option>
                                                        <?php
                                                        }
                                                    } else if ($bike_version == '2') {
                                                        if ($record3[2] == '2') {
                                                        ?>
                                                            <option value="<?php echo $record3[4]; ?>"><?php echo $record3[1], '(2.0) - ', $record3[4]; ?></option>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">2.您借的單車車號：(自動帶入)</label>
                                            <input type="text" class="form-control" value="<?php echo $ubike_bike_id; ?>" disabled>

                                            <input type="hidden" name="ubike_bike_id" value="<?php echo $ubike_bike_id; ?>">

                                            <input type="hidden" name="ubike_borrow_time" value="<?php $ubike_borrow_time = date('Y-m-d G:i:s', strtotime('+8HOUR'));;
                                                                                                    echo $ubike_borrow_time; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">3.回饋：(自動帶入)</label>
                                            <?php

                                            $sql4 = "SELECT ubike_remain_time FROM ubike_discount WHERE ubike_card_id = '$borrow_card'";
                                            $rs4 = mysqli_query($link, $sql4);

                                            while ($record4 = mysqli_fetch_row($rs4)) {
                                                if ($record4[0] <= 0) {
                                            ?>
                                                    <input type="text" class="form-control" value="此次免費" style="color: #FF2D2D; font-weight: bold;" disabled>
                                                    <input type="hidden" name="discount" value="有">
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="text" class="form-control" value="此次無優惠" style="color: #FF2D2D; font-weight: bold;" disabled>
                                                    <input type="hidden" name="discount" value="無">
                                            <?php
                                                }
                                            }
                                            ?>

                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                            <button type="submit" class="btn btn-primary" onclick="transaction()">確定</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- 還車(end) -->


                    <script>
                        function transaction() {
                            ;
                            alert("您已完成本次交易。");
                        }
                    </script>



                <?php
                } else {
                ?>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="color: red;" id="exampleModalLabel"><b>請先登入</b></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="color: #444444;">
                                    請先登入，以使用免持卡租車服務！
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="color: #444444;" class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="color: red;" id="exampleModalLabel"><b>請先登入</b></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="color: #444444;">
                                    請先登入，以使用免持卡租車服務！
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <style>
                #search {
                    color: #fff;
                    font-size: 14px;
                }

                #search .search_sub {
                    padding-top: 15px;
                    padding-left: 30px;
                }

                #search .search_sub h4 {
                    font-size: 24px;
                    margin: 0 0 20px 0;
                    padding: 0;
                    line-height: 1;
                    font-weight: 600;
                }

                #search .search_sub form {
                    background: #fff;
                    padding: 6px 10px;
                    position: relative;
                    border-radius: 50px;
                }

                #search .search_sub form input[type=email] {
                    border: 0;
                    padding: 8px;
                    width: calc(100% - 140px);
                    height: 30px;
                    color: grey;
                }

                #search .search_sub form input[type=submit] {
                    position: absolute;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    border: 0;
                    background: none;
                    font-size: 16px;
                    padding: 0 30px;
                    margin: 3px;
                    background: #e96b56;
                    color: #fff;
                    transition: 0.3s;
                    border-radius: 50px;
                }

                #search .search_sub form input[type=submit]:hover {
                    background: #e6573f;
                }

                #alter_func {
                    border: 0;
                    background: none;
                    font-size: 16px;
                    padding: 5px 20px;
                    margin-top: 12px;
                    background: lightgray;
                    color: #fff;
                    transition: 0.3s;
                    border-radius: 50px;
                }

                #alter_func:focus {
                    background: #e96b56;
                }
            </style>
            <?php include 'googlemap.php' ?>
        </div>
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