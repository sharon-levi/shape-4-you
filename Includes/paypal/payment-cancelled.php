<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gutim Template">
    
    <title>התשלום בוטל או נכשל - SHAPE4YOU </title>
    
    <!-- Css Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css" type="text/css">
  
    
</head>

<body>
<?php

// Connection to db
require('../PHP/db.php');

//if payment is canceled, delete the user 

      $del_sql = "DELETE FROM `clients` WHERE email=\"$_SESSION[email]\"";
      $result_query = $conn->query($del_sql);
      session_destroy();

?>
<!-- payment Section Begin -->
    <section class="membership-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title">
                    </div>
                </div>
            </div>
                 <div class="col-lg-12">
                    <div class="membership-item">
                        <div class="mi-title">
                            <h4>התשלום נכשל או בוטל</h4>
                           </div>
                            <img src="/img/paypal/X.png">
                             <ul>
                              <span dir="rtl"> בטוחים שהתכוונתם לבטל? </span><br>
                              <span dir="rtl">אל תפספסו את המנוי הכי שווה באיזור</span>
                            </ul>
                          
                    <a href="http://adisha.mtacloud.co.il/index.php">
                           <button class="primary-btn">למעבר לדף הבית </button></a>
                     </div>
               </div>
         </div>
 </section>
 <!-- payment Section End -->
</body>
</html>