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
	</style>
</head>
<?
		$select_gigan_y	=	$_POST['select_gigan_y'];	//기간선택 년도
		$select_gigan_m	=	$_POST['select_gigan_m'];	//기간선택 월

		$st_date	= $_POST['st_date'];	//시작날짜
		$ed_date	= $_POST['ed_date'];	//종료날짜
		$gu_office	= $_POST['gu_office'];	//구청
		$c_corp_nm	= $_POST['c_corp_nm'];	//업소명
		$c_ceo_nm	= $_POST['c_ceo_nm'];	//성명
		$rega_no	= $_POST['rega_no'];	//접수번호
		$chk_personA	= $_POST['chk_personA'];  //검사자
		$outdoor_real_addr	= $_POST["outdoor_real_addr"]; //설치장소검색
		$outdoor_act_cate	= $_POST['outdoor_act_cate'];  //광고물종류
		$payment_state	= $_POST['payment_state'];   
		$report_certi	= $_POST['report_certi'];    
		$chk_result	= $_POST['chk_result'];   

		if($select_gigan_m > 0 && $select_gigan_m <= 9){
			$select_gigan_m = "0" . $select_gigan_m;
		}
		$gigan	=	$select_gigan_y . "-" . $select_gigan_m;

		include "./soaa_mng_list_where.php";

		$where .= " order by reg_no desc";
?>
<table>
	<tr>
		<th colspan="14">안전 점검 관리대장</td>
	</tr>
	<tr>
		<th colspan="8" align="left">[검색기간]<?=$select_gigan_y?>년<?=$select_gigan_m?>월</td>
	</tr>
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
		$result = fn_select("*", "bigad_SoaaRegCheck", $where);
		
		$i=1;
		while($rs = mysql_fetch_array($result)){

			$lst_gu_office	=	$rs['gu_office'];
			$lst_outdoor_act_cate	=	$rs['outdoor_act_cate'];

			if($lst_outdoor_act_cate == "oksang" || $lst_outdoor_act_cate == "garo"){
				for($i=0; $i<=7; $i++){
					if($i<7){
						$size .= $rs['outdoor_size' . $i] . "*";
					}else{
						$size .= $rs['outdoor_size' . $i];
					}
				}
			}

			$lst_outdoor_act_type	=	$rs['outdoor_act_type'];
			$lst_chk_result	=	$rs['chk_result'];
			$lst_outdoor_real_addr	=	str_replace("서울특별시 ", "", $rs['outdoor_real_addr']);
			
			$rs_gu_office	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='10' and en_nm='$lst_gu_office'");
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
	  <td rowspan="2"><?=$rs['outdoor_real_addr']?></td>
	  <td rowspan="2"><?=$size;?></td>
	  <td><?=$rs['real_chkday']?></td>
	  <td><?=$rs_chk_result[0]?></td>
	  <td rowspan="2"><?=$rs['payment_in_day']?></td>
   </tr>
   <tr>
	  <td><?=$rs['chk_personA']?></td>
	  <td><?=number_format($rs['chk_pay'])?><span class="bold">원</span></td>
   </tr>
<? 
		$i++;
		}	//end while
?>
</table>

