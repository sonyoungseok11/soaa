<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<body onload="ThisWindowsPrint('sero','0','0','0','0','0');">
<Object id='factory' viewastext style='display:none' classid='clsid:1663ed61-23eb-11d2-b92f-008048fdd814' codebase='http://www.meadroid.com/scriptx/scriptX.cab#Version=6,1,432,1'>
 </Object>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="/css/admin/print_check_result_report.css">
<?

//##################
// POST 또는 GET으로 받을때 reg_no 로 받거나 보내면
// &c_ceo_nm=경숙®_ 처럼 특수문자가 붙음... (페이지 링크 -> common.js->function navi_mng_list -> soaa_mng_list)
// 부득이하게 rega_no 로 임시처리함.
//###################

	//기간선택 년도, 월
	$select_gigan_y	=	$_POST['select_gigan_y'];
	$select_gigan_m	=	$_POST['select_gigan_m'];

	//시작날짜, 종료날짜
	$st_date	=	$_POST['st_date'];
	$ed_date	=	$_POST['ed_date'];

	$gu_office	=	$_POST['gu_office']; 
	$c_corp_nm	=	$_POST['c_corp_nm'];
	$c_ceo_nm	=	$_POST['c_ceo_nm'];

	$rega_no		=	$_POST['rega_no'];
	$chk_personA	=	$_POST['chk_personA']; 
	$outdoor_act_cate	=	$_POST['outdoor_act_cate'];

	$payment_state	=	$_POST['payment_state'];
	$report_certi	=	$_POST['report_certi'];
	$chk_result	=	$_POST['chk_result'];

	$select_page_num	=	$_POST["select_page_num"];
	$chkbox	=	$_POST["chkbox"];
	
	include "../safeChk_Mng/check_result_report_where.php";

	$tmp_reg_no = "";
	for($i=0; $i<count($chkbox); $i++){

		if($i<count($chkbox)-1){
			$tmp_reg_no[$i]	.= "'". $chkbox[$i] . "',";
		}
		if($i==count($chkbox)-1){
			$tmp_reg_no[$i]	.= "'". $chkbox[$i] . "'";
		}

		$reg_no .=$tmp_reg_no[$i];

	}



	$where .= " and reg_no in($reg_no)";

	$result = fn_select("*", "soaa_reg_check", $where);
?>
	<div class="title">
	옥외광고물등 안전점검 결과보고서
	<hr class="title_h">
	</div>

		<table class="tbl" border="1">
			<colgroup>
				<col width="20px">
				<col width="50px">
				<col width="90px">

				<col width="180px">
				<col width="50px">
				<col width="50px">

				<col width="70px">
				<col width="50px">
				<col width="50px">
				<col width="40px">
			</colgroup>
		   <tr>
				<th>No</th>
				<th>성명</th>
				<th>업소명</th>

				<th>설치위치</th>
				<th>종류</th>
				<th>규격</th>

				<th>검사일자</th>
				<th>검사자</th>
				<th>검사결과</th>
				<th>비고</th>
		   </tr>
<?
	$i=1;		//No
	$cut_no=0;	//타이틀 표시 (페이징으로 출력하기 위해 일부러 제목을 구분선으로 넣음-원본 사이트에서 보고 따라함)

	while($rs = mysql_fetch_array($result)){
		$reg_date = explode(" ", $rs["reg_date"]);
		$reg_date = explode("-", $reg_date[0]);
		$outdoor_act_cate	=	$rs['outdoor_act_cate'];
		switch($rs['chk_result']){
			case "pass":
				$td_chk_result = "합격";	break;
			case "failed":
				$td_chk_result = "불합격";	break;
			case "NonMake":
				$td_chk_result = "미설치";	break;
			case "NonTarget":
				$td_chk_result = "비대상";	break;
			case "PlaceModify":
				$td_chk_result = "현장시정";	break;
			case "defer":
				$td_chk_result = "보류";	break;
			case "pullDown":
				$td_chk_result = "철거";	break;
			case "NonChk":
				$td_chk_result = "미검사";	break;
		}

//		if($rs['chk_personA']){
//			$chk_person = $rs['chk_personA'];
//		}else{
//			$chk_person = $rs['chk_personB'];
//		}

		if($rs['outdoor_act_cate'] == "garo" || $rs['outdoor_act_cate'] == "oksang"){
			$size	=	$rs['outdoor_size0'] . "*" . $rs['outdoor_size1'] . "*" . $rs['outdoor_size2'] . "*" . $rs['outdoor_size3']. "*" . $rs['outdoor_size4']. "*" . $rs['outdoor_size5'];
		}else{
			$size	=	$rs['outdoor_size0'] . "*" . $rs['outdoor_size1'] . "*" . $rs['outdoor_size2'] . "*" . $rs['outdoor_size3'];												
		}

		$chk_personA		=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='" . $rs['chk_personA'] . "'");
		$chk_personB		=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='" . $rs['chk_personB'] . "'");

//		$chk_person		=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='$chk_person'");
		$outdoor_act_cate		=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='01' and en_nm='$outdoor_act_cate'");
?>
		<tr>
		  <!-- fetch_array 는 배열 형태로 리턴값을 반환하므로 [0] 을 써줘야함.-->
			<td><?=$i;?></td>
			<td><?=$rs["c_ceo_nm"]?></td>
			<td><?=$rs["c_corp_nm"]?></td>
			<td class="locate"><?=$rs["outdoor_real_addr"]?></td>
			<td><?=$outdoor_act_cate[0]?></td>
			<td><?=$size;?></td>
			<td>2014.10.21</td>
			<td>
				<?
				echo $chk_personA[0];
				if($chk_personB[0]){
					echo "," . $chk_personB[0];
				}
				?>
			</td>
			<td><?=$td_chk_result; ?></td>
			<td><?=$rs['memo1']?></td>
		</tr>


<? 
		$i++;
	}	//end while
?>
		</table>
<!--2개의 tr이 한 세트-->