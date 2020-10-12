<?php

if(empty($_SESSION['email'])) { 
	header("Location: login.php"); 
	die(); 
}

//Connection to db
require('./Includes/PHP/db.php');

//update meeting details, only for employee users
if(!empty($_POST) && array_key_exists("add_train", $_POST)) {
		$sql = "INSERT INTO trains (summary, weigh_belly, weigh_hand, weigh_feet, count_repeat, count_train, trainer, client_email, date) VALUE ('";
		$sql.= implode("','", $_POST['details']);
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
<body>
    <section>
<h2>מעקב ספורט</h2>

<?php
$isstaff = isStaff($conn);
if($isstaff) {
    echo
    "<p>
    בעמוד זה תוכלו לצפות בכל הפגישות שהתבצעו עם הלקוחות<br>
    בנוסף, תוכלו לעדכן את פרטי הפגישה האחרונה שביצעתם עם לקוח
    <a href=\"#trainForm\">בטופס למטה</a></p>";
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
    echo '<p>בעמוד זה תוכלו לצפות בכל הפגישות האחרונות שביצעתם עם המאמנים</p>
    <div class="form-group text-right form-row d-flex flex-row-reverse">
    <a href="http://adisha.mtacloud.co.il/meeting.php">
    <button type="button" class="filter-btn"">לקביעת פגישה עם מאמן/ת לחץ כאן</button></a>
    </div>';
}


//display "trains" table from db to all users
$colums = "summary AS 'סיכום פגישה והמלצות להמשך', weigh_belly AS 'משקל לתרגילי בטן', weigh_hand AS 'משקל לתרגילי ידיים', weigh_feet AS 'משקל לתרגילי רגליים', count_repeat AS 'מספר חזרות לכל תרגיל', count_train AS 'מספר אימונים בשבוע', trainer AS 'מאמן', client_email AS 'לקוח', date AS 'תאריך'";
$query = "SELECT $colums FROM trains";
if($isstaff) {
	$displayValue="block";
	if(!empty($filterUser)) $query .= " WHERE client_email='$filterUser'";
} else {
	$query .= " WHERE client_email='$_SESSION[email]' OR trainer='$_SESSION[email]' ORDER BY date DESC";
	$displayValue="none";
}

$result = $conn->query($query) or die($conn->connect_error);
echo queryToTable($result);
$result->close();



//the following form is only for the trainer(employee user)
if(isStaff($conn)) {
    $formId= "trainForm";
	$selectFields= array('client_email', 'trainer');
	$selectValues= getAllUsers($conn);
	$staffQuery = "SELECT $colums FROM trains LIMIT 1";
	$staffResult = $conn->query($staffQuery) or die($conn->connect_error);
	echo queryToForm($staffResult, "add_train", $selectFields, $selectValues, $formId);
	$staffResult->close();
}
$conn->close();
?>
