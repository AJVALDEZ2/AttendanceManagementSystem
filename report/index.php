<?php
require_once("../include/initialize.php");
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	
	case 'attendance' : 
	$title ='Attendance'; 
		$content    = 'attendance_report.php';		
		break; 
	case 'logs' : 
	$title ='Logs'; 
		$content    = 'userlogs.php';		
		break; 
 
	  default : 
		$title ='Attendance'; 
		$content    = 'attendance_report.php';		
		break; 	
}
  // include '../modal.php';
require_once '../theme/Templates.php';
?>


  
