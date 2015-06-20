<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<?
$ID			=	$_POST["id"];
$PASSWORD	=	$_POST["password"] . "!!";
$PASSWORD = MD5($PASSWORD);

//$PASSWORD	=	MD5($PASSWORD);

$WHERE = " ID='$ID' AND PASSWORD='$PASSWORD'";
$query = "SELECT id, name, level FROM g5_membership where " . $WHERE;

$result = mysql_query($query, $conn);
$rs = mysql_fetch_array($result);

if ($rs["level"] === "05"){
	$_SESSION["id"]	=	$rs["id"];
	$_SESSION["name"]	=	$rs["name"];
?>
	<script type="text/javascript">
		location.href="/index.php";
	</script>
<?
}

if ($rs["level"] === "00")
{
	//echo "<script>window.location.replace('/admin/index.php?id=$rs[id]&name=$rs[name]');</script>";
	$_SESSION["id"]	=	$rs["id"];
	$_SESSION["name"]	=	$rs["name"];


	//접속 기록을 살펴보고 최초 접속자이면
	//전일 접수하려다가 실패한-접수번호만 생성되고 나머지는 빈값인 모든 데이터
	//데이터 일괄 삭제 후 페이지 이동 S
	$vi_year = date("Y");
	$vi_month = date("m");
	$vi_day = date("d");
	
	$conn_rs = fn_select_cnt("*", "g5_visit", "vi_year='$vi_year' and vi_month='$vi_month' and vi_day='$vi_day'");

	if(!$conn_rs){
		$reg_del	=	fn_delete("soaa_reg", "insert_id is null and insert_date is null");
		$reg_chk_del	=	fn_delete("soaa_reg_check", "insert_id is null and insert_date is null");
	}
	//E

	echo "<script>window.location.replace('/safeChk_Mng/soaa_list.php');</script>";
}else
{
?>
	<script type="text/javascript">
		alert("일치하는 고객정보가 없습니다.\n 아이디와 비밀번호 확인 후 다시 시도해 주십시요.");
		history.back(-1);
	</script>
<?
}
?>