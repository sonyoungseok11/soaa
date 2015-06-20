<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<Object id='factory' viewastext style='display:none' classid='clsid:1663ed61-23eb-11d2-b92f-008048fdd814' codebase='http://www.meadroid.com/scriptx/scriptX.cab#Version=6,1,432,1'>
 </Object>
<?
//		$tot_cnt = count(explode(",", $_GET['reg_no']));
//
//		for($i=0; $i<$tot_cnt-1; $i++){
//			$reg_no		=	explode(",", $_GET["reg_no"]);
//
//			$joHang1	=	$_GET["joHang1"];
//			$joHang2	=	$_GET["joHang2"];
//
//			$rs			=	fn_select_fetch_array("*", "soaa_reg_check", "reg_no='$reg_no[0]'");
//			$outdoor_act_cate	=	fn_select_fetch_array("ko_nm, en_nm", "common_selectbox", " code='01' and en_nm='" . $rs['outdoor_act_cate'] . "'");
//			$gu_office	=	fn_select_fetch_array("gu_office", "soaa_reg_check", "reg_no='" . $reg_no[$i] . "'");
//			$gu_office	=	fn_select_fetch_array("ko_nm, en_nm", "common_selectbox", "code='10' and en_nm='" . $gu_office[0] . "'");
//
//			$chk_personA	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='" . $rs['chk_personA'] . "'");
//			$chk_personB	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='" . $rs['chk_personB'] . "'");
//
//			//왼쪽 최상단 별지 제x호 서식 출력을 위한 스윗치문
//			switch($gu_office['en_nm']){
//				case "gangseogu":
//					$SeoSikNum = "3";	break;
//				case "dongjackgu":
//					$SeoSikNum = "6";	break;
//				case "guemcheongu":
//					$SeoSikNum = "5";	break;
//			}
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
<link rel="stylesheet" type="text/css" href="../css/admin/print_bigad_spl.css">
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
    	<div class="document_top_title">
			10&nbsp;&nbsp;&nbsp;&nbsp;옥&nbsp;외&nbsp;광&nbsp;고&nbsp;물&nbsp;점&nbsp;검&nbsp;표
			<hr class="title_hr"></hr>
        </div><!--document-->
		<div class="tbl01_head">□&nbsp;&nbsp;광고물&nbsp;개요</div>
		<table class="tbl01">
			<tr>
				<td class="tbl01_title">설치주소<br>(건물명)</td>
				<td class="tbl01_title">종류</td>
				<td class="tbl01_title">수 허가자</td>
				<td class="tbl01_title">최초허가일</td>
				<td class="tbl01_title">허가기간</td>
				<td class="tbl01_title">표출<br>방법</td>
				<td class="tbl01_title">표출내용</td>
			</tr>
			<tr>
				<td class="tbl01_content">신림동 1422번지 6호</td>
				<td class="tbl01_content">옥상</td>
				<td class="tbl01_content">(주)한강에스피</td>
				<td class="tbl01_content">최초허가일</td>
				<td class="tbl01_content">허가기간</td>
				<td class="tbl01_content">표출<br>방법</td>
				<td class="tbl01_content">(주)한강에스피</td>
			</tr>
		</table>
		<div class="tbl_blank"></div>


		<div class="tbl02_head">□&nbsp;&nbsp;항목별&nbsp;점검내용</div>
		<table class="tbl02">
			<tr>
				<td class="tbl02_title01">구&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;분</td>
				<td class="tbl02_title02">점&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;검&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;내&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;용</td>
				<td class="tbl02_title03">점&nbsp;&nbsp;검&nbsp;&nbsp;결&nbsp;&nbsp;과</td>
				<td class="tbl02_title04">비고</td>
			</tr>

			<!--기초부분-->
			<tr>
				<td rowspan="3" class="tbl02_sub01">1.기초부분</td>
				<td class="tbl02_sub02"> ▶ 앵커 등 광고물 고정 시설물 상태</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
				<td class="tbl02_sub02"> ▶ 기초콘크리트 상태</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
				<td class="tbl02_sub02"> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(
				<?
					for($i=0; $i<=50; $i++){
						echo "&nbsp;";
					}
				?>
				)
				</td>
				<td class="tbl02_sub03"> 양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<!--기초부분-->

			<!--철골부분-->
			<tr>
				<td rowspan="3" class="tbl02_sub01">2.철골부분</td>
				<td class="tbl02_sub02"> ▶ 앵글연결분 용접 또는 볼트조임상태</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
				<td class="tbl02_sub02"> ▶ 게시시설에 광고물 게시상태</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
				<td class="tbl02_sub02"> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(
				<?
					for($i=0; $i<=50; $i++){
						echo "&nbsp;";
					}
				?>
				)
				</td>
				<td class="tbl02_sub03"> 양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<!--철골부분-->


			<!--전기설비-->
			<tr>
				<td rowspan="7" class="tbl02_sub01">3.전기설비</td>
				<td class="tbl02_sub02"> ▶ 안전기등 전기설비 부착상태</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
				<td class="tbl02_sub02"> ▶ 전기배선 등 절연 상태</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
				<td class="tbl02_sub02"> ▶ 피뢰침상태</td>
				<td class="tbl02_sub03"> 양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
				<td class="tbl02_sub02"> ▶ 누전차단기 작동여부</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
				<td class="tbl02_sub02"> ▶ 접지시설 상태</td>
				<td class="tbl02_sub03"> 양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
				<td class="tbl02_sub02"> ▶ 전기사용 자재 규격품 사용여부</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
			<td class="tbl02_sub02"> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(
				<?
					for($i=0; $i<=50; $i++){
						echo "&nbsp;";
					}
				?>
				)
				</td>
				<td class="tbl02_sub03"> 양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<!--전기설비-->


			<!--도색상태-->
			<tr>
				<td rowspan="2" class="tbl02_sub01">4.도색상태</td>
				<td class="tbl02_sub02"> ▶ 광고면 페이트 도장상태(미관저해여부)</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
			<td class="tbl02_sub02"> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(
				<?
					for($i=0; $i<=50; $i++){
						echo "&nbsp;";
					}
				?>
				)
				</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<!--도색상태-->


			<!--기타-->
			<tr>
				<td rowspan="3" class="tbl02_sub01">5. 기타</td>
				<td class="tbl02_sub02"> ▶ 설계서 및 시방서와 일치여부</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
				<td class="tbl02_sub02"> ▶ 외관상 구조전문가의 점검 필요하거나 붕괴위험 여부</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<tr>
			<td class="tbl02_sub02"> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(
				<?
					for($i=0; $i<=50; $i++){
						echo "&nbsp;";
					}
				?>
				)
				</td>
				<td class="tbl02_sub03">양호</td>
				<td class="tbl02_sub04">비고</td>
			</tr>
			<!--기타-->
		</table>
		<div class="tbl_blank_year">
		
		<div class="today">
			<?
				echo date("Y");
				echo "&nbsp;.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo date("m");
				echo "&nbsp;&nbsp;.&nbsp;&nbsp;";
				echo date("d");
			?>
		</div>
		<div class="chk_person">점검자<br>점검자<br>점검자</div>
		<div class="chk_sosok">소속<br>소속<br>소속</div>
		<div class="corp_nm">서울특별시옥외광고협회<br>서울특별시옥외광고협회</div>
		<div class="name">성명<br>성명<br>성명</div>
		<div class="sawon_nm">차형석<br>정수영<br></div>
		<div class="dojang">(인)<br>(인)<br>(인)</div>
    </div><!--wrap-->
</body>
</html>

<?// } ?>