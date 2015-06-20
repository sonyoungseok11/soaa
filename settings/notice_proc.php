<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?
	$title		=	$_POST["title"];
	$content	=	$_POST["content"];
	$actions	=	$_POST["actions"];
	$idx		=	$_POST["idx"];
	$idx_sub		=	$_POST["idx_sub"];
	
	$insert_id = $_SESSION["id"];

	if($actions == "insert"){
		// tbl menu 항목을 그대로 가져와서 사용하므로 insert 는 되면 안됨.
	}else{
		$rs = fn_update("title='$title', content='$content', insert_date=now(), update_date=now(), insert_id='$insert_id'"
						, "notice"
						, "idx='$idx' and idx_sub='$idx_sub'");
	}

	if($rs == 1){
?>
	<script>
	alert("저장 되었습니다.");
	location.href="notice_list.php?idx=<?=$idx?>";
	</script>
<?  }else{ ?>
	<script>
	alert("수정 사항이 없습니다.");
	location.href="notice_list.php?idx=<?=$idx?>";
	</script>
<? } ?>