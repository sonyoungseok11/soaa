<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?
	if($_POST["code"] == "" || $_POST["en_nm"] == "" || $_POST["actions"] == ""){
?>
	<script>
		alert("올바르지 못한 접근입니다.");
		history.back(-1);
	</script>
<? }
	$code		= $_POST["code"];
	$en_nm		= $_POST["en_nm"];
	$actions	= $_POST["actions"];
	$ko_nm		= $_POST["ko_nm"];

	$today = date("Y") . "-" . date("m") . "-" . date("d");

	switch($code){
		case "01":	
			$url = "outdoor_act_cate";	
			$title_nm = "광고물종류";	break;
		case "05":	
			$url = "outdoor_act_type";	
			$title_nm = "광고물형식";	break;
		case "10":	
			$url = "gu_office";
			$title_nm = "구청";		break;
		case "15":	
			$url = "inspector";	
			$title_nm = "검사원";	break;
		case "20":	
			$url = "position";
			$title_nm = "직위";	break;
		case "30":	
			$url = "chk_result";
			$title_nm = "검사결과";	break;
		case "35":	
			$url = "chk_paytype";
			$title_nm = "검사료납부";	break;
		case "40":	
			$url = "report_certi";
			$title_nm = "필증교부";		break;
		case "45":	
			$url = "insert_paytype";
			$title_nm = "입금방법";	break;
		case "50":	
			$url = "outdoor_nre_type";
			$title_nm = "광고물구분";	break;
	}

	if($actions == "insert"){
		$rs = fn_insert("code, en_nm, ko_nm, title_nm, url, insert_date, update_date",
						"'$code', '$en_nm', '$ko_nm', '$title_nm', '$url', '$today', '$today'",
						"common_selectbox");
	}else{
		$rs = fn_update("ko_nm='$ko_nm', update_date='$today'", "common_selectbox", "code='$code' and en_nm='$en_nm'");
	}
	if($rs == 1){
?>
	<script>
	alert("정상 수정 되었습니다.");
	location.href="confi_update.php?code=<?=$code?>&en_nm=<?=$en_nm?>";
	</script>
<? }else{	?>
	<script>
	alert("수정된 내용이 없습니다.");
	location.href="confi_update.php?code=<?=$code?>&en_nm=<?=$en_nm?>";
	</script>
<?	}	?>