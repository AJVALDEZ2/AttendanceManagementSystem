<?php
require_once ("../include/initialize.php");

// Establish MySQLi database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "dbattendance";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."index.php");
}

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    case 'add' :
        doInsert();
        break;
    
    case 'edit' :
        doEdit();
        break; 
    
    case 'delete' :
        doDelete();
        break;

    case 'photos' :
        doupdateimage();
        break;

    case 'checkid' :
        Check_TeacherID();
        break;
}

function doInsert(){
    global $mysqli; // Include $mysqli variable from global scope
    if(isset($_POST['save'])){
        if ($_POST['TeacherID'] == "" || $_POST['Firstname'] == "" || $_POST['Lastname'] == ""
            || $_POST['Middlename'] == "" || $_POST['CourseID'] == "none"  || $_POST['Address'] == "" 
            || $_POST['ContactNo'] == "") {
            $messageStats = false;
            message("All fields are required!","error");
            redirect('index.php?view=add');
        } else {    
            $birthdate =  $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
            $age = date_diff(date_create($birthdate),date_create('today'))->y;

            if ($age < 15){
                message("Invalid age. 15 years old and above is allowed.", "error");
                redirect("index.php?view=add");
            } else {
                // Prepare and execute the statement to check if the teacher ID already exists
                $sql = "SELECT * FROM tblteacher WHERE TeacherID = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("s", $_POST['TeacherID']);
                $stmt->execute();
                $result = $stmt->get_result();
                
                // Check if there are any rows returned
                if ($result->num_rows > 0) {
                    message("teacher ID already in use!", "error");
                    redirect("index.php?view=add");
                } else {
                    $stud = New teacher(); 
                    $stud->TeacherID     = $_POST['TeacherID'];
                    $stud->Firstname    = $_POST['Firstname']; 
                    $stud->Lastname         = $_POST['Lastname'];
                    $stud->Middlename      = $_POST['Middlename'];
                    $stud->CourseID         = $_POST['CourseID']; 
                    $stud->Address            = $_POST['Address']; 
                    $stud->BirthDate         = $birthdate;
                    $stud->Age                 = $age;
                    $stud->Gender          = $_POST['optionsRadios']; 
                    $stud->ContactNo      = $_POST['ContactNo'];
                    $stud->YearLevel         = $_POST['YearLevel'];
                    $stud->create();

                    $autonum = New Autonumber(); 
                    $autonum->auto_update(2);

                    message("New teacher created successfully!", "success");
                    redirect("index.php");
                }
            }
        }
    }
}

function doEdit(){
    if(isset($_POST['save'])){
        if ($_POST['TeacherID'] == "" OR $_POST['Firstname'] == "" OR $_POST['Lastname'] == ""
        OR $_POST['Middlename'] == "" OR $_POST['CourseID'] == "none"  OR $_POST['Address'] == "" 
        OR $_POST['ContactNo'] == "") {
            $messageStats = false;
            message("All fields are required!","error");
            redirect('index.php?view=add');
        } else {    
            $birthdate =  $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
            $age = date_diff(date_create($birthdate),date_create('today'))->y;
            if ($age < 15){
                message("Invalid age. 15 years old and above is allowed.", "error");
                redirect("index.php?view=view&id=".$_POST['TeacherID']);
            } else {
                $stud = New teacher(); 
                $stud->TeacherID        = $_POST['IDNO'];
                $stud->Firstname        = $_POST['Firstname']; 
                $stud->Lastname         = $_POST['Lastname'];
                $stud->Middlename       = $_POST['Middlename'];
                $stud->Address          = $_POST['Address']; 
                $stud->BirthDate        = $birthdate;
                $stud->Age              = $age;
                $stud->Gender           = $_POST['optionsRadios']; 
                $stud->ContactNo        = $_POST['ContactNo'];

                $stud->studupdate($_POST['TeacherID']);

                message("teacher has been updated!", "success");
                redirect("index.php?view=view&id=".$_POST['TeacherID']);
            }
        }
    }
}

function doDelete(){   
    if (isset($_POST['selector'])==''){
        message("Select the records first before you delete!","error");
        redirect('index.php');
    } else {
        $id = $_POST['selector'];
        $key = count($id);
        for($i=0;$i<$key;$i++){
            $subj = New teacher();
            $subj->delete($id[$i]);
        }
        message("teacher(s) already Deleted!","success");
        redirect('index.php');
    }
}

function doupdateimage(){
    $errofile = $_FILES['photo']['error'];
    $type = $_FILES['photo']['type'];
    $temp = $_FILES['photo']['tmp_name'];
    $myfile =$_FILES['photo']['name'];
    $location="photo/".$myfile;

    if ( $errofile > 0) {
        message("No Image Selected!", "error");
        redirect("index.php?view=view&id=". $_GET['id']);
    } else {
        @$file=$_FILES['photo']['tmp_name'];
        @$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
        @$image_name= addslashes($_FILES['photo']['name']); 
        @$image_size= getimagesize($_FILES['photo']['tmp_name']);

        if ($image_size==FALSE ) {
            message("Uploaded file is not an image!", "error");
            redirect("index.php?view=view&id=". $_GET['id']);
        } else {
            move_uploaded_file($temp,"photo/" . $myfile);
            $stud = New teacher();
            $stud->StudPhoto = $location;
            $stud->studupdate($_POST['TeacherID']);
            redirect("index.php?view=view&id=". $_POST['TeacherID']);
        }
    }
}

function Check_TeacherID() {
    // Assuming you have a database connection established
    $mysqli = new mysqli("localhost:3307", "root", "", "dbattendance");

    // Check for connection errors
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        return;
    }

    // Assuming 'single_teacher' method returns a single teacher object based on ID
    $stud = new teacher();
    $teacher = $stud->single_teacher($_POST['IDNO']);

    // Prepare and execute the statement to check if the Teacher ID already exists
    $sql = "SELECT * FROM tblteacher WHERE TeacherID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $_POST['IDNO']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        echo "Teacher ID already in use!";
    } else {
        echo "Teacher ID available.";
    }

    // Close the statement and database connection
    $stmt->close();
    $mysqli->close();
}
function generateQrCode() {
    $qrImg = '<script>document.getElementById(\'qrImg\');</script>';

    // Generate random QR code data
    $text = generateRandomCode(10);
    echo '<script>$("#generatedCode").val(' . $text . ');</script>';

    // Display the QR code image
    if ($text === "") {
        echo '<script>alert("Please enter text to generate a QR code.");</script>';
        return;
    } else {
        $apiUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode($text);
        echo '<script>qrImg.src = "' . $apiUrl . '";</script>';
        // Disable form fields during QR code generation using JavaScript
        echo '<script>
            document.getElementById(\'IDNO\').style.pointerEvents = \'none\';
            document.getElementById(\'Firstname\').style.pointerEvents = \'none\';
            // Other form fields to disable during QR code generation
        </script>';
        // Show QR code and hide the QR code generator button using JavaScript
        echo '<script>
            document.querySelector(\'.qr-con\').style.display = \'\';
            document.querySelector(\'.qr-generator\').style.display = \'none\';
        </script>';
    }

}

?>