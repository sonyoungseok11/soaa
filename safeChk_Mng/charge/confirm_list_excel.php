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
	$st_date1	=	$_POST['st_date1'];
	$st_date2	=	$_POST['st_date2'];
	$ed_date1	=	$_POST['ed_date1'];
	$ed_date2	=	$_POST['ed_date2'];

	$tmp		=	$_POST['tmp'];
	$gu_office	=	$_POST['gu_office'];
	$c_corp_nm	=	$_POST['c_corp_nm'];
	$c_ceo_nm	=	$_POST['c_ceo_nm'];
	$c_tel		=	$_POST['c_tel'];


//
//	echo "st_date1=" . $st_date1 . "<br>";
//	echo "st_date2=" . $st_date2 . "<br>";
//	echo "ed_date1=" . $ed_date1 . "<br>";
//	echo "ed_date2=" . $ed_date2 . "<br>";
//	echo "gu_office=" . $gu_office . "<br>";
//
//	echo "c_corp_nm=" . $c_corp_nm . "<br>";
//	echo "c_ceo_nm=" . $c_ceo_nm . "<br>";
//	echo "c_tel=" . $c_tel . "<br>";

	$where = "";
	include "./confirm_list_where.php";

?>
<body>
<table border="1">
	<tr>
		<th class="title" colspan="7">확인리스트</td>
	</tr>
	<? if($st_date1 && $st_date2){ ?>
	<tr>
		<th class="search_gigan" colspan="7">[납입일자] <?=$st_date1?>~<?=$st_date2?></th>
	</tr>
	<? } ?>

	<? if($ed_date1 && $ed_date2){ ?>
	<tr>
		<th class="search_gigan" colspan="7">[등록일자] <?=$ed_date1?>~<?=$ed_date2?></th>
	</tr>
	<? } ?>
	<tr>
		<th class="w250">업체명</th>
		<th class="w100">성명</th>
		<th class="w100">해당구</th>
		<th class="w100">금액</th>
		<th class="w100">구분</th>
		<th class="w100">확인여부</th>
		<th class="w100">입금날짜</th>
	</tr>
	<?

		if($where){
			$result	=	fn_select("*", "confirm_list", "$where order by insert_date desc");
		}else{
			$result	=	fn_select_orderby("*", "confirm_list", "insert_date desc");
		}

		while($rs = mysql_fetch_array($result)){

			$rs_office	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='10' and en_nm='" .$rs['gu_office'] . "'");
			
			switch($rs['input_pay_type']){
				case "BB":
					$input_pay_type="통장";break;
				case "EB":
					$input_pay_type="지로";break;
			}

			$input_date	=	explode(" ",$rs['input_date']);

			$c_corp_nm = $rs['c_corp_nm'];
			$c_ceo_nm = $rs['c_ceo_nm'];
			$gu_office = $rs['gu_office'];

	?>
	<tr>
		<th><?=$rs['c_corp_nm']?></th>
		<th><?=$rs['c_ceo_nm']?></th>
		<th><?=$rs_office[0];?></th>
		<th><?=number_format($rs['chk_pay'])?>원</th>
		<th><?=$input_pay_type;?></th>
		<th>확인</th>
		<th><?=$input_date[0]?></th>
	</tr>
	<?
		}
	?>
</table>
</body>
