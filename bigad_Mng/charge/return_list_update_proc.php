<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html" charset="utf-8">

<?


	$idx = $_POST['idx'];


	if($reg_no){
		$rs = fn_select_fetch_array("idx", "return_list", "idx='$idx'");
	}

	if($rs['idx']){
		$idx						=	$rs['idx'];
		$input_payment_date			=	$_POST['input_payment_date'];
		$c_ceo_nm					=	$_POST['c_ceo_nm'];
		$rf_payment					= 	str_replace(",", "", $_POST['rf_payment']);
		$memo1						=	$_POST['memo1'];


		$return_rs	=	fn_update(" input_payment_date='$input_payment_date', 
									c_ceo_nm='$c_ceo_nm', 
									rf_payment='$rf_payment', 
									memo1='$memo1'", 

									"return_list", 

									"idx='$idx'");
	}else{
	echo
		"<script>;
			alert(\"잘못된 접근입니다.\");
			location.href = \"return_list.php\";
		</script>";
	}

	if($return_rs > 0){
?>
<script>
	alert("입력 사항이 반영 되었습니다.");
	location.href="return_list.php?idx=" + '<?=$idx?>';
</script>
<?
	}
?>