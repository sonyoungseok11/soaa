<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?
	$chkbox = $_POST["chkbox"];
	$chkbox_cnt = count($chkbox);

	$real_chkday		=	$_POST["real_chkday"];	//검사일자
	$chk_personA		=	$_POST["batch_chk_personA"];	//검사자A
	$chk_personB		=	$_POST["batch_chk_personB"];	//검사자B
	$chk_p_positionA	=	$_POST["batch_chk_p_positionA"];	//검사자A직급
	$chk_p_positionB	=	$_POST["batch_chk_p_positionB"];	//검사자B직급
	$chk_result			=	$_POST["batch_chk_result"];		//검사결과

	for($i=0; $i<$chkbox_cnt; $i++){
		$reg_no[$i]	=	$chkbox[$i];
		$rs = fn_update("real_chkday='$real_chkday', 
							chk_personA='$chk_personA', 
							chk_personB='$chk_personB',
							chk_p_positionA='$chk_p_positionA', 
							chk_p_positionB='$chk_p_positionB',  
							chk_result='$chk_result', 
							insert_date=now(), 
							insert_id='" .$_SESSION["id"] ."'", 

						"soaa_reg_check", 
						"reg_no='" . $reg_no[$i] ."' ");
	}
	
	if($rs == 1){
?>
	<script>
		alert("정상 적용 되었습니다");
		location.href="./soaa_list.php";
	</script>
<? }