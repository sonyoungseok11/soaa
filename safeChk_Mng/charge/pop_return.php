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
<link rel="stylesheet" type="text/css" href="/css/admin/pop_return.css">
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
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
<script>
$(document).ready(function(){
	
	$('a').focus(function(e) {
        $(this).blur();
    });

	$(function(){
		$("#pop_return").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth: true,
            showMonthAfterYear: true ,
            changeYear: true,
			dayNamesMin:["일","월","화","수","목","금","토"],
			monthNames:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],
			monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
			minDate: "-10y",
			maxDate: "+1y",
		})
	});
});
</script>
</head>

<?
	//no_confirm_list 에서 검색 버튼을 클릭하여 들어온경우
	$idx = $_GET['idx'];
	
	$rs = fn_select_fetch_array("*", "giro_list", " idx='$idx'");
?>


<body>
	<div id="wrap">
		<form name="form" method="POST">
			<input type="hidden" name="idx" value="<?=$rs['idx']?>">
			<input type="hidden" name="input_date" value="<?=$rs['input_date']?>">
			<input type="hidden" name="c_corp_nm" value="<?=$rs['c_corp_nm']?>">
			<table class="tb" >
			<tr class="line">
				<td class="left">입금일자</td>
				<td class="right"><?=$rs['input_date']?></td>
			</tr>
			<tr class="line">
				<td class="left">입금자성명</td>
				<td class="right"><?=$rs['c_corp_nm']?> (<?=$rs['c_ceo_nm']?>)</td>
			</tr>
			<tr class="line">
				<td class="left">환불자 성명</td>
				<td class="right">
					<input type="text" class="w150 m_lr" name="refund_nm" value="<?=$rs['c_ceo_nm']?>" onkeydown="javascript: if(event.keyCode == 13) { noConfirmCallBack('charge_search'); }">
				</td>
			<tr class="line">
				<td class="left">환불일자</td>
				<td class="right">
					<input type="text" class="w150 m_lr"  id="pop_return" name="refund_date" value="<?=$today;?>" onkeydown="javascript: if(event.keyCode == 13) { noConfirmCallBack('charge_search'); }">
				</td>
			</tr>
			<tr class="line">
				<td class="left">환불금액</td>
				<td class="right">
					<input type="text" class="w150 m_lr" name="check_pay" value="<?=number_format($rs['chk_pay']);?>" onkeyup="commaNum(this.value);" onkeydown="javascript: if(event.keyCode == 13) { noConfirmCallBack('charge_search'); }">&nbsp;&nbsp;원
				</td>
			</tr>
			<tr class="line">
				<td class="left">환불이유</td>
				<td class="right">
					<input type="text" class="w150 m_lr" name="memo1" value="<?=$memo1?>" size="40" onkeydown="javascript: if(event.keyCode == 13) { noConfirmCallBack('charge_search'); }" placeholder="생략 가능합니다">
				</td>
			</tr>
			</table>
		</form>
        
        <p class="btn"><input type="button" value="확인" id="submit_btn" onclick="updateGiroList('giroListUpdateProc','<?=$rs['idx']?>');"></p>
    </div><!--wrap-->
</body>
</html>