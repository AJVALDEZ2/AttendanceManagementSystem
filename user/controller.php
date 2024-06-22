<?php
require_once("../include/initialize.php");

// Check if user is logged in
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "index.php");
}

// Determine action
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        doInsert();
        break;

    case 'edit':
        doEdit();
        break;

    case 'delete':
        doDelete();
        break;

    case 'photos':
        doupdateimage();
        break;
}

function doInsert()
{
    // Check if form is submitted
    if (isset($_POST['save'])) {

        // Check for empty fields
        if ($_POST['U_NAME'] == "" || $_POST['U_USERNAME'] == "" || $_POST['U_PASS'] == "") {
            message("All fields are required!", "error");
            redirect('index.php?view=add');
            return;
        }

        // Establish database connection
        $connection = mysqli_connect("localhost:3307", "root", "", "dbattendance");

        if (!$connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Sanitize input
        $username = mysqli_real_escape_string($connection, $_POST['U_USERNAME']);

        // Check if username already exists
        $query = "SELECT * FROM useraccounts WHERE ACCOUNT_USERNAME='$username'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        }

        $userresult = mysqli_fetch_assoc($result);

        if ($userresult) {
            message("Username is already taken.", "error");
            redirect('index.php?view=add');
            return;
        }

        // Create new user
        $user = new User();
        $user->ACCOUNT_NAME = $_POST['U_NAME'];
        $user->ACCOUNT_USERNAME = $_POST['U_USERNAME'];
        $user->ACCOUNT_PASSWORD = sha1($_POST['U_PASS']);
        $user->ACCOUNT_TYPE = $_POST['U_ROLE'];
        $user->create();

        message("New [" . $_POST['U_NAME'] . "] created successfully!", "success");
        redirect("index.php");
    }
}

function doEdit()
{
    if (isset($_POST['save'])) {
        // Update user details
        $user = new User();
        $user->ACCOUNT_NAME = $_POST['U_NAME'];
        $user->ACCOUNT_USERNAME = $_POST['U_USERNAME'];
        $user->ACCOUNT_PASSWORD = sha1($_POST['U_PASS']);
        $user->ACCOUNT_TYPE = $_POST['U_ROLE'];
        $user->update($_POST['USERID']);

        message("[" . $_POST['U_NAME'] . "] has been updated!", "success");
        redirect("index.php");
    }
}

function doDelete()
{
    // Delete user
    $id = $_GET['id'];

    $user = new User();
    $user->delete($id);

    message("User already Deleted!", "info");
    redirect('index.php');
}

function doupdateimage()
{
    // Handle image upload
    $errofile = $_FILES['photo']['error'];
    $temp = $_FILES['photo']['tmp_name'];
    $myfile = $_FILES['photo']['name'];
    $location = "photos/" . $myfile;

    if ($errofile > 0) {
        message("No Image Selected!", "error");
        redirect("index.php?view=view&id=" . $_GET['id']);
        return;
    }

    @$file = $_FILES['photo']['tmp_name'];
    @$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    @$image_name = addslashes($_FILES['photo']['name']);
    @$image_size = getimagesize($_FILES['photo']['tmp_name']);

    if ($image_size == FALSE) {
        message("Uploaded file is not an image!", "error");
        redirect("index.php?view=view&id=" . $_GET['id']);
        return;
    }

    // Upload image
    move_uploaded_file($temp, "photos/" . $myfile);

    $user = new User();
    $user->USERIMAGE = $location;
    $user->update($_SESSION['ACCOUNT_ID']);
    redirect("index.php?view=view&id=" . $_SESSION['ACCOUNT_ID']);
}
?>