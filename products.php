<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include ("php/account.php")
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Retired Tests Collection System - Collects</title>
<meta name="keywords" content="考古題, Retired Tests, 資料庫, database, 全部顯示" />
<meta name="description" content="考古題收集系統 顯示" />
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
				<li><a href="products.php" class="selected">下載考古題</a></li>
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
		<div id="content" class="float_r">
			<?php
				echo "<h1><font color='#000030'>考古題下載</font></h1>";
				if (isset($_SESSION["ID"])) {
					if(isset($_GET['Subok']))
					{	
						//echo"<h3><font color='BLUE'>請選擇科系：<br></font></h3>";
						//$j=0;
						//while($j<1000)
						//{
							//if(isset($_GET['schoolok']))
							//{
							echo "<h4><font color='#00B000'>".$_GET['schoolok']."-".$_GET['Depok']."-".$_GET['Subok']."：</font><br></h4>";
								try{				
									$a=$_GET['Subok'];
									$b=$_GET['Depok'];
									$c=$_GET['schoolok'];
									//echo $a;
									$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
									//$dbh->exec("SET SET NAMES UTF8 ") ;
									$result = $dbh->prepare("SELECT FileID,Midterm_Final,Year,File_type,file_info.Professor FROM course_info,file_info WHERE Subject_name='$a' AND Department_name='$b' AND School_name='$c' AND CoureseID=Course_id AND Midterm_Final!=0 ORDER BY Midterm_Final,Year") ;
									$result->execute() ;
									//$temp=0;
									//echo "<form action='products.php' method='get'>";
									while ($row = $result->fetch()) {
										$file_info = NULL ;
										
										$file_info = $a ;
										if ($row['Midterm_Final']==9) {
											$file_info = $file_info . ("-未知第幾次考試") ;
										}
										else
										{
											$file_info = $file_info . ("-第".$row['Midterm_Final']."次期中考") ;
										}					
										if(!$row['Year']||$row['Year']=="0000")
										{
											$file_info = $file_info ."-年份未知-" ;
										}
										else
										{
											$file_info = $file_info ."-".$row['Year']."年-" ;
										}
										//$file_type = $row['File_type'] ;
										$file_info=$file_info."-".$row['Professor']."教授";
										$get_url = "?f=" . $row['FileID'] . "&fn=$file_info" . "." . $row['File_type'] ;
										
										echo "<font size=3><a href='getfile.php" . $get_url . "'>$file_info</a><br><br></font>";
										/*
										if($row['Midterm_Final']!=9){
											if(!$row['Year'])
												echo "<font size=3><a href='/Dropbox/database/uploads/".$row['FileID']."'>年份未知-".$a."-第".$row['Midterm_Final']."次期中考</a><br><br></font>";
											else
												echo "<font size=3><a href='/Dropbox/database/uploads/".$row['FileID']."'>".$row['Year']."年-".$a."-第".$row['Midterm_Final']."次期中考</a><br><br></font>";
										}
										else{
											if(!$row['Year'])
												echo "<font size=3><a href='/Dropbox/database/uploads/".$row['FileID']."'>年份未知-".$a."-期末考</a><br><br></font>";
											else
												echo "<font size=3><a href='/Dropbox/database/uploads/".$row['FileID']."'>".$row['Year']."年-".$a."-期末考</a><br><br></font>";
										}*/
										//$temp++;
									}
									$result = $dbh->prepare("SELECT DISTINCT FileID,Midterm_Final,Year,File_type,file_info.Professor FROM course_info,file_info WHERE Subject_name='$a' AND Department_name='$b' AND School_name='$c' AND CoureseID=Course_id AND Midterm_Final=0 ORDER BY Midterm_Final,Year") ;
									$result->execute() ;
									//$temp=0;
									//echo "<form action='products.php' method='get'>";
									while ($row = $result->fetch()) {
										$file_info = NULL ;
										
										$file_info = $a ;
										$file_info = $file_info . ("-期末考") ;
										if(!$row['Year']||$row['Year']=="0000")
										{
											$file_info = $file_info ."-年份未知-" ;
										}
										else
										{
											$file_info = $file_info ."-".$row['Year']."年-" ;
										}
										//$file_type = $row['File_type'] ;
										$file_info=$file_info."-".$row['Professor']."教授";
										$get_url = "?f=" . $row['FileID'] . "&fn=$file_info" . "." . $row['File_type'] ;
										
										echo "<font size=3><a href='getfile.php" . $get_url . "'>$file_info</a><br><br></font>";
										/*
										if($row['Midterm_Final']!=9){
											if(!$row['Year'])
												echo "<font size=3><a href='/Dropbox/database/uploads/".$row['FileID']."'>年份未知-".$a."-第".$row['Midterm_Final']."次期中考</a><br><br></font>";
											else
												echo "<font size=3><a href='/Dropbox/database/uploads/".$row['FileID']."'>".$row['Year']."年-".$a."-第".$row['Midterm_Final']."次期中考</a><br><br></font>";
										}
										else{
											if(!$row['Year'])
												echo "<font size=3><a href='/Dropbox/database/uploads/".$row['FileID']."'>年份未知-".$a."-期末考</a><br><br></font>";
											else
												echo "<font size=3><a href='/Dropbox/database/uploads/".$row['FileID']."'>".$row['Year']."年-".$a."-期末考</a><br><br></font>";
										}*/
										//$temp++;
									}
									$dbh = NULL ;
									
								}
								catch( PDOException $e ){
									die( $e->getMessage() );
								}
								
							//}//$j++;
						//}
						echo "</form>";
					}					
					else if(isset($_GET['Depok']))
					{	
						echo"<h3><font color='BLUE'>請選擇科目：<br></font></h3>";
						//$j=0;
						//while($j<1000)
						//{
							//if(isset($_GET['schoolok']))
							//{
							echo "<h4><font color='#00B000'>".$_GET['schoolok']."-".$_GET['Depok']."：</font><br></h4>";
								try{				
									$a=$_GET['Depok'];
									$b=$_GET['schoolok'];
									//echo $a;
									$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
									//$dbh->exec("SET SET NAMES UTF8 ") ;
									$result = $dbh->prepare("SELECT DISTINCT Subject_name FROM course_info WHERE Department_name='$a' AND School_name='$b' AND Grade=1 ORDER BY Semester,Subject_name") ;
									$result->execute() ;
									$temp=0;
									echo "<form action='products.php' method='get'> 一年級：<br>";
									echo "<input type='hidden' name='schoolok' value='$b'>";
									echo "<input type='hidden' name='Depok' value='$a'>";
									while ($row = $result->fetch()) {
										echo "<input type='submit' name='Subok' value=".$row['Subject_name']." style='width:190px;height:30px;'/>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										$temp++;
										if($temp==3)
										{
										echo"<br><br>";
										$temp=0;
										}
									}
									if($temp!=0){
									echo "<br><br>";
									}
									$result = $dbh->prepare("SELECT DISTINCT Subject_name FROM course_info WHERE Department_name='$a' AND Grade=2 ORDER BY Semester,Subject_name") ;
									$result->execute() ;
									$temp=0;
									echo "二年級：<br>";
									while ($row = $result->fetch()) {
										echo "<input type='submit' name='Subok' value=".$row['Subject_name']." style='width:190px;height:30px;'/>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										$temp++;
										if($temp==3)
										{
										echo"<br><br>";
										$temp=0;
										}
									}
									if($temp!=0){
									echo "<br><br>";
									}
									$result = $dbh->prepare("SELECT DISTINCT Subject_name FROM course_info WHERE Department_name='$a' AND Grade=3 ORDER BY Semester,Subject_name") ;
									$result->execute() ;
									$temp=0;
									echo "三年級：<br>";
									while ($row = $result->fetch()) {
										echo "<input type='submit' name='Subok' value=".$row['Subject_name']." style='width:190px;height:30px;'/>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										$temp++;
										if($temp==3)
										{
										echo"<br><br>";
										$temp=0;
										}
									}
									if($temp!=0){
									echo "<br><br>";
									}
									$result = $dbh->prepare("SELECT DISTINCT Subject_name FROM course_info WHERE Department_name='$a' AND Grade=4 ORDER BY Semester,Subject_name") ;
									$result->execute() ;
									$temp=0;
									echo "四年級：<br>";
									while ($row = $result->fetch()) {
										echo "<input type='submit' name='Subok' value=".$row['Subject_name']." style='width:190px;height:30px;'/>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										$temp++;
										if($temp==3)
										{
										echo"<br><br>";
										$temp=0;
										}
									}
									if($temp!=0){
									echo "<br><br>";
									}
									$result = $dbh->prepare("SELECT DISTINCT Subject_name FROM course_info WHERE Department_name='$a' AND Grade=0 ORDER BY Semester,Subject_name") ;
									$result->execute() ;
									$temp=0;
									$row = $result->fetch();
									if(isset($row['Subject_name']))
									{
									echo "不分年級：<br>";
									do{
										echo "<input type='submit' name='Subok' value=".$row['Subject_name']." style='width:190px;height:30px;'/>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										$temp++;
										if($temp==3)
										{
										echo"<br><br>";
										$temp=0;
										}
									}while ($row = $result->fetch()) ;}
									$dbh = NULL ;
									
								}
								catch( PDOException $e ){
									die( $e->getMessage() );
								}
								
							//}//$j++;
						//}
						echo "</form>";
					}
					else if(isset($_GET['schoolok']))
					{	
						echo"<h3><font color='BLUE'>請選擇科系：<br></font></h3>";
						//$j=0;
						//while($j<1000)
						//{
							//if(isset($_GET['schoolok']))
							//{
							echo "<h4><font color='#00B000'>".$_GET['schoolok']."：</font><br></h4>";
								try{				
									$a=$_GET['schoolok'];
									//echo $a;
									$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
									//$dbh->exec("SET SET NAMES UTF8 ") ;
									$result = $dbh->prepare("SELECT DISTINCT Department_name,College FROM course_info WHERE School_name='$a' ORDER BY Department_name") ;
									$result->execute() ;
									//$temp=0;
									echo "<form action='products.php' method='get'>";
									echo "<input type='hidden' name='schoolok' value='$a'>";
									$temp=0;
									$Col='沒有';
									while ($row = $result->fetch()) {
										if($row['College']!=$Col)
										{	
											if($temp!=0)
											echo "<br><br>";
											
											if($Col=='沒有')
												echo $row['College'].":<br>";
											else
												echo $row['College'].":<br>";
											$Col=$row['College'];
											$temp=0;
										}
										echo "<input type='submit' name='Depok' value=".$row['Department_name']." style='width:125px;height:30px;' />&nbsp;&nbsp;";
										$temp++;
										if($temp==5)
										{
										echo"<br><br>";
										$temp=0;
										}
									}
									$dbh = NULL ;
									
								}
								catch( PDOException $e ){
									die( $e->getMessage() );
								}
								
							//}//$j++;
						//}
						echo "</form>";
					}					
					else
					{
						echo"<h3><font color='BLUE'>請選擇學校：</font><br></h3>";
						try{
							$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
							//$dbh->exec("SET SET NAMES UTF8 ") ;
							$result = $dbh->prepare("SELECT DISTINCT Sname,Position FROM course_info RIGHT OUTER JOIN sname_abbr ON School_name=Sname ORDER BY Position") ;
							$result->execute() ;
							//$temp=0;
							$pos='沒有';
							echo "<form action='products.php' method='get'>";
							$temp=0;
							while ($row = $result->fetch()) {
								if($row['Position']!=$pos)
									{		
											if($temp!=0)
											echo "<br><br>";
									
											if($pos=='沒有')
												echo "台北新北：<br>";
											else if($pos==1)
												echo "桃竹苗:<br>";
											else if($pos==2)
												echo "中彰投:<br>";
											else if($pos==3)
												echo "雲嘉南:<br>";
											else if($pos==4)
												echo "高屏離島:<br>";
											else if($pos==5)
												echo "基宜花東:<br>";
												
											$pos=$row['Position'];
											//echo "$pos";
											$temp=0;
									}
								echo "<input type='submit' name='schoolok' value=".$row['Sname']." style='width:150px;height:30px;' />&nbsp;&nbsp;";
								$temp++;
								if($temp==4)
								{
								echo"<br><br>";
								$temp=0;
								}								//$temp++;
							}
							$dbh = NULL ;
							//echo "<input type='submit' name='schoolok' value='確認'></form>";
							echo "</form>";
						}
						catch( PDOException $e ){
							die( $e->getMessage() );
						}
					}
				}
				else
				{
					echo "<div style='letter-spacing:10px' >
	                    <H1><br>請先登入，才能下載考古題唷!</H1>
	                    </div>" ;
				}
			?>
		<!--	<h1> Products</h1>
			<div class="product_box">
				<h3>Ut eu feugiat</h3>
				<a href="productdetail.html"><img src="images/product/01.jpg" alt="Shoes 1" /></a>
				<p> Fusce in dui et neque malesuada tincidunt nec at urna. Validate <a href="http://validator.w3.org/check?uri=referer" rel="nofollow">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer" rel="nofollow">CSS</a>.</p>
			  <p class="product_price">$ 100</p>
				<a href="shoppingcart.html" class="addtocart"></a>
				<a href="productdetail.html" class="detail"></a>
			</div>        	
			<div class="product_box">
				<h3>Curabitur et turpis</h3>
				<a href="productdetail.html"><img src="images/product/02.jpg" alt="Shoes 2" /></a>
				<p>Etiam et sapien ut nunc blandit euismod. Sed dui libero, semper a volutpat sed, placerat eu lectus.</p>
			<p class="product_price">$ 80</p>
				<a href="shoppingcart.html" class="addtocart"></a>
				<a href="productdetail.html" class="detail"></a>
			</div>        	
			<div class="product_box no_margin_right">
				<h3>Mauris consectetur</h3>
				<a href="productdetail.html"><img src="images/product/03.jpg" alt="Shoes 3" /></a>
				<p>Curabitur pellentesque ullamcorper massa ac ultricies. Maecenas porttitor erat quis leo pellentesque.</p>
			  <p class="product_price">$ 60</p>
				<a href="shoppingcart.html" class="addtocart"></a>
				<a href="productdetail.html" class="detail"></a>
			</div>     
			
			<div class="cleaner"></div>
				
			<div class="product_box">
				<h3>Proin volutpat</h3>
				<a href="productdetail.html"><img src="images/product/04.jpg" alt="Shoes 4" /></a>
				<p>Morbi non risus vitae est vestibulum tincidunt ac eget metus. Sed congue, erat id congue vehicula.</p>
			  <p class="product_price">$ 260</p>
				<a href="shoppingcart.html" class="addtocart"></a>
				<a href="productdetail.html" class="detail"></a>
			</div>        	
			<div class="product_box">
				<h3>Aenean tempus</h3>
				<a href="productdetail.html"><img src="images/product/05.jpg" alt="Shoes 5" /></a>
				<p>Aenean eu elit arcu. Quisque eget blandit erat. Integer molestie malesuada augue vitae mollis.</p>
			<p class="product_price">$ 80</p>
				<a href="shoppingcart.html" class="addtocart"></a>
				<a href="productdetail.html" class="detail"></a>
			</div>        	
			<div class="product_box no_margin_right">
				<h3>Nulla luctus urna</h3>
				<a href="productdetail.html"><img src="images/product/06.jpg" alt="Shoes 6" /></a>
				<p>Nunc nisl nisi, aliquet eu gravida vitae, porta vel ante. Pellentesque faucibus risus et sem volutpat.</p>
			  <p class="product_price">$ 190</p>
				<a href="shoppingcart.html" class="addtocart"></a>
				<a href="productdetail.html" class="detail"></a>
			</div>   
			
			<div class="cleaner"></div>
					
			<div class="product_box">
				<h3>Pellentesque egestas</h3>
				<a href="productdetail.html"><img src="images/product/07.jpg" alt="Shoes 7" /></a>
				<p>Aenean eu elit arcu. Quisque eget blandit erat. Integer molestie malesuada augue vitae mollis.</p>
			  <p class="product_price">$ 30</p>
				<a href="shoppingcart.html" class="addtocart"></a>
				<a href="productdetail.html" class="detail"></a>
			</div>        	
			<div class="product_box">
				<h3>Suspendisse porttitor</h3>
				<a href="productdetail.html"><img src="images/product/08.jpg" alt="Shoes 8" /></a>
				<p>Nulla rutrum neque vitae erat condimentum eget malesuada neque molestie. Nunc a leo tellus.</p>
			<p class="product_price">$ 220</p>
				<a href="shoppingcart.html" class="addtocart"></a>
				<a href="productdetail.html" class="detail"></a>
			</div>        	
			<div class="product_box no_margin_right">
				 <h3>Nam vehicula</h3>
				<a href="productdetail.html"><img src="images/product/09.jpg" alt="Shoes 9" /></a>
				<p>Vivamus accumsan luctus interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
			  <p class="product_price">$ 65</p>
				<a href="shoppingcart.html" class="addtocart"></a>
				<a href="productdetail.html" class="detail"></a>
			</div>  -->
		</div> 
		<div class="cleaner"></div>
	</div> <!-- END of templatemo_main -->
	
	<div id="templatemo_footer">
		<p><a href="index">首頁</a> | <a href="#">下載考古題</a> | <a href="upload.php">上傳檔案</a> | <a href="account_info.php">會員資料</a> | 
		   <a href="newaccount.php">加入會員</a> | <a href="contact.php">聯絡我們</a>
		</p>

		 Copyright © 2014 <a href="#">NCKU ES104 DataBase</a> | 
		 <a rel="nofollow" href="#">Retired-Test Collection System</a> by <a href="#" rel="nofollow" target="_parent" title="free css templates">Database Team4</a>
	</div> <!-- END of templatemo_footer -->
	
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>