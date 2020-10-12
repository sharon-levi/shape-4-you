<!DOCTYPE html>
<html lang="zxx">
    
<head>
    <meta charset="UTF-8">
    
    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    <!-- Load Header & Footer -->
    <script  src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script> 
    $(function(){
        $("#header").load("header.php"); 
        $("#footer").load("footer.html");
    });
    </script>
    
    <title>הרשמה</title>

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/signup_style.css" type="text/css">
    
</head>

<!-- Begin of signup logic -->
<?php
//Connection to db
require('./Includes/PHP/db.php');

// Create array to store errors for later
$errors = array(); 

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
  $birth_date = $_POST['birth_date'];
  $id = $_POST['id'];
  $phone = $_POST['phone'];
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $street = mysqli_real_escape_string($conn, $_POST['street']);
  $house_number = mysqli_real_escape_string($conn, $_POST['house_number']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
  $medical_info = mysqli_real_escape_string($conn, $_POST['medical_info']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
      echo'
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                        
                          swal({
                            icon: "error",
                            title: "אימות הסיסמה נכשל, נא להזין מחדש",
                            showConfirmButton: "true",
                            timer: 5000
                          })
                        });
                        
                        </script>
                        '; 
  }
  
  // first check the database to make sure a user does not already exist with the same email
  $email_check_query = "SELECT * FROM clients WHERE email='$email' LIMIT 1";
  $result = mysqli_query($conn, $email_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['email'] == $email) {
      array_push($errors, "email already exists");
      echo'
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                        
                          swal({
                            icon: "error",
                            title: "המשתמש כבר קיים במערכת",
                            showConfirmButton: "true",
                            timer: 5000
                          })
                        });
                        
                        </script>
                        '; 
    }
  }
  
  $id_check_query = "SELECT * FROM clients WHERE id='$id' LIMIT 1";
  $id_result = mysqli_query($conn, $id_check_query);
  $user_id = mysqli_fetch_assoc($id_result);
  
  if($user_id) {
      if ($user_id['id'] == $id) {
          array_push($errors, "id already exists");
          echo'
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                        
                          swal({
                            icon: "error",
                            title: "המשתמש כבר קיים במערכת",
                            showConfirmButton: "true",
                            timer: 5000
                          })
                        });
                        
                        </script>
                        '; 
      }
  }
  
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = $password_1;
  	$membership_end_date = new DateTime('now');
  	$membership_end_date->modify('+12 month');
    $membership_end_date = $membership_end_date->format('Y-m-d h:i:s');
    
  	$query = "INSERT INTO `clients` (`first_name`,`last_name`,`birth_date`,`id`,`phone`,`city`,`street`,`house_number`,`email`,`password`,`membership_end_date`, `medical_info`)
  			  VALUES('".$first_name."', '".$last_name."', '".$birth_date."', '".$id."', '".$phone."', '".$city."', '".$street."', '".$house_number."', '".$email."', '".$password."', '".$membership_end_date."', '".$medical_info."')";

    if ($conn->query($query)==FALSE){
    echo "Signup error. Please return to the page and try again";  
    $conn->error;
    exit();
    }
  	else{
  	    session_start();
  	    $_SESSION['email'] = $email;
  	    header("Location: ./Includes/paypal/paypal_redirect.html");
  }
  }
  else {
      foreach ($errors as $error):
   endforeach;
};
}
?>
<!-- End of signup logic -->
<body>
    
    <!-- Header Section Begin -->
    <div id="header"> </div>
    <!-- Header End -->
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb/breadcrumb-main-img.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>הרשמה</h2>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Breadcrumb Section End -->

<!-- Membership Section Begin -->
    <section class="membership-section spad-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title"></div>
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
                                <h5>המחיר הכי משתלם באיזור!</h5>
                                <br>
                                <h5>המנוי כולל:</h5>
                            </li>
                             <li>
                                <h5>מגוון של חוגי ספורט - ללא הגבלה</h5>
                            </li>
                            </br>
                            <li>
                                <h5><u> בניית תוכנית אימונים </u></h5>
                                <h5>פגישה אישית עם מאמן הכוללת בניית תוכנית אימונים מותאמת אישית,
                                
                                מתן דגשים ומעקב מלא על התקדמות הלקוח.
                                
                                 מפגשים ללא הגבלה!</h5>
                            </li>
                            </br>
                            <li>
                                <h5><u>שירות דיאטנית </u></h5>
                             <h5>פגישת אישית עם דיאטנית קלינית הכוללת בניית תפריט מותאם אישית לאורח החיים,<br>
                             מתן דגשים, המלצות להמשך ומעקב מלא על התקדמות הלקוח.
                                <br> 
                                 מפגשים ללא הגבלה!</h5>
                            </li>
                        </ul>
                    </div>
                </div>
    </section>
       <!-- Membership Section End -->

<div class="container-lg-12 mt-5">
  <form method = "post" action = "" name= "signup_form">
      <fieldset>
		<legend>הרשמה</legend>
   
    <div class="form-group text-right form-row d-flex flex-row-reverse">
        <div class="col">
            <label for="first_name">שם פרטי</label>
            <input class="form-control text-right" type="text" id="first_name" maxlength="100" name="first_name" placeholder="שם פרטי" required>
        </div>
        <div class="col">
            <label for="last_name">שם משפחה</label>
        <input class="form-control text-right" type="text" id="last_name" maxlength="100" name="last_name" placeholder="שם משפחה" required>
        </div>
    </div>
    
    <div class="form-group text-right form-row d-flex flex-row-reverse">
        <div class="col">
            <label for="id">תעודת זהות כולל ספרת ביקורת</label>
            <input class="form-control text-right" type="text" id="id" name="id" placeholder="תעודת זהות" pattern="[0-9]{9}" required>
        </div>
        <div class="col">
            <label for="birth_date">תאריך לידה</label>
            <input class="form-control text-right" type="date" id="birth_date" name="birth_date">
        </div>
    </div>
   
   <div class="form-group text-right form-row d-flex flex-row-reverse">
        <div class="col">
            <label for="city">עיר מגורים</label>
            <input class="form-control text-right" type="text" id="city" maxlength="100" name="city" placeholder="עיר מגורים" required>
        </div>
        <div class="col">
            <label for="street">רחוב</label>
            <input class="form-control text-right" type="text" id="street" maxlength="100" name="street" placeholder="רחוב" required>
        </div>
        <div class="col">
            <label for="house_number">מספר בית</label>
            <input class="form-control text-right" type="number" id="house_number" max="500" min="1" name="house_number" placeholder="מספר בית" required>
        </div>
    </div>
    
    <div class="form-group text-right row-reverse">
        <label for="phone">מספר טלפון</label>
        <input class="form-control text-right" type="tel" id="phone" name="phone" placeholder="05XXXXXXXX" pattern="[0]{1}[5]{1}[0-9]{8}" required>
    </div>
    
    <div class="form-group text-right row-reverse">
        <label for="email">כתובת מייל</label>
        <input class="form-control text-right" type="email" id="email" maxlength="100" name="email" placeholder="כתובת מייל" required>
    </div>
    
    <div class="form-group text-right form-row d-flex flex-row-reverse">
        <div class="col">
            <label for="password_1">סיסמה</label>
            <input class="form-control text-right md-6" type="password" maxlength="20" id="password_1" name="password_1" placeholder="סיסמה" required>
        </div>
        <div class="col">
            <label for="password_2">חזור שוב על הסיסמה</label>
            <input class="form-control text-right md-6" type="password" maxlength="20" id="password_2" name="password_2" placeholder="סיסמה" required>
        </div>
    </div>
    
    <div class="form-group custom-control custom-checkbox text-right">
        <input class="custom-control-input" type="checkbox" id="checkbox" required>
        <label class="custom-control-label" for="checkbox">אני מאשר כי מצבי הרפואי מאפשר להתאמן בסטודיו</label>
    </div>

    <div class="form-group text-right row-reverse">
        <label for="medical_info">האם יש בעיות בריאותיות שתרצה לפרט</label>
        <textarea class="form-control text-right" type="text" id="medical_info" maxlength="1000" name="medical_info"></textarea>
    </div>

    <div class="form-group row">
      <input type="submit" class="update-btn" value="סיום הרשמה ומעבר לתשלום" name="reg_user">
    </div>
  </form>
</div>
</fieldset>


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