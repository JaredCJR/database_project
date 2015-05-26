<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
//session_start() ;

//include ("php/database_info.php") ;
//include ("php/encrypt.php") ;
include ("php/account.php") ;
//print_r($_POST) ;




if(isset($_POST["account"])&&isset($_POST["passwd"])&&isset($_POST["Name"])&&isset($_POST["schoolname"])&&isset($_POST["departmentname"])&&isset($_POST["idnumber"]))
{
	//註冊資料
	$account = $_POST["account"] ;
	$passwd = $_POST["passwd"] ;
	$email = $_POST["email"] ;
	$name = $_POST["Name"] ;
	$schoolname = $_POST["schoolname"] ;
	$departmentname = $_POST["departmentname"] ;
	$idnumber = $_POST["idnumber"] ;

	$passwd_encrypt = fnEncrypt($passwd,$account) ;
	//echo "$passwd_encrypt → ".(fnDecrypt($passwd_encrypt,$account)) ;

	//資料庫參數
	global $DB_NAME ;
	global $DB_USER ;
	global $DB_PASSWD ;
	global $DB_HOST ;

	//建立一個PDO物件
	$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));


	//設定字元編碼
	//$dbh->exec("SET CHAEACTER SET utf-8") ;

	//加入使用者
	$result = $dbh->prepare("INSERT INTO user(Account, Passwd, Permission, Name, SchoolName, DepartmentName, IdNumber, Email)
								VALUES('$account','$passwd_encrypt',2,'$name','$schoolname','$departmentname','$idnumber','$email')") ;
	//INSERT INTO `retired_tests_libary`.`user` (`Account`, `Passwd`, `Permission`, `Name`, `SchoolName`, `DepartmentName`, `DepartmentLevel`, `Email`) VALUES ('MuLin', '123', '4', 'MuLin', 'NCKU', 'ES', '104', 'Millenary.soul@gmail.com');


	if(!($result->execute()))
	{
		//echo "ERROR." ;
		$error = 1 ;
	}
	else
	{
		$_SESSION["ID"] = $name ;
		$_SESSION["Account"]=$account;
	}
}
else
{
	$error = 2 ;
}

$dbh = NULL ;
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Retired Tests Collection System - New Account</title>
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

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

</script>

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
		<div id="site_title"><h1><a href="http://www.templatemo.com" rel="nofollow"> </a></h1></div>
		<!--
		<div id="header_right">
			<p>
			<a href="#">My Account</a> | <a href="#">My Wishlist</a> | <a href="#">My Cart</a> | <a href="#">Checkout</a> | <a href="#">Log In</a></p>
			<p>
				Shopping Cart: <strong>3 items</strong> ( <a href="shoppingcart.html">Show Cart</a> )
			</p>
		</div>-->
		<div id="header_right_login">
			<form action='index.php' method='POST'>
			<div id="header_right_login_inside">
			Account <input id="account" type="text"><br>
			Password <input id="passwd" type="text"><br>
			</div>
			<div id="header_right_login_inside2">
			<input value="login" type="submit">
			</div>
			</form>
		</div>
		<div class="cleaner"></div>
	</div> <!-- END of templatemo_header -->
	
	<div id="templatemo_menubar">
		<div id="top_nav" class="ddsmoothmenu">
			<ul>
				<li><a href="index.php">首頁</a></li>
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
			if(isset($_SESSION["ID"]))
			{
				echo "<div style='letter-spacing:10px' >
					<H1><br>加入會員成功<br><br>" ;
				echo $_SESSION["ID"]."，歡迎你。</H1>
					</div>" ;
			}
			else if($error==1)
			{
				echo "<div style='letter-spacing:10px' >
					<H1><br>帳號已經被註冊過了!</H1>
					</div>" ;
			}
			else if($error==2)
			{
				echo "<div style='letter-spacing:10px' >
					<H1><br>請填入資料!</H1>
					<a href='newaccount.php'>回註冊頁</a>
					</div>" ;
			}
			else
			{
				echo "<div style='letter-spacing:10px' >
					<H1><br>未知錯誤!</H1>
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