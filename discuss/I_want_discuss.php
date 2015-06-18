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

function no()
{
    alert("抱歉，尚未提供回饋服務。\n哈哈!") ;
    return false ;
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
                <li><a href="../account_info.php">會員資料</a></li>
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
        
        <div id="content" class="float_r">

		
            
            
            <?php
                echo "<h1 font>我要留言</h1>";
                            echo "<html>";
            echo "<select name=\"CoureseID\" onChange=\"location = this.options[this.selectedIndex].value;\">";
					

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
				$separater2 = $id['CoureseID'];
				echo "<option id=\"courseid\" value=".$separater2.">".$separater."</option>\n";
			}
//這邊設定table的id 讓javascript用>
			echo "</select>";
                        echo "</html>";
                }

			if(!isset($_POST['text']))
			echo"
                                            <br />
                <br />
        	
            <div class='content_half float_l'>
                <p>對考古題有任何問題或建議，歡迎留言。<br>標示<font color='red'>*</font>項為必填</p>
                <div id='contact_form'>
                   <form method='post' name='contact' action='../leave_msg.php'>
                        
                        <label for='author'>標題<font color='red'>*</font>:</label> <input type='text' id='author' name='author' class='required input_field' />
                        <div class='cleaner h10'></div>
        
                        <label for='text'>內容<font color='red'>*</font>:</label> <textarea id='text' name='text' rows='0' cols='0' class='required'></textarea>
                        <div class='cleaner h10'></div>
                        
                        <input type='submit' class='submit_btn' name='submit' id='submit' value='Send' />
                        
                    </form>
                </div>
            </div>
        <div class='content_half float_r'>
            
            <br />
            <br />
            <img src=\"1.jpg\"width=\"300\" height=\"400\">
            <br />
            
        <!--
        	<h5>Primary Office</h5>
			660-110 Quisque diam at ligula, <br />
			Etiam dictum lectus quis, 11220<br />
			Sed mattis mi at sapien<br /><br />
						
			Phone: 010-010-6600<br />
			Email: <a href='mailto:info@yourcompany.com'>info@yourcompany.com</a><br/>
			
            <div class='cleaner h40'></div>
			
            <h5>Secondary Office</h5>
			120-360 Cras ac nunc laoreet,<br />
			Nulla vitae leo ac dui, 10680<br />
			Cras id sem nulla<br /><br />
			
			Phone: 030-030-0220<br />
			Email: <a href='mailto:contact@yourcompany.com'>contact@yourcompany.com</a><br/>
			<br />
            Validate <a href='http://validator.w3.org/check?uri=referer' rel='nofollow'>XHTML</a> &amp; <a href='http://jigsaw.w3.org/css-validator/check/referer' rel='nofollow'>CSS</a>
        -->
        </div>";
		else
		{	//echo $_POST['author']." ".$_POST['email']." ".$_POST['phone']." ".$_POST['text'];
		if($_POST['author']==NULL||$tex=$_POST['text']==NULL)
		{
			if($_POST['author']==NULL)
			echo "<h2>您的Name尚末填寫哦!!<br></h2>";
			if($tex=$_POST['text']==NULL)
			echo "<h2>您沒有填入Message喲!!<br></h2>";
		}
		else
		{
			$aut=$_POST['author'];
			$ema=$_POST['email'];
			$pho=$_POST['phone'];
			$tex=$_POST['text'];
			if(isset($_SESSION["Account"]))
				$acc=$_SESSION["Account"];
			else
				$acc=NULL;
			$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
									//$dbh->exec("SET SET NAMES UTF8 ") ;
			$result = $dbh->prepare("INSERT INTO suggest(gName,gEmail,gPhone,Message,Account) VALUES ('$aut','$ema','$pho','$tex','$acc')") ;
			$result->execute() ;
			
			echo "<h1>感謝您的建議！</h1>";
		}
		}
		
        ?>
        <div class="cleaner h40"></div>
        
        <iframe width="680" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1836.3625294923654!2d120.22054561932995!3d22.997135652276295!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x64db60992a356423!2z5oiQ5Yqf5aSn5a245oiQ5Yqf5qCh5Y2A!5e0!3m2!1szh-TW!2stw!4v1399657874775"></iframe>

        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
        <p><a href="../index.php">首頁</a> | <a href="../products.php">全部分類</a> | <a href="../upload.php">上傳檔案</a> | <a href="../account_info.php">會員資料</a> | 
           <a href="../newaccount.php">加入會員</a> | <a href="contact.php">連絡我們</a>
        </p>

         Copyright © 2014 <a href="#">NCKU ES104 DataBase</a> | 
         <a rel="nofollow" href="#">Retired-Test Collection System</a> by <a href="#" rel="nofollow" target="_parent" title="free css templates">Database Team4</a>
    </div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>