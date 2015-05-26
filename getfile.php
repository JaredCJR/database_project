<?php
session_start() ;
include ("php/database_info.php") ;
if((isset($_GET['f']))&&(isset($_GET['fn']))){

	$file = $_GET['f'] ;//檔案名稱
	$url = "uploads/" ; //路徑位置
	$total_url = $url.$file ;
	$user=$_SESSION["ID"];
	if (glob($total_url)) {
		$filename = $_GET['fn'] ;
		header("Content-type:application");
		header("Content-Disposition: attachment; filename=".$filename);	
		readfile($url.str_replace("@","",$file));	
		$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWD , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
		$downlog=$dbh->prepare("INSERT download_log(Name,Downloader) VALUES ('$file','$user')");
		$downlog->execute();
		$fileDt=$dbh->prepare("UPDATE file_info SET Download_times=Download_times+1 WHERE FileID='$file'");
		$fileDt->execute();
		exit(0);
		
	}
	else
	{
		echo "找不到相關檔案....";
	}
	
	/*
	$url="uploads/"; //路徑位置
	$num=date("Ymds");	
	header("Content-type:application");
	header("Content-Disposition: attachment; filename="."高功率 LED 散熱分析.pdf");	
	readfile($url.str_replace("@","",$file));	
	exit(0);*/
	//$QQ = glob($QAQ) ;
	//print_r($QQ);
}else{
	echo "找不到相關檔案....";
}
?>