<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
	$idx		=	$_GET["idx"]; //대, 소메뉴 코드값
	$idx_sub	=	$_GET["idx_sub"]; //대, 소메뉴 코드값
	$menu_nm	=	$_POST["menu_nm"];
	$actions	=	$_GET["actions"]; //modify, delete 구분
	$url		=	$_POST["url"];

	
//	echo "me_code=" . $me_code . "<br>";
//	echo "menu_nm=" . $menu_nm . "<br>";
//	echo "actions=" . $actions . "<br>";
//	echo "url=" . $url . "<br>";
	

	$tbl = "menu";
	if($actions == "update"){
		//$query = "UPDATE g5_menu SET me_name='$me_name', menu_image='$menu_image', me_link='$link', use_gubun='$use_gubun' WHERE me_code='$me_code'";
		//$query = "UPDATE g5_menu SET me_name='$me_name', me_link='$me_link', use_gubun='$use_gubun' WHERE me_code='$me_code'";
		$rs = fn_update("menu_nm='$menu_nm', url='$url'", $tbl, "idx='$idx' and idx_sub='$idx_sub'");
	}else{
		//대분류를 삭제할경우 하위 소분류까지 모두 N 처리 or 소분류 각기 삭제
		$query = "UPDATE g5_menu SET use_gubun='N' WHERE me_code like '$me_code%'";
	}

	if($rs){
?>
<script type="text/javascript">
	alert('<?=$menu_nm?>' + '의 상태가 변경 되었습니다.');
	location.href="./menu_mng.php";
</script>
<?
	}
?>