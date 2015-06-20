<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<Object id='factory' viewastext style='display:none' classid='clsid:1663ed61-23eb-11d2-b92f-008048fdd814' codebase='http://www.meadroid.com/scriptx/scriptX.cab#Version=6,1,432,1'>
 </Object>
<?
		$tot_cnt = count(explode(",", $_GET['reg_no']));

		for($i=0; $i<$tot_cnt-1; $i++){
		$reg_no		=	explode(",", $_GET["reg_no"]);

		$joHang1	=	$_GET["joHang1"];
		$joHang2	=	$_GET["joHang2"];


		$rs	=	fn_select_fetch_array("*", "soaa_reg_check", "reg_no='" . $reg_no[$i] . "'");

		$outdoor_cate	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='01' and en_nm='" . $rs['outdoor_act_cate'] . "'");
		$gu_office	=	fn_select_fetch_array("gu_office", "soaa_reg_check", "reg_no='" . $reg_no[$i] . "'");
		$gu_office	=	fn_select_fetch_array("ko_nm, en_nm", "common_selectbox", "code='10' and en_nm='" . $gu_office[0] . "'");

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<title>print_nosign</title>
<!--[if lt IE 9]>
<script src="../js/html5shiv.js"></script>
<![endif]-->
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<link rel="stylesheet" type="text/css" href="../css/admin/reset.css">
<link rel="stylesheet" type="text/css" href="../css/admin/print_safe_report_02.css">
<link rel="stylesheet" type="text/css" href="../css/font.css">
<script type="text/javascript">
document.createElement('address');
document.createElement('header');
document.createElement('article');
document.createElement('aside');
document.createElement('figure');
document.createElement('footer');
document.createElement('hgroup');
document.createElement('nav');
document.createElement('section');
document.createElement('menu');
</script>
<script type="text/javascript" src="/js/common.js"></script>
</head>
<body onload="ThisWindowsPrint('sero','0','0','0','0');">
	<div id="wrap">
		<div class="no6style">[별지 제6호서식]</div>
    	<div class="document">옥외광고물 등 안전점검 검사서</div><!--document-->
		<div class="tbl_left_comment">※[&nbsp;&nbsp;&nbsp;&nbsp;]에는 해당되는곳에 ✓표를 합니다.</div>
		<div class="tbl_right_comment">(앞 쪽)</div>

		<table class="tbl01" border="1">
			<tr>
				<td rowspan="4" class="tbl01_left">신청인</td>
			</tr>
			<tr>
				<td class="c_ceo_nm">성명
					<div class="tbl01_content">
						<?=$rs['c_ceo_nm']?>
					</div>
				</td>
				<td class="c_rrn1">주민등록번호
					<div class="tbl01_content">
						<?=$rs['c_rrn1']?> - *******
					</div>
				</td>
			</tr>
			<tr>
				<td class="c_corp_nm">업소명
					<div class="tbl01_content">
						<?=$rs['c_corp_nm']?>
					</div>
				</td>
				<td class="c_tel">전화번호
					<div class="tbl01_content">
						<?=$rs['c_tel']?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="c_addr">주소
					<div class="tbl01_content">
						<?=$rs['c_addr']?>
					</div>
				</td>
				<td class="gubun">
					검사구분
					<div class="chkStats">[&nbsp;&nbsp;&nbsp;&nbsp;]신규&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;&nbsp;]연장&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;&nbsp;]변경</div>
				</td>
			</tr>
		</table>
		<div class="h15"></div>

		<table class="tbl02">
			<tr>
				<td class="acceptNo">광고물 등의 허가 일자 및 번호
					<div class="tbl03_content">
						&nbsp;
					</div>
				</td>
				<td class="cate">광고물 등의 종류
					<div class="tbl03_content">
						<?=$outdoor_cate['ko_nm']?>
					</div>
				</td>

			</tr>
			<tr>
				<td class="outdoor_addr">표시위치 또는 장소
					<div class="tbl03_content">
						<?=$rs['outdoor_real_addr']?>
					</div>
				</td>
				<td class="size">광고물 등의 규격
				
				</td>

			</tr>
			<tr>
				<td class="reg_date">신청일자
					<div class="tbl03_content">
						<?=$rs['reg_date']?>
					</div>
				</td>
				<td class="chk_date">검사일자
					<div class="tbl03_content">
						<?=$rs['real_chkday']?>
					</div>
				</td>
			</tr>
		</table>
		<div class="h15"></div>

		<table class="tbl03">
			<tr>
				<td class="chkContent">점검내용</td>
			</tr>
			<tr>
				<td class="chkComment">점검의견</td>
			</tr>
			<tr>
				<td class="chkResult1">
					<div class="chkResult2">점검결과</div>
					<div class="chkResult3">[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;] 합격 [&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;] 불합격</div>
				</td>
			</tr>
		</table>
			<div class="content_comment">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;「옥외광고물 등 관리법 시행령」 <?=$joHang1;?> 및 「서울특별시 <?=$gu_office[0];?> 옥외광고물 등 관리 조례」 <?=$joHang2;?>에 따라&nbsp;옥외광고물 등 안전점검을 위와 같이 실시하였음을 확인합니다.<br>
			</div>
			<div class="chk_year">년&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;월&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;일<br><br></div>
			<div class="chk_confirm">검사자 소속</div>
			<div class="chk_position">직위(직명)</div>
			<div class="chk_person_nm">성명</div>
			<div class="chk_person_nm_sign">(서명 또는 인)</div>
            <div class="line"></div>
    </div><!--wrap-->
</body>
</html>
<? } ?>