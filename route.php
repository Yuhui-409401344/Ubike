<?php
session_start();

$ubike_user_id = $_SESSION['ubike_user_id'];

$start_station = $_POST['start_station'];

$end_station = $_POST['end_station'];

$link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
if (!$link) {
    echo "連接失敗" . mysqli_connect_error();
}
mysqli_query($link, "set names utf8");
$sql = "SELECT * FROM ubike_station s LEFT JOIN (SELECT * FROM ubike_favorite where ubike_user_id = '$ubike_user_id') AS t ON s.ubike_station_id = t.ubike_station_id";
$result = mysqli_query($link, $sql);

?>
<!DOCTYPE html>

<html>

<head>
    <title>YouBike&nbsp;微笑單車</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://kit.fontawesome.com/874fe894d1.js" crossorigin="anonymous"></script>
    <!-- jsFiddle will insert css and js -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <style>
        #map {
            height: 100%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .ubike_css {
            letter-spacing: 2px;
            font-weight: 900;
            color: #6C6C6C;
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

        #warnings-panel {
            width: 100%;
            height: 10%;
            text-align: center;
        }
    </style>
    <script>
        let map;

        function initMap() {
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

            const markerArray = [];
            // Instantiate a directions service.
            const directionsService = new google.maps.DirectionsService();
            // Create a map and center it on Manhattan.
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: {
                    lat: 25.036212621702365,
                    lng: 121.43236401211286
                },
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
                        icon: {
                            url: "./assets/img/posIcon2.png"
                        },
                        map: map
                    });
                    map.setZoom(17);
                    map.setCenter(pos);

                    const service = new google.maps.DistanceMatrixService(); // instantiate Distance Matrix service

                    const matrixOptions = {
                        origins: [{
                            lat: pos.lat,
                            lng: pos.lng
                        }], // technician locations
                        destinations: destinations, // customer address
                        travelMode: 'WALKING',
                        unitSystem: google.maps.UnitSystem.METRIC
                    };
                    // Call Distance Matrix service
                    service.getDistanceMatrix(matrixOptions, callback).then(e => {
                        console.log("THEN");

                        // Create markers.
                        for (let i = 0; i < MapOptions.length; i++) {
                            console.log(((MapOptions[i].checkID > 0) ? likeString + MapOptions[i].placeID + likeIcon : dislikeString + MapOptions[i].placeID + dislikeIcon))


                            const contentString =
                                '<div id="content" style="width:100%;">' +
                                '<div id="siteNotice">' +
                                '</div>' +

                                '<div id="firstHeading" class="firstHeading">' +

                                '<table border="0" style="width:350px ; height:150px; " class="ubike_css">' +
                                '<tr style="border-bottom: 2px lightgray solid; margin-bottom: 2px;">' +
                                '<td colspan="2" style=" width: 25%; text-align: left; font-size: 30px; padding-left: 20px;">' +
                                ((MapOptions[i].checkID > 0) ? likeString + MapOptions[i].placeID + likeIcon : dislikeString + MapOptions[i].placeID + dislikeIcon) +

                                '<b style="color: #fd7e14;">' + MapOptions[i].placeName + '</b>' +

                                '<sub style="font-size: 10px">距離' + detail.rows[0].elements[i].distance.text + '</sub>' +

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

                                ((MapOptions[i].type === 'version3') ?
                                    borrow_1 + MapOptions[i].borrow_1 + return_1 + MapOptions[i].return_1 + endTag + borrow_2 + MapOptions[i].borrow_2 + return_2 + MapOptions[i].return_2 + endTag :
                                    (MapOptions[i].type === 'version1') ? borrow_1 + MapOptions[i].borrow_1 + return_1 + MapOptions[i].return_1 + endTag : borrow_2 + MapOptions[i].borrow_2 + return_2 + MapOptions[i].return_2 + endTag) +

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

                    });

                    // Callback function used to process Distance Matrix response
                    function callback(response, status) {
                        if (status !== "OK") {
                            alert("Error with distance matrix");
                            return;
                        } else {
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

            // Create a renderer for directions and bind it to the map.
            const directionsRenderer = new google.maps.DirectionsRenderer({
                map: map
            });
            // Instantiate an info window to hold step text.
            const stepDisplay = new google.maps.InfoWindow();

            // Display the route between the initial start and end selections.
            calculateAndDisplayRoute(
                directionsRenderer,
                directionsService,
                markerArray,
                stepDisplay,
                map
            );

            // Listen to change events from the start and end lists.
            const onChangeHandler = function() {
                calculateAndDisplayRoute(
                    directionsRenderer,
                    directionsService,
                    markerArray,
                    stepDisplay,
                    map
                );
            };

            document.getElementById("start").addEventListener("change", onChangeHandler);
            document.getElementById("end").addEventListener("change", onChangeHandler);
        }

        function calculateAndDisplayRoute(
            directionsRenderer,
            directionsService,
            markerArray,
            stepDisplay,
            map
        ) {
            // First, remove any existing markers from the map.
            for (let i = 0; i < markerArray.length; i++) {
                markerArray[i].setMap(null);
            }

            // Retrieve the start and end locations and create a DirectionsRequest using
            // WALKING directions.
            directionsService
                .route({
                    origin: document.getElementById("start").value,
                    destination: document.getElementById("end").value,
                    travelMode: google.maps.TravelMode.WALKING,
                })
                .then((result) => {
                    // Route the directions and pass the response to a function to create
                    // markers for each step.
                    document.getElementById("warnings-panel").innerHTML =
                        "<b>" + result.routes[0].warnings + "</b>";
                    directionsRenderer.setDirections(result);
                    showSteps(result, markerArray, stepDisplay, map);
                })
                .catch((e) => {
                    window.alert("Directions request failed due to " + e);
                });
        }

        function showSteps(directionResult, markerArray, stepDisplay, map) {
            // For each step, place a marker, and add the text to the marker's infowindow.
            // Also attach the marker to an array so we can keep track of it and remove it
            // when calculating new routes.
            const myRoute = directionResult.routes[0].legs[0];

            for (let i = 0; i < myRoute.steps.length; i++) {
                const marker = (markerArray[i] =
                    markerArray[i] || new google.maps.Marker());

                marker.setMap(map);
                marker.setPosition(myRoute.steps[i].start_location);
                attachInstructionText(
                    stepDisplay,
                    marker,
                    myRoute.steps[i].instructions,
                    map
                );
            }
        }

        function attachInstructionText(stepDisplay, marker, text, map) {
            google.maps.event.addListener(marker, "click", () => {
                // Open an info window when the marker is clicked on, containing the text
                // of the step.
                stepDisplay.setContent(text);
                stepDisplay.open(map, marker);
            });
        }

        window.initMap = initMap;
    </script>
</head>

<body>
    <div style="border: none; width: 35%; margin-left: 7%" id="floating-panel">
        <table>
            <tr>
                <td><b>Start：</b></td>
                <td>
                    <select style="font-weight: bold;" id="start" class="form-select" readonly>
                        <?php
                        $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
                        if (!$link) {
                            echo "連接失敗" . mysqli_connect_error();
                        }
                        mysqli_query($link, "set names utf8");
                        $sql = "SELECT * FROM ubike_station where ubike_station_id = '$start_station'";
                        $result2 = mysqli_query($link, $sql);

                        if (is_numeric(substr($start_station, 0, 2))) {
                        ?>

                            <option value="<?php echo $start_station ?>">你的位置</option>

                            <?php } else {
                            while ($record2 = mysqli_fetch_row($result2)) {
                            ?>
                                <option style="font-weight: bold;" value="<?php echo $record2[6] ?>,<?php echo $record2[7] ?>"><?php echo $record2[1] ?></option>

                        <?php }
                        } ?>

                        <!--現在位置 -->
                        <option id="geoPosition">你的位置</option>

                        <?php
                        $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
                        if (!$link) {
                            echo "連接失敗" . mysqli_connect_error();
                        }
                        mysqli_query($link, "set names utf8");
                        $sql = "SELECT * FROM ubike_station";
                        $result2 = mysqli_query($link, $sql);

                        while ($record2 = mysqli_fetch_row($result2)) {
                        ?>

                            <option value="<?php echo $record2[6] ?>,<?php echo $record2[7] ?>"><?php echo $record2[1] ?></option>

                        <?php } ?>
                    </select>
                </td>

                <td style="padding-left: 1%;"><b>End：</b></td>


                <td><select style="font-weight: bold;" id="end" class="form-select" readonly>
                        <?php
                        $link = mysqli_connect("localhost", "root", "12345678", "ubike_sa");
                        if (!$link) {
                            echo "連接失敗" . mysqli_connect_error();
                        }
                        mysqli_query($link, "set names utf8");
                        $sql = "SELECT * FROM ubike_station where ubike_station_id = '$end_station'";
                        $result3 = mysqli_query($link, $sql);

                        if (is_numeric(substr($end_station, 0, 2))) {
                        ?>
                            <option value="<?php echo $end_station; ?>">你的位置</option>
                            <?php
                        } else {
                            while ($record3 = mysqli_fetch_row($result3)) {
                            ?>

                                <option style="font-weight: bold;" value="<?php echo $record3[6] ?>,<?php echo $record3[7] ?>"><b><?php echo $record3[1] ?></b></option>

                        <?php }
                        } ?>
                        <option id="geoPosition2">你的位置</option>
                        <?php
                        $sql4 = "SELECT * FROM ubike_station ";
                        $result4 = mysqli_query($link, $sql4);

                        while ($record4 = mysqli_fetch_row($result4)) {
                        ?>

                            <option value="<?php echo $record4[6] ?>,<?php echo $record4[7] ?>"><?php echo $record4[1] ?></option>

                        <?php } ?>



                    </select>
                </td>
                <td style="padding-left: 2%;"><a href="index.php"><button style="margin-left: 15px; font-size: 14px; width: 100px; font-weight: bold;" type="button" class="btn btn-primary">回首頁</button></a></td>
            </tr>
        </table>
    </div>
    <div id="map"></div>
    &nbsp;
    <div id="warnings-panel"></div>

    <!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqGSLbGTcofKwEbU43wB5tap5IjYSeXJI&libraries=places,geometry&v=3&callback=initMap&v=weekly" defer></script>
</body>
<?php include 'footer.php' ?>

</html>