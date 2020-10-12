<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  
    <title>צור קשר</title>

  
     <!-- Load Header & Footer -->
    <script  src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script> 
    $(function(){
        $("#header").load("header.php"); 
        $("#footer").load("footer.html");
    });
    </script>
    
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
    
</head>

 <!-- Begin of Contact us logic -->

<?php
//Connection to db
require('./Includes/PHP/db.php');

if (isset($_POST['send'])) {
    
    $name=$_POST['name'];
    $email=$_POST['email'];
    $description=$_POST['description'];
    $date=date("Y-m-d");
    
    //add to db
	$sql= "INSERT INTO `contact_us` (`name`, `email`, `description`) VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['description']."')";
	$result = $conn->query($sql);
    
    //send mail to studio
        if ($result){
            $to = "‫shape4yousadna@gmail.com‬"; 
            $from = "myEmail@test.com"; // this is the sender's Email address
            $headers = "From: " .  $email;
            $subject = "New request - Contact us";
            $message = $name . " wrote the following:" . "\n\n" . $description . "\n\n" . "  Email address is: " . $email . "\n\n" . "  Date: " . $date;
        
            mail($to,$subject,$message,$headers);
            
            echo'
                <script type="text/javascript">
                
                $(document).ready(function(){
                
                  swal({
                    icon: "success",
                    title: "תודה שפנית אלינו, נחזור אלייך בהקדם האפשרי",
                    showConfirmButton: "false",
                    timer: 5000
                  })
                });
                
                </script>
                ';
        }
        else {
            echo'
                <script type="text/javascript">
                
                $(document).ready(function(){
                
                  swal({
                    Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "השליחה נכשלה...נסה שנית",
                    timer: 5000
                  })
                });
                
                </script>
                ';
        }
}
?>

<!-- End of Contact us logic -->
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
                        <h2>צור קשר</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->



    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-info">
                        <h4>ואפשר גם באמצעות:</h4>
                        <div class="contact-address">
                            <div class="ca-widget">
                                <div class="cw-icon">
                                    <img src="img/icon/icon-1.png" alt="">
                                </div>
                                <div class="cw-text">
                                    <h5>כתובת</h5>
                                    <p>הרצל 53, חדרה</p>
                                </div>
                            </div>
                            <div class="ca-widget">
                                <div class="cw-icon">
                                    <img src="img/icon/icon-2.png" alt="">
                                </div>
                                <div class="cw-text">
                                    <h5>טלפון</h5>
                                    <p>09-8652875</p>
                                </div>
                            </div>
                            <div class="ca-widget">
                                <div class="cw-icon">
                                    <img src="img/icon/icon-3.png" alt="">
                                </div>
                                <div class="cw-text">
                                    <h5>אימייל</h5>
                                    <p>shape4yousadna@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact-form">
                       <h4>השאירו פרטים בטופס ונחזור אליכם בהקדם</h4>
                        <form method="post" action="">
                            <div class="form-group text-right form-row d-flex flex-row-reverse">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input class="form-control text-right" type="email" id="email" name="email" maxlength="100" placeholder="כתובת מייל" required> 
                                </div>
                                <div class="col-lg-6">
                                    <input class="form-control text-right" id="name" name="name" type="text" maxlength="100" placeholder=" שם פרטי ומשפחה " required>
                                </div>
                                <div class="col-lg-12">
                                    <textarea class="form-control text-right" type="text" id="description" maxlength="1000" name="description" placeholder="תוכן הפנייה שלכם" required></textarea>
                                    <input type="submit" name="send" value="שלח">
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
    

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