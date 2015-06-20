<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="/css/admin/print_soaa_mng_list.css">
<?

//##################
// POST 또는 GET으로 받을때 reg_no 로 받거나 보내면
// &c_ceo_nm=경숙®_ 처럼 특수문자가 붙음... (페이지 링크 -> common.js->function navi_mng_list -> soaa_mng_list)
// 부득이하게 rega_no 로 임시처리함.
//###################
if($_POST['select_gigan_y'] <> "" ||$_POST['select_gigan_m'] <> "" || $_POST['st_date'] <> "" || $_POST['ed_date'] <> ""
|| $_POST['gu_office'] <> "" || $_POST['c_corp_nm'] <> "" || $_POST['c_ceo_nm'] <> "" || $_POST['rega_no'] <> "" || $_POST['chk_personA'] <> "" 
|| $_POST['outdoor_act_cate'] <> ""|| $_POST['payment_state'] <> "" || $_POST['report_certi'] <> ""  || $_POST['chk_result'] <> "" || $_POST["select_page_num"] <> ""){

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

	include "../safeChk_Mng/soaa_mng_list_where.php";
}else{

	$select_gigan_y	=	$_GET['select_gigan_y'];
	$select_gigan_m	=	$_GET['select_gigan_m'];
	$st_date	=	$_GET['st_date'];
	$ed_date	=	$_GET['ed_date'];

	$gu_office	=	$_GET['gu_office']; 
	$c_corp_nm	=	$_GET['c_corp_nm'];
	$c_ceo_nm	=	$_GET['c_ceo_nm'];

	$rega_no		=	$_GET['rega_no'];
	$chk_personA	=	$_GET['chk_personA']; 
	$outdoor_act_cate	=	$_GET['outdoor_act_cate'];

	$payment_state	=	$_GET['payment_state'];
	$report_certi	=	$_GET['report_certi'];
	$chk_result	=	$_GET['chk_result'];
	$select_page_num	=	$_GET["select_page_num"];

	include "../safeChk_Mng/soaa_mng_list_where.php";
}

	if($where == ""){
		//최초에는 빈 화면만 띄워줌.
		$tot_cnt = 0;
		$rs_sum_total = 0;
	}else{
		$tot_cnt = fn_select_cnt("reg_no", "soaa_reg_check", $where);
		$rs_sum_total = fn_total_sum("chk_pay", "soaa_reg_check", $where);
	}

	$page	=	$_GET["page"];

	if (!$page) $page = 1;

	if(!$select_page_num){
		$select_page_num = 5;
	}
	$page_cnt = 10;



	$list_num = $select_page_num; //y축 갯수
	$tot_page_num = ceil($tot_cnt / $select_page_num);	//x축 갯수

	$offset = $list_num	*	($page-1);

	$total_page = ceil($tot_cnt / $select_page_num);
	$total_block = ceil($total_page / $page_cnt);
	$block = ceil($page / $page_cnt);
?>
<?

	if($where == ""){
		$where .= " insert_id is not null order by reg_no desc";
		$result = fn_select("*", "soaa_reg_check", $where);
	}else{
		$where .= " and insert_id is not null order by reg_no desc";
		$result = fn_select("*", "soaa_reg_check", $where);
	}

	$i=1;		//No
	$cut_no=0;	//타이틀 표시 (페이징으로 출력하기 위해 일부러 제목을 구분선으로 넣음-원본 사이트에서 보고 따라함)

	while($rs = mysql_fetch_array($result)){

		$lst_gu_office			=	$rs['gu_office'];
		$lst_outdoor_act_cate	=	$rs['outdoor_act_cate'];

		$real_chkday			=	$rs['real_chkday'];
		if(!$real_chkday){
			$real_chkday = "&nbsp";
		}

		$chk_personA			=	$rs['chk_personA'];
		if(!$chk_personA){
			$chk_personA = "&nbsp";
		}

		$chk_pay				=	$rs['chk_pay'];
		if(!$chk_pay){
			$chk_pay = "&nbsp";
		}

		$memo1					=	$rs['memo1'];
		if(!$memo1){
			$memo1 = "&nbsp";
		}


		$size	=	"";
		if($lst_outdoor_act_cate == "oksang" || $lst_outdoor_act_cate == "garo"){
			for($j=0; $j<=7; $j++){
				if($j<=6){
					$size .= $rs['outdoor_size' . $j] . "*";
				}else{
					$size .= $rs['outdoor_size' . $j];
				}
			}
		}

		if(!$size){
			$size = "&nbsp";
		}

		$lst_outdoor_act_type	=	$rs['outdoor_act_type'];
		$lst_chk_result			=	$rs['chk_result'];
		$lst_outdoor_real_addr	=	str_replace("서울특별시 ", "", $rs['outdoor_real_addr']);

		$rs_gu_office	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='10' and en_nm='$lst_gu_office'");
		$rs_outdoor_act_cate	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='01' and en_nm='$lst_outdoor_act_cate'");
		$rs_outdoor_act_type	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='05' and en_nm='$lst_outdoor_act_type'");
		$rs_chk_result				=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='30' and en_nm='$lst_chk_result'");

		if(!$rs_chk_result[0]){
			$rs_chk_result[0]	=	"&nbsp;";
		}


		if($cut_no == $select_page_num+1 || $cut_no == 0){
			$cut_no =1;
	?>

	<div class="title">안전&nbsp;점검&nbsp;관리대장<?=$i?></div>
	<div class="search_option">[검색기간]&nbsp;<?=$select_gigan_y;?>년&nbsp;<?=$select_gigan_m;?>월</div>

		<table class="tbl" border="1">
		<!--
			<colgroup>
				<col width="50px">
				<col width="100px">
				<col width="70px">

				<col width="50px">
				<col width="150px">
				<col width="100px">

				<col width="70px">
				<col width="100px">
				<col width="80px">
				<col width="250px">

				<col width="140px">
				<col width="70px">
				<col width="70px">
			</colgroup>
		-->
		   <tr>
				<th rowspan="2" class="no">No</th>
				<th rowspan="2" class="receive_num">접수번호</th>
				<th rowspan="2" class="date">신청일자</th>
				<th rowspan="2" class="name">성명</th>
				<th rowspan="2" class="corp_name">업소명</th>
				<th rowspan="2" class="tel">전화번호</th>
				<th rowspan="2" class="guchung_name">구청명</th>
				<th rowspan="2" class="ads_type">광고물종류</th>
				<th rowspan="2" class="sort">형식</th>
				<th rowspan="2" class="locate">표시위치</th>
				<th rowspan="2" class="size">표시규격</th>
				<th class="check_con01">검사일자</th>
				<th class="check_con02">검사결과</th>
				<th rowspan="2" class="memo">비고</th>
		   </tr>
		   <tr>
				<th class="check_con01">검사자</th>
				<th class="check_con02">수수료</th>
		   </tr>
		<?
		}
		?>

			<tr>
			  <!-- fetch_array 는 배열 형태로 리턴값을 반환하므로 [0] 을 써줘야함.-->
			  <td rowspan="2" class="no"><?=$i;?></td>
			  <td rowspan="2" class="receive_num"><?=$rs['reg_no']?></td>
			  <td rowspan="2" class="date"><?=$rs['reg_date']?></td>
			  <td rowspan="2" class="name"><?=$rs['c_ceo_nm']?></td>
			  <td rowspan="2" class="corp_name"><?=$rs['c_corp_nm']?></td>
			  <td rowspan="2" class="tel"><?=$rs['c_tel']?></td>
			  <td rowspan="2" class="guchung_name"><?=$rs_gu_office[0]?></td>
			  <td rowspan="2" class="ads_type"><?=$rs_outdoor_act_cate[0]?></td>
			  <td rowspan="2" class="sort"><?=$rs_outdoor_act_type[0]?></td>
			  <td rowspan="2" class="locate"><?=$lst_outdoor_real_addr?></td>
			  <td rowspan="2" class="size"><?=$size;?></td>
			  <td class="check_con01">2015-01-01<?=$real_chkday?></td>
			  <td class="check_con02">합격<?=$rs_chk_result[0]?></td>
			  <td rowspan="2" class="memo"><?=$memo1?></td>
			</tr>
			<tr>
			  <td class="check_con01">손용석<?=$chk_personA?></td>
			  <td class="check_con02"><?=number_format($chk_pay)?><span class="bold">원</span></td>
			</tr>

<? 
	
			$i++;
			$cut_no++;
		
		}	//end while
?>
		</table>
<!--2개의 tr이 한 세트-->