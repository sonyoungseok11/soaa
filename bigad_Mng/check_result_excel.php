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
		<th>순번</th>
		<th>광고주명</th>
		<th>종류</th>
		<th>규격</th>
		<th>표시장소</th>
		<th>표시내용</th>
		<th>점검일자</th>
		<th>안전점검자</th>
		<th>등급</th>
		<th>점검내용</th>
	</tr>
   <!--2개의 tr이 한 세트-->

   <?
		$where .= " order by reg_no desc";
		$result = fn_select("*", "bigad_SoaaRegCheck", $where);
		
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

			$rs_gu_office	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='10' and en_nm='$lst_gu_office'");
			$chk_person		=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='$chk_person'");
			$rs_outdoor_act_cate	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='01' and en_nm='$lst_outdoor_act_cate'");
			$rs_outdoor_act_type	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='05' and en_nm='$lst_outdoor_act_type'");
			$rs_chk_result				=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='30' and en_nm='$lst_chk_result'");

			$chk_personA		=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='" . $rs['chk_personA'] . "'");
			$chk_personB		=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='" . $rs['chk_personB'] . "'");

			$manual_insert		=	fn_select_fetch_array("manual_insert", "bigad_PrintPage", "reg_no='" . $rs['reg_no'] . "'");
			switch($manual_insert['manual_insert']){
				case "Y":
					$manual_insert = "<font color=red><b>특이사항있음</b></font>";
					break;
				case "N":
					$manual_insert = "특이사항없음";
					break;
				default :
					$manual_insert = "특이사항없음";
					break;
			}
	?>
   <tr>
	  <!-- fetch_array 는 배열 형태로 리턴값을 반환하므로 [0] 을 써줘야함.-->
      <td class="receive_num"><?=$i?></td>
	<td class="offeror"><?=$rs["c_corp_nm"]?></td>
	<td class="corp_name"><?=$rs_outdoor_act_cate[0]?></td>
	<td class="locate"><?=$size?></td>
	<td class="ads_type"><?=$rs['outdoor_real_addr']?></td>
	<td class="standard"><?=$rs["c_corp_nm"]?></td>
	<td class="check_date"><?=$rs['real_chkday']?></td>
	<td class="check_result">
	<?
		echo $chk_personA[0];
		if($chk_personB[0]){
			echo "," . $chk_personB[0];
		}

	?></td>
	<td class="inspector"><?=$rs['bigad_Grade']?></td>
	<td class="manual_insert"><?=$manual_insert?></td>
   </tr>
<? 
		$size =	"";
		$i++;
		}	//end while
?>
</table>