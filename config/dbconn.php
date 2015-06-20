<?

//$ip	=	$_SERVER['REMOTE_ADDR'];

//Doksan Office 118.36.151.10
//boss before 98.18.115.30
//boss after 98.18.17.31
//boss output ip 211.253.60.34
//Boss House 221.147.218.140
//Osan HOme 39.117.195.152
session_cache_limiter('no-cache, must-revalidate');	
session_start();

$db_host = "localhost"; 
$db_user = "soaa"; 
$db_passwd = "2013";
$db_name = "soaa"; 
$conn = mysql_connect($db_host,$db_user,$db_passwd);
mysql_select_db($db_name);

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

include ("util.php");

?>