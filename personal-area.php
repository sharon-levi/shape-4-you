<?php 
session_start();
require_once('./Includes/PHP/personal_area_utils.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta charset="UTF-8">
	<title>איזור אישי</title>

    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
   <link rel="stylesheet" href="css/personal.css" type="text/css"/> 
   
    <!-- Load Header & Footer -->
    <script  src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script> 
    $(function(){
        $("#header").load("header.php"); 
        $("#footer").load("footer.html");
    });
    </script>
</head>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
     <div id="header"> </div>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/personal_area/personal_area.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2 style="margin-right: 9% !important;">איזור אישי</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    
 <!-- Personal Area navigation bar start -->
 
<section class="test">
<p>לחצ/י על הכפתור כדי לעבור ללשונית</p>

    <div class="personalTab">
      <button class="tablinks" onclick="openCity(event, 'personalProfile')" id="personalDefaultOpen">פרופיל אישי</button>
      <button class="tablinks" onclick="openCity(event, 'personalDiet')">מעקב תזונה</button>
      <button class="tablinks" onclick="openCity(event, 'personalTrain')"> מעקב ספורט</button>
    </div>


    <div id="personalProfile" class="personalTabcontent">
      <?php include('personal-area-details-tab.php'); ?>
    </div>
    
    <div id="personalDiet" class="personalTabcontent">
      <?php include('personal-area-diet-tab.php'); ?>
    </div>
    
    <div id="personalTrain" class="personalTabcontent">
      <?php include('personal-area-train-tab.php'); ?>
    </div>

</section>

 <!-- Personal Area navigation bar end -->
 

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("personalTabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="personalDefaultOpen" and click on it
document.getElementById("personalDefaultOpen").click();
</script>


      <!-- Footer Section Begin -->
     <div id="footer"> </div>
    <!-- Footer Banner Section End -->
    <p style="color: white; margin: 0px;">
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i>  <a href="https://colorlib.com" target="_blank"></a>
 </p>

  

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