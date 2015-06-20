<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html" charset="utf-8">

<?

	$reg_no		=	$_GET['reg_no'];
	$page_no	=	$_GET['page_no'];
	$idx	=	$_GET['idx'];


//	echo "reg_no=" . $reg_no . "<br>";
//	echo "idx=" . $idx . "<br>";
//	exit;

	if(!$reg_no || !$idx){
		echo "
				<script>
					alert(\"정상적인 접근이 아닙니다.\");
					history.back(-1);
				</script>
			";
	}
	
	//미확인리스트의 데이터를 확인리스트에 추가하기 위해 선택한 데이터 가져옴.
	$noCon	=	fn_select_fetch_array("*", "no_confirm_list", "idx='$idx'");

	//확인 리스트의 최신 idx 한개 가져옴.
	$ConOrder	=	fn_select_fetch_array("idx", "confirm_list", " idx <> ''  order by idx desc limit 1");
	if($ConOrder['idx'] <> ""){
		$Insert_idx = $ConOrder['idx'] +1;
	}else{
		$Insert_idx = 1;
	}


	//안전점검 접수현황에서 reg_no 의 금액만 변경
	$reg_check_update	=	fn_update("chk_pay='" . $noCon['chk_pay'] . "'",
							"soaa_reg_check",
							"reg_no='$reg_no'");


	if($reg_check_update > 0){
	//확인 리스트에 데이터 추가.
		$Con	=	fn_insert("idx, c_ceo_nm, c_corp_nm, gu_office, c_tel, 
								chk_pay, input_pay_type, input_date, matching_yn,
								insert_id, insert_date", 

							"'$Insert_idx','".$noCon['c_ceo_nm']."','".$noCon['c_corp_nm']."','".$noCon['gu_office']."','".$noCon['c_tel']."',
								'".$noCon['chk_pay']."','".$noCon['input_pay_type']."','".$noCon['input_date']."','Y',
								'".$_SESSION['id']."', now()", 
										"confirm_list");
	}

	if($Con > 0){
	//확인 리스트에 추가 되었으면 미확인 리스트에서 데이터 삭제.
		$noConfirmDel_Rs	= fn_delete("no_confirm_list", "idx='$idx'");
	}


	if($noConfirmDel_Rs > 0){
?>
		<script>
			alert("데이터가 확인 리스트로 이동 되었습니다.");
			window.close();
			opener.parent.location.reload();
			//location.href="no_confirm_list.php?page=" + '<?=$page_no?>';
		</script>
<?
	}
?>