<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?


	include_once("soaa_reg_proc_include.php");


	if($reg_no == "" || $_SESSION["id"] == "" ){
?>
	<script>
		alert("올바르지 못한 접근입니다.");
		history.back(-1);
	</script>
<? }

//	if($c_ceo_nm == "" || $c_corp_nm == "" || $outdoor_real_addr == ""){
//		echo "
//				<script>
//					alert(\"성명 또는 업소명 또는 표시위치는 입력되어야 합니다.\");
//					history.back(-1);
//				</script>
//			";
//	}

	//신청자이름, 신청자업소명, 표시위치
	if($c_ceo_nm <> "" || $c_corp_nm <> "" || $outdoor_real_addr <> ""){

		$rs_reg_chk = 	fn_update(
		"reg_date='$reg_date', c_ceo_nm='$c_ceo_nm', c_rrn1='$c_rrn1', c_corp_nm='$c_corp_nm', c_jibun1='$c_jibun1', c_jibun2='$c_jibun2', c_addr='$c_addr', 
		c_tel='$c_tel', outdoor_act_cate='$outdoor_act_cate', use_item='$use_item', chk_pay='$check_pay', outdoor_act_type='$outdoor_act_type',
		gu_office='$gu_office',outdoor_act_type_gubun='$outdoor_act_type_gubun',
		outdoor_real_jibun1='$outdoor_real_jibun1',outdoor_real_jibun2='$outdoor_real_jibun2',outdoor_real_addr='$outdoor_real_addr',
		outdoor_size0='$outdoor_size0', outdoor_size1='$outdoor_size1', outdoor_size2='$outdoor_size2', outdoor_size3='$outdoor_size3',
		outdoor_size4='$outdoor_size4',outdoor_size5='$outdoor_size5',outdoor_size6='$outdoor_size6',outdoor_size7='$outdoor_size7',outdoor_sizeH0='$outdoor_sizeH0',
		s_ceo_nm='$s_ceo_nm', s_biz_no='$s_biz_no', s_corp_nm='$s_corp_nm',
		s_jibun1='$s_jibun1', s_jibun2='$s_jibun2', s_addr='$s_addr',
		report_certi='$report_certi',payment_state='$payment_state',
		memo1='$memo1', insert_date=now(), insert_id='$insert_id'"

		,"soaa_reg_check",
		"reg_no='$reg_no'"
		);
	}

//	$soaa_reg_delete = fn_delete("soaa_reg", "insert_id is null");
//	$soaa_reg_check_delete = fn_delete("soaa_reg_check", "insert_id is null");
	
	if($rs_reg_chk > 0){
?>
	<script>
		alert("저장 되었습니다.");
		location.href="/safeChk_Mng/soaa_reg.php";
	</script>
<? } ?>