<?php session_start(); ?>

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
            <section id="blog" class="blog" style="margin-left: 15%;">
                <div class=" container" data-aos="fade-up">
                    <div class="row">
                        <div class="col-lg-10 entries">
                            <article class="entry">
                                <center>
                                    <h1 class="entry-title" style="margin-bottom:30px; font-size: 50px; ">常見問題</h1>
                                </center>
                                <div class="container">
                                    <section id="contact" class="contact">
                                        <div class="container">
                                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="background-color:#FFAD60;border-radius:5px;border:none;font-weight:bold;">
                                                            <div class="accordion-head">Q：什麼是微笑單車？</div>
                                                        </button>
                                                    </h2>
                                                    <style>
                                                        .accordion-head{
                                                            color: white
                                                        }
                                                    </style>
                                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body" >A：「YouBike微笑單車」為提供24小時甲租乙還租賃服務的電子無人自動化管理公共自行車系統，以優質的營運服務、舒適好騎的自行車、方便註冊與使用之特點，鼓勵民眾改變出行習慣，使用大眾運輸系統，降低交通壅塞度，同時能夠環保節能，創造永續智慧交通環境。</div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingTwo">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" style="background-color:#FFAD60;border-radius:5px;border:none;font-weight:bold;margin-top:30px;">
                                                            <div class="accordion-head">Q：如何註冊YouBike會員？</div>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">A：至網站<a href="register.php"><b><u>註冊頁面</u></b></a>，填寫會員必備資訊，完成後即成為會員。</div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingThree">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="background-color:#FFAD60;border-radius:5px;border:none;font-weight:bold;margin-top:30px;">
                                                            <div class="accordion-head">Q：YouBike適用的電子票證種類？</div>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">A：目前可使用的電子票證種類有悠遊卡、一卡通及信用卡共三種。</div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingFour">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour" style="background-color:#FFAD60;border-radius:5px;border:none;font-weight:bold;margin-top:30px;">
                                                            <div class="accordion-head">Q：會員租用YouBike的費率為何？</div>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">A：收費方式為<b>每30分鐘10元。</b></div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingFive">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive" style="background-color:#FFAD60;border-radius:5px;border:none;font-weight:bold;margin-top:30px;">
                                                            <div class="accordion-head">Q：不小心騎車跌倒發生事故，怎麼辦？</div>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">A：若騎乘時發生意外，請撥打<a href="ubike_accident.php"><b><u>服務電話</u></b></a>通報，並視當下情況判定是否需要請警方協助。後續微笑單車人員會協助釐清狀況，若車輛損壞嚴重需賠償，後續會再聯繫租用者。</div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingSix">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix" style="background-color:#FFAD60;border-radius:5px;border:none;font-weight:bold;margin-top:30px;">
                                                            <div class="accordion-head">Q：YouBike故障了怎麼辦？</div>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">A：請填寫<a href="ubike_malfunction_form.php"><b><u>單車故障回報表單</u></b></a>，通報我們進行維修。建議您於出發前先檢查車況，確認正常後再行借車。</div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingSeven">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven" style="background-color:#FFAD60;border-radius:5px;border:none;font-weight:bold;margin-top:30px;">
                                                            <div class="accordion-head">Q：YouBike站點的營運時間？</div>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">A：YouBike微笑單車使用無人自動化管理系統，提供24小時自行車甲租乙還之租賃服務。</div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingEight">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight" style="background-color:#FFAD60;border-radius:5px;border:none;font-weight:bold;margin-top:30px;">
                                                            <div class="accordion-head">Q：YouBike是否提供團體租借服務？</div>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">A：為維持及提供民眾租借使用YouBike微笑單車，本公司不提供團體租借服務。</div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingNine">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine" style="background-color:#FFAD60;border-radius:5px;border:none;font-weight:bold;margin-top:30px;">
                                                            <div class="accordion-head">Q：可以使用YouBike長途騎乘或是進行競技比賽嗎？</div>
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">A：YouBike主要設置目的為短程接駁，故車輛設計著重於都市內道路使用，感謝您對YouBike的厚愛，但為了您自身安全，建議您切勿冒險嘗試山路或長程騎乘。</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <style>
        .accordion-body {
            border:none;
            height:100%;
            padding:10px;
            background-color:#F7F7F7;
        }
    </style>

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