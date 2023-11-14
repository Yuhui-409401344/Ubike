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
<!DOCTYPE html>
<html>

<head>
    <script src="https://kit.fontawesome.com/874fe894d1.js" crossorigin="anonymous"></script>

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

    <script>
        let map;
        // var geolocation = 'https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyAvNrHicWm9EGNy0d3JOn8amUWHwiMAk44';

        function initMap() {
            const icons = {
                version1: { //1: 純1.0站點
                    icon: {url:"./assets/img/1.0-map-green.svg", scaledSize: new google.maps.Size(85, 85)},
                },
                version2: { //2: 純2.0站點
                    icon: {url:"./assets/img/1.0-map-orange.svg", scaledSize: new google.maps.Size(85, 85)},
                },
                version3: { //3: 1.0+2.0站點
                    icon: {url:"./assets/img/2.0-map-red.svg", scaledSize: new google.maps.Size(85, 85)},
                },
            };

            map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(25.036071990298225, 121.43233991555581),
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
</head>

<body>
    <div id="map"></div>
    <script defer async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqGSLbGTcofKwEbU43wB5tap5IjYSeXJI&callback=initMap&v=weekly"></script>
    
    <?php
        while ($record = mysqli_fetch_row($result)) {
            echo $record[0];
        }
    ?>

</body>

</html>