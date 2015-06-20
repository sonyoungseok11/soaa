<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<?

//	$_SESSION["id"] = "";
//	$_SESSION["name"] = "";
//	$_SESSION["id"] = $_GET["id"];
//	ECHO "세션 삭제전 = ". $_SESSION["id"] . "<BR>";

//	unset($_SESSION["id"]); //ok
//	unset($_SESSION["name"]); //ok
	$_SESSION = array();	//ok

//	ECHO "세션 삭제후 = ". $_SESSION["id"] . "<BR>";
//	EXIT;
	if ($_SESSION["id"] == ""){
?>
	<script type="text/javascript">
		alert("로그아웃 되었습니다.");
		location.href="/";
		//location.replace("/index.php");
	</script>
<?
	}else{
		echo "세션 삭제 실패";
	}
?>