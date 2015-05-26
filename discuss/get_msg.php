<?php
  		//資料庫參數
		global $DB_NAME ;
		global $DB_USER ;
		global $DB_PASSWD ;
		global $DB_HOST ;
		$CID = $_SESSION['discuss_courseID'];
		//建立一個PDO物件
		$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
		
		//查詢
		$result = $dbh->query("SELECT Student_Name, Student_Department, Student_School, Student_ID, Student_Email, Message_title, Message_content, time FROM course_msg WHERE CourseID = '$CID'" ) ;
		$sqlll ="SELECT COUNT(*) FROM course_msg WHERE CourseID = '$CID' "; 

            $resultll = $dbh->prepare($sqlll); 
            $resultll->execute(); 
            $number_of_rows = $resultll->fetchColumn(); 
			$number_of_rows =(int)$number_of_rows;
		
		if($number_of_rows >0)
		{
			if(!($result->execute()))
		{
			$error = 3 ; //資料庫錯誤
		}
		else
		{ 
			while($msg = $result->fetch(PDO::FETCH_ASSOC) )
			{
				$Student_Name[] = $msg['Student_Name'];
				$Student_Department[] = $msg['Student_Department'];
				$Student_School[] = $msg['Student_School'];
				$Student_ID[] = $msg['Student_ID'];
				$Student_Email[] = $msg['Student_Email'];
				$Message_title[] = $msg['Message_title'];
				$Message_content[] = $msg['Message_content'];
				$time[] = $msg['time'];
			}
		}
		}
  ?>