<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include ("php/account.php")
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Retired Tests Collection System</title>
<meta name="keywords" content="考古題, Retired Tests, 資料庫, database" />
<meta name="description" content="考古題收集系統" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="/Dropbox/database/icon.png">
<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

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
		<div id="site_title"><h1><a href="" rel="nofollow"> </a></h1></div>
		<?php 
		//登入介面

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
	</div>  <!-- END of templatemo_header -->
	
	<div id="templatemo_menubar">
		<div id="top_nav" class="ddsmoothmenu">
			<ul>
				<li><a href="index.php" class="selected">首頁</a></li>
				<li><a href="products.php">下載考古題</a></li>
				<li><a href="upload.php">上傳檔案</a></li>
				<li><a href="account_info.php">會員資料</a></li>
				<li><a href="newaccount.php">加入會員</a></li>
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
		</div>
		
			&nbsp
			<a href="discuss/discuss.php"><img src="images/discuss.jpg" alt="discuss!"width='350'height='600' />
            <a href="pass_analysis/hello.html"><img src="images/analysis.jpg" alt="analysis!" width='350'height='600' />

		
		<div class="cleaner"></div>
	</div> <!-- END of templatemo_main -->
	
	<div id="templatemo_footer">
		<p><a href="#">首頁</a> | <a href="products.php">下載考古題</a> | <a href="upload.php">上傳檔案</a> | <a href="account_info.php">會員資料</a> | 
		   <a href="newaccount.php">加入會員</a> | <a href="contact.php">聯絡我們</a>
		</p>

		 Copyright © 2015 <a href="#">NCKU ES105 DataBase</a> | 
		 <a rel="nofollow" href="#">Retired-Test Collection System</a> by <a href="#" rel="nofollow" target="_parent" title="free css templates">Database Team4</a>
	</div> <!-- END of templatemo_footer -->
	
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>