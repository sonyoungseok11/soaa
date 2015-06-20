var SoaaRegBtnClickCnt = 4;

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
function print(printThis){
//alert(printThis);
	    win = window.open();
    self.focus();
    win.document.open();
    win.document.write('<'+'html'+'><'+'head'+'><'+'style'+'>');
    win.document.write('body, td { font-family: Verdana; font-size: 10pt;}');
    win.document.write('<'+'/'+'style'+'><'+'/'+'head'+'><'+'body'+'>');
    win.document.write(printThis);
    win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
    win.document.close();
    win.print();
    win.close();
}

//프린트할 대상 페이지로 이동해서 프린트할 결과물 화면에 출력
function move_print_page(){
	var f = document.form;
	var cnt = arguments;
	var page_nm = cnt[0];

	switch(cnt.length){

		case 2:
			//입금입력목록
			var search_cnt = cnt[1];
			
			if(search_cnt < 1){
				alert("검색후 이용해 주십시요");
				return false;
			}
		break;
		//안전점검관리대장 조회
		case 3:
			if(cnt[0] == "soaa_mng_list"){
				var select_gigan_y = cnt[1];
				var select_gigan_m = cnt[2];

				if (select_gigan_y == ""){
					alert("기간을 선택하거나 입력하신 후 인쇄하셔야 합니다.");
					document.getElementsByName("select_gigan_y")[0].focus();
					return false;
				}
				if (select_gigan_m == ""){
					alert("기간을 선택하거나 입력하신 후 인쇄하셔야 합니다.");
					document.getElementsByName("select_gigan_m")[0].focus();
					return false;
				}
			}
		break;
		//안전점검 결과보고서
		case 4:
			var st_date = cnt[1];
			var ed_date = cnt[2];
			var tmp_cnt = cnt[3];

			var loop_cnt = "";
			var real_list_num = "";
			var chkbox_result = "";

			if (st_date == ""){
				alert("기간을 선택하거나 입력하신 후 인쇄하셔야 합니다.");
				document.getElementsByName("st_date")[0].focus();
				return false;
			}
			if (ed_date == ""){
				alert("기간을 선택하거나 입력하신 후 인쇄하셔야 합니다.");
				document.getElementsByName("ed_date")[0].focus();
				return false;
			}
			
			//넘겨받은 리스트 갯수는 20개인데, 게시글 리스트에는 20개 미만인경우 실제 게시글 리스트 갯수 가져오기
			//(보통 마지막 블럭 게시글)
			for(var i=0; i<tmp_cnt; i++){
				if(document.getElementsByName("chkbox[]")[i] != undefined){
					real_list_num++;
				}else{
					break;
				}
			}
			
			for(var i=0; i<real_list_num; i++){
				if(document.getElementsByName("chkbox[]")[i].checked == true){
					chkbox_result++;
				}
			}

			if(chkbox_result < 1){
				alert("선택된 항목이 없습니다");
				return false;
			}
		break;
	}

	if(confirm("출력을 진행하시겠습니까?") == true){
		f.action="/print/" + page_nm + ".php";
		f.submit();
	}else{
		return false;
	}
}

//function move_print_page(){
//	var f = document.form;
//	var select_gigan_y = select_gigan_y;
//	var select_gigan_m = select_gigan_m;
//
//	//안전점검관리대장 조회
//	if(page_nm == "soaa_mng_list"){
//		if (select_gigan_y == ""){
//			alert("기간을 선택하거나 입력하신 후 인쇄하셔야 합니다.");
//			document.getElementsByName("select_gigan_y")[0].focus();
//			return false;
//		}
//		if (select_gigan_m == ""){
//			alert("기간을 선택하거나 입력하신 후 인쇄하셔야 합니다.");
//			document.getElementsByName("select_gigan_m")[0].focus();
//			return false;
//		}
//	}
//
//	//입금입력목록
//	if(page_nm == "giro_list"){
//		if(
//	}
//	f.action="/print/" + page_nm + ".php";
//	f.submit();
//}


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

	f.action="/excelUpload/excel_proc.php";
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
	var	f	=	document.form;
	var c_ceo_nm	=	f.c_ceo_nm.value;
	var c_rrn1	=	f.c_rrn1.value;
//	var c_biz_no1	=	f.c_biz_no1.value;
//	var c_biz_no2	=	f.c_biz_no2.value;
	var c_corp_nm	=	f.c_corp_nm.value;
	var c_tel0		=	f.c_tel0.value;
	var c_tel1		=	f.c_tel1.value;
	var c_tel2		=	f.c_tel2.value;
	var c_addr		=	f.c_addr.value;	//신청자 주소
	var outdoor_real_addr = f.outdoor_real_addr.value;	//표시위치 장소
	var use_item = f.use_item.value;

//	if(c_ceo_nm == ""){
//		alert("신청자 성명을 입력해 주십시요.");
//		f.c_ceo_nm.focus();
//		return false;
//	}
//
//	if(c_rrn1 == ""){
//		alert("사업자 등록번호를 입력해 주십시요.");
//		f.c_rrn1.focus();
//		return false;
//	}

//	if(c_biz_no1 == ""){
//		alert("사업자 등록번호를 입력해 주십시요.");
//		f.c_biz_no1.focus();
//		return false;
//	}
//	if(c_biz_no2 == ""){
//		alert("사업자 등록번호를 입력해 주십시요.");
//		f.c_biz_no2.focus();
//		return false;
//	}

//	if(c_corp_nm == ""){
//		alert("업소명을 입력해 주십시요.");
//		f.c_corp_nm.focus();
//		return false;
//	}
//	if(c_tel0 == ""){
//		alert("전화번호를 입력해 주십시요.");
//		f.c_tel0.focus();
//		return false;
//	}
//	if(c_tel1 == ""){
//		alert("전화번호를 입력해 주십시요.");
//		f.c_tel1.focus();
//		return false;
//	}
//	if(c_tel2 == ""){
//		alert("전화번호를 입력해 주십시요.");
//		f.c_tel2.focus();
//		return false;
//	}
//
//	if(c_addr == ""){
//		alert("신청자주소를 입력해 주십시요.");
//		f.c_addr.focus();
//		return false;
//	}
//	if(use_item == ""){
//		alert("사용자재를 입력해 주십시요.");
//		f.use_item.focus();
//		return false;
//	}
//	if(outdoor_real_addr == ""){
//		alert("표시위치를 입력해 주십시요.");
//		f.outdoor_real_addr.focus();
//		return false;
//	}

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
function commaNum1(num) { 

	var f = document.form;
	var rf_payment = f.rf_payment.value;
	var num	=	num.split(",").join("");	
	var numLength = num.length;
	var tmp = "";

	switch(numLength){
		
		case 4:	//1,000
			tmp=num[0] + "," + num[1]+ num[2]+ num[3];
			f.rf_payment.value = tmp; break;
		case 5:	//10,000
			tmp=num[0] + num[1]+ "," +num[2]+ num[3]+ num[4];
			f.rf_payment.value = tmp; break;
		case 6:	//100,000
			tmp=num[0] + num[1]+ num[2] + "," + num[3]+ num[4] +num[5];
			f.rf_payment.value = tmp; break;
		case 7:	//1,000,000
			tmp=num[0] +","+ num[1]+ num[2]+ num[3] +","+ num[4] + num[5]+ num[6];
			f.rf_payment.value = tmp; break;
		case 8:	//10,000,000
			tmp=num[0] + num[1]+ "," +  num[2]+ num[3] + num[4] + ","+  num[5] + num[6] + num[7];
			f.rf_payment.value = tmp; break;
	}
}

function commaNumArray(line_num, num) { 
	//일자 복사
	var keycode	=	event.keyCode;	//giro_reg.php 금액에 입력하는 문자가 숫자인지 tab 키인지 구분하기 위함.
	var DateCopyValue	= "";		//입력하는 글자가 탭키면 줄에 있는 날짜를 복사해서 현재이하의 모든 아랫줄에 복사.
	var loop_start = "";			//현재 줄 번호를 반복시킬 for 문의 시작점에 복사.
	var i = "";						//
	var line_num = line_num;		//현재 라인의 시작번호

	var num	=	num.split(",").join("");	
	var numLength = num.length;
	var tmp = "";

	switch(numLength){	
		case 4:	//1,000
			tmp=num[0] + "," + num[1]+ num[2]+ num[3];
			document.getElementsByName("check_pay[]")[line_num-1].value = tmp;	break;
		case 5:	//10,000
			tmp=num[0] + num[1]+ "," +num[2]+ num[3]+ num[4];
			document.getElementsByName("check_pay[]")[line_num-1].value = tmp;	break;
		case 6:	//100,000
			tmp=num[0] + num[1]+ num[2] + "," + num[3]+ num[4] +num[5];
			document.getElementsByName("check_pay[]")[line_num-1].value = tmp;	break;
		case 7:	//1,000,000
			tmp=num[0] +","+ num[1]+ num[2]+ num[3] +","+ num[4] + num[5]+ num[6];
			document.getElementsByName("check_pay[]")[line_num-1].value = tmp;	break;
		case 8:	//10,000,000
			tmp=num[0] + num[1]+ "," +  num[2]+ num[3] + num[4] + ","+  num[5] + num[6] + num[7];
			document.getElementsByName("check_pay[]")[line_num-1].value = tmp;	break;
	}

	//금액에서 탭키 누를경우 현재 칸의 날짜(일자)를 현재 이하의 모든 열에 붙이기 S
	for(var k=1; k<=20; k++){
		if(line_num != ""){
			loop_start = line_num;
			break;
		}
	}
	if(keycode == 9){	//Tab Key
		for(i=loop_start; i<=20; i++){
			if(DateCopyValue == ""){
				DateCopyValue = document.getElementById("input_date" + i).value;
			}
			document.getElementById("input_date" + i).value	=	DateCopyValue;
		}
	}
	//E
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
		case "강남구":	select_gugun="gangnamgu";	break;
		case "동작구":	select_gugun="dongjackgu";	break;
		case "도봉구":	select_gugun="dobonggu";	break;
		case "동대문구":	select_gugun="dongdaemungu";	break;
		case "강북구":	select_gugun="gangbukgu";	break;
		case "기타":	select_gugun="ETC";	break;
		case "강동구":	select_gugun="gangdonggu";	break;
		case "강서구":	select_gugun="gangseogu";	break;
		case "금천구":	select_gugun="guemcheongu";	break;
		case "구로구":	select_gugun="gurogu";	break;
		case "관악구":	select_gugun="gwangakgu";	break;
		case "광진구":	select_gugun="gwangjingu";	break;
		case "종로구":	select_gugun="jongrogu";	break;
		case "중구":	select_gugun="junggu";	break;
		case "중랑구":	select_gugun="jungranggu";	break;
		case "마포구":	select_gugun="mapogu";	break;
		case "노원구":	select_gugun="nowongu";	break;
		case "서초구":	select_gugun="seochogu";	break;
		case "서대문구": select_gugun="seodaemungu";	break;
		case "성북구":	select_gugun="seongbukgu";	break;
		case "성동구":	select_gugun="seongdonggu";	break;
		case "송파구":	select_gugun="songpagu";	break;
		case "은평구":	select_gugun="unpyeongu";	break;
		case "양천구":	select_gugun="yangcheongu";	break;
		case "영등포구":	select_gugun="yeongdungpogu";	break;
		case "용산구":	select_gugun="yongsangu";	break;
	}

	var select_box = opener.document.getElementById("gu_office");

	if( num == 1){
		//soaa_reg > 해당 구청의 value 값을 가져옴.	
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
		//opener.document.getElementById("c_addr").value = sido + " " + gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;
		opener.document.getElementById("c_addr").value = gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;

		opener.document.getElementById("outdoor_real_addr").value = "";
		//opener.document.getElementById("outdoor_real_addr").value = sido + " " + gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;
		opener.document.getElementById("outdoor_real_addr").value = gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;

		opener.document.getElementById("outdoor_act_cate").focus();
	}else{
		//표시 위치를 입력하지 않으면 신청자의 주소 구가 해당구청에 들어가며
		//표시위치가 바뀌면 검색한 구가 해당구청에 들어감.
		for(var i=0; i<=select_box.length; i++){
			if(select_box[i].value == select_gugun){
				select_box[i].selected = true;
				break;
			}
		}
		opener.document.getElementById("outdoor_real_jibun1").value	= zipcode1;
		opener.document.getElementById("outdoor_real_jibun2").value	= zipcode2;

		opener.document.getElementById("outdoor_real_addr").value = "";
		//opener.document.getElementById("outdoor_real_addr").value = sido + " " + gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;
		opener.document.getElementById("outdoor_real_addr").value = gugun + " " + doro_nm + " " + doro_1 + "-" + doro_2 + " " + gunmul_nm1;
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

//입금입력 목록에서 찾아보기 버튼
function giro_search(page_nm){
	var f = document.form;
	var st_date1 =	document.getElementById("st_date1").value;
	var st_date2 =	document.getElementById("st_date2").value;
	var ed_date1 =	document.getElementById("ed_date1").value;
	var ed_date2 =	document.getElementById("ed_date2").value;

	if(st_date1){
		if(st_date2 == ""){
			alert("납입일자 종료일을 선택해주십시요.");
			return false;
		}
	}

	if(ed_date1){
		if(ed_date2 == ""){
			alert("등록일자 종료일을 선택해주십시요.");
			return false;
		}
	}

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
function navi_move(page_nm, page, select_page_num, st_date, ed_date, gu_office, c_corp_nm, c_ceo_nm, reg_no,outdoor_act_cate, chk_paytype, report_certi, chk_result){
	location.href=page_nm + ".php?page=" + page + "&select_page_num=" + select_page_num + "&st_date=" + st_date + "&ed_date=" + ed_date + "&gu_office=" + gu_office + 
		"&c_corp_nm=" + c_corp_nm + "&c_ceo_nm=" + c_ceo_nm + "&c_corp_nm=" + c_corp_nm + "&rega_no=" + reg_no + "&outdoor_act_cate=" + outdoor_act_cate +
		"&chk_paytype=" + chk_paytype + "&report_certi=" + report_certi + "&chk_result=" + chk_result;
}
//안전점검관리대장 접수 페이징 내비
function navi_mng_list(page_nm, page, select_page_num, select_gigan_y, select_gigan_m, st_date, ed_date, gu_office, c_corp_nm, c_ceo_nm, rega_no, chk_personA, outdoor_act_cate,
	payment_state, report_certi, chk_result){

	location.href=page_nm + ".php?page=" + page + "&select_page_num=" + select_page_num + "&select_gigan_y=" + select_gigan_y + "&select_gigan_m=" + select_gigan_m + 
	"&st_date=" + st_date + "&ed_date=" + ed_date + "&gu_office=" + gu_office + "&c_corp_nm=" + c_corp_nm + "&c_ceo_nm=" + c_ceo_nm + "&rega_no=" + rega_no + 
	"&chk_personA=" + chk_personA + "&outdoor_act_cate=" + outdoor_act_cate;
}
//입금,수수료관리 입금입력목록 페이징 내비
function navi_giro_list(page_nm,page,select_page_num,st_date1,st_date2,ed_date1,ed_date2,TMP,gu_office,c_corp_nm,c_ceo_nm,c_tel){

	location.href=page_nm + ".php?page=" + page + "&select_page_num=" + select_page_num + "&st_date1=" + st_date1 + "&st_date2=" + st_date2 + 
	"&ed_date1=" + ed_date1 + "&ed_date2=" + ed_date2 + "&TMP=" + TMP + "&gu_office=" + gu_office + "&c_corp_nm=" + c_corp_nm + "&c_ceo_nm=" + c_ceo_nm + "&c_tel=" + c_tel;
}

//환불 입력목록 네비
function navi_return_list(page_nm, page, st_date1, st_date2, ed_date1, ed_date2, TMP, gu_office, c_corp_nm, c_ceo_nm){
	location.href=page_nm + ".php?page=" + page + "&st_date1=" + st_date1 + "&st_date2=" + st_date2 + "&ed_date1=" + ed_date1 + 
	"&ed_date2=" + ed_date2 + "&TMP=" + TMP + "&gu_office=" + gu_office + "&c_corp_nm=" + c_corp_nm + "&c_ceo_nm=" + c_ceo_nm;
}
//확인리스트 입력목록 네비
function navi_confirm_list(page_nm, page, st_date1, st_date2, ed_date1, ed_date2, TMP, gu_office, c_corp_nm, c_ceo_nm){
	location.href=page_nm + ".php?page=" + page + "&st_date1=" + st_date1 + "&st_date2=" + st_date2 + "&ed_date1=" + ed_date1 + 
	"&ed_date2=" + ed_date2 + "&TMP=" + TMP + "&gu_office=" + gu_office + "&c_corp_nm=" + c_corp_nm + "&c_ceo_nm=" + c_ceo_nm;
}
//안전점검 결과보고서 네비
function navi_check_result_report(page_nm, page, select_page_num, st_date, ed_date, gu_office, c_corp_nm, c_ceo_nm, reg_no,outdoor_act_cate, chk_paytype, report_certi, chk_result,listNum){
	location.href=page_nm + ".php?page=" + page + "&select_page_num=" + select_page_num + "&st_date=" + st_date + "&ed_date=" + ed_date + "&gu_office=" + gu_office + 
		"&c_corp_nm=" + c_corp_nm + "&c_ceo_nm=" + c_ceo_nm + "&c_corp_nm=" + c_corp_nm + "&rega_no=" + reg_no + "&outdoor_act_cate=" + outdoor_act_cate +
		"&chk_paytype=" + chk_paytype + "&report_certi=" + report_certi + "&chk_result=" + chk_result + "&listNum=" + listNum;
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
	if(confirm("삭제하신 데이터는 복구가 불가능합니다.\n삭제 하시겠습니까?")==true){
		location.href=page_nm + ".php?reg_no=" + reg_no + "&page_no=" + page_no;
	}else{
		return false;
	}
}

function View_regNo_update(page_nm){
	var f = document.form;
	var page_nm = page_nm;

	//검사결과가 미검사일 경우 검사일날짜는 필수임.
	if(f.chk_result[7].checked==true){
		if(f.real_chkday.value == "" || f.real_chkday.value == "--"){
			alert("검사일자를 선택하여 주십시요.");
			return false;
		}		
	}

	if(confirm("입력하신 내용으로 검사접수를 진행 하시겠습니까?")==true){
		f.action = page_nm + ".php";
		f.submit();
	}else{
		return false;
	}
}
function content_update(page_nm, reg_no){
	var f = document.form;

	if(confirm("내용을 수정하시겠습니까?") == true){
		f.action = page_nm + ".php?reg_no=" + reg_no;
		f.submit();
	}else{
		return false;
	}
}

function ExcelDown_0(page_nm){

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
	}
}

function ExcelDown_1(page_nm, where){

	var f = document.form;

	if(where == 0){
		alert("검색 조건을 입력해주십시요");
		return false;
	}
	f.action=page_nm + ".php";
	f.submit();
}

function ExcelDown_2(page_nm, where){

	var f = document.form;

	if(where == 0){
		alert("검색 조건을 입력해주십시요");
		return false;
	}
	f.action=page_nm + ".php";
	f.submit();
}

function ExcelSampleDown(page_nm){
	location.href="/excelUpload/" + page_nm + ".php";
}

function date_loop(number){
	
	var num = number;
	var loop=0;

	for(var i=1; i<=num; i++){
		$("#input_date" + i).datepicker({
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

	}
}

function selectbox_allChange(select_nm, st_num){
	for(var i=st_num; i<20; i++){
		document.getElementsByName("gu_office[]")[i].value = select_nm;
	}
}

function giro_reg_proc(page_nm){
	var f = document.form;

	f.action=page_nm + ".php";
	f.submit();
}

function move_report_cate(page_nm, gubun){
	location.href=page_nm + ".php?gubun=" + gubun;
}

function search_stats_y(page_nm, year){
	var f = document.form;

	f.action=page_nm + ".php";
	f.submit();
}

function search_stats_m(page_nm, month){
	var f = document.form;

	f.action=page_nm + ".php";
	f.submit();
}

function search_stats_d(page_nm, month){
	var f = document.form;

	f.action=page_nm + ".php";
	f.submit();
}

//giro_list 수정버튼 클릭시 재귀로 돌아오면서 내용 수정할수 있는 div 필드 display.
function giro_modify(page_nm, idx){
	location.href=page_nm + ".php?idx=" + idx;
}
function returnlist_modify(page_nm, idx){
	location.href=page_nm + ".php?idx=" + idx;
}


//안전점검 접수 ->  SELECT BOX 변경시.
function change_view_input(obj){

	SoaaRegBtnClickCnt = 4;
	//지주일경우 1x1  h 형식으로 input text 형식을 맞춤.
	//옥상일 경우 1x1, 2x2, 3x3, 4x4 형식
	//기본은 1x1 형시.

	switch(obj){
		case "jiju" :
			$("#outdoor_sizeA").empty();
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size0'>");
			$("#outdoor_sizeA").append("x&nbsp;");
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size1'>");
			$("#outdoor_sizeA").append("&nbsp;H");
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_sizeH0'>");
			break;
		case "oksang" :
			$("#outdoor_sizeA").empty();
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 0 +"'>");
			$("#outdoor_sizeA").append("&nbsp;x&nbsp;");
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 1 +"'>");
			$("#outdoor_sizeA").append("&nbsp;,&nbsp;");

			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 2 +"'>");
			$("#outdoor_sizeA").append("&nbsp;x&nbsp;");
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 3 +"'>");
			$("#outdoor_sizeA").append("&nbsp;,&nbsp;");

			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 4 +"'>");
			$("#outdoor_sizeA").append("&nbsp;x&nbsp;");
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 5 +"'>");
			$("#outdoor_sizeA").append("&nbsp;,&nbsp;");

			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 6 +"'>");
			$("#outdoor_sizeA").append("&nbsp;x&nbsp;");
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 7 +"'>");
			break;
		default :
			$("#outdoor_sizeA").empty();
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size0'>");
			$("#outdoor_sizeA").append("x");
			$("#outdoor_sizeA").append("&nbsp;<input type='text' class='w60 mar' name='outdoor_size1'>");
			break;
	}
}

function change_view_input_viewPage(obj){

	if(obj != "jiju"){
		document.getElementById("notjiju").style.display = "block";
		document.getElementById("jiju").style.display = "none";
	}else{
		document.getElementById("notjiju").style.display = "none";
		document.getElementById("jiju").style.display = "block";
	}
}

//안전점검접수 -> 광고물규격의 add 버튼 누를경우
function addInputText(obj){

	//SoaaRegBtnClickCnt -> 전역변수임.
	if(SoaaRegBtnClickCnt > 5){
		alert("최대 2개까지만 추가할 수 있습니다");
		return false;
	}
	if(obj === "jiju"){
		
		//광고물종류가 지주면 무조건 광고물규격의 input 레이아웃을 초기화후 진행.지주 이외의 다른 광고물을 클릭후에 지주를 클릭할 수 있기 때문임.
		$("#outdoor_sizeA").empty();
		$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 0 +"'>");
		$("#outdoor_sizeA").append("x");
		$("#outdoor_sizeA").append("&nbsp;<input type='text' class='w60 mar' name='outdoor_size" + 1 +"'>");

		if(SoaaRegBtnClickCnt == 4){
			//지주 클릭후 add 를 처음 클릭한 것이라면 n x n 형태만 추가해줌.
			$("#outdoor_sizeA").append("&nbsp;,&nbsp;");
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 2 +"'>");
			$("#outdoor_sizeA").append("x");
			$("#outdoor_sizeA").append("&nbsp;<input type='text' class='w60 mar' name='outdoor_size" + 3 +"'>");
		}else{
			//지주 클릭후 add 를 두번째 클릭한 것이라면 n x n 형태를 한번 더 추가해줌.

			$("#outdoor_sizeA").append(",");
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 2 +"'>");
			$("#outdoor_sizeA").append("x");
			$("#outdoor_sizeA").append("&nbsp;<input type='text' class='w60 mar' name='outdoor_size" + 3 +"'>");

			$("#outdoor_sizeA").append("&nbsp;,&nbsp;");
			$("#outdoor_sizeA").append("<input type='text' class='w60 mar' name='outdoor_size" + 4 +"'>");
			$("#outdoor_sizeA").append("x");
			$("#outdoor_sizeA").append("&nbsp;<input type='text' class='w60 mar' name='outdoor_size" + 5 +"'>");
		}

		$("#outdoor_sizeA").append("&nbsp;H<input type='text' class='w60 mar' name='outdoor_sizeH0'>");
	}else{

		//기존 input text 박스가 4개라서 add 버튼 누를때마다 input 박스를 하나씩 최대 2개까지 추가한다.
		switch(SoaaRegBtnClickCnt){
			case 4:
				$("#outdoor_sizeA").append(",&nbsp;<input type='text' class='w60 mar' name='outdoor_size" + 2 +"'>");
				$("#outdoor_sizeA").append("x&nbsp;<input type='text' class='w60 mar' name='outdoor_size" + 3 +"'>");
			break;
			case 5:
				$("#outdoor_sizeA").append(",&nbsp;<input type='text' class='w60 mar' name='outdoor_size" + 4 +"'>");
				$("#outdoor_sizeA").append("x&nbsp;<input type='text' class='w60 mar' name='outdoor_size" + 5 +"'>");
			break;
		}
	}
	SoaaRegBtnClickCnt++;
}
function noConfirmSearch(page_nm, gu_office, width, c_ceo_nm, search_option){
	var popUrl = page_nm + ".php?gu_office=" + gu_office + "&c_ceo_nm=" + c_ceo_nm + "&search_option=" + search_option;
	var name = "";
	var option = "width=" + width + ", height=540" + ", scrollbars=yes";
	var target= "";
	switch(page_nm){
		case "charge_search":
			target = "_self";	break;
	}
	window.open(popUrl, name, option);
}

function noConfirmCallBack(page_nm){
	var f = document.form;

	f.action = page_nm + ".php";
	f.submit();
}

//입금, 수수료관리 > 미확인리스트 > 리스트의 검색 버튼 > 팝업창 > 마우스 오버 / 아웃 색상 변화S
function mouseOver(num){
	document.getElementsByName("c_corp_nm" +num)[0].style.background = "#b3b3b3";
	document.getElementsByName("c_ceo_nm" +num)[0].style.background = "#b3b3b3";
	document.getElementsByName("c_tel" +num)[0].style.background = "#b3b3b3";
	document.getElementsByName("outdoor_real_addr" +num)[0].style.background = "#b3b3b3";
	document.getElementsByName("reg_date" +num)[0].style.background = "#b3b3b3";
	document.getElementsByName("choice" +num)[0].style.background = "#b3b3b3";
}

function mouseOut(num){
	document.getElementsByName("c_corp_nm" +num)[0].style.background = "#ffffff";
	document.getElementsByName("c_ceo_nm" +num)[0].style.background = "#ffffff";
	document.getElementsByName("c_tel" +num)[0].style.background = "#ffffff";
	document.getElementsByName("outdoor_real_addr" +num)[0].style.background = "#ffffff";
	document.getElementsByName("reg_date" +num)[0].style.background = "#ffffff";
	document.getElementsByName("choice" +num)[0].style.background = "#ffffff";
}


//입금, 수수료관리 > 미확인리스트 > 리스트의 검색 버튼 > 팝업창 > 마우스 오버 / 아웃 색상 변화E
function noConfirm_Update(page_nm, reg_no, idx){
	// page_nm = noConFirm_proc
	var f	=	document.form;

	location.href=page_nm + ".php?reg_no=" + reg_no + "&idx=" + idx;
}
function Print_ChkReport(listNum, gu_office, select_page_num, search_tot){
	var chkResult=0;
	var f = document.form;
	var reg_no = "";
	var guOfficeType = "";
	var prn_page = "";
	var joHang1	=	"";
	var joHang2	=	"";
	
	var listNum = listNum.split(",");
	var gu_office = gu_office.split(",");

	var select_page_num = select_page_num;
	var search_tot = search_tot;


	//리스트 갯수는 20개인데 검색결과가 10개일경우 총 반복 횟수를 10회로 변경.
	if(search_tot >= select_page_num){
		select_page_num = search_tot;
	}

	if(select_page_num > 0){
		for(var i=0; i<select_page_num; i++){
			if(document.getElementsByName("chkbox[]")[i].checked){

				chkResult++;
				reg_no += document.getElementsByName("chkbox[]")[i].value + ",";
	
				//검색한 구청이 있으면 검사서 타입에 매칭시킴.
				//검사서는 구청별로 A, B 타입 두종류가 존재.
				switch(gu_office[i]){
					case "guemcheongu":	guOfficeType="guemcheongu";	joHang1="제37조";	joHang2="제16조1항";	break;
					case "gangseogu":	guOfficeType="gangseogu";	joHang1="제37조";	joHang2="제17조1항";	break;
					case "dongjackgu":	guOfficeType="dongjackgu";	joHang1="제37조";	joHang2="제17조1항";	break;

					case "gangnamgu":	guOfficeType="B";	joHang1="제37조";	joHang2="제20조";	break;
					case "dobonggu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "dongdaemungu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "gangbukgu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "ETC":	guOfficeType="B";	break;
					case "gangdonggu":	guOfficeType="B";	joHang1="제37조";	joHang2="제19조제1항";	break;
					case "gurogu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "gwangakgu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "gwangjingu":	guOfficeType="B";	joHang1="제37조";	joHang2="제19조제1항";	break;
					case "jongrogu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "junggu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "jungranggu":	guOfficeType="B";	joHang1="제37조";	joHang2="제23조제1항";	break;
					case "mapogu":	guOfficeType="B";	joHang1="제37조";	joHang2="제16조제1항";	break;
					case "nowongu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "seochogu":	guOfficeType="B";	joHang1="제37조";	joHang2="제19조제1항";	break;
					case "seodaemungu": guOfficeType="B";	joHang1="제37조";	joHang2="제16조제1항";	break;
					case "seongbukgu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "seongdonggu":	guOfficeType="B";	joHang1="제37조";	joHang2="제20조제1항";	break;
					case "songpagu":	guOfficeType="B";	joHang1="제37조";	joHang2="제18조제1항";	break;
					case "unpyeongu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "yangcheongu":	guOfficeType="B";	joHang1="제37조";	joHang2="제16조";	break;
					case "yeongdungpogu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
					case "yongsangu":	guOfficeType="B";	joHang1="제37조";	joHang2="제17조제1항";	break;
				}
				switch(guOfficeType){
					case "guemcheongu":
						prn_page = "print_safe_report_01_guemcheongu.php";
						break;
					case "gangseogu":
						prn_page = "print_safe_report_01_gangseogu.php";
						break;
					case "dongjackgu":
						prn_page = "print_safe_report_01_dongjackgu.php";
						break;
					case "B":
						prn_page = "print_safe_report_02.php";
						break;
				}
				if(chkResult > 0){
					location.href="/print/" + prn_page + "?reg_no=" + reg_no + "&gu_office=" + gu_office[i] + "&joHang1=" + joHang1 + "&joHang2=" + joHang2;
//					location.href="/print/" + prn_page + "?reg_no=" + reg_no + "&gu_office=" + gu_office[i] + "&joHang1=" + joHang1 + "&joHang2=" + joHang2;
				}
			}		
		}
	}else{
		alert("검색 결과가 없습니다.");
		return false;
	}
}

function return_list_gubun(){
	alert("협회에서 페이지 제거를 요청 받은\n입금,수수료관리->검사수수료 관리페이지에서\n수정할수 있는 항목임.");
}

function se_date(){
	
	var d = new Date();
	var page_nm = "";

	var year = d.getFullYear();
	var month = d.getMonth()+1;
	var day = d.getDate();


	if(month < 10){
		month = "0" + month;
	}

	if(day < 10){
		day = "0" + day;
	}

	var today = year + "-" + month + "-" + day;

	var a = arguments;
	page_nm	=	a[0];
	date_num	=	a[1];

	if(page_nm == "soaa_list" || page_nm == "soaa_mng_list" || page_nm == "check_result_report"){
		document.getElementById("ed_date").value = today;
	}else{

		if(date_num == "st_date1"){
			document.getElementById("st_date2").value = today;
		}else{
			document.getElementById("ed_date2").value = today;
		}
	}	
}

//안전점검접수(soaa_reg) 신청자 주소 value 값을 표시위치 장소 value 로 복사.
function CopyValue01(){
	if(event.keyCode == 9){
		var f = document.form;
		var c_addr = f.c_addr.value;
		
		f.outdoor_real_addr.value = f.c_addr.value;

		var tmp_addr = c_addr.split(' ');
		var modify_addr = "";

		switch(tmp_addr[0]){
			case "종로구": modify_addr = "jongrogu"; break;
			case "중구": modify_addr = "junggu"; break;
			case "용산구": modify_addr = "yongsangu"; break;
			case "성동구": modify_addr = "seongdonggu"; break;
			case "광진구": modify_addr = "gwangjingu"; break;

			case "동대문구": modify_addr = "dongdaemungu"; break;
			case "중랑구": modify_addr = "jungranggu"; break;
			case "성북구": modify_addr = "seongbukgu"; break;
			case "강북구": modify_addr = "gangbukgu"; break;
			case "도봉구": modify_addr = "dobonggu"; break;

			case "노원구": modify_addr = "nowongu"; break;
			case "은평구": modify_addr = "unpyeongu"; break;
			case "서대문구": modify_addr = "seodaemungu"; break;
			case "마포구": modify_addr = "mapogu"; break;
			case "양천구": modify_addr = "yangcheongu"; break;

			case "강서구": modify_addr = "gangseogu"; break;
			case "구로구": modify_addr = "gurogu"; break;
			case "금천구": modify_addr = "guemcheongu"; break;
			case "영등포구": modify_addr = "yeongdungpogu"; break;
			case "동작구": modify_addr = "dongjackgu"; break;

			case "관악구": modify_addr = "gwangakgu"; break;
			case "서초구": modify_addr = "seochogu"; break;
			case "강남구": modify_addr = "gangnamgu"; break;
			case "송파구": modify_addr = "songpagu"; break;
			case "강동구": modify_addr = "gangdonggu"; break;
		}
		f.gu_office.value=modify_addr;
	}
}

function CopyValue02(){
	if(event.keyCode == 9){
		var f = document.form;
		var outdoor_real_addr = f.outdoor_real_addr.value;

		var tmp_addr = outdoor_real_addr.split(' ');
		var modify_addr = "";

		switch(tmp_addr[0]){
			case "종로구": modify_addr = "jongrogu"; break;
			case "중구": modify_addr = "junggu"; break;
			case "용산구": modify_addr = "yongsangu"; break;
			case "성동구": modify_addr = "seongdonggu"; break;
			case "광진구": modify_addr = "gwangjingu"; break;

			case "동대문구": modify_addr = "dongdaemungu"; break;
			case "중랑구": modify_addr = "jungranggu"; break;
			case "성북구": modify_addr = "seongbukgu"; break;
			case "강북구": modify_addr = "gangbukgu"; break;
			case "도봉구": modify_addr = "dobonggu"; break;

			case "노원구": modify_addr = "nowongu"; break;
			case "은평구": modify_addr = "unpyeongu"; break;
			case "서대문구": modify_addr = "seodaemungu"; break;
			case "마포구": modify_addr = "mapogu"; break;
			case "양천구": modify_addr = "yangcheongu"; break;

			case "강서구": modify_addr = "gangseogu"; break;
			case "구로구": modify_addr = "gurogu"; break;
			case "금천구": modify_addr = "guemcheongu"; break;
			case "영등포구": modify_addr = "yeongdungpogu"; break;
			case "동작구": modify_addr = "dongjackgu"; break;

			case "관악구": modify_addr = "gwangakgu"; break;
			case "서초구": modify_addr = "seochogu"; break;
			case "강남구": modify_addr = "gangnamgu"; break;
			case "송파구": modify_addr = "songpagu"; break;
			case "강동구": modify_addr = "gangdonggu"; break;
		}
		f.gu_office.value=modify_addr;
	}
}

//인쇄 버튼 클릭시 프린터 제어
function ThisWindowsPrint(garo, left_Margin, right_Margin, top_Margin, bottom_Margin) {

	with ( factory.printing ){ 
		header = ''; 
		footer = ''; 

		if(garo == "garo"){
		portrait = false; // true 세로출력 , false 가로출력
		}else{
		portrait = true; // true 세로출력 , false 가로출력
		}
		leftMargin = left_Margin; 
		rightMargin = right_Margin; 
		topMargin = top_Margin; 
		bottomMargin = bottom_Margin; 

		Print(true, window) // 첫번째 인자 : 대화상자표시여부 , 두번째인자 : 출력될 프레임
		history.back(-1);
	}
//window.close();
}

//인쇄 버튼 클릭시 프린터 제어
function PrintSoaaInputGraph(garo) {
	with ( factory.printing ){ 
		header = ''; 
		footer = ''; 

		if(garo == "garo"){
		portrait = false; // true 세로출력 , false 가로출력
		}else{
		portrait = true; // true 세로출력 , false 가로출력
		}
		leftMargin = 20; 
		rightMargin = 20; 
		topMargin = 0; 
		bottomMargin = 0; 
		Print(true, window) // 첫번째 인자 : 대화상자표시여부 , 두번째인자 : 출력될 프레임
		history.back(-1);
	}
//window.close();
}

function pop_open(page_nm, idx, width){
//	alert(page_nm);

	var popUrl = page_nm + ".php?idx=" + idx;
	var name = "";
	var option = "width=" + width + ", height=380" + ", scrollbars=yes";
	var target= "";


	window.open(popUrl, name, option);
}

function Print_PrtPrt(page_nm, listNum, gu_office, select_page_num, search_tot){

	var chkResult=0;
	var f = document.form;
	var reg_no = "";
	var guOfficeType = "";
	var prn_page = "";
	var joHang1	=	"";
	var joHang2	=	"";
	var prn_page = page_nm + ".php";

	var listNum = listNum.split(",");
	var gu_office = gu_office.split(",");

	var select_page_num = select_page_num;
	var search_tot = search_tot;

	if(search_tot >= select_page_num){
		select_page_num = search_tot;
	}

	//페이지 리스트 갯수만큼 반복문 돌려서 체크된 접수번호가 있는지 확인
	if(select_page_num > 0){
		for(var i=0; i<select_page_num; i++){
			if(document.getElementsByName("chkbox[]")[i].checked){
				chkResult++;
				reg_no += document.getElementsByName("chkbox[]")[i].value + ",";

				if(chkResult > 0){
					location.href="/print/" + prn_page + "?reg_no=" + reg_no;
				}
			}
		}
	}
}
function updateGiroList(page_nm, idx, where){
	var f = document.form;
	var page_nm = page_nm + ".php";

	if(confirm("수정 하시겠습니까?") == true){
		f.action = "./" + page_nm;
		f.method="POST";
		f.submit();
	}else{
		return false;
	}
}

function viewChkContent(view){

	if(view == "view"){
		var str = "";
		str += "<br><br><br>";
		str +="	<tr>";
		str +="		<td width='100px' style='background-color:#919191;text-align:center;'>구&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;분</td>";
		str +="		<td width='550px' style='background-color:#919191;text-align:center;'>점&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;검&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;내&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;용</td>";
		str +="		<td width='200px' style='background-color:#919191;text-align:center;'>점&nbsp;&nbsp;검&nbsp;&nbsp;결&nbsp;&nbsp;과</td>";
		str +="		<td width='200px' style='background-color:#919191;text-align:center;'>비&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;고";
		str +="	</tr>";
		str +="	<!--기초부분-->";
		str +="	<tr>";
		str +="		<td rowspan='3' style='padding-left:10px;'>1.기초부분</td>";
		str +="		<td style='padding-left:10px;'> ▶ 앵커 등 광고물 고정 시설물 상태</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"1_1_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"1_1_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 기초콘크리트 상태</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"1_2_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"1_2_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(";

		for(var i=0; i<=50; i++){
			str += "&nbsp;";
		}

		str +="		)";
		str +="		</td>";
		str +="		<td style='padding-left:10px;'> <input type=\"text\" name=\"1_3_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"1_3_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<!--기초부분-->";
		str +="	<!--철골부분-->";
		str +="	<tr>";
		str +="		<td rowspan=\"4\" style='padding-left:10px;'>2.철골부분</td>";
		str +="		<td style='padding-left:10px;'> ▶ 앵글연결분 용접 또는 볼트조임상태</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"2_1_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"2_1_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 게시시설에 광고물 게시상태</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"2_2_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"2_2_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 부&nbsp;식&nbsp;상&nbsp;태</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"2_3_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"2_3_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(";

		for(var i=0; i<=50; i++){
			str += "&nbsp;";
		}

		str +="		)";
		str +="		</td>";
		str +="		<td style='padding-left:10px;'> <input type=\"text\" name=\"2_4_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"2_4_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<!--철골부분-->";


		str +="	<!--전기설비-->";
		str +="	<tr>";
		str +="		<td rowspan=\"7\" style='padding-left:10px;'>3.전기설비</td>";
		str +="		<td style='padding-left:10px;'> ▶ 안전기등 전기설비 부착상태</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_1_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_1_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 전기배선 등 절연 상태</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_2_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_2_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 피뢰침상태</td>";
		str +="		<td style='padding-left:10px;'> <input type=\"text\" name=\"3_3_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_3_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 누전차단기 작동여부</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_4_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_4_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 접지시설 상태</td>";
		str +="		<td style='padding-left:10px;'> <input type=\"text\" name=\"3_5_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_5_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 전기사용 자재 규격품 사용여부</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_6_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_6_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="	<td style='padding-left:10px;'> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(";

		for(var i=0; i<=50; i++){
			str += "&nbsp;";
		}

		str +="		)";
		str +="		</td>";
		str +="		<td style='padding-left:10px;'> <input type=\"text\" name=\"3_7_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"3_7_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<!--전기설비-->";


		str +="	<!--도색상태-->";
		str +="	<tr>";
		str +="		<td rowspan=\"2\" style='padding-left:10px;'>4.도색상태</td>";
		str +="		<td style='padding-left:10px;'> ▶ 광고면 페이트 도장상태(미관저해여부)</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"4_1_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"4_1_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="	<td style='padding-left:10px;'> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(";

		for(var i=0; i<=50; i++){
			str += "&nbsp;";
		}

		str +="		)";
		str +="		</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"4_2_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"4_2_etc\" value=\"\"></td>";
		str +="	</tr>";


		str +="	<!--기타-->";
		str +="	<tr>";
		str +="		<td rowspan=\"3\" style='padding-left:10px;'>5. 기타</td>";
		str +="		<td style='padding-left:10px;'> ▶ 설계서 및 시방서와 일치여부</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"5_1_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"5_1_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="		<td style='padding-left:10px;'> ▶ 외관상 구조전문가의 점검 필요하거나 붕괴위험 여부</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"5_2_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"5_2_etc\" value=\"\"></td>";
		str +="	</tr>";
		str +="	<tr>";
		str +="	<td style='padding-left:10px;'> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(";

		for(var i=0; i<=50; i++){
			str += "&nbsp;";
		}

		str +="		)";
		str +="		</td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"5_3_result\" value=\"\"></td>";
		str +="		<td style='padding-left:10px;'><input type=\"text\" name=\"5_3_etc\" value=\"\"></td>";
		str +="	</tr>";



	}else{
		var str = "";
	}

		document.getElementById("viewChkContent").innerHTML = str;
}

function showChkContent(view){

	var str = "";

	//특이사항있음 라디오 버튼 클릭하면 일단 초기화후(empty) 추가(append)
	if(view == "view"){
		document.getElementById("viewChkContent").style.display = "block";
	}else{
		//특이사항없음 라디오버튼 클릭하면 기존 append 되어 있었던 내용 초기화.
		// 없음 있음을 몇번씩 클릭하면 table 내용이 계속 생겨서 추가하였음.
		document.getElementById("viewChkContent").style.display = "none";
	}
}