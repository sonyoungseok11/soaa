<?

$ip	=	$_SERVER['REMOTE_ADDR'];

//Doksan Office 118.36.151.10
//boss before 98.18.115.30
//boss after 98.18.17.31
//boss output ip 211.253.60.34
//Boss House 221.147.218.140
//Osan HOme 39.117.195.152



if( ($_SERVER["REMOTE_ADDR"] == "211.253.60.34") || ($_SERVER["REMOTE_ADDR"] == "118.36.151.10") || ($_SERVER["REMOTE_ADDR"] == "39.117.195.152") || ($_SERVER["REMOTE_ADDR"] == "221.147.218.140")){
	
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
}else{
	echo "
		<script>
			alert(\"작업중입니다.\");
			history.back(-1);
		</script>
		";
}
?>