<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>התחברות למערכת - SHAPE4YOU </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
     <!-- Css Styles -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/login_style.css">  

    
</head>
<body>
    
<!----- Begin of Login logic ------>

<?php
//Connection to db
require('./Includes/PHP/db.php');

// If form submitted, insert values into the database.
if (isset($_POST['email'])){
        session_start();
        // removes backslashes
     $email = stripslashes($_REQUEST['email']);
         //escapes special characters in a string
     $email = mysqli_real_escape_string($conn,$email);
     $password = stripslashes($_REQUEST['password']);
     $password = mysqli_real_escape_string($conn,$password);
         //Checking if user existing in the db or not
     $query = "SELECT * FROM `clients` WHERE email='$email' and password='$password'";
     $result = mysqli_query($conn,$query) or die(mysql_error());
     $rows = mysqli_num_rows($result);
        if($rows==1){
             $row = $result->fetch_assoc();	
             $_SESSION['user_id'] = $row[id];
             $_SESSION['email'] = $email;
             header("Location: index.php");
         }
         else{
             echo ' <div class="p-5 mt-5 membership-item" id="frm">  
             <h2> התחברות למערכת</h2>
            <form action="" method="post">
               
              <div class="imgcontainer">
                <img src="img/homepage/black_logo.png" class="avatar">
              </div>
              <div class="container">
                        <input class="form-control text-right" type="email" id="email" name="email" placeholder="שם משתמש" required/>
                        <input type="password" class="form-control text-right" id="password" name="password" placeholder="סיסמה" required/>
                    <small class="text-danger"> שם המשתמש או הסיסמה אינם נכונים. אנא נסה שנית</small>
                   <button type="submit">Login</button>
              </div>
            
              <div class="container" style="background-color:#f1f1f1">
                  <a href="index.php">
                <button type="button" class="cancelbtn">חזרה לדף הבית</button></a>
                <span class="psw"><a href="contact.php">שכחת סיסמה?</a></span>
              </div>
            </form>
            </div>';
             }
}
else{
?>
<!----- End of Login logic ------>

<!----- Begin of Login form ------>
   
            <div class="p-5 mt-5 membership-item" id="frm">  
             <h2> התחברות למערכת</h2>
            <form action="" method="post">
               
              <div class="imgcontainer">
                <img src="img/homepage/black_logo.png" class="avatar">
              </div>
              <div class="container">
                        <input class="form-control text-right" type="email" id="email" name="email" maxlength="100" placeholder="שם משתמש" required/>
                        <input type="password" class="form-control text-right" id="password" maxlength="100" name="password" placeholder="סיסמה" required/>
                    
                <button type="submit">Login</button>
              </div>
            
              <div class="container" style="background-color:#f1f1f1">
                  <a href="index.php">
                <button type="button" class="cancelbtn">חזרה לדף הבית</button></a>
                <span class="psw"><a href="contact.php">שכחת סיסמה?</a></span>
              </div>
            </form>
            </div>

<!----- End of Login form ------>
<?php } ?>


</body>
</html>
