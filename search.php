<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include ("php/account.php")
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
				<li><a href="index.php">首頁</a></li>
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
		<div id="content" class="float_r faqs">
		<h1>搜尋結果</h1>
		<?php 
		/*
            echo "<div style='letter-spacing:10px' >
                <H5><br>暫時無搜尋功能，謝謝!<br><br><br></H5>
                </div>" ;*/
            echo "<br><br>";

            if (isset($_GET["keyword"])) {
            	
	            $keyword = $_GET["keyword"] ;
	            $result_empty = 0 ;

	            global $DB_NAME ;
				global $DB_USER ;
				global $DB_PASSWD ;
				global $DB_HOST ;

				//建立一個PDO物件
				$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
				//$length=strlen($keyword);
				//$arr=utf8_str_split($keyword);
				$temp="SELECT * FROM  course_info WHERE concat(School_name,Department_name,Subject_name) LIKE '";
				for($i=0;$i<strlen($keyword)/3;$i++)
				{	if(mb_substr($keyword,$i,1,'UTF-8')!=' ')
					$temp=$temp."%".mb_substr($keyword,$i,1,'UTF-8');
				}
				$temp=$temp."%'";
				//"%$keyword%'";
				//echo strlen($keyword)/3;
				//echo "$temp<br>";
				//$test="apple";
				//echo strlen($test);
				//echo"<br>".mb_substr($keyword,1,2,'UTF-8');
				$result = $dbh->prepare("$temp") ;
				$result->execute() ;
//SELECT * FROM  course_info WHERE Subject_name LIKE '"for($i=0;$i<strlen($keyword);i++){.%substr(%keyword,$i,1).}"%' LIMIT 0 , 30"
				while ($row = $result->fetch()) {
			        //print_r($row) ;
			        $get_d="?schoolok=" . $row['School_name'] . "&Depok=". $row['Department_name'] ."&Subok=".$row['Subject_name'] ;
			        $tot_name=$row["School_name"]."-".$row["Department_name"]."-".$row["Subject_name"];
			        echo "<H3><a href='products.php".$get_d."' style='color:orange'>◈ $tot_name</a></H3>" ;
			        $result_empty ++ ;
			    }

			    if ($result_empty==0) {
			    	echo "<div style='letter-spacing:10px' >
		                <H5><br> 無結果!<br><br><br></H5>
		                </div>" ;
			    }
				
			    /*
			    if (is_null($data)) {
			    	$temp["Subject_name"] = "無資料" ;
			    	$data[1] = $temp ;
			    }*/
				$dbh = NULL ;
            }
		?>
		</div>
		<div class="cleaner"></div>
	</div> <!-- END of templatemo_main -->
	
	<div id="templatemo_footer">
		<p><a href="index">首頁</a> | <a href="products.php">下載考古題</a> | <a href="upload.php">上傳檔案</a> | <a href="account_info.php">會員資料</a> | 
		   <a href="#">加入會員</a> | <a href="about.php">關於此網站</a> | <a href="contact.php">聯絡我們</a>
		</p>

		 Copyright © 2014 <a href="#">NCKU ES104 DataBase</a> | 
		 <a rel="nofollow" href="#">Retired-Test Collection System</a> by <a href="#" rel="nofollow" target="_parent" title="free css templates">Database Team4</a>
	</div> <!-- END of templatemo_footer -->
	
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>