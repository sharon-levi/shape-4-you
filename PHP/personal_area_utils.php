<?php
function msg($message) 
{
	return sprintf('<script type="text/javascript"> alert(\'%s\'); </script>', $message);
}
function mylog($message) 
{
	file_put_contents("info.log", "$message\n", FILE_APPEND);
	//error_log
}


//display table from db
function queryToTable($result) 
{
	$all_property = [];  //declare an array for saving property
	$str="";
	//showing property
	$str.= "<table class='personalDataTable'>
			\t<tr class='personalDataHeading'>
			\t";  //initialize table tag
	while ($property = $result->fetch_field()) {
		$str.= "<td class='personalDataTableCell'>$property->name</td>";  //get field name for header
		$all_property[]= $property->name;  //save those to array
	}
	$str.= "\n\t</tr>\n"; //end tr tag
	
	//showing all data
	while ($row = $result->fetch_assoc()) {
		$str.= "<tr>";
		foreach ($all_property as $item) {
			$str.= "<td class='personalDataTableCell'> $row[$item] </td>"; //get items using property value
		}
		$str.= '</tr>';
	}
	$str.= "</table>";
	
	return $str;
}



//display table from db as form(in order to update details)
function queryToForm($result, $submit_name, $selectFields, $selectValues, $formId)
{
	$all_property = [];  //declare an array for saving property
	while ($property = $result->fetch_field()) {
		$all_property[]= $property;  //get field name and save it to array
		//echo print_r($property);
	}
	$str="";
	$str.= "
	<br>
	<div>
  <form  id=\"$formId\" method=\"post\" autocomplete=\"off\">
  <fieldset style=\"width: 50%; margin: auto; margin-bottom: 5%;\"> 
				<legend>טופס סיכום פגישה עם לקוח </legend>
         ";
	foreach($all_property as $col) {
		if(in_array("$col->orgname", $selectFields)) {
				$str.= "
				<div class=\"form-group text-right form-row d-flex flex-row-reverse \">
				
				<label for=\"$col->orgname\">$col->name</label><br>
				
				<select class=\"custom-select custom-select-sm\" id=\"$col->orgname\" name=\"details[]\" required>
				";
				foreach($selectValues as $value) $str.="<option value=\"$value\">$value</option>";
				$str.= "</select>
				
				</div>
				";
		} else {
			$str.= "
			<div class=\"form-group text-right form-row d-flex flex-row-reverse\">
				
				<label for=\"$col->orgname\">$col->name</label>
				" . (($col->length > 500)? "<textarea class=\"form-control text-right\" " : "<input class=\"form-control text-right\" maxlength=\"100\" type=\"text\"") . 
				" id=\"$col->orgname\" name=\"details[]\" value=\"\" required>" . (($col->length > 500)?"</textarea>":"") . "
				
				</div>
			";
		}
	}
     $str.= "
		<div class=\"form-group row\">
			<input type=\"submit\" class=\"update-btn\" value=\"לחץ להוספת פרטי הפגישה\" name=\"$submit_name\">
		</div>
		</fieldset>
  </form>
  </div>
  ";
  return $str;
}


//checking if user is employee or client
function isStaff($connection) 
{
	$query = "SELECT user_type from clients WHERE email='$_SESSION[email]'";
	$result = $connection->query($query) or die($connection->connect_error);
	$obj= $result->fetch_assoc();
	$result->close();
	return $obj['user_type'] == "employee";	
}


//get all clients list
function getAllUsers($connection) 
{
	$queryUser = "SELECT email FROM clients";
	$resultUser = $connection->query($queryUser) or die($connection->connect_error);
	$allUsers= [];	
	foreach($resultUser->fetch_all() as $user) $allUsers[]= $user[0];
	$resultUser->close();
	return $allUsers;
}
