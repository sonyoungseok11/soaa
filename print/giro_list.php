<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="/css/admin/print_giro_list.css">
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

	if($where){
		$result	=	fn_select("*", "confirm_list", "$where order by insert_date desc");
	}else{
		$result	=	fn_select_orderby("*", "confirm_list", "insert_date desc");
	}

	$i=1;		//No
	$cut_no=0;	//타이틀 표시 (페이징으로 출력하기 위해 일부러 제목을 구분선으로 넣음-원본 사이트에서 보고 따라함)

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
		$search_rs	=	fn_select_fetch_array("c_ceo_nm", "soaa_reg_check", "c_ceo_nm='$c_ceo_nm' and c_corp_nm='$c_corp_nm' and gu_office='$gu_office'");

		if($search_rs){
			$chk_rs = "확인";
		}else{
			$chk_rs = "미확인";
		}

		if($cut_no == $select_page_num+1 || $cut_no == 0){
			$cut_no =1;
	?>

	<div class="title">입금&nbsp;입력&nbsp;목록</div>
	<!--<div class="search_option">[검색기간]&nbsp;<?=$select_gigan_y;?>년&nbsp;<?=$select_gigan_m;?>월</div>-->

		<table class="tbl">
		   <tr>
				<th class="no">No</th>
				<th class="corp_nm">업체명</th>
				<th class="ceo_nm">성명</th>
				<th class="gu_office">해당구</th>
				<th class="tel">연락처</th>
				<th class="payment">금액</th>
				<th class="input_pay_type">구분</th>
				<th class="confirm">확인여부</th>
				<th class="payment_in_date">입금날짜</th>
				<th class="refund">환불</th>
		   </tr>
		</table>

		<?
		}//End if
		?>

		<table class="tbl">
			<tr>
			  <!-- fetch_array 는 배열 형태로 리턴값을 반환하므로 [0] 을 써줘야함.-->
				<td class="no"><?=$i;?></td>
				<td class="corp_nm"><?=$rs['c_corp_nm']?></td>
				<td class="ceo_nm"><?=$rs['c_ceo_nm']?></td>
				<td class="gu_office"><?=$rs_office[0];?></td>
				<td class="tel"><?=$rs['c_tel']?></td>
				<td class="payment"><?=number_format($rs['chk_pay'])?><span class="bold">원</span></td>
				<td class="input_pay_type"><?=$input_pay_type;?></td>
				<td class="confirm"><?=$chk_rs?></td>
				<td class="payment_in_date"><?=$input_date[0];?></td>
				<td class="refund"></td>
			</tr>
		</table>

<? 
		$i++;
		$cut_no++;
		}	//end while
?>

<!--2개의 tr이 한 세트-->