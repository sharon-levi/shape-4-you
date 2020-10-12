<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
      <title>SHAPE4YOU - דף הבית</title>
 
    
    <!-- Load Header & Footer -->
    <script  src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script> 
    $(function(){
        $("#header").load("header.php"); 
        $("#footer").load("footer.html");
    });
    </script>

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
      
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <div id="header"> </div>
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb/breadcrumb-main-img.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero-text">
                        <h1>SHAPE 4 YOU</h1>
                        <span>סטודיו המתמחה בתזונה, ספורט ושמירה על אורח חיים בריא</span>
                    </div>
                 
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Section Begin -->
    <section class="about-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-pic">
                        <img src="img/homepage/shutterstock_531182776-min.jpg" alt="">
                        <a href="https://www.youtube.com/watch?v=_Y-T5aIJvRM" class="play-btn video-popup">
                            <img src="img/play.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-text">
                        <h2>הסיפור שלנו</h2>
                        <p class="first-para"> SHAPE4YOU</p>
                         <p class="second-para"> 
                                         הסטודיו הוקם לפני כ-10 שנים בחדרה ופועל לספק אימוני כושר וליווי תזונתי עבור לקוחותיו.
                              <br>השירותים הניתנים ללקוחות הסטודו כוללים אימונים מגוונים המתאימים לכל רמת קושי,
                              ליווי אישי מרגע ההרשמה עד להשגת התוצאות הרצויות,
                              <br>
                              גם בתחום הספורט - פגישות אישיות עם מאמן, בניית תכניות אימונים 
                              <br>
                            וגם בתחום התזונה - פגישות אישיות עם דיאטנית ובניית תפריט תזונה מותאם אישית
                            <br>כל התהליך מתבצע ע״י אנשי המקצוע הטובים ביותר בתחום
                                   </p>
                        
                        <a href="about-us.html" class="primary-btn">עוד על הסטודיו</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Services Section Begin -->
    <section class="services-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="services-pic">
                        <img src="img/homepage/home_banner-min.jpg">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-items">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="services-item pd-b">
                                    <img src="img/services/trx1.png"  width=100px   >
                                    <h4>TRX </h4>
                                    <p>אימון כנגד משקל גוף המאפשר לנו לחזק את כל שרירי הגוף בתנוחות תרגול שונות ובכל רמות הקושי</p>
                                </div>
                                <div class="services-item bg-gray pd-b">
                                <img src="img/services/service-icon-2.png" width=80px >
                                    <h4>מאמן אישי</h4>
                                        <p>בניית תכניות אימונים מותאמות אישית לרמת הכושר של הלקוח וכן שינוי התוכניות לפי קצב ההתקדמות</p>      
                                        <p>מתן דגשים והמלצות להמשך התהליך באופן תמידי עד להשגת תוצאות</p></div>
                            </div>
                            <div class="col-md-6">
                                <div class="services-item bg-gray">
                                    <img src="img/services/yogaO .png"  width=100px  >
                                    <h4>Yoga</h4>
                                    <p>תרגול יוגה הוא פעילות חשובה מאוד לבריאות שלנו, היא משפרת את הגמישות והיציבה שלנו, </p>
                                    <p>מפחיתה לחץ נפשי, משפרת את זרימת הדם, את המערכת החיסונית ומעלה את מצב הרוח.</p>
                                </div>
                                <div class="services-item pd-b">
                                    <img src="img/services/service-icon-4.png" width=60px >
                                        <h4>דיאטנית קלינית</h4>
                                            <p>ליווי תזונתי אישי מרגע הרישום לסטודיו, הכולל בניית תפריט תזונה אישית המותאם לאורח חיי הלקוח</p>      
                                            <p>המלצות בתחום התזונה והתאמת התפריט למצב הבריאותי המשתנה של כל אחד</p></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <!-- Services Section End -->
    
    
    <!-- Membership Section Begin -->
    <section class="membership-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">

                    </div>
                </div>
            </div>
           
                 <div class="col-lg-12">
                    <div class="membership-item">
                        <div class="mi-title">
                            <h4>מנוי שנתי</h4>
                            <div class="triangle"></div>
                        </div>
                        <h2 class="mi-price"> ₪1200 </h2>
                        <ul>
                            <li>
                                <h5>המנוי כולל:</h5>
                            </li>
                             <li>
                                <h5>מגוון של חוגי ספורט - ללא הגבלה</h5>
                            </li>
                            </br>
                            <li>
                                <h5><u> בניית תוכנית אימונים </u></h5>
                                <h5>פגישה אישית עם מאמן הכוללת בניית תוכנית אימונים מותאמת אישית,
                               
                                מתן דגשים ומעקב מלא על התקדמות הלקוח
                                <br> 
                                 מפגשים ללא הגבלה!</h5>
                            </li>
                            </br>
                            <li>
                                <h5><u>שירות דיאטנית </u></h5>
                             <h5>פגישת אישית עם דיאטנית קלינית הכוללת בניית תפריט מותאם אישית לאורח החיים,
                             מתן דגשים, המלצות להמשך ומעקב מלא על התקדמות הלקוח
                                <br> 
                                 מפגשים ללא הגבלה!</h5>
                            </li>
                        </ul>
                        <a href="signup.php" class="primary-btn membership-btn">להרשמה </a>
                    </div>
                </div>
       <!-- Membership Section End -->

       <!-- Trainer Section Begin -->
    <section class="trainer-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>צוות המאמנים שלנו </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="single-trainer-item">
                        <img src="img/trainer/מאמנת 3.jpg"  >
                        <div class="trainer-text">
                            <h5>ענבל ברי</h5>
                            <span>מדריכת יוגה </span>
                            <p>ענבל מתרגלת יוגה כ-8 שנים, בעלת הכשרה כמדריכה כבר 6 שנים ובעלת הכשרות רבות בתחום</p>
                
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="single-trainer-item">
                        <img src="img/trainer/OHAD-ROMANO-4612-FINAL_P_wo_500_679.jpg"  >
                        <div class="trainer-text">
                            <h5>אירה בליך</h5>
                            <span>מאמנת ארובי </span>
                                <p>בעלת תואר שני בספורט, מאמנת כושר כבר 7 שנים עם הכשרות רבות בתחום האירובי</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="single-trainer-item">
                        <img src="img/trainer/מאמן1.jpeg"   >
                        <div class="trainer-text">
                            <h5>כפיר דדון</h5>
                            <span>מנהל הסטודיו</span>
                                <p>מנהל הסטודיו, בעל תואר שני בספורט מבית הספר ווינגיט, עם ניסיון של 10 שנים בתחום וניהול מכוני כושר</p>
                        </div>
                    </div>
                </div>
                
                  <div class="col-lg-3 col-md-3">
                    <div class="single-trainer-item">
                        <img src="img/trainer/תזונאית.jpg" >
                        <div class="trainer-text">
                            <h5>מאיה רוזמן</h5>
                            <span>דיאטנית קלינית </span>
                            <p>מאיה בעלת ותק של 30 שנה בתחום ייעוץ, ליווי תזונתי וידע נרחב בהקלת בעיות רפואיות.</p>
                           
                        </div>
                    </div>
                </div>
               
                </div>
            </div>
        </div>
    </section>
    <!-- Trainer Section End -->

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