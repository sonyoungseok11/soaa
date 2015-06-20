<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<?
	$vi_year = date("Y");
	$vi_month = date("m");
	$vi_day = date("d");

	$insert_date = date('g:i:s');

	$vi_ipaddr = $_SERVER["REMOTE_ADDR"];
	//echo $year . " " . $month . " ". $day;

	$sql	=	"SELECT * FROM g5_visit WHERE vi_year='$vi_year' and vi_month='$vi_month' and vi_day='$vi_day' order by vi_idx desc";
	$result = mysql_query($sql);
	$rs = mysql_fetch_array($result);
	$rs_cnt = mysql_num_rows($result);

	if($rs_cnt < 1){
		$vi_idx = 1;
	}else{
		$vi_idx = $rs["vi_idx"] + 1;
	}

	$tbl = "g5_visit";
	$sql = "INSERT INTO $tbl VALUES('$vi_idx','$vi_year','$vi_month','$vi_day','$insert_date','$vi_ipaddr')";
	$result = mysql_query($sql);
?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/head.php"; ?>
<?
	$this_page =  explode("/", $_SERVER["REQUEST_URI"]);

	//추가 또는 게시글 클릭전 왼쪽 메뉴
	switch($this_page[2]){
		case "outdoor_act_cate.php":	//광고물종류
			$li_class[0] = "class=click";	break;
		case "outdoor_act_type.php"://광고물형식
			$li_class[1] = "class=click";	break;
		case "gu_office.php"://구청관리
			$li_class[2] = "class=click";	break;
		case "inspector.php"://검사원관리
			$li_class[3] = "class=click";	break;
		case "position.php"://직위관리
			$li_class[4] = "class=click";	break;
		case "chk_result.php"://검사결과
			$li_class[5] = "class=click";	break;
		case "chk_paytype.php"://검사료납부
			$li_class[6] = "class=click";	break;
		case "report_certi.php":	//필증교부 
			$li_class[7] = "class=click"; break;
		case "insert_paytype.php":
			$li_class[8] = "class=click"; break;

		case "menu_mng.php"://메뉴관리
			$menu_mng = "class=click";	break;

		case "notice_list.php?idx=1":	//Notice 안전점검관리
			$notice_class[0] = "class=click";	break;

		case "notice_list.php?idx=1&idx_sub=10":	//Notice 셀렉트박스 [안전점검 관리]
			$notice_class[0] = "class=click";	break;
		case "notice_list.php?idx=1&idx_sub=20":	//Notice 셀렉트박스 [입금,수수료 관리]
			$notice_class[0] = "class=click";	break;
		case "notice_list.php?idx=1&idx_sub=30":	//Notice 셀렉트박스 [보고서]
			$notice_class[0] = "class=click";	break;
		case "notice_list.php?idx=1&idx_sub=40":	//Notice 셀렉트박스 [자료실 관리]
			$notice_class[0] = "class=click";	break;

		case "notice_list.php?idx=2":	//Notice
			$notice_class[1] = "class=click";	break;
	}


	$this_page = explode("?", $this_page[2]);
	$before_page = array_pop(explode("/", $_SERVER["HTTP_REFERER"]));

//	echo "<br>this_page=" . $this_page[0] . "<br>";
//	echo "<br>before_page=" . $before_page . "<br>";
	//추가 또는 게시글 클릭후 왼쪽 메뉴

	if($this_page[0] == "confi_insert.php" || $this_page[0] == "confi_update.php" || $this_page[0] == "menu_update.php" || $this_page[0] == "notice_update.php"){
		switch($before_page){
			case "outdoor_act_cate.php":	//광고물종류
				$li_class[0] = "class=click";	break;
			case "outdoor_act_type.php"://광고물형식
				$li_class[1] = "class=click";	break;
			case "gu_office.php"://구청관리
				$li_class[2] = "class=click";	break;
			case "inspector.php"://검사원관리
				$li_class[3] = "class=click";	break;
			case "position.php"://직위관리
				$li_class[4] = "class=click";	break;
			case "chk_result.php"://검사결과
				$li_class[5] = "class=click";	break;
			case "chk_paytype.php"://검사료납부
				$li_class[6] = "class=click";	break;
			case "report_certi.php":	//필증교부 
				$li_class[7] = "class=click"; break;
			case "insert_paytype.php":
				$li_class[8] = "class=click"; break;

			case "menu_mng.php"://메뉴관리
				$menu_mng = "class=click";	break;

			case "notice_list.php?idx=1"://NOTICE 안전점검관리
				$notice_class[0] = "class=click";	break;
			case "notice_list.php?idx=2"://NOTICE 대형옥외물관리
				$notice_class[1] = "class=click";	break;
		}

		//proc 페이지에서 저장후에 돌아온 뒤 왼쪽 메뉴
		$confi_proc = array_pop(explode("/", $_SERVER["HTTP_REFERER"]));

		if($confi_proc == "confi_proc.php"){
			$tmp_url = explode("?", $_SERVER["REQUEST_URI"]);	//   /settings/confi_update.php?code=05&en_nm=ElecLamp
			$tmp_url = explode("&", $tmp_url[1]);				//		code=05&en_nm=ElecLamp
			$code = explode("=", $tmp_url[0]);					//		code=05
		
			switch($code[1]){

				case "01" :
					$li_class[0] = "class=click";	break;
				case "05" :
					$li_class[1] = "class=click";	break;
				case "10" :
					$li_class[2] = "class=click";	break;
				case "15" :
					$li_class[3] = "class=click";	break;
				case "20" :
					$li_class[4] = "class=click";	break;
				case "30" :
					$li_class[5] = "class=click";	break;
				case "35" :
					$li_class[6] = "class=click";	break;
				case "40" :
					$li_class[7] = "class=click";	break;
				case "45" :
					$li_class[8] = "class=click";	break;
			}
		}
	}
?>
        <section id="section">
        	<section class="lnb">
            	<h4 class="lnb_title">환경&nbsp;설정</h4>
            	<ul>
                	<li class="bg_catch"><img src="../img/arrow_right.png" alt="arrow_right">공통&nbsp;설정</li>
					<?
						$rs_cnt = fn_select_cnt("distinct(title_nm), url", "common_selectbox","code is not null order by code");
						$result = fn_select("distinct(title_nm), url", "common_selectbox", "code is not null order by code");

						$i=0;
						while($rs = mysql_fetch_array($result)){
					?>
                    <li <?=$li_class[$i]?>><a href="<?=$rs["url"]?>.php"><?=$rs["title_nm"]?></a></li>
					<? 
						$i++;
						} ?>

                	<li class="bg_catch"><img src="../img/arrow_right.png" alt="arrow_right">메뉴&nbsp;관리</li>
                    <li <?=$menu_mng?>><a href="menu_mng.php">메뉴&nbsp;관리</a></li>

                	<li class="bg_catch"><img src="../img/arrow_right.png" alt="arrow_right">Notice</li>
                    <li <?=$notice_class[0]?>><a href="notice_list.php?idx=1">안전점검&nbsp;관리</a></li>
                    <li <?=$notice_class[1]?>><a href="notice_list.php?idx=2">대형옥외물&nbsp;관리</a></li>
                </ul>
            </section><!--lnb-->
            
	