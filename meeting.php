<?php
session_start();
if(empty($_SESSION['email'])) {
	header("Location: login.php");
	die();
}


?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
      <title>קביעת פגישה אישית</title>

    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    <!-- Load Header & Footer -->
    <script  src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script>
    $(function(){
        $("#header").load("header.php");
        $("#footer").load("footer.html");
        $(".datepicker").datetimepicker();
    });
    </script>

    </script>

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/meeting.css" type="text/css">
    <link rel="stylesheet" href="css/jquery.datetimepicker.min.css" type="text/css">
</head>

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
                        <h2>פגישות אישיות</h2>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Breadcrumb Section End -->

<div>

</div>
    
    <!-- Form Section Begin -->
    <section class = row>
    <!-- Display Google Calendar iFrame -->
    <section class="col-lg-6">
    <div class="form-group">
        <div class="input-group" id="datetimepicker">

            <span class="input-group-addon">
            <iframe id="googleCalendarIframe" src="https://calendar.google.com/calendar/embed?src=v2jqmrq6beojkk27ld91csmgok%40group.calendar.google.com&ctz=Asia%2FJerusalem&showTabs=0&amp;showCalendars=0&amp;showPrint=0&amp;mode=WEEK" style="border:solid 0px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
            <span class="glyphicon glyphicon-calender"></span>
            </span>
        </div>
    </div>
    </section>
    
    <section class="col-lg-6">
            <div class="container">
                 <div class="col">
                    <div class="membership-item mt-4 mb-4">
                        <div class="mi-title">
                            <h4>קביעת פגישות אישיות</h4>
                        </div>
                        <h2 class="mi-price">קביעת פגישה אישית עם מאמן או דיאטנית </h2>
                        <ul>
                            <li>
                                <h5>על מנת לקבוע פגישה, יש תחילה לבחור איש מקצוע (מאמן או דיאטנית), ולאחר מכן את השעה הרצויה בהתאם לשעות הזמינות</h5>
                            </li>
                            </br>
                            <li>
                                <h5><u> שימו לב - שעות הפגישות האישיות (דיאטנית ומאמן) הן:</u></h5>
                                <h5>ימים א-ה 8:00-20:00</h5>
                                <h5>ימי ו 8:00-13:00</h5>
                            </li>
                            </br>
                            <li>
                                <h5><u><label>נא לבחור מאמן או דיאטנית</label></u></h5>
                                <select name="trainer" id="trainerSelect" onchange="refreshCalendar()">
                                <option value="0">FITNESS INSTRUCTOR</option>
                                <option value="1">DIET INSTRUCTOR</option>
                                </select>
                                <br>
                                <h5><u><label> נא לבחור תאריך ושעה רצויה</label></u></h5>
                                <input type="datetime" class="datepicker" id="meetingStart"/>
                            </li>
                        </ul>
                        <button class ="primary-btn" type="submit" onclick="checkAuthAndHandleResult()"> שליחה </button>
                        <h2 style="color: red;" id="submitError"></h2>
                        </form>
                    </div>
                </div>
    </section>
       <!-- Form Section End -->
    
    <script>
        document.onload = () => {refreshCalendar}

        var clientId = '400208953298-st5j0h169nq742ic8qvkf7qlu8menebv.apps.googleusercontent.com'; //choose web app client Id, redirect URI and Javascript origin set to http://localhost
        var apiKey = 'AIzaSyBVuYNRY3c0sl15YkN4qVP64XewXfMIwnM'; //choose public apiKey, any IP allowed
        var maxRows = 10; //events to shown
        var calName = "shape4you_Instructor_" + document.getElementById("trainerSelect").value; //name of calendar
        var scopes = 'https://www.googleapis.com/auth/calendar';
				var hasAuthorizedGoogle = false;

        //--------------------- client CALL

        function handleClientLoad() {
            gapi.client.setApiKey(apiKey);
            // checkAuth();
        }

        //--------------------- end

        //--------------------- check Auth

        function checkAuthAndHandleResult() {
					if (hasAuthorizedGoogle) {
						createMeetingEvent();
					} else {
						hasAuthorizedGoogle = true;
            gapi.auth2.authorize({client_id: clientId, scope: scopes}, createMeetingEvent);
					}
        }

        //--------------------- end

        //--------------------- handle result and make CALL

        function handleAuthResult(authResult) {

        }
        //--------------------- end


        function refreshCalendar() {
          switch (document.getElementById("trainerSelect").value) {
            case "0":
              document.getElementById("googleCalendarIframe").src = 'https://calendar.google.com/calendar/embed?src=v2jqmrq6beojkk27ld91csmgok%40group.calendar.google.com&ctz=Asia%2FJerusalem&mode=WEEK&amp;showTabs=0&amp;showCalendars=0&amp;showPrint=0&amp'
              break;
            case "1":
              document.getElementById("googleCalendarIframe").src = 'https://calendar.google.com/calendar/embed?src=3h221pe7ieameikfjef7caacv0%40group.calendar.google.com&ctz=Asia%2FJerusalem&mode=WEEK&amp;showTabs=0&amp;showCalendars=0&amp;showPrint=0&amp'
              break;
            default:

          }

        }

        function getCalendarListId(calendarListName) {
          var calendarLists = {
            "shape4you_Instructor_0": "v2jqmrq6beojkk27ld91csmgok@group.calendar.google.com",
            "shape4you_Instructor_1": "3h221pe7ieameikfjef7caacv0@group.calendar.google.com"
          }
          return calendarLists[calendarListName];
        }

        //--------------------- API CALL itself
        function createMeetingEvent() {
          //first, check if one already exists in calendar...
            gapi.client.load('calendar', 'v3', () => {
							gapi.auth2.init({client_id: clientId, scope: scopes}).then(() => {



              var trainerId = document.getElementById("trainerSelect").value

              var relevantCalendarId = getCalendarListId("shape4you_Instructor_" + trainerId);
              var title = "פגישת לקוח - Shape4You"
              var startDate = new Date(document.getElementById("meetingStart").value)
              var endDate = new Date(startDate.getTime() + 1000 * 60 * 30);
              
              if(startDate.getHours()<8 || startDate.getHours()>20) {
                  document.getElementById("submitError").innerHTML = "השעה הנבחרה מחוץ לשעות הפעילות, נא לבחור מחדש"

                   return;
              }
              
              
            
              var listRequest = gapi.client.calendar.events.list({
                calendarId: relevantCalendarId,
                timeMin: startDate.toISOString(),
                timeMax: endDate.toISOString()
              })

              listRequest.execute(function (listResp) {
                if (listResp.items.length) {
                  //slot taken, display error
                  document.getElementById("submitError").innerHTML = "השעה הנבחרה תפוסה, נא לבחור מחדש"

                  return;
                }

                var request = gapi.client.calendar.events.insert({
                  // calendarId: getCalendarListId("shape4you_Instructor_" + document.getElementById("trainerSelect").value),
                  calendarId: "primary",
                  attendees: [{
                    email: relevantCalendarId
                  }],
                  summary: title,
                  start: {
                    dateTime: startDate.toISOString()
                  },
                  end: {
                    dateTime: endDate.toISOString()
                  }
                });
                request.execute(function (resp) {
                  submitForm("/Includes/PHP/createMeeting.php", {title, startDate: startDate.toISOString().slice(0, 19).replace('T', ' '), endDate: endDate.toISOString().slice(0, 19).replace('T', ' '), trainerId}, "post")
                });

              })
							})
            });
        }
        //--------------------- end


        function submitForm(path, params, method) {
            method = method || "post";

            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            //Move the submit function to another variable
            //so that it doesn't get overwritten.
            form._submit_function_ = form.submit;

            for(var key in params) {
                if(params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                 }
            }

            document.body.appendChild(form);
            form._submit_function_();
        }

    </script>

    <script src='https://apis.google.com/js/client.js?onload=handleClientLoad'></script>

    </section>

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

    <script type="text/javascript" src="js/jquery.datetimepicker.full.min.js"></script>
    <script src="js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>
    <script src="https://apis.google.com/js/api.js"></script>
</body>

</html>
