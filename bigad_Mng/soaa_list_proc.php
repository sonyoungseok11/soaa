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
	$manual_insert		=	$_POST["chkContent"];		//특이사항여부(manual_insert 는 디비필드명임)

	include("./soaa_bigad_PrintPage_include.php");


	for($i=0; $i<$chkbox_cnt; $i++){
		$reg_no[$i]	=	$chkbox[$i];

		//안전점검 접수 업데이트
//		$rs_SoaaRegCheck = fn_update("real_chkday='$real_chkday', 
//							chk_personA='$chk_personA', 
//							chk_personB='$chk_personB',
//							chk_p_positionA='$chk_p_positionA', 
//							chk_p_positionB='$chk_p_positionB',  
//							chk_result='$chk_result', 
//							insert_date=now(), 
//							insert_id='" .$_SESSION["id"] ."'", 
//
//						"bigad_SoaaRegCheck", 
//						"reg_no='" . $reg_no[$i] ."' ");

		//대형옥외물 점검표 업데이트
		$rs_return	=	fn_select_fetch_array("reg_no", "bigad_PrintPage", "reg_no='$reg_no[$i]'");
		$rs_outdoorActCate = fn_select_fetch_array("outdoor_act_cate", "bigad_SoaaRegCheck", "reg_no='$reg_no[$i]'");

		include("./bigad_soaaList_switchCase.php");

		if($rs_return['reg_no']){
			$rs_SoaaRegCheck = fn_update("
					manual_insert		='$manual_insert',

					one_one_result		='$one_one_result',
					one_one_etc			='$one_one_etc',
					one_two_result		='$one_two_result',
					one_two_etc			='$one_two_etc',
					one_three_result	='$one_three_result',
					one_three_etc		='$one_three_etc',

					two_one_result		='$two_one_result',
					two_one_etc			='$two_one_etc',
					two_two_result		='$two_two_result',
					two_two_etc			='$two_two_etc',
					two_three_result	='$two_three_result',
					two_three_etc		='$two_three_etc',
					two_four_result		='$two_four_result',
					two_four_etc		='$two_four_etc',

					three_one_result	='$three_one_result',
					three_one_etc		='$three_one_etc',
					three_two_result	='$three_two_result',
					three_two_etc		='$three_two_etc',
					three_three_result	='$three_three_result',
					three_three_etc		='$three_three_etc',
					three_four_result	='$three_four_result',
					three_four_etc		='$three_four_etc',
					three_five_result	='$three_five_result',
					three_five_etc		='$three_five_etc',
					three_six_result	='$three_six_result',
					three_six_etc		='$three_six_etc',
					three_seven_result	='$three_seven_result',
					three_seven_etc		='$three_seven_etc',

					four_one_result		='$four_one_result',
					four_one_etc		='$four_one_etc',
					four_two_result		='$four_two_result',
					four_two_etc		='$four_two_etc',

					five_one_result		='$five_one_result',
					five_one_etc		='$five_one_etc',
					five_two_result		='$five_two_result',
					five_two_etc		='$five_two_etc',
					five_three_result	='$five_three_result',
					five_three_etc		='$five_three_etc'

					", 

			"bigad_PrintPage", 
			"reg_no='" . $reg_no[$i] ."' ");
				
		}else{
			$rs_SoaaRegCheck = fn_insert("
											reg_no,
											manual_insert,
											one_one_result,		-- //필드명 시작<br>
											one_one_etc,			
											one_two_result,			
											one_two_etc,			
											one_three_result,		
											one_three_etc,			

											two_one_result,			
											two_one_etc,			
											two_two_result,			
											two_two_etc,			
											two_three_result,		
											two_three_etc,			
											two_four_result,		
											two_four_etc,	

											three_one_result,		
											three_one_etc,			
											three_two_result,		
											three_two_etc,			
											three_three_result,		
											three_three_etc,		
											three_four_result,		
											three_four_etc,			
											three_five_result,		
											three_five_etc,			
											three_six_result,		
											three_six_etc,			
											three_seven_result,		
											three_seven_etc,		

											four_one_result,		
											four_one_etc,			
											four_two_result,		
											four_two_etc,			

											five_one_result,		
											five_one_etc,			
											five_two_result,		
											five_two_etc,			
											five_three_result,		
											five_three_etc",
												
											"
											'$reg_no[$i]',		-- //데이터 시작<br>
											'$manual_insert',
											'$one_one_result',
											'$one_one_etc',			
											'$one_two_result',			
											'$one_two_etc',			
											'$one_three_result',		
											'$one_three_etc',			

											'$two_one_result',			
											'$two_one_etc',			
											'$two_two_result',			
											'$two_two_etc',			
											'$two_three_result',		
											'$two_three_etc',			
											'$two_four_result',		
											'$two_four_etc',


											'$three_one_result',		
											'$three_one_etc',			
											'$three_two_result',		
											'$three_two_etc',			
											'$three_three_result',		
											'$three_three_etc',		
											'$three_four_result',		
											'$three_four_etc',			
											'$three_five_result',		
											'$three_five_etc',			
											'$three_six_result',		
											'$three_six_etc',			
											'$three_seven_result',		
											'$three_seven_etc',		

											'$four_one_result',		
											'$four_one_etc',			
											'$four_two_result',		
											'$four_two_etc',			

											'$five_one_result',		
											'$five_one_etc',			
											'$five_two_result',		
											'$five_two_etc',			
											'$five_three_result',
											'$five_three_etc'",

											"bigad_PrintPage");
		}
	}

	if($rs_SoaaRegCheck == 1){

		echo "
			<script>
				alert(\"정상 적용 되었습니다\");
				location.href=\"./soaa_list.php\";
			</script>
			
			";
	}

?>