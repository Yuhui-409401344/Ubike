<?php
    $ubike_user_id = $_SESSION['ubike_user_id'];
    if (!isset($ubike_user_id)) {
        header('Location: login.php');
    }

    $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
    if (!$link) {
        echo "連接失敗" . mysqli_connect_error();
    }
    mysqli_query($link, "set names utf8");

    //ubike_station_total, ubike_user_id
    $sql = "SELECT DISTINCT s.ubike_station_id, ubike_station_name, ubike_station_version, ubike_station_1_borrow, ubike_station_1_return, ubike_station_2_borrow, ubike_station_2_return, ubike_station_x, ubike_station_y FROM ubike_station s, ubike_favorite f WHERE s.ubike_station_id = f.ubike_station_id AND f.ubike_user_id = '$ubike_user_id' ORDER BY s.ubike_station_id ASC";

    $result = mysqli_query($link, $sql);

    $result2 = mysqli_query($link, $sql);

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
    <script>
        function myFunction() {
            alert("已取消收藏。");
            window.setTimeout(100);
        }
    </script>
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/874fe894d1.js" crossorigin="anonymous"></script>

    <style>
        .featured {
            padding: 0 0 8px 0;
        }

        .featured .icon-box:hover {
            background: #d3ac73;
        }

        .featured .icon-box:hover i, .featured .icon-box:hover h3 a, .featured .icon-box:hover p {
            color: #FF2D2D;
        }
    </style>

    <script>
        let map

        function initMap() {
            const MapOptions = [
            <?php
            while ($record2 = mysqli_fetch_row($result2)) {
            ?> {
                position: new google.maps.LatLng(<?php echo $record2[7] ?>, <?php echo $record2[8] ?>),
                },
            <?php } ?>
            ];

            let destinations = []
            for (let i = 0; i < MapOptions.length; i++) {
                destinations.push(new google.maps.LatLng(MapOptions[i].position));
            }

            console.log(destinations)
            var detail;

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    console.log(position.coords);

                    const service = new google.maps.DistanceMatrixService(); // instantiate Distance Matrix service
                    // var originPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    // destinations.push(new google.maps.LatLng(f.geometry.coordinates[0], f.geometry.coordinates[1]));

                    const matrixOptions = {
                        origins: [{lat: pos.lat, lng: pos.lng}], // technician locations
                        destinations: destinations, // customer address
                        travelMode: 'WALKING',
                        unitSystem: google.maps.UnitSystem.METRIC
                        // avoidHighways: true, // 是否避開高速公路
                        // avoidTolls: true // 是否避開收費路線
                    };
                    // Call Distance Matrix service
                    service.getDistanceMatrix(matrixOptions, callback).then(e => {
                        console.log("THEN");
                        // Create markers.
                        var tr = document.getElementsByClassName("distance");
                        for (var i = 0; i < tr.length; i++) {
                            tr[i].innerText = detail.rows[0].elements[i].distance.text;
                        }
                        
                        // document.getElementById(".distance").value = pos.lat + "," + pos.lng;
                    }) ;

                    // Callback function used to process Distance Matrix response
                    function callback(response, status) {
                        if (status !== "OK") {
                            alert("Error with distance matrix");
                            return;
                        }
                        else {
                            detail = response;
                            console.log("In callback");
                            console.log(detail)
                            console.log("Finish callback\n\n\n")
                        }
                    }
    
                });
            } else {
                // Browser doesn't support Geolocation
                alert("未允許或遭遇錯誤！");
            }
        }

    </script>
</head>

<body>
    <script defer async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVwup4bS9HoTBM34rE3THMsngB_LrLJ2Q&callback=initMap&v=weekly"></script>

    <div style="display: flex; flex-direction: row">
    <?php include 'navigation.php' ?>
    <main id="main" style="width: 100%">
        
        <!-- ======= 整個版面 ======= -->
        <section id="blog" class="blog" style="margin-left: 10%;">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-11 entries">
                        <article class="entry">
                            <center>
                                <h1 class="entry-title" style="margin-bottom:30px; font-size: 50px; ">
                                    <a href="#">收藏站點清單</a>
                                </h1>
                            </center>
                            <?php
                                while ($record = mysqli_fetch_row($result)) {
                            ?>  
                                    <section id="featured" class="featured">
                                        <div class="container">
                                            <div class="row">
                                                <!-- 已綁定的卡 -->
                                                <div style="padding-bottom: 5px;">
                                                    <div class="icon-box">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col"></th>
                                                                    <th scope="col">站點名稱</th>
                                                                    <th scope="col">距離站點</th>
                                                                    <?php if($record[2] == 1) { ?>
                                                                    <th scope="col">可借數(1.0)</th>
                                                                    <th scope="col">可還數(1.0)</th>
                                                                    <?php } elseif ($record[2] == 2) { ?>
                                                                    <th scope="col">可借數(2.0)</th>
                                                                    <th scope="col">可還數(2.0)</th>
                                                                    <?php } else { ?>
                                                                    <th scope="col">可借數(1.0)</th>
                                                                    <th scope="col">可借數(2.0)</th>
                                                                    <th scope="col">可還數(1.0)</th>
                                                                    <th scope="col">可還數(2.0)</th>
                                                                    <?php } ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><a href="ubike_favorite_dislike.php?ubike_station_id=<?php echo $record[0]; ?>" onclick="myFunction()"><i class="fa-solid fa-heart" style="font-size: 30px; margin-top: 12px; padding-left: 8px;"></i></a></td>
                                                                    <td><?php echo $record[1]; ?></td>
                                                                    <td class="distance">計算中...</td>
                                                                    
                                                                    <?php if($record[2] == 1) { ?>
                                                                    <th><?php echo $record[3]; ?></th>
                                                                    <th><?php echo $record[4]; ?></th>
                                                                    <?php } elseif ($record[2] == 2) { ?>
                                                                    <th><?php echo $record[5]; ?></th>
                                                                    <th><?php echo $record[6]; ?></th>
                                                                    <?php } else { ?>
                                                                    <th><?php echo $record[3]; ?></th>
                                                                    <th><?php echo $record[5]; ?></th>
                                                                    <th><?php echo $record[4]; ?></th>
                                                                    <th><?php echo $record[6]; ?></th>
                                                                    <?php } ?>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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