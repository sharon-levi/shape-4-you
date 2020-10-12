<?php
  session_start();
  require('db.php');

  $instructorId = mysqli_real_escape_string($conn, $_POST['trainerId']);
  $clientId = mysqli_real_escape_string($conn, $_SESSION['user_id']);
  $startDate = mysqli_real_escape_string($conn, $_POST['startDate']);
  $endDate = mysqli_real_escape_string($conn, $_POST['endDate']);


  $sql = "INSERT INTO `meetings` (`instructor_id`, `client_id`, `start_date`, `end_date`) VALUES ($instructorId, $clientId, \"$startDate\", \"$endDate\")";
  $result = $conn->query($sql);

  var_dump($sql);
  if ($result){
      echo "SUCCESS - meeting";

      header('Location: /meetingSuccess.php');
      exit();
  }
  else {
    echo "ERROR! - meeting";
    // header('Location: /meeting.php');
    $conn->error;
    exit();
  }



  $conn->close();
