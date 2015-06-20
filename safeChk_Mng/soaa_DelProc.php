<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<meta http-equiv="Content-Type" content="text/html" charset="utf-8">

<?
	if($_GET['reg_no'] <> "" && $_GET['page_no'] <> ""){
		//soaa_list 에서 삭제 버튼을 각각 누를 경우
		$reg_no		=	$_GET['reg_no'];
		$page_no	=	$_GET['page_no'];
	}else{
		//soaa_view 에서 데이터 건별로 삭제 버튼을 누를 경우
		$reg_no		=	$_POST['reg_no'];
		$page_no	=	$_POST['page_no'];
	}
//	echo "reg_no=" . $reg_no. "<br>";
//	echo "page_no=" . $page_no. "<br>";
//	echo "soaa_DelProc.php<br>";
//	exit;

	$rs_1 = fn_delete("soaa_reg", "reg_no='$reg_no'");
	$rs_2 = fn_delete("soaa_reg_check", "reg_no='$reg_no'");

	if($rs_1 > 0 && $rs_2 > 0){
?>
<script>
	alert("데이터가 정상 삭제 되었습니다.");
	location.href="soaa_list.php?page=" + '<?=$page_no?>';
</script>
<?
	}
?>