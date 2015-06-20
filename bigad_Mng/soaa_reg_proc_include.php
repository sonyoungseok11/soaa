<?
		
//		$reg_no		= $_POST['reg_no'];		//접수번호
//		$reg_date	= $_POST['reg_date'];	//접수날짜
//
//		/*****************	신청자정보 시작 ****************/
//		$c_ceo_nm	= $_POST['c_ceo_nm'];		//성명
//		$c_rrn1	= $_POST['c_rrn1'];			//주민등록번호 앞6자리
//		$c_corp_nm	= $_POST['c_corp_nm'];	//업소명
//
//
//		$c_tel0			= $_POST['c_tel0'];		//전화번호
//		$c_tel1			= $_POST['c_tel1'];	//전화번호
//		$c_tel2			= $_POST['c_tel2'];//전화번호
//		$c_tel			= $c_tel0 . "-" . $c_tel1 . "-" . $c_tel2;//전화번호
//
//		$c_jibun1	= $_POST['c_jibun1'];	//주소지번1
//		$c_jibun2	= $_POST['c_jibun2'];	//주소지번2
//		$c_addr		= $_POST['c_addr'];		//신청자주소
//		/*****************	신청자정보 종료 ****************/
//
//
//		$outdoor_act_cate	= $_POST['outdoor_act_cate'];	//광고물종류
//		$use_item			= $_POST['use_item'];		//사용자재
//
//		$check_pay			= $_POST['check_pay'];	//검사료
//		$chk_pay	=	str_replace(",", "", $check_pay);	//입금
//		$rf_payment	=	str_replace(",", "", $check_pay);	//환불
//
//		$outdoor_act_type	= $_POST['outdoor_act_type'];		//광고물형식
//		$gu_office			= $_POST['gu_office'];		//해당구청
//
//		$outdoor_act_type_gubun			= $_POST['outdoor_act_type_gubun'];	//광고물구분
//
//		$outdoor_real_jibun1			= $_POST['outdoor_real_jibun1'];	//표시위치,장소
//		$outdoor_real_jibun2			= $_POST['outdoor_real_jibun2'];	//표시위치,장소
//		$outdoor_real_addr				= $_POST['outdoor_real_addr'];		//표시위치,장소
//
//		$chk_personA				= $_POST['chk_personA'];		//검사자A
//		$chk_personB				= $_POST['chk_personB'];		//검사자B
//
//		$chk_result					= $_POST['chk_result'];			//검사결과
//
//		$outdoor_size0 = $_POST['outdoor_size0']; //광고물규격
//		$outdoor_size1 = $_POST['outdoor_size1']; //광고물규격
//		$outdoor_size2 = $_POST['outdoor_size2']; //광고물규격
//		$outdoor_size3 = $_POST['outdoor_size3']; //광고물규격
//		$outdoor_size4 = $_POST['outdoor_size4']; //광고물규격
//		$outdoor_size5 = $_POST['outdoor_size5']; //광고물규격
//		$outdoor_size6 = $_POST['outdoor_size6']; //광고물규격
//		$outdoor_size7 = $_POST['outdoor_size7']; //광고물규격
//		$outdoor_sizeH0 = $_POST['outdoor_sizeH0']; //광고물높이
//
//		/*****************	시공업소정보 시작 ****************/
//		$s_ceo_nm	= $_POST['s_ceo_nm'];	//시공업소대표자
//		$s_biz_no0	= $_POST['s_biz_no0'];	//사업자번호
//		$s_biz_no1	= $_POST['s_biz_no1'];	//사업자번호
//		$s_biz_no2	= $_POST['s_biz_no2'];	//사업자번호
//		$s_biz_no	= $s_biz_no0 . "-" . $s_biz_no1 . "-" . $s_biz_no2; //사업자번호
//
//		$s_corp_nm	= $_POST['s_corp_nm'];	//업소명
//
//		$s_jibun1	= $_POST['s_jibun1'];	//주소1
//		$s_jibun2	= $_POST['s_jibun2'];	//주소2
//		$s_addr		= $_POST['s_addr'];		//주소전체
//		/*****************	시공업소정보 종료 ****************/
//
//		$report_certi		= $_POST['report_certi'];	//필증교부
//		if($report_certi == ""){
//			$report_certi = "N";
//		}
//		$payment_state		= $_POST['payment_state'];;	//검사료납부여부
//		$real_chkday		= $_POST['real_chkday'];	//검사일
//		$payment_in_day		= $_POST['payment_in_day'];	//검사료 납부일
//
//		$memo1		= $_POST['memo1'];	//검사의견
//		$etc_memo		= $_POST['etc_memo'];	//기타사항
//		$actions	= $_POST['actions'];	//insert
//
//		$insert_id	= $_SESSION['id'];

//echo "------------------------------------------<br>";
//echo "접수번호=" . $reg_no . "<br>";
//echo "접수날짜=" . $reg_date . "<br>";
//echo "신청자 성명=" . $c_ceo_nm . "<br>";
//echo "주민번호=" . $c_rrn1 . "<br>";
//echo "업소명=" . $c_corp_nm . "<br>";
//echo "전화번호=" . $c_tel . "<br>";
//echo "주소=" . $c_addr . "<br>";
//
//echo "------------------------------------------<br>";
//echo "광고물종류=" . $outdoor_act_cate . "<br>";
//echo "광고물형식=" . $outdoor_act_type . "<br>";
//echo "------------------------------------------<br>";
//echo "표시위치1=" . $outdoor_real_jibun1 . "<br>";
//echo "표시위치2=" . $outdoor_real_jibun2 . "<br>";
//echo "표시위치Full=" . $outdoor_real_addr . "<br>";
//echo "------------------------------------------<br>";
//echo "구청=" . $gu_office . "<br>";
//
//echo "규격0=" . $outdoor_size0 . "<br>";
//echo "규격1=" . $outdoor_size1 . "<br>";
//echo "규격2=" . $outdoor_size2 . "<br>";
//echo "규격3=" . $outdoor_size3 . "<br>";
//echo "규격4=" . $outdoor_size4 . "<br>";
//echo "규격5=" . $outdoor_size5 . "<br>";
//echo "규격6=" . $outdoor_size6 . "<br>";
//echo "규격7=" . $outdoor_size7 . "<br>";
//echo "높이 H0=" . $outdoor_sizeH0 . "<br>";
//
//echo "검사자A=" . $chk_personA . "<br>";
//echo "검사자B=" . $chk_personB . "<br>";
//echo "검사결과=" . $chk_result . "<br>";
//echo "검사료=" . $check_pay . "<br>";
//echo "검사일=" . $real_chkday . "<br>";
//echo "필증교부=" . $report_certi . "<br>";
//echo "------------------------------------------<br>";
//echo "사용자재=" . $use_item . "<br>";
//echo "설치장소=" . $outdoor_real_addr . "<br>";
//
//echo "------------------------------------------<br>";
//echo "시공대표=" . $s_ceo_nm . "<br>";
//echo "사업자번호0=" . $s_biz_no0 . "<br>";
//echo "사업자번호1=" . $s_biz_no1 . "<br>";
//echo "사업자번호2=" . $s_biz_no2 . "<br>";
//echo "시공업소명=" . $s_corp_nm . "<br>";
//echo "검사의견=" . $memo1 . "<br>";
//echo "기타사항=" . $etc_memo . "<br>";
//

$c_ceo_nm			= $_POST['c_ceo_nm'];		//성명
$c_rrn1				= $_POST['c_rrn1'];			//주민등록번호 앞6자리
$c_corp_nm			= $_POST['c_corp_nm'];	//업소명
$c_tel				= $_POST['c_tel0'] . "-" . $_POST['c_tel1'] . "-" . $_POST['c_tel2'];//전화번호
$c_jibun1			= $_POST['c_jibun1'];	//주소지번1
$c_jibun2			= $_POST['c_jibun2'];	//주소지번2
$c_addr				= $_POST['c_addr'];		//신청자주소
$outdoor_act_cate	= $_POST['outdoor_act_cate'];	//광고물종류
$outdoor_act_type	= $_POST['outdoor_act_type'];		//광고물형식
$outdoor_real_jibun1= $_POST['outdoor_real_jibun1'];	//표시위치,장소
$outdoor_real_jibun2= $_POST['outdoor_real_jibun2'];	//표시위치,장소
$outdoor_real_addr	= $_POST['outdoor_real_addr'];		//표시위치,장소
$gu_office			= $_POST['gu_office'];		//해당구청


if($outdoor_act_cate <> "jiju"){
$outdoor_size0		= $_POST['outdoor_size0']; //광고물규격
$outdoor_size1		= $_POST['outdoor_size1']; //광고물규격
$outdoor_size2		= $_POST['outdoor_size2']; //광고물규격
$outdoor_size3		= $_POST['outdoor_size3']; //광고물규격
$outdoor_size4		= $_POST['outdoor_size4']; //광고물규격
$outdoor_size5		= $_POST['outdoor_size5']; //광고물규격
$outdoor_size6		= $_POST['outdoor_size6']; //광고물규격
$outdoor_size7		= $_POST['outdoor_size7']; //광고물규격
}else{
$outdoor_size0		= $_POST['outdoor_size0']; //광고물규격
$outdoor_size1		= $_POST['outdoor_size1']; //광고물규격
$outdoor_size2		= $_POST['outdoor_size2']; //광고물규격
$outdoor_size3		= $_POST['outdoor_size3']; //광고물규격
$outdoor_size4		= $_POST['outdoor_size4']; //광고물규격
$outdoor_size5		= $_POST['outdoor_size5']; //광고물규격
$outdoor_size6		= $_POST['outdoor_size6']; //광고물규격
$outdoor_size7		= $_POST['outdoor_size7']; //광고물규격
$outdoor_sizeH0		= $_POST['outdoor_sizeH0']; //광고물높이
}



$chk_personA		= $_POST['chk_personA'];		//검사자A
$chk_personB		= $_POST['chk_personB'];		//검사자B
$chk_result			= $_POST['chk_result'];			//검사결과
$check_pay			= $_POST['check_pay'];			//검사료
$payment_state		= $_POST['payment_state'];;		//검사료납부여부
$real_chkday		= $_POST['real_chkday'];		//검사일

if($payment_state == "PC"){
$payment_in_day			= $_POST['payment_in_day'];		//입금일경우 검사료 납부일
}else{
$input_payment_date		= $_POST['payment_in_day'];		//아닐경우 검사료 납부일
}


$report_certi		= $_POST['report_certi'];		//필증교부

$s_ceo_nm			= $_POST['s_ceo_nm'];//시공업소대표자
$s_biz_no			= $_POST['s_biz_no0'] . "-" . $_POST['s_biz_no1'] . "-" . $_POST['s_biz_no2']; //사업자등록번호
$s_corp_nm			= $_POST['s_corp_nm'];	//업소명
$s_jibun1			= $_POST['s_jibun1'];	//주소1
$s_jibun2			= $_POST['s_jibun2'];	//주소2
$s_addr				= $_POST['s_addr'];		//주소전체
$memo1				= $_POST['memo1'];	//검사의견
$etc_memo			= $_POST['etc_memo'];	//기타사항

$bigad_Grade			= $_POST['bigad_Grade'];	//등급(A to  D)
//$bigad_PlacePic1		= $_POST['bigad_PlacePic1'];	//현장사진1
//$bigad_PlacePic2		= $_POST['bigad_PlacePic2'];	//현장사진2
$bigad_OrderIndi1		= $_POST['bigad_OrderIndi1'];	//지시사항1
$bigad_OrderIndi2		= $_POST['bigad_OrderIndi2'];	//지시사항2
//$bigad_OrderIndi1Pic	= $_POST['bigad_OrderIndi1Pic'];	//지시사항1사진
//$bigad_OrderIndi2Pic	= $_POST['bigad_OrderIndi2Pic'];	//지시사항2사진


/**********  현장사진1 업로드 프로세스 *************/
$bigad_PlacePic1_NM	=	$_FILES['bigad_PlacePic1']['name'];
$bigad_PlacePic1_TMPNM	=	$_FILES['bigad_PlacePic1']['tmp_name'];
$bigad_PlacePic1_PATH = $_SERVER['DOCUMENT_ROOT'] . 'img/bigad_soaaRegImgUpload/' ."[" .date("Y-m-d G:i:s") . "]		" .  $bigad_PlacePic1_NM;

if($_FILES['bigad_PlacePic1']['name']){
	move_uploaded_file($_FILES['bigad_PlacePic1']['tmp_name'], $bigad_PlacePic1_PATH);
	$bigad_PlacePic1 = str_replace("/home/soaa/www", "", $bigad_PlacePic1_PATH = $_SERVER['DOCUMENT_ROOT'] . 'img/bigad_soaaRegImgUpload/' . $bigad_PlacePic1_NM);
}

/**********  현장사진2 업로드 프로세스 *************/
$bigad_PlacePic2_NM	=	$_FILES['bigad_PlacePic2']['name'];
$bigad_PlacePic2_TMPNM	=	$_FILES['bigad_PlacePic1']['tmp_name'];
$bigad_PlacePic2_PATH = $_SERVER['DOCUMENT_ROOT'] . 'img/bigad_soaaRegImgUpload/' ."[" .date("Y-m-d G:i:s") . "]		" .  $bigad_PlacePic2_NM;

if($_FILES['bigad_PlacePic2']['name']){
	move_uploaded_file($_FILES['bigad_PlacePic2']['tmp_name'], $bigad_PlacePic2_PATH);
	$bigad_PlacePic2 = str_replace("/home/soaa/www", "", $bigad_PlacePic2_PATH = $_SERVER['DOCUMENT_ROOT'] . 'img/bigad_soaaRegImgUpload/' . $bigad_PlacePic2_NM);
}
/**********  현장사진2 업로드 프로세스 *************/

/**********  지시사항1사진 업로드 프로세스 *************/
$bigad_OrderIndiPic1_NM	=	$_FILES['bigad_OrderIndiPic1']['name'];
$bigad_OrderIndiPic1_TMPNM	=	$_FILES['bigad_OrderIndiPic1']['tmp_name'];
$bigad_OrderIndiPic1_PATH = $_SERVER['DOCUMENT_ROOT'] . 'img/bigad_soaaRegImgUpload/' ."[" .date("Y-m-d G:i:s") . "]		" .  $bigad_OrderIndiPic1_NM;

if($_FILES['bigad_OrderIndiPic1']['name']){
	move_uploaded_file($_FILES['bigad_OrderIndiPic1']['tmp_name'], $bigad_OrderIndiPic1_PATH);
	$bigad_OrderIndiPic1 = str_replace("/home/soaa/www", "", $bigad_OrderIndiPic1_PATH = $_SERVER['DOCUMENT_ROOT'] . 'img/bigad_soaaRegImgUpload/' . $bigad_OrderIndiPic1_NM);
}
/**********  지시사항1사진 업로드 프로세스 *************/

/**********  지시사항2사진 업로드 프로세스 *************/
$bigad_OrderIndiPic2_NM	=	$_FILES['bigad_OrderIndiPic2']['name'];
$bigad_OrderIndiPic2_TMPNM	=	$_FILES['bigad_OrderIndiPic2']['tmp_name'];
$bigad_OrderIndiPic2_PATH = $_SERVER['DOCUMENT_ROOT'] . 'img/bigad_soaaRegImgUpload/' ."[" .date("Y-m-d G:i:s") . "]		" .  $bigad_OrderIndiPic2_NM;

if($_FILES['bigad_OrderIndiPic2']['name']){
	move_uploaded_file($_FILES['bigad_OrderIndiPic2']['tmp_name'], $bigad_OrderIndiPic2_PATH);
	$bigad_OrderIndiPic2 = str_replace("/home/soaa/www", "", $bigad_OrderIndiPic2_PATH = $_SERVER['DOCUMENT_ROOT'] . 'img/bigad_soaaRegImgUpload/' . $bigad_OrderIndiPic2_NM);
}
/**********  지시사항2사진 업로드 프로세스 *************/

$check_pay	= str_replace(",", "", $check_pay);	//검사료 콤마 제거.
$rf_payment	= str_replace(",", "", $check_pay);	//환불의 콤마 제거.


if($report_certi == ""){	//필증교부 선택치 않으면 기본 미교부로.
	$report_certi = "N";
}

//$1_1_result			= $_POST['1_1_result'];
//echo "1_1_result = " . $1_1_result;

$one_one_result		=	$_POST['1_1_result'];
$one_one_etc		=	$_POST['1_1_etc'];
$one_two_result		=	$_POST['1_2_result'];
$one_two_etc		=	$_POST['1_2_etc'];
$one_three_result	=	$_POST['1_3_result'];
$one_three_etc		=	$_POST['1_3_etc'];

$two_one_result		=	$_POST['2_1_result'];
$two_one_etc		=	$_POST['2_1_etc'];
$two_two_result		=	$_POST['2_2_result'];
$two_two_etc		=	$_POST['2_2_etc'];
$two_three_result	=	$_POST['2_3_result'];
$two_three_etc		=	$_POST['2_3_etc'];


$three_one_result		=	$_POST['3_1_result'];
$three_one_etc			=	$_POST['3_1_etc'];
$three_two_result		=	$_POST['3_2_result'];
$three_two_etc			=	$_POST['3_2_etc'];
$three_three_result		=	$_POST['3_3_result'];
$three_three_etc		=	$_POST['3_3_etc'];
$three_four_result		=	$_POST['3_4_result'];
$three_four_etc			=	$_POST['3_4_etc'];
$three_five_result		=	$_POST['3_5_result'];
$three_five_etc			=	$_POST['3_5_etc'];
$three_six_result		=	$_POST['3_6_result'];
$three_six_etc			=	$_POST['3_6_etc'];
$three_seven_result		=	$_POST['3_7_result'];
$three_seven_etc		=	$_POST['3_7_etc'];

$four_one_result		=	$_POST['4_1_result'];
$four_one_etc			=	$_POST['4_1_etc'];
$four_two_result		=	$_POST['4_2_result'];
$four_two_etc			=	$_POST['4_2_etc'];

$five_one_result		=	$_POST['5_1_result'];
$five_one_etc			=	$_POST['5_1_etc'];
$five_two_result		=	$_POST['5_2_result'];
$five_two_etc			=	$_POST['5_2_etc'];
$five_three_result		=	$_POST['5_3_result'];
$five_three_etc			=	$_POST['5_3_etc'];

//echo "------------------------------------------<br>";
//echo "성명=" . $c_ceo_nm . "<br>";
//echo "주민등록번호=" . $c_rrn1 . "<br>";
//echo "업소명=" . $c_corp_nm . "<br>";
//echo "전화번호=" . $c_tel . "<br>";
//echo "주소지번1=" . $c_jibun1 . "<br>";
//echo "주소지번2=" . $c_jibun2 . "<br>";
//echo "주소지번3=" . $c_addr . "<br>";
//echo "------------------------------------------<br>";
//echo "광고물종류=" . $outdoor_act_cate . "<br>";
//echo "광고물형식=" . $outdoor_act_type . "<br>";
//echo "표시위치,장소1=" . $outdoor_real_jibun1 . "<br>";
//echo "표시위치,장소2=" . $outdoor_real_jibun2 . "<br>";
//echo "표시위치,장소3=" . $outdoor_real_addr . "<br>";
//echo "해당구청=" . $gu_office . "<br>";
//echo "------------------------------------------<br>";
//echo "광고물규격0=" . $outdoor_size0 . "<br>";
//echo "광고물규격1=" . $outdoor_size1 . "<br>";
//echo "광고물규격2=" . $outdoor_size2 . "<br>";
//echo "광고물규격3=" . $outdoor_size3 . "<br>";
//echo "광고물규격4=" . $outdoor_size4 . "<br>";
//echo "광고물규격5=" . $outdoor_size5 . "<br>";
//echo "광고물규격6=" . $outdoor_size6 . "<br>";
//echo "광고물규격7=" . $outdoor_size7 . "<br>";
//echo "광고물규격H=" . $outdoor_sizeH0 . "<br>";
//echo "------------------------------------------<br>";
//echo "검사자A=" . $chk_personA . "<br>";
//echo "검사자B=" . $chk_personB . "<br>";
//echo "검사결과=" . $chk_result . "<br>";
//echo "검사료=" . $check_pay . "<br>";
//
//echo "검사료납부여부=" . $payment_state . "<br>";
//echo "검사일=" . $real_chkday . "<br>";
//echo "검사료 납부일=" . $payment_in_day . "<br>";
//echo "------------------------------------------<br>";
//
//echo "필증교부=" . $report_certi . "<br>";
//echo "시공업소대표자=" . $s_ceo_nm . "<br>";
//echo "사업자등록번호=" . $s_biz_no . "<br>";
//echo "업소명=" . $s_corp_nm . "<br>";
//echo "주소1=" . $s_jibun1 . "<br>";
//echo "주소2=" . $s_jibun2 . "<br>";
//echo "주소전체=" . $s_addr . "<br>";
//echo "------------------------------------------<br>";
//echo "검사의견=" . $memo1 . "<br>";
//echo "기타사항=" . $etc_memo . "<br>";
//exit;
?>