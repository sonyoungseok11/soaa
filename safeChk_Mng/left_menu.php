<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include_once $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<?

if($_SESSION["id"] == ""){
	echo "
		<script>
			alert(\"로그인후에 이용하여 주십시요\");
			location.href=\"/index.php\";
		</script>
		";
}

	$vi_year = date("Y");
	$vi_month = date("m");
	$vi_day = date("d");


	$insert_date = date('g:i:s');

	//등록번호만 있는 빈 값은 /LoginProc.php 에서 처리됨. 37-50

	$vi_ipaddr = $_SERVER["REMOTE_ADDR"];

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

	include $_SERVER["DOCUMENT_ROOT"] . "/head.php";

	//현재 페이지
	$this_page = array_pop(explode("/", $_SERVER["REQUEST_URI"]));
	$this_page = explode(".", $this_page);
?>
        <section id="section">
        	<section class="lnb">
            	<h4 class="lnb_title">안전점검&nbsp;관리</h4>
            	<ul>
					<?
						$result = fn_select("idx_sub, menu_nm, url", "menu", "length(idx_sub) < 3  and idx_sub between '10' and '40'");

						$i=1;
						while($rs = mysql_fetch_array($result)){

							// 50부터는 대형옥외물임.
							if($i==5){
								continue;
							}
					?>
						<li class="bg_catch"><img src="/img/arrow_right.png" alt="arrow_right"><?=$rs["menu_nm"]?></li>
						<?
							$result_sub = fn_select("idx_sub, menu_nm, url", "menu", "length(idx_sub) > 3 and idx_sub like '" .$i ."0%'");
							while($rs_sub = mysql_fetch_array($result_sub)){

								$click_page = array_pop(explode("/", $rs_sub["url"]));
								$click_page = explode(".", $click_page);

								//현재 페이지가 db url 의 제일 마지막 주소와 같으면..
								// ex) soaa_list.php(현재페이지) == soaa_list.php (db 페이지)
								if($click_page[0] == $this_page[0]){
						?>
		                    <li class="click"><a href="<?=$rs_sub["url"]?>"><?=$rs_sub["menu_nm"]?></a></li>							
						<?		}else{	?>
		                    <li><a href="<?=$rs_sub["url"]?>"><?=$rs_sub["menu_nm"]?></a></li>							
						<?
								}
							}
							$i++;
						?>
					<? } ?>
                </ul>
            </section><!--lnb-->