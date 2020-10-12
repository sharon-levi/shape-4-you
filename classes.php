<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>אימונים</title>

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

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
   
    
</head>

<!-- Begin of "book to class or unbook from class" logic -->

<?php
//Connection to db
require('./Includes/PHP/db.php');

    if (isset($_POST['book'])) {
    
	$sql= "SELECT id FROM `classes` WHERE `type`='".$_POST['type']."' AND `date`='".$_POST['date']."' AND `hour`='".$_POST['hour']."'";
	$result = $conn->query($sql);
	$insert_sql= "INSERT INTO `participation` (classid, email) VALUES ";
	foreach($result->fetch_all() as $row){
		$insert_sql .= "($row[0], \"$_POST[email]\"),";
	}
	
	$result= $conn->query(rtrim($insert_sql, ","));
         if ($result){
                    echo'
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                        
                          swal({
                            icon: "success",
                            title: "נרשמת בהצלחה לשיעור",
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
                          text: "הרישום נכשל...נסה שנית",
                            timer: 5000
                          })
                        });
                        
                        </script>
                        ';
        }
    }
    if (isset($_POST['cancel'])) {
	$sql= "SELECT id FROM `classes` WHERE `type`='".$_POST['type']."' AND `date`='".$_POST['date']."' AND `hour`='".$_POST['hour']."'";
	$result = $conn->query($sql);
	$classids=[];
	foreach($result->fetch_all() as $row){
		$classids[]= "$row[0]";
	}
	$del_sql= "DELETE FROM `participation` WHERE classid IN (" . implode(",", $classids) . ") AND email=\"$_POST[email]\"";
	$result = $conn->query($del_sql);
    
        if ($result){
                    echo'
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                        
                          swal({
                            icon: "warning",
                            title: "הביטול התבצע בהצלחה",
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
                          text: "הביטול נכשל...נסה שנית",
                            timer: 5000
                          })
                        });
                        
                        </script>
                        ';
                 
         }
    }
                                        
?>

<!-- End of "book to class or unbook from class" logic -->


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
                        <h2>שיעורים</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Trainer Table Schedule Section Begin -->
    
    <section class="classes-timetable spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <br>
                        <h2>לוח אימונים</h2>
                        <br>
                    <?php 
                     if ($_SESSION['email']) {
                        echo"
                       <p> שמחים שחזרתם ללוח האימונים שלנו
                       <br>
                       אם כבר הגעתם עד לכאן, אתם חייבים להירשם לאימון!
                       <br>
                      <b>התמדה מביאה תוצאות.</b>
                       <br>
                       נתראה באימונים :)
                        </p>";
                     }
                    else {
                         echo'
                         <p>
                            ברוכים הבאים! לוח האימונים שלנו זמין לצפייה כל הזמן     
                        <br>
                          הצטרפו אלינו עוד היום ותוכלו להירשם למגוון אימונים שאנו מציעים כאן בסטודיו, עם המאמנים הכי טובים באיזור ובשעות שנוחות לכל אחד :)
                       <br><br>
                          <a href="signup.php" class="classes-btn">הירשמו עכשיו! </a>
                        </a>
                        </p>';
                        }
                        ?>
                    </div>
                    <div class="nav-controls">
                        <ul>
                            <!-- ability to filter by type of class -->
                            <li data-tsfilter="hiit">HIIT</li>
                            <li data-tsfilter="TRX">TRX</li>
                            <li data-tsfilter="cardio">אירובי</li>
                            <li data-tsfilter="body">כוח</li>
                            <li data-tsfilter="yoga">יוגה</li>
                            <li data-tsfilter="pilates">פילאטיס</li>
                            <li class="active" data-tsfilter="all">כל השיעורים </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="schedule-table">
                        <table>
                            <thead>
                                <tr>
                                    <!-- days of current week (next 7 days) -->
                                    <th></th>
                                    <th>ראשון<br>
                                    <?php
                                    $sunday=strtotime("Sunday");
                                    echo date("d-m-y", $sunday);
                                    ?>
                                    </th>
                                    <th>שני<br>
                                    <?php
                                    $monday=strtotime("Monday");
                                    echo date("d-m-y", $monday);
                                    ?>
                                    </th>
                                    <th>שלישי<br>
                                    <?php
                                    $tuesday=strtotime("Tuesday");
                                    echo date("d-m-y", $tuesday);
                                    ?>
                                    </th>
                                    <th>רביעי<br>
                                    <?php
                                    $wednesday=strtotime("Wednesday");
                                    echo date("d-m-y", $wednesday);
                                    ?>
                                    </th>
                                    <th>חמישי<br>
                                    <?php
                                    $thursday=strtotime("Thursday");
                                    echo date("d-m-y", $thursday);
                                    ?>
                                    </th>
                                    <th>שישי<br>
                                    <?php
                                    $friday=strtotime("Friday");
                                    echo date("d-m-y", $friday);
                                    ?>
                                    </th>
                                    <th>שבת<br>
                                    <?php
                                    $saturday=strtotime("Saturday");
                                    echo date("d-m-y", $saturday);
                                    ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- classes -->
                                <tr>
                                    <td class="workout-time">07.00</td>
                                    <td class="ts-item" data-tsmeta="yoga">
                                        <form method="POST" action="">
                                            <h6>יוגה</h6>
                                                <span>09.00 - 07.00</span>
                                                <div class="trainer-name">
                                                    ענבל ברי
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Yoga">
                                                <input type="hidden" id="date" name="date" value="<?php $sunday=strtotime("Sunday"); echo date("yy-m-d", $sunday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="7">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $sunday = strtotime("Sunday");
                                                        $date = date("yy-m-d", $sunday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Yoga' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Yoga' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 

                                                }  else echo "";
                                                ?>
                                         </form>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="ts-item" data-tsmeta="pilates">
                                       <form method="POST" action="">
                                            <h6>פילאטיס</h6>
                                                <span>08.00 - 07.00</span>
                                                <div class="trainer-name">
                                                  דניאל לוי
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Pilates">
                                                <input type="hidden" id="date" name="date" value="<?php $friday=strtotime("Friday"); echo date("yy-m-d", $friday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="7">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $friday = strtotime("Friday");
                                                        $date = date("yy-m-d", $friday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Pilates' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Pilates' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="workout-time">08.00</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="ts-item" data-tsmeta="yoga">
                                        <form method="POST" action="">
                                            <h6>יוגה</h6>
                                                <span>09.00 - 08.00</span>
                                                <div class="trainer-name">
                                                    ענבל ברי
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Yoga">
                                                <input type="hidden" id="date" name="date" value="<?php $thursday=strtotime("Thursday"); echo date("yy-m-d", $thursday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="8">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $thursday = strtotime("Thursday");
                                                        $date = date("yy-m-d", $thursday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Yoga' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Yoga' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>
                                    </td>
                                    <td class="ts-item" data-tsmeta="cardio">
                                        <form method="POST" action="">
                                        <h6>אירובי</h6>
                                        <span>09.00 - 08.00</span>
                                        <div class="trainer-name">
                                           אירה בליך
                                        </div>
                                        <input type="hidden" id="type" name="type" value="Cardio">
                                                <input type="hidden" id="date" name="date" value="<?php $friday=strtotime("Friday"); echo date("yy-m-d", $friday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="8">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $friday = strtotime("Friday");
                                                        $date = date("yy-m-d", $friday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Cardio' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Cardio' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="workout-time">09.00</td>
                                    <td class="ts-item" data-tsmeta="TRX">
                                        <form method="POST" action="">
                                        <h6>TRX</h6>
                                        <span>10.00 - 09.00</span>
                                        <div class="trainer-name">
                                           מלכה כהן
                                        </div>
                                        <input type="hidden" id="type" name="type" value="TRX">
                                                <input type="hidden" id="date" name="date" value="<?php $sunday=strtotime("Sunday"); echo date("yy-m-d", $sunday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="9">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $sunday = strtotime("Sunday");
                                                        $date = date("yy-m-d", $sunday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='TRX' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='TRX' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>
                                    </td>
                                    <td class="ts-item" data-tsmeta="pilates">
                                       <form method="POST" action="">
                                            <h6>פילאטיס</h6>
                                                <span>10.00 - 09.00</span>
                                                <div class="trainer-name">
                                                  דניאל לוי
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Pilates">
                                                <input type="hidden" id="date" name="date" value="<?php $monday=strtotime("Monday"); echo date("yy-m-d", $monday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="9">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $monday = strtotime("Monday");
                                                        $date = date("yy-m-d", $monday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Pilates' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Pilates' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td class="ts-item" data-tsmeta="body">
                                       <form method="POST" action="">
                                            <h6>כוח</h6>
                                                <span>10.00 - 09.00</span>
                                                <div class="trainer-name">
                                              לי רווח
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Body">
                                                <input type="hidden" id="date" name="date" value="<?php $tuesday=strtotime("Tuesday"); echo date("yy-m-d", $tuesday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="9">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $tuesday = strtotime("Tuesday");
                                                        $date = date("yy-m-d", $tuesday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Body' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Body' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td></td>
                                    <td class="ts-item" data-tsmeta="hiit">
                                       <form method="POST" action="">
                                            <h6>HIIT</h6>
                                                <span>10.00 - 09.00</span>
                                                <div class="trainer-name">
                                             כפיר דדון
                                                </div>
                                                <input type="hidden" id="type" name="type" value="HIIT">
                                                <input type="hidden" id="date" name="date" value="<?php $thursday=strtotime("Thursday"); echo date("yy-m-d", $thursday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="9">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $thursday = strtotime("Thursday");
                                                        $date = date("yy-m-d", $thursday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='HIIT' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='HIIT' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td class="ts-item" data-tsmeta="TRX">
                                        <form method="POST" action="">
                                        <h6>TRX</h6>
                                        <span>10.00 - 09.00</span>
                                        <div class="trainer-name">
                                          מלכה כהן
                                        </div>
                                        <input type="hidden" id="type" name="type" value="TRX">
                                                <input type="hidden" id="date" name="date" value="<?php $friday=strtotime("Friday"); echo date("yy-m-d", $friday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="9">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $friday = strtotime("Friday");
                                                        $date = date("yy-m-d", $friday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='TRX' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='TRX' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="workout-time">10.00</td>
                                    <td></td>
                                    <td></td>
                                    <td class="ts-item" data-tsmeta="cardio">
                                       <form method="POST" action="">
                                            <h6>אירובי</h6>
                                                <span>11.00 - 10.00</span>
                                                <div class="trainer-name">
                                             אירה בליך
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Cardio">
                                                <input type="hidden" id="date" name="date" value="<?php $tuesday=strtotime("Tuesday"); echo date("yy-m-d", $tuesday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="10">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $tuesday = strtotime("Tuesday");
                                                        $date = date("yy-m-d", $tuesday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Cardio' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Cardio' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td class="ts-item" data-tsmeta="yoga">
                                        <form method="POST" action="">
                                        <h6>יוגה</h6>
                                        <span>12.00 - 10.00</span>
                                        <div class="trainer-name">
                                        ענבל ברי
                                        </div>
                                        <input type="hidden" id="type" name="type" value="Yoga">
                                                <input type="hidden" id="date" name="date" value="<?php $friday=strtotime("Friday"); echo date("yy-m-d", $friday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="10">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $friday = strtotime("Friday");
                                                        $date = date("yy-m-d", $friday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Yoga' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Yoga' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="workout-time">18.00</td>
                                    <td></td>
                                    <td class="ts-item" data-tsmeta="body">
                                       <form method="POST" action="">
                                            <h6>כוח</h6>
                                                <span>19.00 - 18.00</span>
                                                <div class="trainer-name">
                                                  לי רווח
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Body">
                                                <input type="hidden" id="date" name="date" value="<?php $monday=strtotime("Monday"); echo date("yy-m-d", $monday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="18">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $monday = strtotime("Monday");
                                                        $date = date("yy-m-d", $monday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Body' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Body' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td class="ts-item" data-tsmeta="pilates">
                                       <form method="POST" action="">
                                            <h6>פילאטיס</h6>
                                                <span>19.00 - 18.00</span>
                                                <div class="trainer-name">
                                             דניאל לוי
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Pilates">
                                                <input type="hidden" id="date" name="date" value="<?php $tuesday=strtotime("Tuesday"); echo date("yy-m-d", $tuesday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="18">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $tuesday = strtotime("Tuesday");
                                                        $date = date("yy-m-d", $tuesday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Pilates' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Pilates' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td class="ts-item" data-tsmeta="body">
                                       <form method="POST" action="">
                                            <h6>כוח</h6>
                                                <span>19.00 - 18.00</span>
                                                <div class="trainer-name">
                                            לי רווח
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Body">
                                                <input type="hidden" id="date" name="date" value="<?php $wednesday=strtotime("Wednesday"); echo date("yy-m-d", $wednesday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="18">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $wednesday = strtotime("Wednesday");
                                                        $date = date("yy-m-d", $wednesday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Body' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Body' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="workout-time">19.00</td>
                                    <td class="ts-item" data-tsmeta="cardio">
                                        <form method="POST" action="">
                                            <h6>אירובי</h6>
                                                <span>20.00 - 19.00</span>
                                                <div class="trainer-name">
                                               אירה בליך
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Cardio">
                                                <input type="hidden" id="date" name="date" value="<?php $sunday=strtotime("Sunday"); echo date("yy-m-d", $sunday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="19">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $sunday = strtotime("Sunday");
                                                        $date = date("yy-m-d", $sunday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Cardio' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Cardio' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>
                                    </td>
                                    <td class="ts-item" data-tsmeta="cardio">
                                       <form method="POST" action="">
                                            <h6>אירובי</h6>
                                                <span>20.00 - 19.00</span>
                                                <div class="trainer-name">
                                                אירה בליך
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Cardio">
                                                <input type="hidden" id="date" name="date" value="<?php $monday=strtotime("Monday"); echo date("yy-m-d", $monday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="19">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $monday = strtotime("Monday");
                                                        $date = date("yy-m-d", $monday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Cardio' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Cardio' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td class="ts-item" data-tsmeta="hiit">
                                       <form method="POST" action="">
                                            <h6>HIIT</h6>
                                                <span>20.00 - 19.00</span>
                                                <div class="trainer-name">
                                            כפיר דדון
                                                </div>
                                                <input type="hidden" id="type" name="type" value="HIIT">
                                                <input type="hidden" id="date" name="date" value="<?php $tuesday=strtotime("Tuesday"); echo date("yy-m-d", $tuesday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="19">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $tuesday = strtotime("Tuesday");
                                                        $date = date("yy-m-d", $tuesday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='HIIT' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='HIIT' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td class="ts-item" data-tsmeta="TRX">
                                       <form method="POST" action="">
                                            <h6>TRX</h6>
                                                <span>20.00 - 19.00</span>
                                                <div class="trainer-name">
                                           מלכה כהן
                                                </div>
                                                <input type="hidden" id="type" name="type" value="TRX">
                                                <input type="hidden" id="date" name="date" value="<?php $wednesday=strtotime("Wednesday"); echo date("yy-m-d", $wednesday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="19">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $wednesday = strtotime("Wednesday");
                                                        $date = date("yy-m-d", $wednesday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='TRX' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='TRX' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td class="ts-item" data-tsmeta="cardio">
                                       <form method="POST" action="">
                                            <h6>אירובי</h6>
                                                <span>20.00 - 19.00</span>
                                                <div class="trainer-name">
                                          אירה בליך
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Cardio">
                                                <input type="hidden" id="date" name="date" value="<?php $thursday=strtotime("Thursday"); echo date("yy-m-d", $thursday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="19">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $thursday = strtotime("Thursday");
                                                        $date = date("yy-m-d", $thursday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Cardio' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Cardio' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td></td>
                                    <td></td>
                             </tr>
                            <tr>
                                    <td class="workout-time">20.00</td>
                                    <td class="ts-item" data-tsmeta="hiit">
                                        <form method="POST" action="">
                                            <h6>HIIT</h6>
                                                <span>21.00 - 20.00</span>
                                                <div class="trainer-name">
                                              כפיר דדון
                                                </div>
                                                <input type="hidden" id="type" name="type" value="HIIT">
                                                <input type="hidden" id="date" name="date" value="<?php $sunday=strtotime("Sunday"); echo date("yy-m-d", $sunday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="20">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $sunday = strtotime("Sunday");
                                                        $date = date("yy-m-d", $sunday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='HIIT' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='HIIT' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>
                                    </td>
                                    <td class="ts-item" data-tsmeta="TRX">
                                       <form method="POST" action="">
                                            <h6>TRX</h6>
                                                <span>21.00 - 20.00</span>
                                                <div class="trainer-name">
                                               מלכה כהן
                                                </div>
                                                <input type="hidden" id="type" name="type" value="TRX">
                                                <input type="hidden" id="date" name="date" value="<?php $monday=strtotime("Monday"); echo date("yy-m-d", $monday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="20">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $monday = strtotime("Monday");
                                                        $date = date("yy-m-d", $monday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='TRX' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='TRX' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                <td></td>
                                    <td class="ts-item" data-tsmeta="yoga">
                                       <form method="POST" action="">
                                            <h6>יוגה</h6>
                                                <span>22.00 - 20.00</span>
                                                <div class="trainer-name">
                                          ענבל ברי
                                                </div>
                                                <input type="hidden" id="type" name="type" value="Yoga">
                                                <input type="hidden" id="date" name="date" value="<?php $wednesday=strtotime("Wednesday"); echo date("yy-m-d", $wednesday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="20">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $wednesday = strtotime("Wednesday");
                                                        $date = date("yy-m-d", $wednesday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Yoga' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='Yoga' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td class="ts-item" data-tsmeta="TRX">
                                       <form method="POST" action="">
                                            <h6>TRX</h6>
                                                <span>21.00 - 20.00</span>
                                                <div class="trainer-name">
                                        מלכה כהן
                                                </div>
                                                <input type="hidden" id="type" name="type" value="TRX">
                                                <input type="hidden" id="date" name="date" value="<?php $thursday=strtotime("Thursday"); echo date("yy-m-d", $thursday);?>">
                                                <input type="hidden" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                                                <input type="hidden" id="hour" name="hour" value="20">
                                                <?php 
                                                    if ($_SESSION['email']) {
                                                        $email = $_SESSION['email'];
                                                        $thursday = strtotime("Thursday");
                                                        $date = date("yy-m-d", $thursday);
                                                        $query = "SELECT classes.* FROM `classes` JOIN `participation` ON classid=id WHERE `type`='TRX' AND `date`='$date' AND `participation`.email='$email'";
                                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                                        $rows = mysqli_num_rows($result);
                                                        if($rows==1){
                                                                echo '<button class="btn btn-outline-danger btn-sm" type="submit" name="cancel">רשום - לחץ לביטול</button>'; 
                                                        }
                                                        else {
                                                                $query_full = "SELECT * FROM `classes` JOIN `participation` ON classid=id WHERE `type`='TRX' AND `date`='$date'";
                                                                $result_full = mysqli_query($conn,$query_full) or die(mysql_error());
                                                                $rows_full = mysqli_num_rows($result_full);
                                                                if($rows_full==15){
                                                                            echo '<p style="color: red;"> האימון מלא </p>';
                                                                }
                                                                else   echo '<button class="btn btn-outline-success btn-sm" type="submit" name="book">הירשם</button>';
                                                        } 
                                                } else echo "";
                                                ?>
                                         </form>   
                                    </td>
                                    <td></td>
                                    <td></td>
                             </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Trainer Table Schedule Section End -->

    
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