<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RMMC School Event Management System">
    <meta name="author" content="">
    <title>Home | RMMC School Event Management System</title>
    
    <!-- Core CSS -->
    <link href="<?php echo web_root; ?>css/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/main.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/responsive.css" rel="stylesheet">

    <!-- Additional CSS -->
    <link href="<?php echo web_root; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo web_root; ?>css/datepicker.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="<?php echo web_root; ?>select2/select2.min.css">
    <link href="<?php echo web_root; ?>css/nav-button-custom.css" rel="stylesheet" media="screen">
    <link href="<?php echo web_root; ?>css/menu.css" rel="stylesheet" media="screen">
</head>

<body class="homepage">
    <div id="cssmenu" style="margin-bottom: 30px;">
        <ul>
            <li class="<?php echo (currentpage_public() == 'index.php') ? 'active' : ''; ?>"><a href="<?php echo web_root; ?>index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="<?php echo (currentpage_public() == 'student') ? 'active' : ''; ?>"><a href="<?php echo web_root; ?>student/"><i class="fa fa-users"></i> Students</a></li>
            <li class="<?php echo (currentpage_public() == 'teacher') ? 'active' : ''; ?>"><a href="<?php echo web_root; ?>teacher/"><i class="fa fa-users"></i> Teacher</a></li>
            <li class="<?php echo (currentpage_public() == 'attendance') ? 'active' : ''; ?>"><a href="<?php echo web_root; ?>attendance/"><i class="fa fa-clock-o"></i> Attendance</a></li>
            <li class="<?php echo (currentpage_public() == 'course') ? 'active' : ''; ?>"><a href="<?php echo web_root; ?>course/"><i class="fa fa-graduation-cap"></i> Courses</a></li>
            <li class="<?php echo (currentpage_public() == 'department') ? 'active' : ''; ?>"><a href="<?php echo web_root; ?>department/"><i class="fa fa-building"></i> Departments</a></li>
            <li class="<?php echo (currentpage_public() == 'user') ? 'active' : ''; ?>"><a href="<?php echo web_root; ?>user/"><i class="fa fa-user"></i> Users</a></li>
            <li class="<?php echo (currentpage_public() == 'report') ? 'active' : ''; ?>"><a href="<?php echo web_root; ?>report/"><i class="fa fa-info"></i> Reports</a></li>
            <li><a href="<?php echo web_root; ?>logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
    </div>
    
    <div class="container" style="min-height:500px;">
        <div class="row">
            <?php check_message(); ?>
            <?php require_once $content; ?>
        </div>
    </div>

    <footer id="footer" class="midnight-blue" style="background-color: #202010; border-top: 1px solid #47c9ad; padding: 20px 0;">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 text-center">
                <p style="margin-bottom: 0;">
                    <a target="_blank" href="<?php echo web_root; ?>" style="color: #47c9ad; font-weight: bold; font-size: 18px; text-decoration: none;">ITE Attendance Monitoring System</a>
                </p>
                <p style="color: #999; font-size: 14px; margin-top: 5px;">&copy; <?php echo date('Y'); ?> RMMC School. All rights reserved.</p>
            </div>
            <div class="col-sm-6 text-center">
                <ul class="list-inline">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


    <!-- JavaScript Libraries -->
    <script src="<?php echo web_root; ?>jquery/jquery.min.js"></script> 
    <script src="<?php echo web_root; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo web_root; ?>js/js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo web_root; ?>js/js/jquery.isotope.min.js"></script>
    <script src="<?php echo web_root; ?>js/js/main.js"></script>
    <script src="<?php echo web_root; ?>js/js/wow.min.js"></script>
    <script src="<?php echo web_root; ?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo web_root; ?>js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo web_root; ?>select2/select2.full.min.js"></script>
    <script src="<?php echo web_root; ?>slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo web_root; ?>js/bootstrap-datepicker.js" charset="UTF-8"></script>
    <script src="<?php echo web_root; ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script src="<?php echo web_root; ?>js/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
    <script src="<?php echo web_root; ?>input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo web_root; ?>input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo web_root; ?>input-mask/jquery.inputmask.extensions.js"></script>
    <script src="<?php echo web_root; ?>input-mask/meiomask.min.js"></script>
    <script src="<?php echo web_root; ?>js/ekko-lightbox.js"></script>
    <script src="<?php echo web_root; ?>js/janobe.js"></script>

    <!-- Custom Scripts -->
    <script>
        $(function () {
            $(".select2").select2();
        });

        $('input[data-mask]').each(function() {
            var input = $(this);
            input.setMask(input.data('mask'));
        });

        $("#datetime12").inputmask("hh:mm t", {"placeholder": "hh:mm t"});
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        $("[data-mask]").inputmask();

        $(document).ready(function() {
            $('#dash-table').DataTable({
                responsive: true,
                "sort": false
            });
        });

        function capitalize(textboxid, str) {
            document.getElementById(textboxid).value = str.toUpperCase();
        }

        $("#search_attendance").on("click", function() {
            var attenddate = $(".date_pickerfrom").val();
            var yearlevel = $(".YearLevel").val();
            var attendance = $(".Attendance").val();

            if (attenddate == '') {
                showErrorMsg("Please enter the dates");
                return false;
            }
            if (yearlevel == '') {
                showErrorMsg("Please select Year Level");
                return false;
            }
            if (attendance == '') {
                showErrorMsg("Please select Course");
                return false;
            }
        });

        function showErrorMsg(message) {
            $("#error_msg").hide().css({
                "background": "red",
                "color": "#fff"
            }).fadeIn("slow").html(message);
        }

        $('.date_pickerfrom, .date_pickerto, #date_picker').datetimepicker({
            format: 'mm/dd/yyyy',
            startDate: '01/01/2000',
            language: 'en',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });

        $(document).on("click", ".save", function() {
            var pass1 = $("#U_PASS").val();
            var pass2 = $("#RU_PASS").val();
            var name = $("#U_NAME").val();
            var username = $("#U_USERNAME").val();

            if (name == '') {
                showErrorMsg("This field is required", "#errormsg_uname");
                $("#U_NAME").focus();
                return false;
            }
            if (username == '') {
                showErrorMsg("This field is required", "#errormsg_username");
                $("#U_USERNAME").focus();
                return false;
            }
            if (pass1 == '') {
                showErrorMsg("This field is required", "#errormsg_pass1");
                $("#U_PASS").focus();
                return false;
            }
            if (pass2 == '') {
                showErrorMsg("This field is required", "#errormsg_pass2");
                $("#RU_PASS").focus();
                return false;
            }
            if (pass1 != pass2) {
                showErrorMsg("Password does not match", "#errormsg_pass2");
                $("#RU_PASS").focus();
                return false;
            }
        });

        function showErrorMsg(message, selector) {
            $(selector).hide().css({
                "background": "red",
                "color": "#fff"
            }).fadeIn("slow").html(message);
        }

        $("#gosearch").click(function() {
            if ($("#INST_ID").val() == 'Select') {
                alert("Please select Instructor.");
                return false;
            }
            return true;
        });
    </script>
</body>
</html>
