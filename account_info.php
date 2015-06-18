<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include ("php/account.php") ;
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
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="/Dropbox/database/icon.png">
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
				<li><a href="account_info.php" class="selected">會員資料</a></li>
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
			<!--
			<div class="sidebar_box"><span class="bottom"></span>
				<h3><a class="sidebar_box_icon" href="http://tw.clipartlogo.com/free/cigarette-smoking.html"   target="_blank"><img src="images/templatemo_sidebar_header.png" alt="" title="吸煙 剪貼畫" /></a>Bestsellers </h3>   
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
		<div id="content" class="float_r faqs">
		<h1>會員資料</h1>
		<?php 
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
					//echo "<div class='float_l' style='width: 200px ;'> " ;
					echo "<h5>♧名字</h5><p>&nbsp;&nbsp;<font color='blue'>".$result['Name']."</font></p>"
						."<h5>♧學校</h5><p>&nbsp;&nbsp;<font color='blue'>".$result['SchoolName']."</font></p>"
						."<h5>♧系所</h5><p>&nbsp;&nbsp;<font color='blue'>".$result['DepartmentName']."</font></p>"
						."<h5>♧學號</h5><p>&nbsp;&nbsp;<font color='blue'>".$result['IdNumber']."</font></p>" ;
					echo "<BR><BR>" ;
					//echo "</div>" ;
                                        
                                        echo "<h1>大一</h1>";
                                        echo "<h3>普通物理學    普通物理學實驗   工程力學   計算機概論    材料科學   微積分（一）</h3>";
                                        echo "<h3>近代物理    微積分（二）   工程動力學   程式設計</h3>";
                                        echo "<br/><br/>";
                                        
                                        
                                        echo "<h1>大二</h1>";
                                        echo "<h3>資料結構   電路學   材料力學（一）   工程數學（一）  工程圖學與模擬   熱力學</h3>";
                                        echo "<h3>工程數學（二）   電子學   邏輯設計   電子學實驗</h3>";
                                        echo "<br/><br/>";
                                        
                                        echo "<h1>大三</h1>";
                                        echo "<h3>流體力學   計算機組織與組合語言   自動控制</h3>";
                                        echo "<h3>數值方法   熱傳學</h3>";
                                        echo "<br/><br/>";
                                        
                                        echo "<h1>大四</h1>";
                                        
                                        
					echo "<BR><BR><BR><BR>" ;
					if (isset($changeResult)) {
						if ($changeResult==1) {
							echo "<h5>原始密碼驗證失敗QQ。</h5>" ;
						}
						else if ($changeResult==2) {
							echo "<h5>新密碼更改失敗QQ。</h5>" ;
						}
						else{
							echo "<h5>密碼更改完成ˊ_>ˋ。</h5>" ;
						}
					}
					echo "<br><br>" ;
					echo "<div class='content_half checkout' >" ;
					echo "<form name='account_info' action='' method='POST' onsubmit='return account_info_comfirm();'>" ;
					echo "<h5>更改密碼</h5>
						原密碼:
						<input type='password' id='oldpasswd'  style='width:300px;' name='oldpasswd'  />
						<br />
						<br />
						更改密碼:(最多32個字母)
						<input type='password' id='passwd'  style='width:300px;' name='passwd'  />
						<br />
						<br />
						密碼確認:
						<input type='password' id='passwdcomfirm'  style='width:300px;' />
						<br />
						<br />
						<input type='submit' value='更改密碼'>          <input type='reset' value='清空資料'> " ;
					echo "</form></div>" ;
				}
			}
			else
			{
                echo "<div style='letter-spacing:10px' >
                    <H1><br>請先登入!</H1>
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

		 Copyright © 2015 <a href="#">NCKU ES105 DataBase</a> | 
		 <a rel="nofollow" href="#">Retired-Test Collection System</a> by <a href="#" rel="nofollow" target="_parent" title="free css templates">Database Team4</a>
	</div> <!-- END of templatemo_footer -->
	
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>