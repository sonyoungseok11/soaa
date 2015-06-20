//한글입력방지
function fn_press_han(obj){
	//좌우 방향키, 백스페이스, 딜리트, 탭키에 대한 예외
	if(event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 ){
	return;
	}
	obj.value = obj.value.replace(/[\ㄱ-ㅎㅏ-ㅣ가-힣]/g, '');
}

//한글입력만
function fn_press_must_hangul(obj){
	var reg=/[A-Z]|[a-z]|[0-9]|\s/;

	if(reg.test(obj) == true){
		alert("잘못 입력 하셨습니다..");
		document.getElementById("name").value = "";
	}
}
//공백만 안됨
function fn_press_not_space(obj){
	var reg=/\s/;

	if(reg.test(obj) == true){
		alert("잘못 입력 하셨습니다..");
		document.getElementById("nick_name").value = "";
	}
}

function move_index(){
	location.href="/index.php";
}
function logout(){
	location.href="../logout.php";
}
function movePage(page_nm){
	location.href=page_nm + ".php";
}
function CheckLogin(obj)
{
	var f	=	document.form;
	var id = f.id.value;

	var keycode	=	0;
	var shiftKey	=	false;
	shiftKey	=	obj.shiftKey;

	if(shiftKey){
		alert("CapsLock이 켜져 있습니다\n비밀번호는 대소문자를 구분합니다.");
		f.password.focus();
		return false;
	}
	if (f.id.value == ""){
		alert("아이디를 입력해주십시요.");
		f.id.focus();
		return false;
	}
	if (id.length < 4){
		alert("아이디는 4~8자 사이로 입력해주세요");
		f.id.focus();
		return false;
	}
	if (f.password.value == "")	{
		alert("비밀번호를 입력해주십시요.");
		f.password.focus();
		return false;
	}
	f.action="./LoginProc.php";
	f.submit();
}
function excelUpload(){
	var f = document.excelform;
	
	f.action="./excelUpload/excel_proc.php";
	f.submit();
}

function addList(num){
	location.href="./confi_insert.php?code=" + num;
}
function updateList(code, en_nm){
	location.href="./confi_update.php?code=" + code + "&en_nm=" + en_nm;
}

//환경설정 > Notice > 추가버튼
function moveWritePage(page_nm){
	location.href=page_nm + ".php";
}
function moveUpdatePage(page_nm, idx, idx_sub){
	location.href=page_nm + ".php?idx=" + idx + "&idx_sub=" + idx_sub;
}

function notice_write_proc(){
	var f = document.form;


	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);

    // 에디터의 내용에 대한 값 검증은 이곳에서
    // document.getElementById("ir1").value를 이용해서 처리한다.
    try {
        elClickedObj.form.submit();
    } catch(e) {}

	f.action="notice_proc.php";
	f.submit();
}

//대,소메뉴 수정창 이동(make_cate.php)
function modify_cate(idx, idx_sub, actions){
	//idx > 메뉴코드(1, 2 : 안전점검, 대형옥외물 구분코드)
	//idx_sub > 메뉴코드(1010,1020 : 하위메뉴코드)
	//actions > action 코드(수정=modify, 삭제=delete)

	if(actions=="update")	{
		location.href="./menu_update.php?idx=" + idx + "&idx_sub=" + idx_sub + "&actions=" + actions;
	}else{
		if(confirm("삭제 하시면 하위 메뉴들도 표기되지 않습니다.\n 진행 하시겠습니까?") == true){
		location.href="./modify_cate_process.php?idx=" + idx + "&idx_sub=" + idx_sub + "&actions=" + actions;
		}
	}
}
//메뉴 수정, 삭제
function cate_modify_process(idx, idx_sub, actions){
	//obj = me_code(10, 1010..)
	//ojb1 =  modify
	var f	=	document.form;
	var menu_nm	=	f.menu_nm.value;
	var url = f.url.value;
	//var menu_image = f.menu_image.value;

	if(menu_nm == ""){
		alert("대메뉴명을 기입해주세요.");
		f.menu_nm.focus();
		return false;
	}
	if(url == ""){
		alert("링크주소를 기입해주세요.");
		f.url.focus();
		return false;
	}
	f.action = "./menu_proc.php?idx=" + idx + "&idx_sub=" + idx_sub + "&actions=" + actions;
	f.submit();
}

//셀렉트 박스 변경
function select_change(page_nm, idx, idx_sub){
	location.href=page_nm + ".php?idx=" + idx + "&idx_sub=" + idx_sub;
}

//공통 셀렉트 박스 내용 db업데이트
function common_selectbox_update(page_nm){
	var f = document.form;

	if(confirm("저장 하시겠습니까?")==true){
		f.action=page_nm + ".php";
		f.submit();
	}else{
		return false;
	}
}

//안전점검 접수 proc 페이지로 이동.
function soaa_reg_proc(){
	var f = document.form;
	var c_addr = f.c_addr.value;
	var outdoor_real_addr = f.outdoor_real_addr.value;

	if(c_addr == "" || outdoor_real_addr == ""){
		alert("신청자 혹은 표시위치의 주소가 입력되지 않았습니다.");
		return false;
	}

	f.action="soaa_reg_proc.php";
	f.submit();
}

//안전점검 접수현황에서 선택(chk box) 클릭시 리스트 체크박스 일괄선택, 해제
function chk_reverse(){
	var chkbox = document.getElementsByName("chkbox[]");

	if(chkbox[0].checked== false){
		for(var i=0; i<chkbox.length; i++){
			chkbox[i].checked=true;
		}
	}else{
		for(var i=0; i<chkbox.length; i++){
			chkbox[i].checked=false;
		}
	}
}

//1천단위 콤마
function commaNum(num) { 
	var f = document.form;
	var check_pay = f.check_pay.value;
	var num	=	num.split(",").join("");	
	var numLength = num.length;
	var tmp = "";

	switch(numLength){
		
		case 4:	//1,000
			tmp=num[0] + "," + num[1]+ num[2]+ num[3];
			f.check_pay.value = tmp; break;
		case 5:	//10,000
			tmp=num[0] + num[1]+ "," +num[2]+ num[3]+ num[4];
			f.check_pay.value = tmp; break;
		case 6:	//100,000
			tmp=num[0] + num[1]+ num[2] + "," + num[3]+ num[4] +num[5];
			f.check_pay.value = tmp; break;
		case 7:	//1,000,000
			tmp=num[0] +","+ num[1]+ num[2]+ num[3] +","+ num[4] + num[5]+ num[6];
			f.check_pay.value = tmp; break;
		case 8:	//10,000,000
			tmp=num[0] + num[1]+ "," +  num[2]+ num[3] + num[4] + ","+  num[5] + num[6] + num[7];
			f.check_pay.value = tmp; break;
	}
}


function commaNumArray(num) { 
	var f = document.form;
	var sig = "loop";

	for(var i=1; i<=20; i++){
		if(sig != "stop"){
			if(document.getElementsByName("check_pay" + i)[0].value != ""){
				sig = "stop";

				var check_pay = document.getElementsByName("check_pay" + i)[0].value;
				var num	=	num.split(",").join("");	
				var numLength = num.length;
				var tmp = "";

				switch(numLength){
					case 4:	//1,000
						tmp=num[0] + "," + num[1]+ num[2]+ num[3];
						alert(document.getElementsByName("check_pay" + i)[0].value);
						document.getElementsByName("check_pay" + i)[0].value = tmp; break;
					case 5:	//10,000
						tmp=num[0] + num[1]+ "," +num[2]+ num[3]+ num[4];
						document.getElementsByName("check_pay" + i)[0].value = tmp; break;
					case 6:	//100,000
						tmp=num[0] + num[1]+ num[2] + "," + num[3]+ num[4] +num[5];
						document.getElementsByName("check_pay" + i)[0].value = tmp; break;
					case 7:	//1,000,000
						tmp=num[0] +","+ num[1]+ num[2]+ num[3] +","+ num[4] + num[5]+ num[6];
						document.getElementsByName("check_pay" + i)[0].value = tmp; break;
					case 8:	//10,000,000
						tmp=num[0] + num[1]+ "," +  num[2]+ num[3] + num[4] + ","+  num[5] + num[6] + num[7];
						document.getElementsByName("check_pay" + i)[0].value = tmp; break;
				}
			}
		}
	}
}

function search_post(num){

	var f	=	document.form;
	var dong = 	f.dong.value;
	f.action="/zip_search_popup.php?num=" + num + "&dong=" + dong;
	f.submit();
}

function move_zip_search_popup(num){
	//1 : 신청자
	//2 : 표시위치
	//3 : 시공업소
	var popUrl = "/zip_search_popup.php?num=" + num;
	var name = "";
	var option = "width=600, height=540";
	window.open(popUrl, name, option);
}

function zipsearch_result(page_nm, page_link, sido,dong, num){
	location.href=page_nm + ".php" + "?page=" + page_link + "&sido=" + sido + "&dong=" + dong + "&num=" + num;
}
//테이블 tr위에 마우스오버 = 회색, 마우스아웃 = 흰색
function change_tr_color(tr, oldcolor, newcolor){
	tr.style.background = newcolor;

	tr.onmouseout=function(){
	tr.style.background=oldcolor;
	}
}
function zip_code_opener_move(num, zipcode1, zipcode2, sido, gugun, doro_nm, doro_1, doro_2, gunmul_nm1){
	var select_gugun = "";

	switch(gugun){
		case "강남구":
			select_gugun="gangnamgu";	break;
		case "동작구":
			select_gugun="dongjackgu";	break;
	}


	if( num == 1 || num == 2){
	//soaa_reg > 해당 구청의 value 값을 가져옴.
		var select_box = opener.document.getElementById("gu_office");


		//구청의 전체 value 갯수만큼 반복해서 돌리는중에 팝업창에서 선택한 구를 만나면 
		//soaa_reg > 구청을 선택하고 중단.
		for(var i=0; i<=select_box.length; i++){
			if(select_box[i].value == select_gugun){
				select_box[i].selected = true;
				break;
			}
		}

		opener.document.getElementById("c_jibun1").value	= zipcode1;
		opener.document.getElementById("c_jibun2").value	= zipcode2;

		opener.document.getElementById("outdoor_real_jibun1").value	= zipcode1;
		opener.document.getElementById("outdoor_real_jibun2").value	= zipcode2;
		/*
		if(doro_2 < 1){
			opener.document.getElementById("addr1").value = sido + " " + gugun + " " + doro_nm + " " + doro_1 + " " + gunmul_nm1;
		}else{
			opener.document.getElementById("addr2").value = sido + " " + gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;
		}*/
		opener.document.getElementById("c_addr").value = "";
		opener.document.getElementById("c_addr").value = sido + " " + gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;

		opener.document.getElementById("outdoor_real_addr").value = "";
		opener.document.getElementById("outdoor_real_addr").value = sido + " " + gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;

		opener.document.getElementById("outdoor_act_cate").focus();
	}else{
		opener.document.getElementById("s_jibun1").value	= zipcode1;
		opener.document.getElementById("s_jibun2").value	= zipcode2;

		/*
		if(doro_2 < 1){
			opener.document.getElementById("addr1").value = sido + " " + gugun + " " + doro_nm + " " + doro_1 + " " + gunmul_nm1;
		}else{
			opener.document.getElementById("addr2").value = sido + " " + gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;
		}*/
		opener.document.getElementById("s_addr").value = "";
		opener.document.getElementById("s_addr").value = sido + " " + gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;
	}
	self.close();
}

//사용자 화면별 전체 해상도 구하기
function screen_width(){
	alert(window.screen.width);
}
//안전점검관린에서 찾아보기 버튼
function soaa_search(page_nm){
	var f = document.form;

	f.action=page_nm + ".php";
	f.submit();
}
// 안전점검 접수현황 일괄적용 클릭시 선택한 결과리스트 일괄적용 update proc 적용
function all_soaa_result_apply(page_nm){

	var f = document.form;

	var chkbox = document.getElementsByName("chkbox[]");
	var chkbox_result = "";

	for(var i=0; i<chkbox.length; i++){
		if(chkbox[i].checked==true){
			chkbox_result = 1;
		}
	}

	if(chkbox_result == ""){
		alert("적용할 리스트를 체크해주십시요");
		return false;
	}else{
		f.action=page_nm + ".php";
		f.submit();
	}
}

//selectbox 페이지 갯수를 선택하면 갯수만큼 페이지 리로딩
function page_list(page_nm, num){
	var f = document.form;

	f.action=page_nm + ".php";
	f.submit();
}
//안전점검 접수 페이징 내비
function navi_move(page_nm, page, select_page_num, st_date, ed_ate, gu_office, c_corp_nm, c_ceo_nm, reg_no,outdoor_act_cate, chk_paytype, report_certi, chk_result){
	location.href=page_nm + ".php?page=" + page + "&select_page_num=" + select_page_num + "&st_date=" + st_date + "&ed_ate=" + ed_ate + "&gu_office=" + gu_office + 
		"&c_corp_nm=" + c_corp_nm + "&c_ceo_nm=" + c_ceo_nm + "&c_corp_nm=" + c_corp_nm + "&reg_no=" + reg_no + "&outdoor_act_cate=" + outdoor_act_cate +
		"&chk_paytype=" + chk_paytype + "&report_certi=" + report_certi + "&chk_result=" + chk_result;
}
//안전점검관리대장 접수 페이징 내비
function navi_mng_list(page_nm, page, select_page_num, gigan_y, gigan_m, st_date, ed_date, gu_office, c_corp_nm, c_ceo_nm, rega_no, chk_personA, outdoor_act_cate,
	payment_state, report_certi, chk_result){
//alert("page_nm==" + page_nm);
//alert("page==" + page);
//alert("select_page_num==" + select_page_num);
//alert("gigan_y==" + gigan_y);
//alert("gigan_m==" + gigan_m);
//alert("st_date==" + st_date);
//alert("ed_date==" + ed_date);
//alert("gu_office==" + gu_office);
//
//alert("c_corp_nm==" + c_corp_nm);
//alert("c_ceo_nm==" + c_ceo_nm);
//alert("reg_no==" + reg_no);
//alert("chk_personA==" + chk_personA);
//alert("outdoor_act_cate==" + outdoor_act_cate);
//alert("payment_state==" + payment_state);
//alert("eport_certi==" + report_certi);
//alert("chk_result==" + chk_result);
location.href=page_nm + ".php?page=" + page + "&select_page_num=" + select_page_num + "&gigan_y=" + gigan_y + "&gigan_m=" + gigan_m + 
	"&st_date=" + st_date + "&ed_date=" + ed_date + "&gu_office=" + gu_office + "&c_corp_nm=" + c_corp_nm + "&c_ceo_nm=" + c_ceo_nm + "&rega_no=" + rega_no + 
	"&chk_personA=" + chk_personA + "&outdoor_act_cate=" + outdoor_act_cate;
}


//soaa_list -> soaa_view 이동
function soaa_list_view(page_nm, page_no, reg_no){
	location.href=page_nm + ".php?reg_no=" + reg_no + "&page_no=" + page_no;
}

//soaa_view.php 에서 삭제 버튼 누를경우
//일단 soaa_reg, soaa_reg_check 두곳에서 모두다 삭제함.
//정책이 Y/N  구분이 아닌 삭제임.
function View_Del_regNo(){
	var f = document.form;
	var page_nm = "soaa_DelProc.php";

	if(confirm("삭제하신 데이터는 복구가 불가능합니다.\n삭제 하시겠습니까?")==true){
		f.action=page_nm;
		f.submit();
	}else{
		return false;
	}
}

function soaa_list_Del(page_nm,page_no,reg_no){
	var page_nm = "soaa_DelProc.php";

	if(confirm("삭제하신 데이터는 복구가 불가능합니다.\n삭제 하시겠습니까?")==true){
		location.href=page_nm + "?reg_no=" + reg_no + "&page_no=" + page_no;
	}else{
		return false;
	}
}

function View_regNo_update(){
	var f = document.form;
	var page_nm = "soaa_chkStart_proc.php";

	if(confirm("입력하신 내용으로 검사접수를 진행 하시겠습니까?")==true){
		f.action = page_nm;
		f.submit();
	}else{
		return false;
	}
}

function ExcelDown(page_nm){

	var f = document.form;

	if(f.select_gigan_y.value == ""){
		alert("기간을 선택하거나 입력하신 후 인쇄하셔야 합니다.");
		document.form.select_gigan_y.focus();
	}
	if(f.select_gigan_y.value != "" && f.select_gigan_m.value == ""){
		alert("기간을 선택하거나 입력하신 후 인쇄하셔야 합니다.");
		document.form.select_gigan_m.focus();
	}

	if(f.select_gigan_y.value > 0 && f.select_gigan_m.value > 0){
		f.action=page_nm + ".php";
		f.submit();
//		location.href=page_nm + ".php?select_gigan_y=" + select_gigan_y + "&select_gigan_m=" + select_gigan_m;
	}
}

function date_loop(number){
	
	var num = number;
	alert(num);
	var date_loop="";
	for(var date_loop=1; date_loop<=num; date_loop++){
		$("#input_date" + num).datepicker({
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
	}
}