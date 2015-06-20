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

	.w100 { width:100px; text-align:center; background-color:#eeeeee;}
	.w250 { width:250px; text-align:center; background-color:#eeeeee;}
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

//		echo "select_y=" . $select_y . "<br>";
//		echo "select_m=" . $select_m . "<br>";
//		echo "select_d=" . $select_d . "<br>";
//
//		echo "select_yy=" . $select_yy . "<br>";
//		echo "select_mm=" . $select_mm . "<br>";
//		echo "select_dd=" . $select_dd . "<br>";		

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
			$where =	"  date_format(insert_date, '%Y') in('$select_y')";	break;
		case "day":
			$where =	"  date_format(insert_date, '%Y-%m') in('$select_y" . "-" ."$select_m')";	break;
		case "period":
			$where =	"  date_format(insert_date, '%Y-%m-%d') between ('$select_y" . "-" ."$select_m" . "-" . "$select_d') and ('$select_yy" . "-" ."$select_mm" . "-" . "$select_dd')";	break;
	}

	//총 건수와 합계
	include "./soaa_input_graph_cal_sum.php";
?>
<body>
<table border="1">
	<tr>
		<th class="title" colspan="7">구청별 입금통계</td>
	</tr>
	<tr>
		<th class="search_gigan" colspan="7">[검색기간] <?=$search_echo?></th>
	</tr>
	<tr>
		<th class="search_cnt_sum" colspan="7">총 <span class="c_red"><?=$rs['pc_cnt'];?></span>건&nbsp;&#47;&nbsp;<span class="c_red"><?=number_format($rs['pc_sum']);?></span>원</th>
	</tr>
	<tr>
		<th rowspan="2" class="w100">구청</th>
		<th colspan="2" class="w250">입금&nbsp;금액</th>
		<th colspan="2" class="w250">환불&nbsp;금액</th>
		<th colspan="2" class="w250">합계</th>
	</tr>
	<tr>
		<th class="cnt_title">건수</th>
		<th class="sum_title">금액</th>
		<th class="cnt_title">건수</th>
		<th class="sum_title">금액</th>
		<th class="cnt_title">건수</th>
		<th class="sum_title">금액</th>
	</tr>
	<?
		//구청별로 리스트 출력
		include "./soaa_input_gu_office_list.php";
		//총계 출력
		include "./soaa_input_graph_cnt_sum_total.php";
	?>
</table>
</body>