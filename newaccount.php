<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include ("php/account.php") ;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Retired Tests Collection System - New Account</title>
<meta name="keywords" content="考古題, Retired Tests, 資料庫, database, Account, 帳戶" />
<meta name="description" content="考古題收集系統 加入會員" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="/Dropbox/database/icon.png">
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<script type="text/javascript" src="js/upload.js"></script>
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
	if(document.all.account_info.account.value=='')
	{
		msg+=" 您沒有輸入帳號,請重新填寫並確認! \n";
		alert(msg);
		document.all.account_info.account.focus();
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
	if(document.all.account_info.Name.value=='')
	{
		msg+=" 您的姓名尚未輸入,請重新填寫並確認! \n";
		alert(msg);
		document.all.account_info.Name.focus();
		return false;
	}
	if(document.all.account_info.idnumber.value=='')
	{
		msg+=" 您的學號尚未輸入,請重新填寫並確認! \n";
		alert(msg);
		document.all.account_info.idnumber.focus();
		return false;
	}
}

</script>

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
		<div id="site_title"><h1><a href="index.php" rel="nofollow"> </a></h1></div>
		<!--
		<div id="header_right">
			<p>
			<a href="#">My Account</a> | <a href="#">My Wishlist</a> | <a href="#">My Cart</a> | <a href="#">Checkout</a> | <a href="#">Log In</a></p>
			<p>
				Shopping Cart: <strong>3 items</strong> ( <a href="shoppingcart.html">Show Cart</a> )
			</p>
		</div>-->
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
				<li><a href="open_course/course.php">開放式課程</a></li>
				<li><a href="products.php">下載考古題</a></li>
				<li><a href="upload.php">上傳檔案</a></li>
				<li><a href="account_info.php">會員資料</a></li>
				<li><a href="newaccount.php" class="selected">加入會員</a></li>
				<li><a href="contact.php">聯絡我們</a></li>
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
								echo "<li class='first'><a href='products.php".$get_d."'>&emsp;$tot_name</a></li>" ;
							}
							else if ($i==$Hot_data_size) {
								echo "<li class='last'><a href='products.php".$get_d."'>&emsp;$tot_name</a></li>" ;
							}
							else
							{
								echo "<li><a href='products.php".$get_d."'>&emsp;$tot_name</a></li>" ;
							}
						}
					?>
					</ul>
				</div>
			</div>
			<!--
			<div class="sidebar_box"><span class="bottom"></span>
				<h3><a class="sidebar_box_icon" href="http://tw.clipartlogo.com/free/food.html" title="食品 剪貼畫"  target="_blank"><img src="images/templatemo_sidebar_header.png" alt="食品 剪貼畫"  /></a>Bestsellers </h3>   
				<div class="content"> 
					<div class="bs_box">
						<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
						<h4><a href="#">Donec nunc nisl</a></h4>
						<p class="price">$10</p>
						<div class="cleaner"></div>
					</div>
					<div class="bs_box">
						<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
						<h4><a href="#">Lorem ipsum dolor sit</a></h4>
						<p class="price">$12</p>
						<div class="cleaner"></div>
					</div>
					<div class="bs_box">
						<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
						<h4><a href="#">Phasellus ut dui</a></h4>
						<p class="price">$20</p>
						<div class="cleaner"></div>
					</div>
					<div class="bs_box">
						<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
						<h4><a href="#">Vestibulum ante</a></h4>
						<p class="price">$8</p>
						<div class="cleaner"></div>
					</div>
				</div>
			</div>-->
		</div>
		<div id="content" class="float_r">
		<?php 
			if(!isset($_SESSION["ID"]))
			{
				echo "<h1>加入會員</h1>
					<h5><strong>填寫註冊資訊</strong></h5>
					<form name='account_info' action='account_comfirm.php' method='POST' onsubmit='return account_info_comfirm();'>
					<div class='content_half float_l checkout'>
						
						帳號 (最多32個字母):  
						<input type='text'  style='width:300px;' name='account'  />
						<br />
						<br />
						密碼:(最多32個字母)
						<input type='password' id='passwd'  style='width:300px;' name='passwd'  />
						<br />
						<br />
						密碼確認:
						<input type='password' id='passwdcomfirm'  style='width:300px;' />
						<br />
						<br />
						E-mail:
						<input type='text'  style='width:300px;' name='email'  />
					</div>
					
					<div class='content_half float_r checkout' >
						姓名/暱稱:
						<input type='text'  style='width:300px;' name='Name'  />
						<br />
						<br />
						
						<form name='file_info' action='file_upload.php' method='POST' enctype='multipart/form-data' onsubmit='return file_info_comfirm();'>
						
							學校:  
							<select id='schoolname' name='schoolname' style='width:300px;' onChange='getdata(1)'>
							<option value=''>請選擇</option>" ;
						
					try{
						$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
						//$dbh->exec("SET SET NAMES UTF8 ") ;
						$result = $dbh->prepare("SELECT DISTINCT School_name FROM course_info") ;
						$result->execute() ;
						while ($row = $result->fetch()) {
    						echo '<option value="' . $row['School_name'] . '">' . $row['School_name'] . '</option>' . "\n";
						}
						$dbh = NULL ;
					}
					catch( PDOException $e ){
						die( $e->getMessage() );
					}
						
					echo"</select>
						<br />
						<br />
						系所:
						<select id='departmentname' name='departmentname' style='width:300px;' onChange='getdata(2)'>
						<option value=''>請選擇</option>
						</select>
						<br />
						<br />";
						echo "
						學號:
						<input type='text'  style='width:300px;' name='idnumber'  />
						<br />
						<br />
						
					</div>
					<div class='cleaner h50'></div>
					<div style='text-align:center ;letter-spacing:10px ' >
					<input type='submit' value='送出資料'>          <input type='reset' value='清空資料'> 
					</form> 
					</div>" ;
			}
			else
			{
				echo "<div style='letter-spacing:10px' >
					<H1><br>你已經登入。</H1>
					</div>" ;
			}
		?>
		</div> 
		<div class="cleaner"></div>
		
	</div> <!-- END of templatemo_main -->
	
	<div id="templatemo_footer">
		<p><a href="index">首頁</a> | <a href="products.php">下載考古題</a> | <a href="upload.php">上傳檔案</a> | <a href="account_info.php">會員資料</a> | 
		   <a href="#">加入會員</a> | <a href="contact.php">聯絡我們</a>
		</p>

		 Copyright © 2014 <a href="#">NCKU ES104 DataBase</a> | 
		 <a rel="nofollow" href="#">Retired-Test Collection System</a> by <a href="#" rel="nofollow" target="_parent" title="free css templates">Database Team4</a>
	</div> <!-- END of templatemo_footer -->
	
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>

