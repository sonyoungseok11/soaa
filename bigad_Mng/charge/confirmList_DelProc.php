<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html" charset="utf-8">

<?

	$idx		=	$_GET['reg_no'];
	$page_no	=	$_GET['page_no'];
		
	if(!$idx){
		echo "
				<script>
					alert(\"정상적인 접근이 아닙니다.\");
					history.back(-1);
				</script>
			";
	}

	$rs = fn_delete("confirm_list", "idx='$idx'");

	if($rs > 0){
?>
<script>
	alert("데이터가 정상 삭제 되었습니다.");
	location.href="confirm_list.php?page=" + '<?=$page_no?>';
</script>
<?
	}
?>