<?
$db_host = "localhost"; 
$db_user = "soaa"; 
$db_passwd = "2013";
$db_name = "doro_zipcode"; 
$conn = mysql_connect($db_host,$db_user,$db_passwd);
mysql_select_db($db_name);

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?
	$dong = $_POST["dong"];
	$query = "SELECT * FROM doro_zipcode WHERE dong like '%$dong%'";
	$result = mysql_query($query);
	while($rs = mysql_fetch_array($result)){
	
		if($rs["doro_2"] <> "0"){
		echo $rs["sido"] . " " . $rs["gugun"] . " " . $rs["doro_nm"] . " " . $rs["doro_1"] . "-" . $rs["doro_2"] . "<br>";
		}else{
		echo $rs["sido"] . " " . $rs["gugun"] . " " . $rs["doro_nm"] . " " . $rs["doro_1"] . "<br>";
		}
	}
?>

<div id="page_navi">
		<?
		$total_block = ceil($total_page / $page_num);
		$block = ceil($page / $page_num);

		$first = ($block-1) * $page_num;
		$last = $block * $page_num;

		if($block >= $total_block){
			$last=$total_page;
		}
		//처음 *개 앞
		if($block > 1){
			$prev = $first-1;
			echo "<a href=guide01.php?page=1'>&nbsp;&nbsp;img border=0 src=/image/guide/btn_pre_1.gif></a>";
			echo "<a href=guide01.php?page=$prev'>&nbsp;&nbsp;[$page_num 개 앞]</a>";
		}

		//이전
		if($page > 1) {
		$go_page = $page -1;
		echo "<a href=guide01.php?$page=$go_page>&nbsp;&nbsp;<img border=0 src=/image/guide/btn_pre_2.gif></a>";
		}

		//페이지 링크
		for($page_link=$first+1; $page_link<=$last; $page_link++)	{
			if($page_link==$page){
				echo "<font color=black><b>$page_link</b>  </font>";
			}else{
				echo "<a href=guide01.php?page=$page_link>$page_link  </a>";
			}
		}

		//다음
		if($total_page > $page) {
			$go_page = $page +1;
			echo "<a href=guide01.php?page=$go_page>&nbsp;&nbsp;<img border=0 src=/image/guide/btn_next_2.gif></a>";
		}
		//*개뒤 마지막
		if($block < $total_block){
			$next = $last + 1;
			echo "<a href=guide01.php?page=$next>$page_num 개뒤</a>";
			echo "<a href=guide01.php?page=$total_page>&nbsp;&nbsp;<img border=0 src=/image/guide/btn_next_1.gif></a>";
		}
		?>
	</div>