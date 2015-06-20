<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<title>no_confirm_list_modify</title>
<!--[if lt IE 9]>
<script src="/js/html5shiv.js"></script>
<![endif]-->
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/css/admin/reset.css">
<link rel="stylesheet" type="text/css" href="/css/admin/no_confirm_list_modify.css">
<link rel="stylesheet" type="text/css" href="/css/font.css">
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
<script src="/js/jquery-1.11.0.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/jquery-ui-1.10.4.custom.min.js"></script>
<script>
$(document).ready(function(){
	
	$('a').focus(function(e) {
        $(this).blur();
    });
});
</script>
</head>

<?
	//no_confirm_list 에서 검색 버튼을 클릭하여 들어온경우
	if($_GET['search_option'] == "auto"){
		$gu_office_rs	=	fn_select_fetch_array("en_nm, ko_nm", "common_selectbox", "code='10' and en_nm='" . $_GET['gu_office'] . "'");
	}else{
		//charge_search 팝업창에서 검색하는경우
		$search_sig = $_POST['search_sig'];
		$gu_office_rs	=	fn_select_fetch_array("en_nm, ko_nm", "common_selectbox", "code='10' and en_nm='" . $_POST['gu_office'] . "'");
	}
?>

<body>
	<div id="wrap">
		<form name="form" method="POST">
		<input type="hidden" name="gu_office" value="<?=$gu_office_rs['en_nm']?>">
		<input type="hidden" name="search_option" value="manual">
		<input type="hidden" name="search_sig" value="1">
    	<div class="search">
        	업체명<input type="text" class="w150 m_lr" name="c_corp_nm" value="<?=$c_corp_nm?>" onkeydown="javascript: if(event.keyCode == 13) { noConfirmCallBack('charge_search'); }">
			성명<input type="text" class="w150 m_lr" name="c_ceo_nm" value="<?=$c_ceo_nm?>" onkeydown="javascript: if(event.keyCode == 13) { noConfirmCallBack('charge_search'); }">
			<img src="/img/search.png" alt="search" class="search_img" onclick="noConfirmCallBack('charge_search');">
        </div><!--search-->
		</form>
        <div class="search_table">
            <table>
                <colgroup>
                    <col width="270px">
                    <col width="250px">
                    <col width="130px">
                    <col width="389px">
                    <col width="100px">
                    <col width="60px">
                </colgroup>
                <tr>
                    <th>업체명</th>
                    <th>성명</th>
                    <th>연락처</th>
                    <th>표시위치</th>
                    <th>접수날짜</th>
                    <th>선택</th>
                </tr>
				<?
					//검색하려는 구청이 ETC-기타   구청이 아닐경우 각 구청에 맞게 검색.
					if($gu_office_rs['en_nm'] <> "ETC"){
						$where = " gu_office='" . $gu_office_rs['en_nm'] ."'";
					}else{
					//ETC-기타   구청일 경우에는 모든 구청에서 검색
						$where = " gu_office <> ''";
					}

					if($c_corp_nm){
						$where .= " and c_corp_nm like '%$c_corp_nm%'";
					}

					if($c_ceo_nm){
						$where .= " and c_ceo_nm like '%$c_ceo_nm%'";
					}

					$result	=	fn_select("*", "giro_list", $where);
					$tot_cnt	=	fn_select_cnt("idx", "giro_list", $where);
					
					$i=0;
					while($rs = mysql_fetch_array($result)){
						$reg_no	=	$rs['reg_no'];
				?>
		         <tr onmouseover="mouseOver('<?=$i?>');" onmouseout="mouseOut('<?=$i?>');">
                    <td class="corp_name" name="c_corp_nm<?=$i?>"><?=$rs['c_corp_nm']?></td>
                    <td class="name" name="c_ceo_nm<?=$i?>"><?=$rs['c_ceo_nm']?></td>
                    <td class="tel" name="c_tel<?=$i?>"><?=$rs['c_tel']?></td>
                    <td class="position" name="outdoor_real_addr<?=$i?>"><?=$rs['outdoor_real_addr']?></td>
                    <td class="reg_date" name="reg_date<?=$i?>" ><?=$rs['reg_date']?></td>
                    <td class="choose" name="choice<?=$i?>"><a href="javascript:void(0);" onclick="noConfirm_Update('no_confirm_updateProc','<?=$reg_no?>', '<?=$idx;?>')">선택</a></td>
                </tr>

                <?
					$i++;
					}//end while
				if($tot_cnt < 1){
					echo "
						<tr><td class=\"non_result\" colspan=\"6\">검색결과가 없습니다</td></tr>
					";
					}
				?>
            </table>
        </div><!--search_table-->
        <p class="btn"><input type="button" value="창닫기" id="submit_btn" onclick="self.close();"></p>
    </div><!--wrap-->
</body>
</html>