<?php
require_once("include/initialize.php");

if (isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "index.php");
    exit();
}

$message = '';

if (isset($_POST['btnLogin'])) {
    $email = trim($_POST['username']);
    $upass = trim($_POST['pass']);
    $h_upass = sha1($upass);

    if ($email == '' OR $upass == '') {
        $message = "Invalid Username and Password!";
    } else {
        $user = new User();
        $res = $user::userAuthentication($email, $h_upass);
        if ($res == true) {
            $message = "You logon as " . $_SESSION['ACCOUNT_TYPE'] . ".";

            $sql = "INSERT INTO `tbllogs` (`USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`)
                    VALUES (" . $_SESSION['ACCOUNT_ID'] . ",'" . date('Y-m-d H:i:s') . "','" . $_SESSION['ACCOUNT_TYPE'] . "','Logged in')";
            $mydb->setQuery($sql);
            $mydb->executeQuery();

            if ($_SESSION['ACCOUNT_TYPE'] == 'Administrator') {
                redirect(web_root . "index.php");
            } elseif ($_SESSION['ACCOUNT_TYPE'] == 'Registrar') {
                redirect(web_root . "index.php");
            } else {
                redirect(web_root . "login.php");
            }
            exit();
        } else {
            $message = "Account does not exist! Please contact Administrator.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Attendance Monitoring</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo web_root; ?>css/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" type="text/css" href="<?php echo web_root; ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo web_root; ?>css/main.css">

    <style>
        body {
            background-image: url('<?php echo web_root; ?>images/242.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .limiter {
            width: 100%;
            max-width: 1000px;
            padding: 50px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 10px rgba(50, 50, 50, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            text-align: center;
        }

        .login100-form-title {
            background: url('<?php echo web_root; ?>images/logo.png') no-repeat center;
            background-size: 120px 120px;
            height: 140px;
            margin-bottom: 30px;
        }

        .login100-form-title span {
            display: block;
            margin-top: 150px;
            font-size: 28px;
            color: #333;
        }

        .wrap-input100 {
            position: relative;
            margin-bottom: 30px;
            text-align: left;
        }

        .input100 {
            width: 100%;
            padding: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 18px;
            transition: border-color 0.3s;
        }

        .input100:focus {
            border-color: #4CAF50;
        }

        .label-input100 {
            position: absolute;
            top: -14px;
            left: 18px;
            background: #fff;
            padding: 0 5px;
            font-size: 16px;
            color: #999;
        }

        .container-login100-form-btn {
            text-align: center;
        }

        .login100-form-btn {
            padding: 15px 30px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s;
        }

        .login100-form-btn:hover {
            background: lightgrey;
        }

        .contact100-form-checkbox {
            display: flex;
            align-items: center;
        }

        .label-checkbox100 {
            margin-left: 5px;
            font-size: 16px;
            color: #555;
        }

        .txt1 {
            font-size: 16px;
            color: #007BFF;
            text-decoration: none;
        }

        .txt1:hover {
            text-decoration: underline;
        }

        .flex-sb-m {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .message-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px; /* Adjust as needed */
            color: red; /* Change color as needed */
            font-size: 18px; /* Adjust as needed */
            margin-bottom: 20px; /* Adjust as needed */
        }
    </style>

</head>

<body id="login">

<div class="limiter">
    <div class="container-login100">
        <div class="login100-form-title">
            <span class="login100-form-title-1">
                Sign In
            </span>
            <div class="message-container">
                <?php if($message != '') { echo $message; } ?>
            </div>
        </div>

        <div class="wrap-login100">
            <form class="login100-form validate-form" action="" method="POST">
                <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="username" placeholder="Enter username">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="pass" placeholder="Enter password">
                    <span class="focus-input100"></span>
                </div>

                <div class="flex-sb-m w-full p-b-30">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

                    <div>
                        <a href="#" class="txt1">
                            Forgot Password?
                        </a>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit" name="btnLogin">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo web_root; ?>jquery/jquery.min.js"></script>
<script src="<?php echo web_root; ?>js/main.js"></script>
</body>
</html>
