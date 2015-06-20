<!doctype html>
<html lang="ko">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<title>soaa_list</title>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/css/admin/reset.css">
<link rel="stylesheet" type="text/css" href="/css/admin/common.css">
<link rel="stylesheet" type="text/css" href="/css/font.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
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
<script src="/js/common.js"></script>
<script src="/js/jquery-1.11.0.min.js"></script>
<script src="/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="/se2/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>

<script style="text/javascript">
	$(function(){
		$("#input_date1").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth: true,
			showMonthAfterYear: true ,
			changeYear: true,
			dayNamesMin:["일","월","화","수","목","금","토"],
			monthNames:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],
			monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
			minDate: "-10y",
			maxDate: "+1y"
		});
		$("#st_date").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth: true,
            showMonthAfterYear: true ,
            changeYear: true,
			dayNamesMin:["일","월","화","수","목","금","토"],
			monthNames:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],
			monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
			minDate: "-10y",
			maxDate: "+1y",
		});

		$("#ed_date").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth: true,
            showMonthAfterYear: true ,
            changeYear: true,
			dayNamesMin:["일","월","화","수","목","금","토"],
			monthNames:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],
			monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
			minDate: "-10y",
			maxDate: "+1y",
		});

		$("#chk_date").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth: true,
            showMonthAfterYear: true ,
            changeYear: true,
			dayNamesMin:["일","월","화","수","목","금","토"],
			monthNames:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],
			monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
			minDate: "-10y",
			maxDate: "+1y",
		});
		$("#pay_checkin_date").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth: true,
            showMonthAfterYear: true ,
            changeYear: true,
			dayNamesMin:["일","월","화","수","목","금","토"],
			monthNames:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],
			monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
			minDate: "-10y",
			maxDate: "+1y",
		});

		$("#st_date1").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth: true,
            showMonthAfterYear: true ,
            changeYear: true,
			dayNamesMin:["일","월","화","수","목","금","토"],
			monthNames:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],
			monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
			minDate: "-10y",
			maxDate: "+1y",
		});
		$("#st_date2").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth: true,
            showMonthAfterYear: true ,
            changeYear: true,
			dayNamesMin:["일","월","화","수","목","금","토"],
			monthNames:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],
			monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
			minDate: "-10y",
			maxDate: "+1y",
		});
		$("#ed_date1").datepicker({
			dateFormat:"yy-mm-dd",
			changeMonth: true,
            showMonthAfterYear: true ,
            changeYear: true,
			dayNamesMin:["일","월","화","수","목","금","토"],
			monthNames:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],
			monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
			minDate: "-10y",
			maxDate: "+1y",
		});
		$("#ed_date2").datepicker({
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
</script>

</head>
<body>
	<div id="wrap">
        <div class="block"></div>
    	<header class="header">
            <div class="top">
                <h1 class="ci"><a href="/safeChk_Mng/soaa_list.php"><img src="/img/header_ci.png" alt="header_ci"></a></h1>
                <ul class="top_menu">
                    <li><a href="/soaa_list.php">Home</a></li>
                    <li><a href="/logout.php">Logout</a></li>
                </ul>
            </div><!--top-->
            <div class="side_menu">

            <ul>
				<?
					$this_page =  explode("/", $_SERVER["REQUEST_URI"]);
					switch($this_page[1]){
						case "safeChk_Mng":
							$safeChk_Mng_class = "class=click";	break;
						case "bigad_Mng":
							$bigad_Mng_class = "class=click";	break;
						case "settings":
							$settings_class = "class=click";	break;
					}
				?>
				
                <li <?=$safeChk_Mng_class?>><a href="/safeChk_Mng/soaa_list.php">안전점검&nbsp;관리</a></li>
                <li <?=$bigad_Mng_class?>><a href="/bigad_Mng/soaa_list.php">대형옥외물&nbsp;관리</a></li>
                <li <?=$settings_class?>><a href="/settings/outdoor_act_cate.php">환경&nbsp;설정</a></li>					
            </ul>
        </div><!--side_menu-->
        </header><!--header-->