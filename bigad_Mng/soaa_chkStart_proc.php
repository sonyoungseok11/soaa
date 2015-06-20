<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?
//	$reg_no		=	$_POST['reg_no'];
//	$page		=	$_POST['page_no'];
//	$chk_result	=	$_POST['chk_result'];
//	$payment_state	=	$_POST['payment_state'];
//	$real_chkday	=	$_POST['real_chkday'];
//	$report_certi	=	$_POST['report_certi'];
//	$payment_in_day	=	$_POST['payment_in_day'];
//	$c_ceo_nm	=	$_POST['c_ceo_nm'];
//
//	// 금액 콤마 제거
//	$tmp_chk_pay	=	$_POST['check_pay'];
//	$chk_pay	=	str_change(",", "", $tmp_chk_pay);	//입금
//	$rf_payment	=	str_change(",", "", $tmp_chk_pay);	//환불

	include_once("soaa_reg_proc_include.php");

	//필증교부

	switch($payment_state){
		//입금
		case "PC":

     	   $PC_condition	=	"   c_ceo_nm			= '$c_ceo_nm',			-- //성명<br>
								c_rrn1				= '$c_rrn1',				-- //주민등록번호 앞6자리<br>
								c_corp_nm			= '$c_corp_nm',	-- //업소명<br>
								c_tel				= '$c_tel',				-- //전화번호<br>
								c_jibun1			= '$c_jibun1',	-- //주소지번1<br>
								c_jibun2			= '$c_jibun2',	-- //주소지번2<br>
								c_addr				= '$c_addr',		-- //신청자주소<br>
								outdoor_act_cate	= '$outdoor_act_cate',	-- //광고물종류<br>
								outdoor_act_type	= '$outdoor_act_type',		-- //광고물형식<br>
								outdoor_real_jibun1	= '$outdoor_real_jibun1',	-- //표시위치,장소<br>
								outdoor_real_jibun2	= '$outdoor_real_jibun2',	-- //표시위치,장소<br>
								outdoor_real_addr	= '$outdoor_real_addr',		-- //표시위치,장소<br>
								gu_office			= '$gu_office',		-- //해당구청<br>
								outdoor_size0		= '$outdoor_size0', -- //광고물규격<br>
								outdoor_size1		= '$outdoor_size1', -- //광고물규격<br>
								outdoor_size2		= '$outdoor_size2', -- //광고물규격<br>
								outdoor_size3		= '$outdoor_size3', -- //광고물규격<br>
								outdoor_size4		= '$outdoor_size4', -- //광고물규격<br>
								outdoor_size5		= '$outdoor_size5', -- //광고물규격<br>
								outdoor_size6		= '$outdoor_size6', -- //광고물규격<br>
								outdoor_size7		= '$outdoor_size7', -- //광고물규격<br>
								outdoor_sizeH0		= '$outdoor_sizeH0', -- //광고물높이<br>
								chk_personA			= '$chk_personA',		-- //검사자A<br>
								chk_personB			= '$chk_personB',		-- //검사자B<br>
								chk_result			= '$chk_result',			-- //검사결과<br>
								chk_pay				= '$check_pay',	-- //검사료<br>
								payment_state		= '$payment_state',	-- //검사료납부여부<br>
								real_chkday			= '$real_chkday',	-- //검사일<br>
								payment_in_day		= '$payment_in_day',	-- //검사료 납부일<br>
								report_certi		= '$report_certi',	-- //필증교부<br>

								s_ceo_nm			= '$s_ceo_nm',-- //시공업소대표자<br>
								s_biz_no			= '$s_biz_no', -- //사업자등록번호<br>
								s_corp_nm			= '$s_corp_nm',	-- //업소명<br>
								s_jibun1			= '$s_jibun1',	-- //주소1<br>
								s_jibun2			= '$s_jibun2',	-- //주소2<br>
								s_addr				= '$s_addr',		-- //주소전체<br>
								memo1				= '$memo1',	-- //검사의견<br>
								etc_memo			= '$etc_memo'	-- //기타사항<br>
							";
			$tbl		=	"bigad_SoaaRegCheck";
			$where		=	"reg_no='$reg_no'";

			break;
		//환불
		case "RF":

			$rs = fn_select_fetch_array("idx", "return_list", "idx <> '' order by idx desc");
			if($rs['idx'] > 0){
				$idx = $rs['idx'] +1;
			}else{
				$idx = 1;
			}
			$bigad_SoaaRegCheck_rs	=	fn_select_fetch_array("a.chk_pay, a.payment_in_day",
															"bigad_SoaaRegCheck a left join return_list b on a.reg_no=b.reg_no",
														"a.reg_no='" . $reg_no . "'"
														);
			//bigad_SoaaRegCheck 에서 입금금액을 받아서 return_list 에 추가함.
			$chk_pay			=	$bigad_SoaaRegCheck_rs['chk_pay'];
//			$input_payment_date	=	$bigad_SoaaRegCheck_rs['payment_in_day'];

			$RF_condition	.=	" idx, 
									reg_no, 
									c_ceo_nm, 
									c_corp_nm, 
									gu_office, 
									chk_pay, 
									rf_payment, 
									input_pay_type, 
									confirm_yn, 
									real_chkday, 
									input_payment_date,
									insert_id,
									insert_date
								";

			$RF_condition1	=	" '$idx', 
									'$reg_no', 
									'$c_ceo_nm',
									'$c_corp_nm',
									'$gu_office',
									'$chk_pay',
									'$rf_payment',
									'$input_pay_type',
									'$confirm_yn',
									'$real_chkday',
									'$input_payment_date',
									'" . $_SESSION['id'] . "',
									now()
								";
			$tbl		=	"return_list";
			break;
	}

	//옥외광고물 점검표 값이 있으면 21번줄 soaa_reg_proc_include 에서 받아오고 124줄에서 업데이트 실시.
	include("./bigad_UpdatePrintPage.php");


	exit;

	//검사료납부여부가 입금이면
	if($payment_state == "PC"){
		//안전점검 접수현황->보기->입금체크, 검사료 기입, 검사료납부일 -> 입금입력 목록으로 update
		$rs	=	fn_update($PC_condition, $tbl, $where);
	} else{
		//접수현황에서 검사료 납부여부를 환불로 업데이트
		$rs	=	fn_update("payment_state='RF'", "bigad_SoaaRegCheck", "reg_no='" . $reg_no . "'");

		//환불입력 목록으로 insert
		$rs	=	fn_insert($RF_condition, $RF_condition1, $tbl);
	}
	
	if($rs > 0){
?>
<script>
	alert("저장 되었습니다");
	location.href="soaa_list.php?page=" + '<?=$page?>';
</script>
<?
	}else{
?>
<script>
	alert("변경된 데이터가 없습니다.");
	history.back(-1);
</script>
<? } ?>