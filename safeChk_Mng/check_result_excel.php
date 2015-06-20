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
	.center {text-align:center;}
	.title { font-weight:bold; font-size:20px; border:0px;}
	</style>
</head>
<?
		$st_date	=	$_POST["st_date"];
		$ed_date	= 	$_POST["ed_date"];
		$gu_office	= 	$_POST["gu_office"];

		$c_corp_nm	=	$_POST["c_corp_nm"];
		$c_ceo_nm	=	$_POST["c_ceo_nm"];
		$reg_no		=	$_POST["reg_no"];

		$outdoor_act_cate		=	$_POST["outdoor_act_cate"];
		$chk_paytype		=	$_POST["chk_paytype"];
		$report_certi		=	$_POST["report_certi"];
		$chk_result		=	$_POST["chk_result"];

		include "./check_result_report_where.php";
?>

<table border="1">
	<tr>
		<th  class="title" colspan="14">안전 점검 관리대장</td>
	</tr>
	<?
		if($select_gigan_y && $select_gigan_m){
	?>
	<tr>
		<th colspan="14" align="right">[검색기간]<?=$select_gigan_y?>년<?=$select_gigan_m?>월</td>
	</tr>
	<?
		}
	?>
</table>
<table border="1">
	<tr>
		<th rowspan="2">No</th>
		<th rowspan="2">접수번호</th>
		<th rowspan="2">신청일자</th>
		<th rowspan="2" width="200">성명</th>
		<th rowspan="2">업소명</th>
		<th rowspan="2">전화번호</th>
		<th rowspan="2">구청명</th>
		<th rowspan="2">광고물종류</th>
		<th rowspan="2">형식</th>
		<th rowspan="2">표시위치</th>
		<th rowspan="2">표시규격</th>
		<th>검사일자</th>
		<th>검사결과</th>
		<th rowspan="2">입금일자</th>
	</tr>
	<tr>
		<th>검사자</th>
		<th>수수료</th>
	</tr>
   <!--2개의 tr이 한 세트-->

   <?
		$result = fn_select("*", "soaa_reg_check", $where);
		
		$i=1;
		while($rs = mysql_fetch_array($result)){

			$lst_gu_office	=	$rs['gu_office'];
			$lst_outdoor_act_cate	=	$rs['outdoor_act_cate'];

			if($lst_outdoor_act_cate == "oksang" || $lst_outdoor_act_cate == "garo"){
				for($j=0; $j<=7; $j++){
					if($j<=6){
						$size .= $rs['outdoor_size' . $j] . "*";
					}else{
						$size .= $rs['outdoor_size' . $j];
					}
				}
			}

			$lst_outdoor_act_type	=	$rs['outdoor_act_type'];
			$lst_chk_result	=	$rs['chk_result'];
			$chk_personA	=	$rs['chk_personA'];
			$chk_personB	=	$rs['chk_personB'];
			$lst_outdoor_real_addr	=	str_replace("서울특별시 ", "", $rs['outdoor_real_addr']);

			if($chk_personA){
				$chk_person = $chk_personA;
			}else{
				$chk_person = $chk_personB;
			}
			
			$rs_gu_office	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='10' and en_nm='$lst_gu_office'");
			$chk_person		=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='$chk_person'");
			$rs_outdoor_act_cate	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='01' and en_nm='$lst_outdoor_act_cate'");
			$rs_outdoor_act_type	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='05' and en_nm='$lst_outdoor_act_type'");
			$rs_chk_result				=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='30' and en_nm='$lst_chk_result'");
	?>
   <tr>
	  <!-- fetch_array 는 배열 형태로 리턴값을 반환하므로 [0] 을 써줘야함.-->
      <td class="center" rowspan="2"><?=$i?></td>
	  <td class="center" rowspan="2"><?=$rs['reg_no']?></td>
	  <td rowspan="2"><?=$rs['reg_date']?></td>
	  <td rowspan="2" width="200"><?=$rs['c_ceo_nm']?></td>
	  <td rowspan="2"><?=$rs['c_corp_nm']?></td>
	  <td rowspan="2"><?=$rs['c_tel']?></td>
	  <td rowspan="2"><?=$rs_gu_office[0]?></td>
	  <td rowspan="2"><?=$rs_outdoor_act_cate[0]?></td>
	  <td rowspan="2"><?=$rs_outdoor_act_type[0]?></td>
	  <td rowspan="2"><?=$outdoor_real_addr?></td>
	  <td rowspan="2"><?=$size;?></td>
	  <td><?=$rs['real_chkday']?></td>
	  <td><?=$rs_chk_result[0]?></td>
	  <td rowspan="2"><?=$rs['payment_in_day']?></td>
   </tr>
   <tr>
	  <td><?=$chk_person[0]?></td>
	  <td><?=number_format($rs['chk_pay'])?><span class="bold">원</span></td>
   </tr>
<? 
		$size =	"";
		$i++;
		}	//end while
?>
</table>