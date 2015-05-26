<?php

if (!isset($_GET["level"])) {
	echo "NONONOQ" ;
	exit() ;
}
//print_r($_GET) ;
include ("database_info.php") ;

header("Content-Type:text/html; charset=utf-8");

$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8")) ;

//print_r($_GET) ;


if (isset($_GET['schoolname'])) {
		$schoolname = $_GET['schoolname'] ;
}

if (isset($_GET['departmentname'])) {
		$departmentname = $_GET['departmentname'] ;
}

if (isset($_GET['subjectname'])) {
		$subjectname = $_GET['subjectname'] ;
}

if(((int) $_GET['level'] == 1) && isset($schoolname))
{
	$result = $dbh->prepare("SELECT DISTINCT Department_name FROM course_info WHERE School_name='$schoolname' ") ;
	$result->execute() ;
	while ($row = $result->fetch()) {
		$data[$row['Department_name']] = $row['Department_name'] ;
	}
}

if(((int) $_GET['level'] == 2) && isset($schoolname) && isset($departmentname))
{
	$result = $dbh->prepare("SELECT DISTINCT Subject_name FROM course_info WHERE School_name='$schoolname' AND Department_name='$departmentname' ORDER BY Grade,Semester") ;
	$result->execute() ;
	while ($row = $result->fetch()) {
		$data[$row['Subject_name']] = $row['Subject_name'] ;
	}
}

if(((int) $_GET['level'] == 3) && isset($schoolname) && isset($departmentname) && isset($subjectname))
{
	$result = $dbh->prepare("SELECT DISTINCT Professor FROM course_info WHERE School_name='$schoolname' AND Department_name='$departmentname' AND Subject_name='$subjectname'") ;
	$result->execute() ;
	while ($row = $result->fetch()) {
		$data[$row['Professor']] = $row['Professor'] ;
	}
}


echo json_encode($data);
$dbh = NULL ;


//print_r($_GET) ;
//phpinfo() ;
?>