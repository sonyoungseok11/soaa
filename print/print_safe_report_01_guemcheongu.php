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

			$rs			=	fn_select_fetch_array("*", "soaa_reg_check", "reg_no='$reg_no[$i]'");
			$outdoor_act_cate	=	fn_select_fetch_array("ko_nm, en_nm", "common_selectbox", " code='01' and en_nm='" . $rs['outdoor_act_cate'] . "'");
			$gu_office	=	fn_select_fetch_array("gu_office", "soaa_reg_check", "reg_no='" . $reg_no[$i] . "'");
			$gu_office	=	fn_select_fetch_array("ko_nm, en_nm", "common_selectbox", "code='10' and en_nm='" . $gu_office[0] . "'");

			if($outdoor_act_cate['en_nm'] == "oksang" || $outdoor_act_cate['en_nm'] == "garo"){
				for($j=0; $j<=7; $j++){
					if($j<=6){
						$size .= $rs['outdoor_size' . $j] . "*";
					}else{
						$size .= $rs['outdoor_size' . $j];
					}
				}
			}
			

			//왼쪽 최상단 별지 제x호 서식 출력을 위한 스윗치문
			switch($gu_office['en_nm']){
				case "gangseogu":
					$SeoSikNum = "3";	break;
				case "dongjackgu":
					$SeoSikNum = "6";	break;
				case "guemcheongu":
					$SeoSikNum = "5";	break;
			}
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
<link rel="stylesheet" type="text/css" href="../css/admin/print_safe_report_01_guemcheongu.css">
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
    	<div class="document_left">
		[별지 제<?=$SeoSikNum?>호 서식]<개정 2013.8.9>
        </div><!--document-->
    	<div class="document_right">
			<div class="document_right_1">※ □에는 해당되는 곳에 ✓표를 합니다.</div>
			<div class="document_right_2"><앞면></div>

        </div><!--document-->
		<div style="clear:both"></div>
		<table class="tbl">
			<tr>
				<td class="title">옥 외 광 고 물 등&nbsp;&nbsp;&nbsp;안 전 점 검&nbsp;&nbsp;&nbsp;검 사 서</td>
			</tr>
		</table>
		<table class="tbl01">
			<tr>
				<td rowspan="4" class="left">신<br>청<br>인<br></td>
			</tr>
			<tr>
				<td class="sub_title">&nbsp;성&nbsp;&nbsp;&nbsp;&nbsp;명</td>
				<td class="blank"><?=$rs['c_ceo_nm']?></td>
				<td class="sub_title">주민등록번호</td>
				<td class="blank"><?=$rs['c_rrn1']?> - *******</td>
			</tr>
			<tr>
				<td class="sub_title">&nbsp;업&nbsp;소&nbsp;명</td>
				<td class="blank"><?=$rs['c_corp_nm']?></td>
				<td class="sub_title">&nbsp;검&nbsp;사&nbsp;구&nbsp;분</td>
				<td class="blank">□&nbsp;&nbsp;신규, □&nbsp;&nbsp;연장, □&nbsp;&nbsp;변경</td>
			</tr>
			<tr>
				<td class="sub_title">&nbsp;주&nbsp;&nbsp;&nbsp;&nbsp;소</td>
				<td colspan="3" class="addr"><?=$rs['c_addr']?></td>
			</tr>
			<tr>
				<td colspan="2" class="sub_title07">광고물등허가<br>일자 및 번호</td>
				<td class="blank"></td>
				<td class="sub_title07"> 광고물종류<br>(사용조명)</td>
				<td class="blank">
					<?
						echo $outdoor_act_cate['ko_nm'];

						echo "<br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						if($rs['use_item'] <> ""){
							echo $rs['use_item'];
						}
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)";
						?>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="sub_title07">표시위치 또는<br>장&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;소</td>
				<td class="blank"><?=$rs['outdoor_real_addr']?></td>
				<td class="sub_title07">광고물등의규격<br>(m)</td>
				<td class="blank"><?=$size;?></td>
			</tr>
			<tr>
				<td colspan="2" class="sub_title">신&nbsp;&nbsp;&nbsp;청&nbsp;&nbsp;&nbsp;일&nbsp;&nbsp;&nbsp;자</td>
				<td class="blank"><?=$rs['reg_date']?></td>
				<td class="sub_title">검&nbsp;&nbsp;사&nbsp;&nbsp;일&nbsp;&nbsp;자</td>
				<td class="blank"><?=$rs['real_chkday']?></td>
			</tr>
			<tr>
				<td colspan="2" class="sub_title">검&nbsp;&nbsp;&nbsp;사&nbsp;&nbsp;&nbsp;항&nbsp;&nbsp;&nbsp;목</td>
				<td colspan="3" class="blank"> 뒷면기재(당해 광고물등에 해당되는 항목을 검사함)</td>
			</tr>
			<tr>
				<td colspan="2" class="sub_title07">검&nbsp;&nbsp;&nbsp;사&nbsp;&nbsp;&nbsp;의&nbsp;&nbsp;&nbsp;견<br>(종&nbsp;&nbsp;&nbsp;합&nbsp;&nbsp;&nbsp;의&nbsp;&nbsp;&nbsp;견)</td>
				<td colspan="3" class="blank"></td>
			</tr>
			<tr>
				<td colspan="2" class="sub_title">안&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;전&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;도</td>
				<td colspan="3" class="blank">□ 합격, □ 불합격</td>
			</tr>
			<tr>
				<td colspan="6" class="content">
				<div class="h15"></div>
				<div class="content_comment">
			「옥외광고물 등 관리법 시행령」 <?=$joHang1;?> 및 「서울특별시 <?=$gu_office[0]?> 옥외광고물 등 관리 조례」<br><?=$joHang2;?>의 규정에 의하여 안전도검사를 위와 같이 실시 하였음을 확인합니다.
				</div>
				<div class="chk_year">년&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;월&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;일<br><br></div>
				<div class="chk_confirm1">점검자</div>
				<div class="chk_confirm2">소속 : <br>직위 : <br>성명:</div>
				<div class="chk_confirm3">(서명 또는 인)</div>

				<div class="chk_guoffice"><b>안전점검 실시기관장</b></div>
				<div class="chk_guoffice_stamp"><img src="/img/stamp.png" width="90" height="90"></div>
				</td>
			</tr>
		</table>
    </div><!--wrap-->
</body>
</html>

<? } ?>