
<?php
if(empty($_SESSION['email'])) { 
	header("Location: login.php"); 
	die(); 
}

//Connection to db
require('./Includes/PHP/db.php');

//update meeting details, only for employee users
if(!empty($_POST) && array_key_exists("add_diet", $_POST)) {
		$sql = "INSERT INTO diets (summary, fat, hand, thigh, hip, butt, calories, dietitian, client_email, date) VALUE ('";
		$sql.= implode("','", $_POST[details]);
		$sql.= "');";
		$result = $conn->query($sql);
		if($result) { 
			echo'
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                        
                          swal({
                            icon: "success",
                            title: "פרטי הפגישה עודכנו בהצלחה",
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
                            text: "עדכון פרטי הפגישה נכשל.. אנא נסה שנית"
                            showConfirmButton: "false",
                            timer: 5000
                          })
                        });
                        
                        </script>
                        ';
		}
//filter for table, only for employee users	
} elseif(!empty($_POST) && array_key_exists("add_filter", $_POST)) { 
	$filterUser= $_POST['filter_by_user'];
}
?>

<section>
<h2>מעקב תזונה</h2>

<?php
$isstaff = isStaff($conn);
if($isstaff) {
    echo
    "<p>
    בעמוד זה תוכלי לצפות בכל הפגישות שהתבצעו עם הלקוחות<br>
    בנוסף, תוכלי לעדכן את פרטי הפגישה האחרונה שביצעת עם לקוח 
    <a href=\"#dietForm\">בטופס למטה</a></p>";
    echo <<< EOF

<div class="container" style="display:$displayValue">
	<form method="post" autocomplete="off">
		<div class="form-group text-right form-row d-flex flex-row-reverse">
		
			<input type="text" class="filter-field" id="email" name="filter_by_user" value="$filterUser" placeholder="סנן לפי כתובת דואר אלקטרוני">
			<input type="submit" class="filter-btn" value="Submit" name="add_filter">
			
		</div>
	</form>
</div>
EOF;
}
else {
    echo '<p>בעמוד זה תוכלו לצפות בכל הפגישות האחרונות שביצעתם עם הדיאטנית</p>
    <div class="form-group text-right form-row d-flex flex-row-reverse">
    <a href="http://adisha.mtacloud.co.il/meeting.php">
    <button type="button" class="filter-btn"">לקביעת פגישה עם דיאטנית לחץ כאן</button></a>
    </div>';
}

//display "diets" table from db to all users
$colums = "summary AS 'סיכום פגישה והמלצות להמשך', fat AS 'אחוז שומן', hand AS 'היקף ידיים', thigh AS 'היקף ירכיים', hip AS 'היקף מותניים', butt AS 'היקף ישבן', calories AS 'ערך קלורי יומי מומלץ', dietitian AS 'דיאטנית', client_email AS 'לקוח', date AS 'תאריך'";
$query = "SELECT $colums FROM diets";
if($isstaff) {
	$displayValue="block";
	if(!empty($filterUser)) $query .= " WHERE client_email='$filterUser'";
} else {
	$query .= " WHERE client_email='$_SESSION[email]' OR dietitian='$_SESSION[email]' ORDER BY date DESC";
	$displayValue="none";
}
$result = $conn->query($query) or die($conn->connect_error);
echo queryToTable($result);
$result->close();


//the following form is only for the dietitian(employee user)
if($isstaff) {
    $formId="dietForm";
	$selectFields= array('client_email', 'dietitian');
	$selectValues= getAllUsers($conn);
	$staffQuery = "SELECT $colums FROM diets LIMIT 1";
	$staffResult = $conn->query($staffQuery) or die($conn->connect_error);
	echo queryToForm($staffResult, "add_diet", $selectFields, $selectValues, $formId);
	$staffResult->close();
}
$conn->close();
?>

</section>
<div></div>
<div></div>
<div></div>
<div></div>
<div></div>
<section></section>
