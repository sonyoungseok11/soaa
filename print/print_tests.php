<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<?
		$tot_cnt = count(explode(",", $_GET['reg_no']));

		for($i=0; $i<$tot_cnt-1; $i++){
			$reg_no		=	explode(",", $_GET["reg_no"]);

			$joHang1	=	$_GET["joHang1"];
			$joHang2	=	$_GET["joHang2"];

			$rs			=	fn_select_fetch_array("*", "soaa_reg_check", "reg_no='$reg_no[0]'");
			$outdoor_act_cate	=	fn_select_fetch_array("ko_nm, en_nm", "common_selectbox", " code='01' and en_nm='" . $rs['outdoor_act_cate'] . "'");
			$gu_office	=	fn_select_fetch_array("gu_office", "soaa_reg_check", "reg_no='" . $reg_no[$i] . "'");
			$gu_office	=	fn_select_fetch_array("ko_nm, en_nm", "common_selectbox", "code='10' and en_nm='" . $gu_office[0] . "'");
			$chk_personA	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='" . $rs['chk_personA'] . "'");
			$chk_personB	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='" . $rs['chk_personB'] . "'");

//			if($outdoor_act_cate['en_nm'] == "oksang" || $outdoor_act_cate['en_nm'] == "garo"){
//				for($j=0; $j<=7; $j++){
//					if($j<=6){
//						$size .= $rs['outdoor_size' . $j] . "*";
//					}else{
//						$size .= $rs['outdoor_size' . $j];
//					}
//				}
//			}
			

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
<link rel="stylesheet" type="text/css" href="../css/admin/print_tests.css">
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
<body onload="ThisWin11dowsPrint('sero','0','0','0','0');">
<Object id='factory' viewastext style='display:none' classid='clsid:1663ed61-23eb-11d2-b92f-008048fdd814' codebase='http://www.meadroid.com/scriptx/scriptX.cab#Version=6,1,432,1'>
 </Object>
	<div id="wrap">
    	<div class="document_left">
			<div class="document_left1">
			■&nbsp;옥외광고물 등 관리법 시행령&nbsp;[별지 제 4호서식] <개정 2011.10.10>
			</div>
			<div class="document_left2">
			제 <?=$rs['reg_no']?> 호		
			</div>
        </div><!--document-->

		<div style="clear:both"></div>
		<table class="tbl">
			<tr>
				<td class="title">옥 외 광 고 물 등&nbsp;&nbsp;&nbsp;안 전 점 검 검 사 서</td>
			</tr>
		</table>
		<table class="tbl01">
			<tr>
				<td rowspan="4" class="tbl01_owner">신&nbsp;청&nbsp;자</td>
			</tr>
			<tr>
				<td class="tbl01_name">성명
					<div class="tbl01_content">한지웅</div>
				</td>
				<td class="tbl01_juMin">주민등록번호
					<div class="tbl01_content"><?=$rs['c_rrn1']?> - *******</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="tbl01_corpNm">업소명
					<div class="tbl01_content"><?=$rs['c_corp_nm']?></div>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="tbl01_addr">주소
					<div class="tbl01_content"><?=$rs['c_addr']?></div>
				</td>
			</tr>
		</table>

		<div class="tbl_blank">&nbsp;</div>

		<table class="tbl02">
			<tr>
				<td class="tbl02_accept">광고물등 허가일 및 번호
					<div class="tbl02_content">&nbsp;</div>
				</td>
				<td class="tbl02_cate">광고물등의 종류
					<div class="tbl02_content"><?=$outdoor_act_cate[0]?></div>
				</td>
				<td class="tbl02_useItem">사용자재
					<div class="tbl02_content">
						<? 
							if($rs['use_item'] == ""){ 
								echo "&nbsp;";
							}else{
								echo $rs['use_item'];
							}
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="tbl02_addr">표시 위치 또는 장소
					<div class="tbl02_content">
						<? 
							if($rs['outdoor_real_addr'] == ""){ 
								echo "&nbsp;";
							}else{
								echo $rs['outdoor_real_addr'];
							}
						?>
					</div>
				</td>
				<td class="tbl02_size" colspan="2">광고물등의 규격
					<div class="tbl02_content">
						<? 

							for($i=0; $i<=7; $i++){
								if($rs["outdoor_size" . $i] <> ""){ 
									$size .= $rs["outdoor_size" . $i];
								}

								if($i % 2 == 0 && $rs["outdoor_size" . $i] <> ""){
									$size .= "x";
								}
								if($i % 2 == 1 && $rs["outdoor_size" . $i] <> ""){
									$size .= " , ";
								}
							}
							echo $size;
						?>
					</div>
				</td>
			</tr>
		</table>

		<div class="tbl_blank">&nbsp;</div>

		<table class="tbl03">
			<tr>
				<td rowspan="3" class="tbl03_owner">시공업자</td>
			</tr>
			<tr>
				<td class="tbl03_ceo">대표자
					<div class="tbl03_content">
						<? 
							if($rs['s_ceo_nm'] <> ""){
								echo $rs['s_ceo_nm'];	
							}else{
								echo "&nbsp;";
							}
						?>
					</div>
				</td>
				<td class="tbl03_sinGoNum">신고번호
					<div class="tbl03_content">
						&nbsp;
					</div>
				</td>
			</tr>
			<tr>
				<td class="tbl03_corpNm">업소명
					<div class="tbl03_content">
						<?
							if($rs['s_corp_nm'] <> ""){
								echo $rs['s_corp_nm'];
							}else{
								echo "&nbsp";
							}
						?>
					</div>
				</td>
				<td class="tbl03_addr">주소
					<div class="tbl03_content">
						<?
							if($rs['s_addr'] <> ""){
								echo $rs['s_addr'];
							}else{
								echo "&nbsp;";
							}
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="tbl03_result">검사결과
					<div class="tbl03_content">
					<?
						if($rs['chk_result'] <> "NonChk"){
							$chk_result = "합격";
						}else{
							$chk_result = "<font color='#e80005'>미검사</font>";
						}
						
						if($rs['chk_result'] == ""){
							$chk_result = "&nbsp;";
						}

						echo $chk_result;
					?>
					</div>
				</td>
			</tr>
		</table>
		<div class="confirmCommnet">
		「옥외광고물 등 관리법」 제 9조 및 같은 법 시행령 제 37조 1항에 따라서 위와 같이 안전점검을 하였음을 확인합니다.
		</div>

		<div class="today">
			<?
				echo $year . "년&nbsp;&nbsp;" . $month . "월&nbsp;&nbsp;" . $day . "일";
			?>
		</div>
		<div class="chkCompany">
			위&nbsp;탁&nbsp;검&nbsp;사&nbsp;기&nbsp;관 : &nbsp; <b><font size="4px">(사)서울특별시옥외광고협회</font>
			</b><div class="stamp"><img src="/img/stamp.png" width="90" height="90"></div>
		</div>
		<div class="chkPerson">검사요원 직위 : 안전점검원</div>
		<div class="chkPersonNm">성명 : 
			<?
				if($chk_personA[0] <> ""){
					echo $chk_personA[0];
				}
				if($chk_personB[0] <> ""){
					echo "," . $chk_personB[0];
				}
			?>
		</div>
		<div class="gu_office">
			<b><?=$gu_office[0]?>청장&nbsp;&nbsp;귀하</b>
		</div>
		<hr class="hr">
		<!--
			<tr>
				<td colspan="6" class="content">
				<div class="h15"></div>
				<div class="content_comment">
			「옥외광고물 등 관리법 시행령」 <?=$joHang1;?> 및 「서울특별시 <?=$gu_office[0]?> 옥외광고물 등 관리 조례」<br><?=$joHang2;?>의 규정에 의하여 안전도검사를 위와 같이 실시 하였음을 확인합니다.
				</div>
				<div class="chk_year">년&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;월&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;일<br><br></div>
				<div class="chk_confirm">
				위&nbsp;&nbsp;&nbsp;&nbsp;탁&nbsp;&nbsp;&nbsp;&nbsp;검&nbsp;&nbsp;&nbsp;&nbsp;사&nbsp;&nbsp;&nbsp;&nbsp;기&nbsp;&nbsp;&nbsp;&nbsp;관(단체,법인)&nbsp;&nbsp;&nbsp;(인)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
				검사원&nbsp;&nbsp;&nbsp;&nbsp;직위 : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;성명 : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(인)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br><br>
				</div>
				<div class="chk_guoffice"><b>서울특별시&nbsp;<?=$gu_office[0]?>청장&nbsp;&nbsp;</b></div><div class="chk_guoffice_to">귀하</div>
				</td>
			</tr>
	
		</table>
		-->
    </div><!--wrap-->
</body>
</html>

<? } ?>