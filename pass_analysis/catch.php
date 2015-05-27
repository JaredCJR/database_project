

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
				<li><a href="../index.php">首頁</a></li>
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




<html><head>
<title>成大數位學習平台-統計資料</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!--  
<link rel="stylesheet" type="text/css" media="screen" href="js/ui-1.10.3/css/base/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
 -->
 <link rel="stylesheet" type="text/css" media="screen" href="js/easytabs/style.css" />
 
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script src=".js/easytabs/jquery.hashchange.min.js" type="text/javascript"></script>
<script src="js/easytabs/jquery.easytabs.min.js" type="text/javascript"></script>
<!--   
<script type="text/javascript" src="js/ui-1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/ui-1.10.3/jquery.ui.tabs.js"></script>
 -->

<script type="text/javascript">
  $(document).ready(function () {
	  //$( "#tabs" ).tabs();
	  $('#tab-container').easytabs();
	
}); //end of $(document).ready(function () {

</script>
</head>


<body>
    <div id="header"><h1>成大歷史統計資料</h1></div>
<div id="container">

<div id="tab-container" class='tab-container'>
 <ul class='etabs'>
  
   
   
 </ul>
 <div class='panel-container'>
  <div id="tabs1">
   <table cellpadding="0" cellspacing="0" border="0">
  	<tr>
  <h3>線上教材統計</h3>
  	<td> 
	  	<table boder="0">
	  	<tr>
	  	<ul>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=1031" target="_blank">103學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=1022" target="_blank">102學年度第2學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=1021" target="_blank">102學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=1012" target="_blank">101學年度第2學期</a></li></td>
	  	</ul>
	  	</tr>
	  	<tr>
	  	<ul>  	
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=1011" target="_blank">101學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=1002" target="_blank">100學年度第2學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=1001" target="_blank">100學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=992" target="_blank">99學年度第2學期</a></li></td>
	  	</li>
	  	</tr>
	  	<tr>
	  	<ul>  	
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=991" target="_blank">99學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=982" target="_blank">98學年度第2學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester.php?sem=981" target="_blank">98學年度第1學期</a></li></td>
	  	</ul>
	  	</tr>	  	
	  	</table>
  	</td>
  	</tr>
  	</table>    
  </div>
  
  <div id="tabs2">
   <table cellpadding="0" cellspacing="0" border="0">
  	<tr>
            <br>
  	<h3>線上選課人數統計</h3>
  	<td>  	
	  	<table boder="0">
	  	<tr>
	  	<ul>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=1031" target="_blank">103學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=1022" target="_blank">102學年度第2學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=1021" target="_blank">102學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=1012" target="_blank">101學年度第2學期</a></li></td>
		</ul>  	
	  	</tr>
	  	<ul>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=1011" target="_blank">101學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=1002" target="_blank">100學年度第2學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=1001" target="_blank">100學年度第1學期</a></li></td>	
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=992" target="_blank">99學年度第2學期</a></li></td>
	  	</ul>
	  	</tr>
	  	<tr>
	  	<ul>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=991" target="_blank">99學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=982" target="_blank">98學年度第2學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/semester_enroll.php?sem=981" target="_blank">98學年度第1學期</a></li></td>
	  	</ul>
	  	</tr>
	  	</table>
  	
  	</td>
  	</tr>
  	</table>    
  </div>
  
  <div id="tabs3">
   <table cellpadding="0" cellspacing="0" border="0">
  	<tr>
  
  	<td>  	
	  	<table boder="0">
	  	<tr>
	  	<ul>
	  	
	  	</ul>
	  	</tr>
	  	<tr><td></td></tr>
	  	<tr><td></td></tr>
	  	<tr><td></td></tr>
	  	<tr>
                    
	  	<td colspan="3"><h3>各學院課程啟用分析</h3></td>
	  	</tr>
	  	
	  	<tr>
	  	<ul>	  	
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=1031" target="_blank">103學年度第1學期 </a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=1022" target="_blank">102學年度第2學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=1021" target="_blank">102學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=1012" target="_blank">101學年度第2學期</a></li></td>	  	
		</ul>
	  	</tr>
	  	
	  	<tr>
	  	<ul>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=1011" target="_blank">101學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=1002" target="_blank">100學年度第2學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=1001" target="_blank">100學年度第1學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=992" target="_blank">99學年度第2學期</a></li></td>
	  	</ul>
	  	</tr>
	  	
	  	<tr>
	  	<ul>	  	
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=991" target="_blank">99學年度第1學期</a></li></td>	  	
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=982" target="_blank">98學年度第2學期</a></li></td>
	  	<td><li><a href="http://moodle.ncku.edu.tw/nckustats/course_visible_analysis.php?sem=981" target="_blank">98學年度第1學期</a></li></td>
	  	</ul>
	  	</tr>
	  	
	  	</table>
  	
  	</td>
  	</tr>
  	</table>    
  </div>
 </div> <!-- <div class='panel-container'> -->
 
</div>
</div> <!--  <div id="container">  -->

</body>
</html>


        
        
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