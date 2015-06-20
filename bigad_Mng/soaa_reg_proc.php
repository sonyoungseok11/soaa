<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?

	$chkContent		=	$_POST['chkContent'];		//특이사항(Radio 체크) 여부를 79라인 include 문에서 사용함.
	$manual_insert	=	$_POST['chkContent'];		//특이사항(Radio 체크) 여부를 

	include_once("soaa_reg_proc_include.php");


	if($reg_no == "" || $_SESSION["id"] == "" ){

	echo "
			<script>
				alert(\"올바르지 못한 접근입니다.\");
				history.back(-1);
			</script>
		 ";
	}

	//신청자이름, 신청자업소명, 표시위치
	if($c_ceo_nm <> "" || $c_corp_nm <> "" || $outdoor_real_addr <> ""){
		$rs_reg_chk = 	fn_update(
								"reg_date='$reg_date', 
								c_ceo_nm='$c_ceo_nm', 
								c_rrn1='$c_rrn1', 
								c_corp_nm='$c_corp_nm', 
								c_jibun1='$c_jibun1',
								c_jibun2='$c_jibun2', 
								c_addr='$c_addr', 
								c_tel='$c_tel',
								outdoor_act_cate='$outdoor_act_cate', 
								use_item='$use_item',
								chk_pay='$check_pay', 
								outdoor_act_type='$outdoor_act_type',
								gu_office='$gu_office',
								outdoor_act_type_gubun='$outdoor_act_type_gubun',
								outdoor_real_jibun1='$outdoor_real_jibun1',
								outdoor_real_jibun2='$outdoor_real_jibun2',
								outdoor_real_addr='$outdoor_real_addr',
								outdoor_size0='$outdoor_size0',
								outdoor_size1='$outdoor_size1',
								outdoor_size2='$outdoor_size2',
								outdoor_size3='$outdoor_size3',
								outdoor_size4='$outdoor_size4',
								outdoor_size5='$outdoor_size5',
								outdoor_size6='$outdoor_size6',
								outdoor_size7='$outdoor_size7',
								outdoor_sizeH0='$outdoor_sizeH0',
								s_ceo_nm='$s_ceo_nm',
								s_biz_no='$s_biz_no',
								s_corp_nm='$s_corp_nm',
								s_jibun1='$s_jibun1',
								s_jibun2='$s_jibun2',
								s_addr='$s_addr',
								report_certi='$report_certi',
								payment_state='$payment_state',
								memo1='$memo1', -- //<br>

								bigad_Grade='$bigad_Grade',
								bigad_PlacePic1='$bigad_PlacePic1',
								bigad_PlacePic2='$bigad_PlacePic2',
								bigad_OrderIndi1='$bigad_OrderIndi1',
								bigad_OrderIndi2='$bigad_OrderIndi2',
								bigad_OrderIndiPic1='$bigad_OrderIndiPic1',
								bigad_OrderIndiPic2='$bigad_OrderIndiPic2',

								insert_date=now(),
								insert_id='$insert_id'"

		,"bigad_SoaaRegCheck",
		"reg_no='$reg_no'"
		);

		//옥외광고물점검표 출력에 관한 내용을 수동으로 입력 하였을겨우 bigad_PrintPage 테이블로 데이터 추가함.
		include ("./bigad_switchCase.php");

		$rs_Prn	=	fn_insert(
				"
				reg_no,
				manual_insert,
				one_one_result, 
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
				'$reg_no',
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
				'$five_three_etc'
				",

				"bigad_PrintPage"
			);
	}
	
	if($rs_reg_chk > 0 ){
		echo "
				<script>
					alert(\"저장 되었습니다.\");
					location.href=\"/bigad_Mng/soaa_reg.php\";
				</script>
				";
	}else{
		echo "
				<script>
					alert(\"오류가 발생하였습니다..\");
					history.back(-1);
				</script>
			";
	}