<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<body onload="ThisWindowsPrint('garo');">
<Object id='factory' viewastext style='display:none' classid='clsid:1663ed61-23eb-11d2-b92f-008048fdd814' codebase='http://www.meadroid.com/scriptx/scriptX.cab#Version=6,1,432,1'>
 </Object>
<script type="text/javascript" src="/js/common.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="/css/admin/print_soaa_local_graph_r.css">
<?
	if($_GET['gubun']){
		$gubun	=	$_GET['gubun'];
	}else{
		$gubun	=	$_POST['gubun'];
	}
//	echo "년도 월별 기간별 구분값=" . $gubun . "<br>";
	

	$select_y	=	$_POST['select_y'];
	$select_m	=	$_POST['select_m'];
	$select_d	=	$_POST['select_d'];

	$select_yy	=	$_POST['select_yy'];
	$select_mm	=	$_POST['select_mm'];
	$select_dd	=	$_POST['select_dd'];


	if(!$gubun){
		$gubun = "month";
	}

	$now_y	=	date("Y");
	$now_m	=	date("m");
	$now_d	=	date("d");

	$where = "";
	switch($gubun){
		case "month":
			$where =	" and date_format(reg_date, '%Y') in('$select_y')";	break;
		case "day":
			$where =	" and date_format(reg_date, '%Y-%m') in('$select_y" . "-" ."$select_m')";	break;
		case "period":
			$where =	" and date_format(reg_date, '%Y-%m-%d') between ('$select_y" . "-" ."$select_m" . "-" . "$select_d') and ('$select_yy" . "-" ."$select_mm" . "-" . "$select_dd')";	break;
	}

	$start_y = $now_y -20;

?>
<div class="title">안전점검&nbsp;통계(접수일)</div>

<? if($select_y && !$select_m){ ?>
<div class="search_option">[검색기간]&nbsp;<?=$select_y;?>년</div>
<? } ?>

<? if($select_m && !$select_d){ ?>
<div class="search_option">[검색기간]&nbsp;<?=$select_y;?>년&nbsp;<?=$select_m;?>월</div>
<? } ?>

<? if($select_dd){ ?>
<div class="search_option">[검색기간]&nbsp;<?=$select_y;?>년&nbsp;<?=$select_m;?>월&nbsp;<?=$select_d;?>일 ~ <?=$select_yy;?>년&nbsp;<?=$select_mm;?>월&nbsp;<?=$select_dd;?>일</div>
<? } ?>
<table class="tbl" border="1">
	<colgroup>
		<col width="85px">
		<col width="60px">
		<col width="132px">
		<col width="60px">
		<col width="132px">
		<col width="60px">
		<col width="132px">
		<col width="60px">
		<col width="132px">
		<col width="60px">
		<col width="132px">
		<col width="60px">
		<col width="132px">
		<col width="60px">
		<col width="138px">
	</colgroup>
	<tr>
		<th rowspan="2">구청</th>
		<th colspan="2">옥상간판</th>
		<th colspan="2">돌출간판</th>
		<th colspan="2">지주간판</th>
		<th colspan="2">가로형간판</th>
		<th colspan="2">현수막게시시설</th>
		<th colspan="2">기타안내</th>
		<th colspan="2">합계</th>
	</tr>
	<tr>
		<th>건수</th>
		<th>금액</th>
		<th>건수</th>
		<th>금액</th>
		<th>건수</th>
		<th>금액</th>
		<th>건수</th>
		<th>금액</th>
		<th>건수</th>
		<th>금액</th>
		<th>건수</th>
		<th>금액</th>
		<th>건수</th>
		<th>금액</th>
	</tr>
	<?
		//구청별로 리스트 출력
		include "../safeChk_Mng/stat/soaa_local_graph_r_gu_office_list.php";

		//총계 출력
		include "../safeChk_Mng/stat/soaa_local_graph_r_cnt_sum_total.php";
	?>
</table>