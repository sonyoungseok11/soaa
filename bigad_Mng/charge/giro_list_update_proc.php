<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html" charset="utf-8">

<?


	$tmp_idx = $_REQUEST['idx'];

	if($tmp_idx){
		$rs = fn_select_fetch_array("idx", "giro_list", "idx='$tmp_idx'");
	}

	if($rs['idx']){
		$idx			=	$_REQUEST['idx'];
		$input_date		=	$_REQUEST['input_date'];
		$input_pay_type	=	$_REQUEST['input_pay_type'];	//통장 혹은 지로 입금의 구분 방법 대기. 입금 입력에서 해결되어야 진행가능.
		$c_corp_nm		=	$_REQUEST['c_corp_nm'];
		$c_ceo_nm		=	$_REQUEST['c_ceo_nm'];
		$gu_office		=	$_REQUEST['gu_office'];

		$chk_pay		= 	str_replace(",", "", $_REQUEST['chk_pay']);

		$return_rs	=	fn_update("input_date='$input_date',
									input_pay_type='$input_pay_type',
									c_corp_nm='$c_corp_nm',
									c_ceo_nm='$c_ceo_nm',
									gu_office='$gu_office',
									chk_pay='$chk_pay'"
									
									,
									"giro_list",
									"idx='$idx'");
	}else{
	echo "<script>;
			alert(\"잘못된 접근입니다.\");
			location.href = \"giro_list.php\";
		</script>";
	}

	if($return_rs > 0){
?>
<script>
	alert("입력 사항이 반영 되었습니다.");
	location.href="giro_list.php?idx=" + '<?=$idx?>';
</script>
<?
	}
?>