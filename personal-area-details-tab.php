<?php

if(empty($_SESSION['email'])) { 
	header("Location: login.php"); 
	die(); 
}

//Connection to db
require('./Includes/PHP/db.php');

// update user details in db
if(!empty($_POST) && array_key_exists("edit_user", $_POST)) {
	$form=$_REQUEST["details"];
	if($_REQUEST["password-verification"] == $form[8]) {
		
		$format = "UPDATE clients SET 
		first_name='%s',
		last_name='%s',
		id='%d',
		phone='%d',
		city='%s',
		street='%s',
		house_number='%d',
		medical_info='%s',
		password='%s' WHERE email='$_SESSION[email]';";

		$sql= sprintf($format, $form[0], $form[1], $form[2], $form[3], str_replace("-", "", $form[4]), $form[5], $form[6], $form[7], empty($form[8])?0:$form[8], $form[9] );
		$result = $conn->query($sql);
		if($result) { 
			echo'
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                        
                          swal({
                            icon: "success",
                            title: "הפרטים עודכנו בהצלחה",
                            showConfirmButton: "false",
                            timer: 5000
                          })
                        });
                        
                        </script>
                        ';
		} else {
				echo'
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                        
                          swal({
                            icon: "error",
                            title: "Oops...",
                            text: "עדכון הפרטים נכשל.. אנא נסה שנית"
                            showConfirmButton: "false",
                            timer: 5000
                          })
                        });
                        
                        </script>
                        ';
		}		
	} else {
		echo'
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                        
                          swal({
                            icon: "error",
                            title: "Oops...",
                            text: "אימות הסיסמה נכשל, אנא נסה שנית",
                            showConfirmButton: "false",
                            timer: 5000
                          })
                        });
                        
                        </script>
                        ';
	}
}

//load parameters from db (do this even after UPDATE)
$query_data = "SELECT * FROM clients WHERE email='$_SESSION[email]'";
$result_data = $conn->query($query_data) or die($conn->connect_error);
$obj = $result_data->fetch_assoc();
$result_data->close();

//load schedualed classes for user
$query_class = "SELECT  trainer_name AS מאמן, TYPE AS שיעור, hour AS שעה, day AS יום, date AS תאריך FROM classes JOIN participation ON classid=id  WHERE email='$_SESSION[email]' ORDER BY date DESC";
$result_class = $conn->query($query_class) or die($conn->connect_error);
$classes_table= queryToTable($result_class);
$result_class->close();

$conn->close();
?>


<!-- user personal details start -->
<body>
<div class="container">
  <form method="post" autocomplete="off">
      <fieldset>
		<legend> צפייה ועריכת פרטים אישיים </legend>
      <p>תוכלו לשנות את פרטיכם האישיים בכל זמן שתרצו, פרט לשדות המסומנים באפור.<br>
    שימו לב, כל שינוי בפרטים האישיים מחייב אימות סיסמה.</p>
      <br>
    <div class="form-group text-right form-row d-flex flex-row-reverse">
        <div class="col">
            <label for="first_name">שם פרטי</label>
            <input readonly class="form-control text-right" type="text" id="first_name" name="details[]" value="<?=$obj['first_name']?>" placeholder="שם פרטי">
        </div>
        <div class="col">
            <label for="last_name">שם משפחה</label>
        <input readonly class="form-control text-right" type="text" id="last_name" name="details[]" value="<?=$obj['last_name']?>" placeholder="שם משפחה">
        </div>
    </div>
    
    <div class="form-group text-right form-row d-flex flex-row-reverse">
        <div class="col">
            <label for="id">תעודת זהות כולל ספרת ביקורת</label>
            <input readonly class="form-control text-right" type="number" id="id" name="details[]" value="<?=$obj['id']?>" placeholder="תעודת זהות">
        </div>
        <div class="col">
            <label for="phone">מספר טלפון</label>
            <input class="form-control text-right" type="tel" id="phone" name="details[]" pattern="[0]{1}[5]{1}[0-9]{8}" value="<?=empty($obj['phone'])?"":0 . substr_replace($obj['phone'], "", 2, 0)?>" placeholder="052-1234567"  required>
        </div>
    </div>
    
    <div class="form-group text-right form-row d-flex flex-row-reverse">
        <div class="col">
           <label class="d-flex flex-row-reverse" for="email">כתובת מייל</label>
        <input readonly class="form-control text-right form-row d-flex flex-row-reverse" type="email" id="email" value="<?=$obj['email']?>" placeholder="כתובת מייל">
        </div>
        <div class="col">
            <label for="city">עיר מגורים</label>
            <input class="form-control text-right" type="text" id="city" maxlength="100" name="details[]" value="<?=$obj['city']?>" placeholder="עיר מגורים"  required>
        </div>
    </div>
    
   <div class="form-group text-right form-row d-flex flex-row-reverse">
        <div class="col">
            <label for="street">רחוב</label>
            <input class="form-control text-right"  type="text" id="street" maxlength="100" name="details[]" value="<?=$obj['street']?>" placeholder="רחוב"  required>
        </div>
        <div class="col">
            <label for="house_number">מספר בית</label>
            <input class="form-control text-right" type="number" id="house_number" max="500" min="1" name="details[]" value="<?=empty($obj['house_number'])?"":$obj['house_number']?>" placeholder="מספר בית"  required>
        </div>
    </div>
    
    <div class="form-group text-right row-reverse">
        <label class="d-flex flex-row-reverse" for="medical_info">רקע בריאותי</label>
	    <input autocomplete="off" class="form-control text-right form-row d-flex flex-row-reverse" maxlength="1000" type="text" id="medical_info" name="details[]" value="<?=$obj['medical_info']?>" placeholder="רקע בריאותי" >
	</div>
	
    <div class="form-group text-right form-row d-flex flex-row-reverse">
        <div class="col">
            <label for="password_1">סיסמה</label>
            <input class="form-control text-right md-6"  type="password" id="password_1" maxlength="20" name="details[]" value="<?=$obj['password']?>" placeholder="סיסמה" required>
        </div>
        <div class="col">
            <label for="password_2">אימות סיסמה</label>
            <input class="form-control text-right md-6 is-invalid" type="password" maxlength="20" id="password_2" name="password-verification" placeholder="אימות סיסמה"  aria-describedby="passwordHelpBlock" required>
            <small id="passwordHelpBlock" class="invalid-feedback">
            שינוי פרטים מחייב אימות סיסמה
            </small>
        </div>
    </div>


    <div class="form-group row">
      <input type="submit" class="update-btn" value="לחץ לעדכון הפרטים" name="edit_user">
    </div>
  </form>

</div>
</fieldset>
<!-- user personal details end -->


<!-- user subscription details start -->

<fieldset class="mini-set">
    <?php
    $start=$obj['membership_start_date'];
    $membership_start_date = strtotime($start);
    
    $end=$obj['membership_end_date'];
    $membership_end_date = strtotime($end);
    
    ?>
		<legend> פרטי מנוי </legend>
		<div class="form-group text-right form-row d-flex flex-row-reverse">
		    <div class="col">
		        <label for="membership_start_date">תאריך תחילת מנוי</label>
             <input readonly class="form-control text-right" type="text" id="membership_start_date"  value="<?php  echo date ("d-m-y", $membership_start_date); ?>" placeholder="membership_start_date">
            </div>
             <div class="col">
            <label for="membership_end_date">תאריך סוף מנוי</label>
             <input readonly class="form-control text-right" type="text" id="membership_end_date"  value="<?php  echo date ("d-m-y", $membership_end_date); ?>" placeholder="membership_start_date">
             </div>
        </div>
</fieldset>

<!-- user subscription details end -->



<!-- user schedulaed classes start -->
<fieldset class="mini-set">
    <legend> השיעורים שלי </legend>
<div class="my-classes">
	<br> <?= $classes_table ?>
</div>
</fieldset>

<!-- user schedulaed classes start -->
</body>
