<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
  .bg {
    background: url('images/OIP (4).jpg') no-repeat;
  }
  .ssgmenu > li > a {
    font-size: 25px;
    font-weight: bold;
    padding: 15px;
    color: #000;
  }
  .ssgmenu > li > a:hover,
  .ssgmenu > li > a:focus {
    background: #FF0000;
    color: #fff;
  }
  .motto p {
    font-size: 32px;
    font-weight: bold;
    margin-top: 5%;
    line-height: 32px;
  }
  .motto {
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 1);
    color: #000;
    font-size: 16px;
  }
  .timeh1 {
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 1);
    color: #000;
  }
  .span10 img {
    width: 100%;
    height: 400px;
  }
  .index_logo {
    width: 100px; /* Adjust the width to make the image smaller */
    height: auto; /* Maintain the aspect ratio */
  }
</style>
</head>
<body>
<section id="feature" class="transparent-bg">
  <div class="container bg">
    <div class="row">
      <div class="center wow fadeInDown">
        <ul class="nav navbar-nav ssgmenu motto" id="footer_nav">
          <li><a href="attendance/check_attendance.php" target="_blank"><img src="images/242-removebg-preview.jpg" alt="CHECK ATTENDANCE" class="index_logo">CHECK ATTENDANCE</a></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="features">
        <div class="col-lg-6">
          <div class="title_index">
            <div class="row-fluid">
              <div class="span12"></div>
              <div class="row-fluid">
                <div class="span10">
                  <img class="index_logo" src="images/242-removebg-preview.jpg" alt="Index Logo">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="col-md-12">
            <div class="motto">
              <p>Attendance Monitoring System</p>
            </div>
          </div>
          <div class="row-fluid">
            <div class="col-md-12">
              <span id="tick2" class="timeh1" style="font-size:25px;"></span>
              <?php
                $date = new DateTime();
                echo $date->format('l, F jS, Y');
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
// Function to display the current time
function show2() {
  if (!document.all && !document.getElementById) return;
  var thelement = document.getElementById ? document.getElementById("tick2") : document.all.tick2;
  var Digital = new Date();
  var hours = Digital.getHours();
  var minutes = Digital.getMinutes();
  var seconds = Digital.getSeconds();
  var dn = "PM";
  if (hours < 12) dn = "AM";
  if (hours > 12) hours = hours - 12;
  if (hours == 0) hours = 12;
  if (minutes <= 9) minutes = "0" + minutes;
  if (seconds <= 9) seconds = "0" + seconds;
  var ctime = hours + ":" + minutes + ":" + seconds + " " + dn;
  thelement.innerHTML = ctime;
  setTimeout("show2()", 1000);
}
window.onload = show2;
</script>
</body>
</html>
