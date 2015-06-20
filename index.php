<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/dbconn.php"; ?>
<?  include $_SERVER["DOCUMENT_ROOT"] . "/config/function.php"; ?>


<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<title>login</title>
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
<link rel="stylesheet" type="text/css" href="/css/admin/login.css">
<link rel="stylesheet" type="text/css" href="/css/font.css">
<script type="text/javascript" src="/js/common.js"></script>
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
</head>
<body>
	<div id="wrap">
        <div class="block"></div>
    	<header class="header">
        	<h1 class="ci"><img src="img/header_ci.png" alt="ci"></h1>
            <div class="clear"></div>
            <p class="header_txt">안전도검사솔루션</p>
        </header>
        <section class="content">
        	<form name="form" method="post">
                <div class="bg">
                    <p class="title">Admin&nbsp;Login</p>
                	<div class="txt_unit">
                        <p class="left_txt">아이디<input type="text" class="w150 m_left23" name="id" required autofocus></p>
                        <p class="left_txt">비밀번호<input type="password" class="w150" name="password" onkeydown="javascript: if(event.keyCode == 13) { CheckLogin('e'); }" required></p> 
                    </div>
                    <p class="right_btn"><input type="button" id="submit_btn" value="로그인" onclick="CheckLogin('e')"></p>
                    <div class="clear"></div>
                    <p class="tip">&#40;사&#41;&nbsp;서울특별시&nbsp;옥외광고협회&nbsp;관리자&nbsp;화면</p>
                </div>
            </form>
        </section>
    </div>
</body>
</html>
