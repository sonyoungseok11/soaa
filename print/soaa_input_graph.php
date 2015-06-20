<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<!-- PrintSoaaInputGraph(가로세로출력여부,왼쪽마진,오른쪽마진,상단마진,하단마진)-->
	<body onload="ThisWindowsPrint('garo', '20', '20', '','');">
	<Object id='factory' viewastext style='display:none' classid='clsid:1663ed61-23eb-11d2-b92f-008048fdd814' codebase='http://www.meadroid.com/scriptx/scriptX.cab#Version=6,1,432,1'>
	</Object>
<script type="text/javascript" src="/js/common.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="/css/admin/print_soaa_input_graph.css">

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

	if($select_y == ""){	$select_y	=	$now_y;		}
	if($select_m == ""){	$select_m	=	$now_m;		}
	if($select_d == ""){	$select_d	=	"01";			}

	if($select_yy == ""){	$select_yy	=	$now_y;		}
	if($select_mm == ""){	$select_mm	=	$now_m;		}
	if($select_dd == ""){	$select_dd	=	$now_d;		}

	$where = "";
	switch($gubun){
		case "month":
			$where =	"  date_format(insert_date, '%Y') in('$select_y')";	break;
		case "day":
			$where =	"  date_format(insert_date, '%Y-%m') in('$select_y" . "-" ."$select_m')";	break;
		case "period":
			$where =	"  date_format(insert_date, '%Y-%m-%d') between ('$select_y" . "-" ."$select_m" . "-" . "$select_d') and ('$select_yy" . "-" ."$select_mm" . "-" . "$select_dd')";	break;
	}

//	echo "where=" . $where . "<br>";
	$start_y = $now_y -20;

	if($where){
		$excel_where = 1;
	}else{
		$excel_where = 0;
	}
	//검색조건 switch 문에서 현재 페이지명을 스크립트로 넘기기 위해 사용
	$this_page = array_pop(explode("/",$_SERVER['REQUEST_URI']));
	$this_page = explode(".", $this_page);
//	echo "현재페이지=" . $this_page[0];
?>


<div class="title">구청별&nbsp;입금통계</div>

<? if($select_y && !$select_m){ ?>
<div class="search_option">[검색기간]&nbsp;<?=$select_y;?>년</div>
<? } ?>

<? if($select_m && !$select_d){ ?>
<div class="search_option">[검색기간]&nbsp;<?=$select_y;?>년&nbsp;<?=$select_m;?>월</div>
<? } ?>

<? if($select_dd){ ?>
<div class="search_option">[검색기간]&nbsp;<?=$select_y;?>년&nbsp;<?=$select_m;?>월&nbsp;<?=$select_d;?>일 ~ <?=$select_yy;?>년&nbsp;<?=$select_mm;?>월&nbsp;<?=$select_dd;?>일</div>
<? } ?>

<table class="tbl" border="1px">
	<colgroup>
		<col width="205px">
		<col width="100px">
		<col width="310px">
		<col width="100px">
		<col width="310px">
		<col width="100px">
		<col width="310px">
	</colgroup>
	<tr>
		<th rowspan="2" class="head">구청</th>
		<th colspan="2" class="head">입금&nbsp;금액</th>
		<th colspan="2" class="head">환불&nbsp;금액</th>
		<th colspan="2" class="head">합계</th>
	</tr>
	<tr>
		<th class="head">건수</th>
		<th class="head">금액</th>
		<th class="head">건수</th>
		<th class="head">금액</th>
		<th class="head">건수</th>
		<th class="head">금액</th>
	</tr>
	<?
	//구청별로 리스트 출력
	include "../safeChk_Mng/stat/soaa_input_gu_office_list.php";

	//총계 출력
	include "../safeChk_Mng/stat/soaa_input_graph_cnt_sum_total.php";
	?>
</table>