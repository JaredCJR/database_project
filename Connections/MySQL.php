<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_MySQL = "localhost";
$database_MySQL = "mylittlepony";
$username_MySQL = "bigpony";
$password_MySQL = "pigpigpig";
$MySQL = mysql_pconnect($hostname_MySQL, $username_MySQL, $password_MySQL) or trigger_error(mysql_error(),E_USER_ERROR); 
?>