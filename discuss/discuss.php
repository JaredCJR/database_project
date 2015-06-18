<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include ("../php/account.php") ;
if (isset($_POST["oldpasswd"])&&isset($_POST["passwd"])) {
	$changeResult = changePW($_SESSION["Account"],$_POST["oldpasswd"],$_POST["passwd"]) ;
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Retired Tests Collection System - Account Information</title>
<meta name="keywords" content="shoes store, faqs, frequently asked questions, free template, ecommerce, online shop, website templates, CSS, HTML" />
<meta name="description" content="Shoes Store FAQs - free ecommerce HTML CSS template by templatemo.com" />
<link href="../templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="/Dropbox/database/icon.png">
<link rel="stylesheet" type="text/css" href="../css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "top_nav", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

function account_info_comfirm()
{
	var msg="\n系统提示 : \n\n";
	if(document.all.account_info.oldpasswd.value=='')
	{
		msg+=" 您沒有輸入原密碼,請重新填寫並確認! \n";
		alert(msg);
		document.all.account_info.oldpasswd.focus();
		return false;
	}
	if(document.all.account_info.passwd.value=='')
	{
		msg+=" 您沒有輸入密碼,請重新填寫並確認! \n";
		alert(msg);
		document.all.account_info.passwd.focus()
		return false;
	}
	if(document.all.account_info.passwd.value!=document.all.account_info.passwdcomfirm.value)
	{
		msg+=" 您兩次輸入的密碼不一樣,請重新確認! \n";
		alert(msg);
		document.all.account_info.passwdcomfirm.focus()
		return false;
	}
}

</script>

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
		<div id="site_title"><h1><a href="../index.php" rel="nofollow"> </a></h1></div>

		<?php 
		if(!isset($_SESSION["ID"]))
		{
			echo "<div id='header_right_login'>
					<form action='' method='POST'>
					<div id='header_right_login_inside'>
						Account <input name='id' type='text'><br>
						Password <input name='pw' type='password'><br>
					</div>
					<div id='header_right_login_inside2'>
						<input value='login' type='submit'>
					</div>
					</form>
				</div>" ;
		}
		else
		{
			
			echo "<div id='header_right_login_success'><form action='' method='POST'>" ;
			echo $_SESSION["ID"]."，你好" ;
			echo "<input type='submit' value='登出' name='logout'>
				</form>" ;
			echo "</div>" ;
		}
		?>
		<div class="cleaner"></div>
	</div> <!-- END of templatemo_header -->
	
	<div id="templatemo_menubar">
		<div id="top_nav" class="ddsmoothmenu">
			<ul>
				<li><a href="../open_course/course.php">開放式課程</a></li>
				<li><a href="../products.php">下載考古題</a></li>
				<li><a href="../upload.php">上傳檔案</a></li>
				<li><a href="../account_info.php" >會員資料</a></li>
				<li><a href="../newaccount.php">加入會員</a></li>
				<li><a href="../contact.php">聯絡我們</a></li>
			</ul>
			<br style="clear: left" />
		</div> <!-- end of ddsmoothmenu -->
		<div id="templatemo_search">
			<form action="search.php" method="get">
			  <input type="text" value="" name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
			  <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
			</form>
		</div>
	</div> <!-- END of templatemo_menubar -->
	
	<div id="templatemo_main">
		<div id="sidebar" class="float_l">
			<div class="sidebar_box"><span class="bottom"></span>
				<h3>熱門考古題</h3>   
				<div class="content"> 
					<ul class="sidebar_list">
					<?php 
						$HotCourseID = HotCourse() ;
						$Hot_data_size = count($HotCourseID) ;
						for ($i=1; $i <= $Hot_data_size; $i++) { 
							$sub_elem = $HotCourseID[$i] ;
							$Subject_name = $sub_elem["Subject_name"] ;
							$get_d="?schoolok=" . $sub_elem['School_name'] . "&Depok=". $sub_elem['Department_name'] ."&Subok=".$sub_elem['Subject_name'] ;
							//$Year = $sub_elem["Year"] ;
							$tot_name=$sub_elem["Sname_a"]."-".$sub_elem["Department_name"]."<br>&emsp;".$sub_elem["Subject_name"];
							if ($i==1) {
								echo "<li class='first'><a href='../products.php".$get_d."'>&emsp;$tot_name</a></li>" ;
							}
							else if ($i==$Hot_data_size) {
								echo "<li class='last'><a href='../products.php".$get_d."'>&emsp;$tot_name</a></li>" ;
							}
							else
							{
								echo "<li><a href='../products.php".$get_d."'>&emsp;$tot_name</a></li>" ;
							}
						}
					?>
					</ul>
				</div>
			</div>

		</div>
		<div id="content" class="float_r faqs">
		<h1>討論區</h1>
        
        <html>
		<a href="discuss.php"><img src="../images/I_want_discuss.png" alt="discuss!"width='30'height='30' />
        <a href="discuss.php"><img src="../images/I_want_discuss.png" alt="discuss!"width='30'height='30' />
        <a href="discuss.php"><img src="../images/I_want_discuss.png" alt="discuss!"width='30'height='30' />
        <a href="discuss.php"><img src="../images/I_want_discuss.png" alt="discuss!"width='30'height='30' />
        
		</html>

<script>
function selectCourse(y)
{
	//alert(y);
	location.href="get.php?value="+y;
	
}


function selectMsg()
  { 
	  
  var ID = "<?php echo $_SESSION['discuss_courseID']; ?>";
  alert(ID);

  ////////////////////////////
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
  var number_of_row = "<?php echo $number_of_rows; ?>";
  var number_of_row = parseInt(number_of_row);
  if(number_of_row >0)
  {
	  var Student_Name = ["<?php echo join("\", \"", $Student_Name); ?>"];
   	  var Student_Department = ["<?php echo join("\", \"", $Student_Department); ?>"];
      var Student_School = ["<?php echo join("\", \"", $Student_School); ?>"];
      var Student_ID = ["<?php echo join("\", \"", $Student_ID); ?>"];
      var Student_Email = ["<?php echo join("\", \"", $Student_Email); ?>"];
      var Message_title = ["<?php echo join("\", \"", $Message_title); ?>"];
      var Message_content = ["<?php echo join("\", \"", $Message_content); ?>"];
      var time = ["<?php echo join("\", \"", $time); ?>"];
  add_multiple_data(number_of_row,Student_Name,Student_Department,Student_School,Student_ID,Student_Email,Message_title,Message_content,time);
  //remove_multiple_data(9);
  }
  }

function add_multiple_data(number_of_row,Student_Name,Student_Department,Student_School,Student_ID,Student_Email,Message_title,Message_content,time)
{
	for (i = 0; i < number_of_row; i++) {
    add_new_data(Student_Name[i],Student_Department[i],Student_School[i],Student_ID[i],Student_Email[i],Message_title[i],Message_content[i],time[i]);
	}
}

function remove_multiple_data(number_of_row)
{
	for (i = 0; i < number_of_row; i++) {
    remove_data();
	}
}

//http://blog.hsin.tw/2008/javascript-table-add-remove-row/
function add_new_data(Student_Name,Student_Department,Student_School,Student_ID,Student_Email,Message_title,Message_content,time) {
 //先取得目前的row數
 var num = document.getElementById("mytable").rows.length;
 //建立新的tr 因為是從0開始算 所以目前的row數剛好為目前要增加的第幾個tr
 var Tr1 = document.getElementById("mytable").insertRow(num);
 var Tr2 = document.getElementById("mytable").insertRow(num+1);
 var Tr3 = document.getElementById("mytable").insertRow(num+2);
 //建立新的td 而Tr.cells.length就是這個tr目前的td數
 Tr1.style.color="Black";
 Tr1.style.fontSize = "17px"
 Tr2.style.color="Gray";
 Tr2.style.fontSize = "12px"
 
 Td1 = Tr1.insertCell(0);
 Td1.innerHTML=Student_Name;
 Td2 = Tr2.insertCell(0);
 Td2.innerHTML=Student_School;
 Td2.innerHTML+="<br>";
 Td2.innerHTML+=Student_Department;
 Td2.innerHTML+="<br>";
 Td2.innerHTML+=Student_ID;
 Td2.innerHTML+="<br>";
 Td2.innerHTML+=Student_Email;

 Td1 = Tr1.insertCell(1);
 Td1.innerHTML=Message_title;
 Td2 = Tr2.insertCell(1);
 Td2.innerHTML=Message_content;
 Td2.innerHTML+="<br>";
 Td2.innerHTML+="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 Td2.innerHTML+=time;
 //http://www.w3schools.com/tags/ref_colorpicker.asp
 Tr3.style.color="#7A2900";
 Tr3.style.fontSize = "10px"
 Td3 = Tr3.insertCell(0);
 Td3.innerHTML='╠═╬═╬═╬═╬═╬═╬═╬═╬═╬';
 Td3 = Tr3.insertCell(1);
 Td3.innerHTML='╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╬═╣';
 
}


function remove_data() {
 //先取得目前的row數
 var num = document.getElementById("mytable").rows.length;
 //防止把標題跟原本的第一個刪除XD
 if(num >2)
 {
  //刪除最後一個
  document.getElementById("mytable").deleteRow(-1);
 }
}
</script>



		<?php 
			if(!isset($_SESSION['discuss_courseID']) )//如果不這樣做，會沒有session(discuss_courseID)
			{
				//$_SESSION['discuss_courseID'] = "E949000";
				$newURL = "get.php";
				header('Location: '.$newURL);
			}
		
			if(isset($_SESSION["ID"]))
			{
				$result = MemberQuery($_SESSION["Account"]) ;
				if (!$result) 
				{
					echo "<div style='letter-spacing:10px' >
                    	<H1><br>未知錯誤!</H1>
                    	</div>" ;
				}
				else
				{
					
					echo "<a href=\"I_want_discuss.php\"><p><font color='blue'></p><h2>★我要發問</h2></a>";
					echo "<html>";
					echo "<select name=\"CoureseID\" onchange=\"selectCourse(this.value)\">";
					

		//資料庫參數
		global $DB_NAME ;
		global $DB_USER ;
		global $DB_PASSWD ;
		global $DB_HOST ;

		//建立一個PDO物件
		$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
		
		//查詢課程代碼
		$result = $dbh->query("SELECT School_name,Department_name,Subject_name,CoureseID FROM course_info WHERE 1") ;
		$resultID = $dbh->query("SELECT CoureseID FROM course_info WHERE 1") ;
		if(!($result->execute() and $resultID->execute()))
		{
			$error = 3 ; //資料庫錯誤
		}
		else
		{
			while($course_id = $result->fetch(PDO::FETCH_ASSOC) and $id = $resultID->fetch(PDO::FETCH_ASSOC))
			{
				$separater = implode("", $course_id);
				//$separater2 = implode("", $id);
				$separater2 = $id['CoureseID'];
				echo "<option id=\"courseid\" value=".$separater2.">".$separater."</option>\n";
			}
//這邊設定table的id 讓javascript用>
			echo "</select>";
			echo "</html>";
			
			echo "<html>";
			//表格
			print '<table id="mytable" width="1000";table style="border: 5px ridge rgb(109, 2, 107); height: 100px; background-color: rgb(255, 255, 255); width: 600px;" align="left" cellpadding="5" cellspacing="5" frame="border" rules="all">';
			//http://tzoyiing.pixnet.net/blog/post/22374838-%E3%80%90%E6%95%99%E5%AD%B8%E3%80%91html%E8%A1%A8%E6%A0%BC%EF%BC%88table%EF%BC%89%E7%9A%84%E5%B8%B8%E7%94%A8%E8%AA%9E%E6%B3%95%EF%BC%88part.i%EF%BC%89
			print '</table>';
			//表格結束
			echo "</html>";
		}
		
		echo '<script type="text/javascript">'   , 'selectMsg();'   , '</script>';
		
					echo "<BR><BR>" ;
				}
			}
			else
			{
                echo "<div style='letter-spacing:10px' >
                    <H1><br><a href=\"..\index.php\">請先登入</a>!</H1>
                    </div>" ;
			}
		?>
        
        
		</div>
		<div class="cleaner"></div>
	</div> <!-- END of templatemo_main -->
	
	<div id="templatemo_footer">
		<p><a href="../index">首頁</a> | <a href="../products.php">下載考古題</a> | <a href="../upload.php">上傳檔案</a> | <a href="../account_info.php">會員資料</a> | 
		   <a href="#">加入會員</a> | <a href="../contact.php">聯絡我們</a>
		</p>

		 Copyright © 2015 <a href="#">NCKU ES105 DataBase</a> | 
		 <a rel="nofollow" href="#">Retired-Test Collection System</a> by <a href="#" rel="nofollow" target="_parent" title="free css templates">Database Team4</a>
	</div> <!-- END of templatemo_footer -->
	
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>