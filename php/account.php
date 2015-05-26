<?php 
session_start() ;
include ("database_info.php") ;
include ("encrypt.php") ;
//print_r($_POST) ;
if(isset($_POST["logout"]))
{
	unset($_SESSION["ID"]);
}

if(!isset($_SESSION["ID"]))
{
	if (isset($_POST["id"])&&isset($_POST["pw"])) 
	{
		//echo "not empty <br>" ; 
		$AC_Value = $_POST["id"] ;
		$PW_value = fnEncrypt($_POST["pw"],$AC_Value) ;

		$ID = checkMember($AC_Value,$PW_value) ;
		if($ID)
		{
			$_SESSION["ID"] = $ID["Name"] ;  //顯示名字
			$_SESSION["Account"] = $ID["Account"] ;
		}	
	}
}


function checkMember($AC_Value, $PW_value)
{
	global $DB_NAME ;
	global $DB_USER ;
	global $DB_PASSWD ;
	global $DB_HOST ;

	//建立一個PDO物件
	$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));

	//設定字元編碼
	// $dbh->exec("SET CHAEACTER SET utf-8") ;

	$checkID = $dbh->prepare("SELECT Account,Name FROM user WHERE Account='$AC_Value' AND Passwd='$PW_value' LIMIT 1") ;
	$checkID->execute() ;
	$result = $checkID->fetch() ;

	if(!($result))
	{
		$dbh = NULL ;
		return false ;
	}
	else
	{
		$dbh = NULL ;
		$data["Account"] = $result["Account"] ;
		$data["Name"] = $result["Name"] ;
		return $data ;	//成功則傳回用戶ID
	}
	$dbh = NULL ;
}

function MemberQuery($ID)
{
	global $DB_NAME ;
	global $DB_USER ;
	global $DB_PASSWD ;
	global $DB_HOST ;

	//建立一個PDO物件
	$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));


	$checkID = $dbh->prepare("SELECT * FROM user WHERE Account='$ID' LIMIT 1") ;
	$checkID->execute() ;
	$result = $checkID->fetch() ;

	if(!($result))
	{
		return false ;
	}
	else
	{
		return $result ;
	}
	$dbh = NULL ;
}

function HotCourse()
{
	global $DB_NAME ;
	global $DB_USER ;
	global $DB_PASSWD ;
	global $DB_HOST ;

	//建立一個PDO物件
	$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));


	$result = $dbh->prepare("SELECT Course_id, Subject_name, Year, SUM(Download_times), Department_name, School_name ,Sname_a FROM course_info INNER JOIN file_info ON course_info.CoureseID=file_info.Course_id JOIN sname_abbr ON Sname=School_name GROUP BY Course_id ORDER BY SUM(Download_times) DESC LIMIT 15") ;
	$result->execute() ;
	$data = NULL ;
	$data_index = 1 ; 
	while ($row = $result->fetch()) {
        
            // 將取得的資料放入陣列中
            $data[$data_index] = $row ;
            $data_index = $data_index+1 ;
    }
    if (is_null($data)) {
    	$temp["Subject_name"] = "無資料" ;
    	$data[1] = $temp ;
    }
    $dbh = NULL ;
    return $data ;
	/*
	if(!($result))
	{
		return false ;
	}
	else
	{
		return $result ;
	}*/
	$dbh = NULL ;
}

function changePW($AC_Value,$old_PW,$new_PW)
{
	global $DB_NAME ;
	global $DB_USER ;
	global $DB_PASSWD ;
	global $DB_HOST ;

	$Old_PW_value = fnEncrypt($old_PW,$AC_Value) ;

	//建立一個PDO物件
	$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));

	$checkPW = $dbh->prepare("SELECT * FROM user WHERE account='$AC_Value' AND Passwd='$Old_PW_value' LIMIT 1") ;
	//print_r($checkPW) ;
	$checkPW->execute() ;
	$result = $checkPW->fetch() ;

	if(!($result))
	{
		//echo "HAH" ;
		$dbh = NULL ;
		return 1 ;
	}
	else
	{
		$New_PW_value = fnEncrypt($new_PW,$AC_Value) ;
		$changePW = $dbh->prepare("UPDATE user SET Passwd='$New_PW_value' WHERE account='$AC_Value' AND Passwd='$Old_PW_value' LIMIT 1") ;
		
		//$changePW->execute() ;
		//$result = $checkPW->fetch() ;
		if(!($changePW->execute()))
		{
			$dbh = NULL ;
			return 2 ;
		}
		else
		{
			$dbh = NULL ;
			return 3 ;
		}
	}

	$dbh = NULL ;
}

?>
<!--
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="account.php" method="POST">
		AC<input type="text" name="id"><br>
		PW <input type="text" name="pw"><br>
		<input type="submit">
	</form>
</body>
</html>-->