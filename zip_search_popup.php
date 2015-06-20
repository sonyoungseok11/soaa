<?

$num = $_GET["num"];

$db_host = "localhost"; 
$db_user = "soaa"; 
$db_passwd = "2013";
$db_name = "doro_zipcode"; 
$conn = mysql_connect($db_host,$db_user,$db_passwd);
mysql_select_db($db_name);

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");
$db_name = "soaa"; 
	$dong = $_GET["dong"];
	$sido = $_GET["sido"];
	$page = $_GET["page"];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>zip code</title>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->
<link rel="stylesheet" href="/css/admin/reset.css">
<link rel="stylesheet" href="/css/admin/zip_code.css">
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
<body>
<div id="wrapper">
	<form name="form" method="get">
		<input type="hidden" name="num" value="<?=$num?>">
		<div class="top_box">
			<p>우편번호 검색</p>
		</div>
		
		<div class="center_box">
			<div class="mix">
				<img src="/img/grayishpurple_3.png" alt="">
				<p class="txt_1">찾고자 하시는 주소의 동(읍/면/리)을 입력하세요.</p>
				<p class="txt_2">예)수유,두리,무지(두글자 이상)</p>
			</div>
			<div class="sel">
				<select name="sido" onchange="change_sido(this.value);">
				<?	
					
					mysql_select_db($db_name);

					$query = "SELECT * FROM g5_tel WHERE cate_gubun='sido' and use_gubun='Y'";
					$result = mysql_query($query);
					while($rs = mysql_fetch_array($result)){

				?>
					<option value="<?=$rs["area"];?>" <? if($sido == $rs["area"]){ echo "selected=selected"; }?>><?=$rs["area"];?></option>
				<?	
					}
				?>
				</select>
				<input type="text" id="write_site" autofocus required name="dong" value="<?=$dong;?>" size="30" onkeypress="if(event.keyCode=='13'){ search_post('<?=$num?>'); }">
				<!--<input type="text" name="dong" value="<?=$dong;?>" size="30">-->
				<input type="button" class="finder" value="검색" onclick="search_post('<?=$num?>');">
			</div>
			
		<table summary="우편번호 검색">
		<caption>우편번호 검색</caption>
			<?
			if (!$page) $page = 1;
			$list_num = 10;
			$page_num = 10;
			$offset = $list_num	*	($page-1);

			if($dong <> ""){
				$db_name = "doro_zipcode";
				mysql_select_db($db_name);

				$second_tbl = "_doro_zipcode";
				switch($sido){
					case "서울" :
						$tbl = "seoul" . $second_tbl;
						$sido = "seoul";
						break;
					case "부산" :
						$tbl = "busan" . $second_tbl;				
						$sido = "busan";
						break;
					case "대구" :
						$tbl = "daegu" . $second_tbl;				
						$sido = "daegu";
						break;
					case "인천" :
						$tbl = "incheon" . $second_tbl;				
						$sido = "incheon";
						break;
					case "광주" :
						$tbl = "gwangju" . $second_tbl;				
						$sido = "gwangju";
						break;
					case "대전" :
						$tbl = "daejeon" . $second_tbl;				
						$sido = "daejeon";
						break;
					case "울산" :
						$tbl = "ulsan" . $second_tbl;				
						$sido = "ulsan";
						break;
					case "세종" :
						$tbl = "sejong" . $second_tbl;				
						$sido = "sejong";
						break;
					case "강원" :
						$tbl = "gangwondo" . $second_tbl;				
						$sido = "gangwondo";
						break;
					case "경기" :
						$tbl = "gyeongggido" . $second_tbl;				
						$sido = "gyeongggido";
						break;
					case "경상" :
						$tbl = "gyeongsangdo" . $second_tbl;				
						$sido = "gyeongsangdo";
						break;
					case "전라" :
						$tbl = "jeollado" . $second_tbl;				
						$sido = "jeollado";
						break;
					case "제주" :
						$tbl = "jejudo" . $second_tbl;				
						$sido = "jejudo";
						break;
					case "충청" :
						$tbl = "chungcheongdo" . $second_tbl;				
						$sido = "chungcheongdo";
						break;
				}
				if($tbl == ""){
					$tbl = "seoul" . $second_tbl;
					$sido = "seoul";
				}
				$WHERE = " WHERE doro_nm like '%$dong%' or dong like '%$dong%' or li like '%$dong%' or up_myon like '%$dong%'";
				$query = "SELECT COUNT(*) FROM $tbl" . $WHERE;
				
				$result	=	mysql_query($query) or die(mysql_error());
				$row	=	mysql_fetch_array($result);
				$total_no	=	$row[0];

				$total_page = ceil($total_no / $list_num);
				$cur_num = $total_no - $list_num * ($page-1);


				$query = "SELECT * FROM $tbl " . $WHERE . " order by jibun1, jibun2 LIMIT $offset, $list_num";
				$result	=  mysql_query($query);   // sql문 실행
				?>
				<p class="alarm">총<?=number_format($total_no)?>건이 검색 되었습니다.</p>
				
				<table>
					<tr>
						<th class="con_1">우편번호</th>
						<th class="con_1">도로명주소</th>
					</tr>
				<?
				while($rs = mysql_fetch_array($result)){
					$zipcode_1	=	substr($rs["zipcode"],0,3);
					$zipcode_2	=	substr($rs["zipcode"],3,3);
					$zipcode	=	substr($rs["zipcode"],0,3) . "-" . substr($rs["zipcode"], 3, 3);;

					$sido = $rs["sido"];
					$gugun = $rs["gugun"];
					$doro_nm = $rs["doro_nm"];
					$doro_1 = $rs["doro_1"];
					$doro_2 = $rs["doro_2"];
					$dong = $rs["dong"];
					$jibun1 = $rs["jibun1"];
					$jibun2 = $rs["jibun2"];
					$gunmul_nm1 = $rs["gunmul_nm1"];

					if($doro_2 <> "0"){
						$address = $sido . " " . $gugun . " " . $doro_nm . " " . $doro_1 . "-" . $doro_2 . 
							" (" . $dong. " " . $jibun1 ."-". $jibun2. " " . $gunmul_nm1 .")";
					}else{
						$address = $sido . " " . $gugun . " " .	$doro_nm . " " . $doro_1 . 
							" (" . $dong. " " . $jibun1 ."-". $jibun2. " " . $gunmul_nm1 .")";
					}
				?>
					<!--<tr onmouseover="change_tr_color(this,'#e51c1c','#1c1ce5');">-->
					<tr>
						<td class="con_2">
							<a href="#" onclick="zip_code_opener_move('<?=$num?>','<?=$zipcode_1;?>','<?=$zipcode_2;?>','<?=$sido;?>','<?=$gugun;?>','<?=$doro_nm;?>','<?=$doro_1;?>','<?=$doro_2;?>','<?=$gunmul_nm1;?>');"><?=$zipcode;?>
							</a>
						</td>
						<td class="con_3">
							<a href="#" 
							onclick="zip_code_opener_move('<?=$num?>','<?=$zipcode_1;?>','<?=$zipcode_2;?>','<?=$sido;?>','<?=$gugun;?>','<?=$doro_nm;?>','<?=$doro_1;?>','<?=$doro_2;?>','<?=$gunmul_nm1;?>');"><?=$address;?>
							</a>
						</td>
					</tr>
				<?
				}//end while
					echo "</table>";
			}//end if dong
				
			?>
		<? if($total_no > 1){ ?>
		<div class="num">
			<?
			$sido = $_GET["sido"];
			$total_block = ceil($total_page / $page_num);
			$block = ceil($page / $page_num);

			$first = ($block-1) * $page_num;
			$last = $block * $page_num;

			if($block >= $total_block){
				$last=$total_page;
			}
			//처음 *개 앞

			//$prev = $first-1;
			if($block > 1){
				$go_page=1;
			?>
				<a href="javascript:void(0);" onclick="zipsearch_result('zip_search_popup','1','<?=$sido?>','<?=$dong?>','<?=$num?>')">&nbsp;<img border=0 src="/img/zip_first.png"></a>
			<?
			}
			//이전페이지
			if($block != 1 && $block <= $total_block){
				
				if($block >= 3){
					$go_page = (($block - 2) * 10) +1;
				}else{
					$go_page = 1;
				}

				if($go_page == 0){
					$go_page = 1;
				}
			?>
				<a href="javascript:void(0);" onclick="zipsearch_result('zip_search_popup','<?=$go_page?>','<?=$sido?>','<?=$dong?>','<?=$num?>')">&nbsp;<img border=0 src="/img/zip_before.png"></a>
			<? }
			//페이지 링크
			for($page_link=$first+1; $page_link<=$last; $page_link++)	{
				if($page_link==$page){
					echo "<font color=black><b>$page_link</b>  </font>";
				}else{ ?>
					<a href="javascript:void(0);" onclick="zipsearch_result('zip_search_popup','<?=$page_link?>','<?=$sido?>','<?=$dong?>','<?=$num?>')">[<?=$page_link?>]</a>
				<? }
			}

			//다음
			if($total_page > $page) {
				//$go_page = $page + 10;
				$go_page = ($block * 10) + 1;
			?>
				<a href="javascript:void(0);" onclick="zipsearch_result('zip_search_popup','<?=$go_page?>','<?=$sido?>','<?=$dong?>','<?=$num?>')">&nbsp;<img border=0 src="/img/zip_after.png"></a>
			<?	}
			//*개뒤 마지막
			if($block < $total_block){
				$next = $last + 1;
			?>
				<a href="javascript:void(0);" onclick="zipsearch_result('zip_search_popup','<?=$total_page?>','<?=$sido?>','<?=$dong?>','<?=$num?>')">&nbsp;<img border=0 src="/img/zip_last.png"></a>
			<?
			}
			?>
		</div>
		<? } ?>
	</form>
</div>
</body>
</html>