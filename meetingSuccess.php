<?php
session_start();
?>
    
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!-- Load Header & Footer-->
    <script  src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script> 
    $(function(){
        $("#header").load("header.php"); 
        $("#footer").load("footer.html");
    });
    </script>
    
    <title>פגישה נקבעה בהצלחה</title>
    
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/meeting.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <div id="header"> </div>
    <!-- Header End -->
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb/breadcrumb-main-img.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>פגישות אישיות</h2>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Meeting Success Section Begin -->
    <section class="meeting-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                    </div>
                </div>
            </div>
                 <div class="col-lg-12">
                    <div class="membership-item mb-5">
                        <div class="mi-title">
                            <h4>הפגישה נקבעה בהצלחה</h4>
                           </div>
                           <img src="/img/paypal/V.png">
                          <h2 class="mi-price"> נתראה בקרוב</h2>
                             <ul>
                              <h5><u>דגשים לקראת הפגישה האישית:</u></h5><br><br>
                              <ol>
                                  <li><h5>יש להגיע למכון כ10 דקות לפני שעת הפגישה שנקבעה.</h5></li><br>
                                  <li><h5>הדיאטנית או המאמן יאספו אותך מהקבלה בשעת הפגישה.</h5></li><br>
                                  <li><h5>לאור הנחיות ה"תו הסגול", יש לעטות מסכה לאורך כל זמן הפגישה.</h5></li><br>
                                  <li><h5>ניתן לצפות במדדים ובסיכום הפגישה ב<a href="http://adisha.mtacloud.co.il/personal-area.php">איזור האישי</a> תחת הלשונית "מעקב תזונה" או "מעקב ספורט".</h5></li><br>
                              </ol>
                            </ul>
                    <a href="http://adisha.mtacloud.co.il/index.php">
                           <button class="primary-btn ">למעבר לדף הבית</button></a>
                     </div>
               </div>
         </div>
    </section>
    <!-- Meeting Success Section End -->
 
    <!-- Footer Section Begin -->
     <div id="footer"> </div>
     <p style="color: white; margin: 0px;">
     Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i>  <a href="https://colorlib.com" target="_blank"></a>
   </p>

    <!-- Footer Section End -->


    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
