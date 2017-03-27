<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_new = "localhost";
$database_new = "income_tax";
$username_new = "root";
$password_new = "root";
$new = mysql_pconnect($hostname_new, $username_new, $password_new) or trigger_error(mysql_error(),E_USER_ERROR); 
?>