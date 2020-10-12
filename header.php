<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
     
<!-- Add hightlight to current page in nav bar -->
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script>
        $(function(){
            $('a').each(function(){
                if ($(this).prop('href') == window.location.href) {
                    $(this).addClass('active'); $(this).parents('li').addClass('active');
                }
            });
        });
    </script>

<!-- Header Start -->
   <header class="header-section">
        <div class="container">
            <div class="logo">
                <a href="./index.php">
                    <img style="max-width: 100%;" src="img/homepage/white_logo.png">
                </a>
            </div>
            <div class="nav-menu">
                <nav class="mainmenu mobile-menu">
                    <ul>
                       <li><a href="./index.php">דף הבית</a></li>
                       <li><a href="./about-us.html">עלינו</a></li>
                       <li><a href="./classes.php">שיעורים</a></li>
                       <li><a href="./gallery.html">גלריה</a></li>
                       <li><a href="./success_stories.html">סיפורי הצלחה</a></li>
                       <li><a href="./contact.php">צור קשר</a></li>
                    </ul>
                </nav>
                <?php if ($_SESSION['email']) {
                    echo '<a href="./personal-area.php" class="hover-bg primary-btn signup-btn">איזור אישי</a>';
                    echo '<a href="./login.php" class="primary-btn signup-btn">LOGOUT</a> ';
                  
                } 
                else {
                    echo '<a href="./signup.php" class="primary-btn signup-btn">הרשמו עכשיו!</a>';
                    echo '<a href="./login.php" class="primary-btn signup-btn">LOGIN</a>';
                }
            ?>
                
                
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
<!-- Header End -->
    
    
 </html>