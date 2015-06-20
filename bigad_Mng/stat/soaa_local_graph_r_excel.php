<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<?
 header("Pragma:"); 
 header("Cache-Control:"); 
 header("Content-Type: application/vnd.ms-excel"); 
 header("Content-Disposition: attachment; filename=exceldown.xls"); 
 header("Content-Description: PHP5 Generated Data"); 
?>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<style>
	body { text-align:right;}
	.center {text-align:center;}
	.c_red {color:red;}

	.title { font-weight:bold; font-size:20px; border:0px;}
	.search_gigan { text-align:right; border:0px;}
	.search_cnt_sum { text-align:right; border:0px;}

	.w200 { width:180px; text-align:center; background-color:#eeeeee;}
	.cnt_title { background-color:#eeeeee;}
	.sum_title { background-color:#eeeeee;}

	.guchung { background-color:#eeeeee;}
	.case { padding-right:10px; }
	.sum { margin-right:10px; }
	</style>
</head>
<?		
	$select_y	=	$_POST['select_y'];
	$select_m	=	$_POST['select_m'];
	$select_d	=	$_POST['select_d'];

	$select_yy	=	$_POST['select_yy'];
	$select_mm	=	$_POST['select_mm'];
	$select_dd	=	$_POST['select_dd'];
	$gubun		=	$_POST['gubun'];
	

	if($select_y){
		$search_echo = $select_y . "년 ";
	}
	if($select_m){
		$search_echo .= $select_m ."월 ";
	}
	if($select_d){
		$search_echo .= $select_d . "일";
	}

	if($select_yy){
		$search_echo .= " ~ " . $select_yy . "년 ";
	}
	if($select_mm){
		$search_echo .= $select_mm ."월 ";
	}
	if($select_dd){
		$search_echo .= $select_dd . "일 ";
	}

	switch($gubun){
		case "month":
			$where =	" and date_format(reg_date, '%Y') in('$select_y')";	break;
		case "day":
			$where =	" and date_format(reg_date, '%Y-%m') in('$select_y" . "-" ."$select_m')";	break;
		case "period":
			$where =	" and date_format(reg_date, '%Y-%m-%d') between ('$select_y" . "-" ."$select_m" . "-" . "$select_d') and ('$select_yy" . "-" ."$select_mm" . "-" . "$select_dd')";	break;
	}


	//총 건수와 합계
	include "./soaa_local_graph_r_cal_sum.php";
		
?>
<body>
<table border="1">
	<tr>
		<th class="title" colspan="15">안전 점검 통계(접수일) [검색기간] <?=$search_echo?></td>
	</tr>
	<!--
	<tr>
		<th class="search_gigan" colspan="15"></th>
	</tr>
	-->
	<tr>
		<th class="search_cnt_sum" colspan="15">총 <span class="c_red"><?=$rs['all_tot'];?></span>건&nbsp;&#47;&nbsp;<span class="c_red"><?=number_format($rs['all_sum'])?></span>원</th>
	</tr>
	<tr>
		<th rowspan="2" class="w200">구청</th>
		<th colspan="2" class="w200">옥상간판</th>
		<th colspan="2" class="w200">돌출간판</th>
		<th colspan="2" class="w200">지주간판</th>
		<th colspan="2" class="w200">가로형간판</th>
		<th colspan="2" class="w200">현수막게시시설</th>
		<th colspan="2" class="w200">기타안내</th>
		<th colspan="2" class="w200">합계</th>
	</tr>
	<tr>
		<td class="cnt_title">건수</td>
		<td class="sum_title" >금액</td>
		<td class="cnt_title">건수</td>
		<td class="sum_title" >금액</td>
		<td class="cnt_title">건수</td>
		<td class="sum_title" >금액</td>
		<td class="cnt_title">건수</td>
		<td class="sum_title" >금액</td>
		<td class="cnt_title">건수</td>
		<td class="sum_title" >금액</td>
		<td class="cnt_title">건수</td>
		<td class="sum_title" >금액</td>
		<td class="cnt_title">건수</td>
		<td class="sum_title" >금액</td>
	</tr>
	<?
		//구청별로 리스트 출력
		include "./soaa_local_graph_r_gu_office_list.php";
		//총계 출력
		include "./soaa_local_graph_r_cnt_sum_total.php";
	?>
</table>
</body>
