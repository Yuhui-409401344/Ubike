<!-- 資料庫抓值 -->
<?php
session_start();
$ubike_user_id = $_SESSION['ubike_user_id'];

$link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
if (!$link) {
    echo "連接失敗" . mysqli_connect_error();
}
mysqli_query($link, "set names utf8");
$sql = "SELECT * FROM ubike_station s LEFT JOIN (SELECT * FROM ubike_favorite where ubike_user_id = '$ubike_user_id') AS t ON s.ubike_station_id = t.ubike_station_id";
$result = mysqli_query($link, $sql);
?>
<html>

<head>
    <style>
        #map {
            height: 650px;
            width: 100%;
        }

        .ubike_css {
            letter-spacing: 2px;
            font-weight: 900;
            color: #6C6C6C;
        }
    </style>
    
    <!-- icon JS -->
    <script src="https://kit.fontawesome.com/874fe894d1.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script>
        // function initMap() {
        //     const map = new google.maps.Map(document.getElementById("map"), {
        //         zoom: 17,
        //         center: {
        //             lat: 25.03667266204939,
        //             lng:  121.43273221764,
        //         },
        //     });
        //     const geocoder = new google.maps.Geocoder();
        //     const infowindow = new google.maps.InfoWindow();

        //     document.getElementById("submit").addEventListener("click", () => {
        //         geocodeLatLng(geocoder, map, infowindow);
        //     });
        // }

        function geocodeLatLng(geocoder, map, infowindow) {
            const input = document.getElementById("latlng").value;
            const latlngStr = input.split(",", 2);
            const latlng = {
                lat: parseFloat(latlngStr[0]),
                lng: parseFloat(latlngStr[1]),
            };

            geocoder
                .geocode({
                    location: latlng
                })
                .then((response) => {
                    if (response.results[0]) {
                        map.setZoom(20);


                        const marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            icon: {
                                url: "./assets/img/lin/click_1.png",
                                scaledSize: new google.maps.Size(35, 35)
                            },
                            // animation: google.maps.Animation.BOUNCE,
                            animation: google.maps.Animation.DROP

                        });

                        infowindow.setContent('<p style="margin:0;padding:0;"><strong>Here！</strong></p>');
                        infowindow.open(map, marker);

                    } else {
                        window.alert("No results found");
                    }
                })
                .catch((e) => window.alert("Geocoder failed due to: " + e));
        }

        window.initMap = initMap;
    </script>
    <script>
        let map;

        function initMap() {
            // const iconBase =
            //     "https://developers.google.com/maps/documentation/javascript/examples/full/images/";
            const icons = {
                version1: {
                    icon: {
                        url: "./assets/img/1.0-map-green.svg",
                        scaledSize: new google.maps.Size(85, 85)
                    },
                    // icon: {url:icons["./assets/img/1.0-map-orange.svg"], scaledSize: new google.maps.Size(85, 85)},
                },
                version2: {
                    icon: {
                        url: "./assets/img/1.0-map-orange.svg",
                        scaledSize: new google.maps.Size(85, 85)
                    },
                },
                version3: {
                    icon: {
                        url: "./assets/img/2.0-map-red.svg",
                        scaledSize: new google.maps.Size(85, 85)
                    },
                },
            };
            // 新增
            const geocoder = new google.maps.Geocoder();
            const infowindow = new google.maps.InfoWindow();

            document.getElementById("submit").addEventListener("click", () => {
                geocodeLatLng(geocoder, map, infowindow);
            });

            // 結束
            map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(25.03667266204939, 121.43273221764),
                zoom: 17,
                streetViewControl: false,
                mapTypeControl: false,
                fullscreenControl: false,
            });

            const MapOptions = [
                <?php
                while ($record = mysqli_fetch_row($result)) {
                ?> {
                        position: new google.maps.LatLng(<?php echo $record[6] ?>, <?php echo $record[7] ?>),
                        type: "version" + '<?php echo $record[2] ?>',
                        placeName: '<?php echo $record[1] ?>',
                        placeAdress: '<?php echo $record[5] ?>',
                        placeID: '<?php echo $record[0] ?>',
                        checkID: '<?php echo $record[12] ?>',
                        borrow_1: '<?php echo $record[8] ?>',
                        return_1: '<?php echo $record[9] ?>',
                        borrow_2: '<?php echo $record[10] ?>',
                        return_2: '<?php echo $record[11] ?>',
                    },
                <?php } ?>
            ];

            //收藏敘述
            const likeString = '<a href="ubike_favorite_dislike.php?ubike_station_id='
            const likeIcon = '" onclick="myFunction()"><i class="fa-solid fa-heart"></i></a>&nbsp;'
            const dislikeString = '<a href="ubike_favorite_like.php?ubike_station_id='
            const dislikeIcon = '" onclick="myFunction()"><i class="fa-regular fa-heart"></i></a>&nbsp;'

            //站點資訊: 可借可還數量
            const borrow_1 = '<tr><td style="width: 22%;color: white;background-color: orange; border-radius: 5px;">&nbsp;1.0&nbsp;</td><td style="color:#EA0000; ">'
            const return_1 = '</td><td style="color:#000093; ">'
            const borrow_2 = '<tr><td style="color:white; background-color: #e96b56; border-radius: 5px;">&nbsp;2.0&nbsp;</td><td style="color:#EA0000; ">'
            const return_2 = '</td><td style="color:#000093; ">'
            const endTag = '</td></tr>'

            // Create markers.
            let destinations = [];
            for (let i = 0; i < MapOptions.length; i++) {
                destinations.push(new google.maps.LatLng(MapOptions[i].position));
            }
            // console.log("destinations", destinations)
            // console.log("MapOptions", MapOptions)
            var detail;

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    console.log(position.coords);
                    var marker = new google.maps.Marker({
                        position: pos,
                        icon: {url:"./assets/img/posIcon2.png"},
                        map: map
                    });
                    map.setZoom(17);
                    map.setCenter(pos);

                    const service = new google.maps.DistanceMatrixService(); // instantiate Distance Matrix service

                    const matrixOptions = {
                        origins: [{lat: pos.lat, lng: pos.lng}], // technician locations
                        destinations: destinations, // customer address
                        travelMode: 'WALKING',
                        unitSystem: google.maps.UnitSystem.METRIC
                    };
                    // Call Distance Matrix service
                    service.getDistanceMatrix(matrixOptions, callback).then(e => {
                        console.log("THEN");

                        // Create markers.
                        for (let i = 0; i < MapOptions.length; i++) {
                            console.log(((MapOptions[i].checkID > 0)?likeString + MapOptions[i].placeID + likeIcon:dislikeString + MapOptions[i].placeID + dislikeIcon))


                            const contentString =
                                '<div id="content" style="width:100%;">' +
                                '<div id="siteNotice">' +
                                '</div>' +

                                '<div id="firstHeading" class="firstHeading">' +

                                '<table border="0" style="width:350px ; height:150px; " class="ubike_css">' +
                                '<tr style="border-bottom: 2px lightgray solid; margin-bottom: 2px;">' +
                                '<td colspan="2" style=" width: 25%; text-align: left; font-size: 30px; padding-left: 20px;">' +
                                ((MapOptions[i].checkID > 0)?likeString + MapOptions[i].placeID + likeIcon:dislikeString + MapOptions[i].placeID + dislikeIcon) + 
                                
                                '<b style="color: #fd7e14;">' + MapOptions[i].placeName + '</b>' +

                                '<sub style="font-size: 10px">距離'+ detail.rows[0].elements[i].distance.text + '</sub>' +

                                '</td>' +
                                '</tr>' +

                                '<tr style="border-bottom: 2px lightgray solid; ">' +
                                '<td style="width: 100%;padding: 4%; ">' +
                                '<table border="0" style="width:100%;font-size:14px; text-align:center;">' +
                                '<tr style="font-size:14px;">' +
                                '<td style="text-align:left;"></td>' +
                                '<td>可借車數</td>' +
                                '<td>可還車數</td>' +
                                '</tr>' +

                                ((MapOptions[i].type === 'version3')
                                    ? borrow_1 + MapOptions[i].borrow_1 + return_1 + MapOptions[i].return_1 + endTag + borrow_2 + MapOptions[i].borrow_2 + return_2 + MapOptions[i].return_2 + endTag
                                    : (MapOptions[i].type === 'version1') ? borrow_1 + MapOptions[i].borrow_1 + return_1 + MapOptions[i].return_1 + endTag : borrow_2 + MapOptions[i].borrow_2 + return_2 + MapOptions[i].return_2 + endTag) +

                                '</table>' +
                                '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td style="width:20%; text-align:center; font-size:8px"><b>地址</b>：' + MapOptions[i].placeAdress + '</td>' +
                                '</tr>' +
                                '</table>' +
                                '</div>';
                        
                            const marker = new google.maps.Marker({
                                position: MapOptions[i].position,
                                icon: icons[MapOptions[i].type].icon,
                                map: map,
                            });

                            const infowindow = new google.maps.InfoWindow({
                                content: contentString,
                            });

                            marker.addListener("click", () => {
                                infowindow.open({
                                    anchor: marker,
                                    map,
                                    shouldFocus: false,
                                });

                            });

                            google.maps.event.addListener(map, "click", function(event) {
                                infowindow.close();
                            });
                        }

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
            console.log("Out callback");
            console.log(detail)
            console.log("Finish callback\n\n\n")
        }
    </script>
    <style>
        /* 
 * Always set the map height explicitly to define the size of the div element
 * that contains the map. 
 */
        #map {
            height: 100%;
        }

        /* 
 * Optional: Makes the sample page fill the window. 
 */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: "Roboto", "sans-serif";
            line-height: 30px;
            padding-left: 10px;
        }

        #floating-panel {
            position: absolute;
            top: 5px;
            left: 50%;
            margin-left: -180px;
            width: 350px;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
        }

        #latlng {
            width: 225px;
        }

        /* .gm-style .gm-style-iw-t::after {
    background: linear-gradient(45deg,rgba(255,255,255,1) 50%,rgba(255,255,255,0) 51%,rgba(255,255,255,0) 100%) #fff;
    box-shadow: -2px 2px 2px 0 rgb(178 178 178 / 40%);
    content: "";
    height: 0;
    left: 0;
    position: absolute;
    top: 0;
    transform: translate(-50%,-50%) rotate(-45deg);
    width: 15px;
} */
    </style>
</head>

<body>
    <div style="display: flex; flex-direction: row">
        <?php include 'navigation.php' ?>

        <div style="width:100%; height: 690px">
    <div id="floating-panel" style="background-color:white;width:210px;border-radius:10px;border:none;margin-left:0px;">
    

        <table style="border-radius:30px ;">
            <?php
            $search_station = $_POST['search_station'];
            $arr = explode(" ", $search_station);

            $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
            if (empty($searchtxt)) {
                $sql = "select * from ubike_station where ubike_station_name like '%$arr[2]%'";
            } else {
                $sql = "select * from ubike_station where id like '%$searchtxt%' or id like '%$searchtxt%'";
            }

            $rs = mysqli_query($link, $sql);
            if ($record = mysqli_fetch_assoc($rs)) {
                $ubike_station_x = $record['ubike_station_x'];
                $ubike_station_y = $record['ubike_station_y'];
            }
            ?>
            <tr>
                <td><input type="hidden" class="form-control" style="width:100%;" id="latlng" type="text" value="<?php echo $ubike_station_x ?>,<?php echo $ubike_station_y ?>" /></td>
                <td><input id="submit" class="btn btn-danger" type="button" value="確定搜尋" style="margin-left: 5px;border-radius:10px;font-size:15px" /></td>
                <td><a href="index.php"><input class="btn btn-success" type="button" value="返回搜尋" style="margin-left: 10px;border-radius:10px;font-size:15px" /></a></td>
            </tr>

        </table>
    </div>
    <div id="map"></div>
        </div>
    </div>

    <!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWBsv2Taa3fUqd8A0-_6cvCcY0bsXPcfA&callback=initMap&v=weekly" defer></script>
</body>

</html>