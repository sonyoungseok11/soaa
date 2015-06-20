<?  include $_SERVER["DOCUMENT_ROOT"] . "/bigad_Mng/left_menu.php"; ?>

<link rel="stylesheet" type="text/css" href="/css/admin/soaa_reg.css">


<?
//	$soaa_reg_del = fn_delete("soaa_reg", "insert_id is null");
//	$bigad_SoaaRegCheck_del = fn_delete("bigad_SoaaRegCheck", "insert_id is null");

	$year = date("Y");
	$month = date("m");
	$day = date("d");
	$reg_today = $year . "-" . $month . "-" . $day;

	$rs = fn_select_fetch_array("reg_no", "bigad_SoaaRegCheck", "reg_no is not null order by reg_no desc limit 0,1");
	$reg_no = $rs["reg_no"];

	if($reg_no){
		$reg_no_seNum = explode("-", $reg_no);
		$reg_no_seNum[1]++;
		$reg_no_seLength = strlen($reg_no_seNum[1]);

		switch($reg_no_seLength){
			case "1":	//00001 -> 00002
				$reg_no_seNum[1] = str_pad($reg_no_seNum[1], "5", "0", str_pad_left);
			case "2":	//00011 -> 00012
				$reg_no_seNum[1] = str_pad($reg_no_seNum[1], "5", "0", str_pad_left);
			case "3":
				$reg_no_seNum[1] = str_pad($reg_no_seNum[1], "5", "0", str_pad_left);
			case "4":
				$reg_no_seNum[1] = str_pad($reg_no_seNum[1], "5", "0", str_pad_left);
			case "5":
				$reg_no_seNum[1] = str_pad($reg_no_seNum[1], "5", "0", str_pad_left);
		}

	$reg_no = $year . "-" . $reg_no_seNum[1];

	}else{
		$reg_no = $year . "-" . "00001";
	}

	//동시간대에 여러 사람이 각각 입력할 수 있어서
	//reg_no 를 우선 insert 하고 proc 에서 사용자 입력 정보를 update
	//신청자 주소나 표시위치 주소 입력 안하면 proc 페이지로 못감.

//	$soaa_reg_insert = fn_insert("reg_no", "'$reg_no'", "bigad_SoaaRegCheck");
	$bigad_SoaaRegCheck_insert = fn_insert("reg_no", "'$reg_no'", "bigad_SoaaRegCheck");

	$rs = fn_select_fetch_array("reg_no", "bigad_SoaaRegCheck", "reg_no='$reg_no'");
?>
<!--
<body onload="screen_width();">
-->
<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump"><a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전점검&nbsp;관리</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전점검&nbsp;접수</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="/img/set_icon.png" alt="icon">안전점검&nbsp;접수<span class="contop_tip">안전점검&nbsp;접수를&nbsp;할&nbsp;수&nbsp;있습니다&#46;</span><span class="info_notice"><a href="#"><img src="/img/notice.png" alt="알림"></a></span></p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
					<form id="form" name="form" method="post" enctype="multipart/form-data">
					<input type="hidden" name="actions" value="insert">
                        <div class="receive_table">
                            <table>
                                <colgroup>
                                    <col span="2" width="70px" />
                                    <col width="540px" />
                                    <col width="140px" />
                                    <col width="*" />
                                </colgroup>
                                <tr>
                                    <td class="con_title" colspan="2">접수번호</td>
                                    <td class="con_content01"><input type="text" class="w180 readonly" name="reg_no" value="<?=$rs["reg_no"]?>" readonly></td>
                                    <td class="con_title">접수날짜</td>
                                    <td class="con_content02"><input type="text" class="w180" id="st_date" name="reg_date" value="<?=$reg_today?>"></td>
                                </tr>
                                <tr>
                                    <td class="con_apart01" rowspan="3">신<br>청<br>자</td>
                                    <td class="con_apart02">성명</td>
                                    <td class="con_content01"><input type="text" class="w180" name="c_ceo_nm"></td>
                                    <td class="con_title">주민등록번호</td>
                                    <td class="con_content02">
										<input type="text" class="w80" name="c_rrn1" maxlength="6">&nbsp;&#8211;&nbsp;
										<input type="text" class="w80 readonly" name="c_rrn2" value="*******" maxlength="7" readonly>
									</td>
                                </tr>
                                <tr>
                                    <td class="con_apart02">업소명</td>
                                    <td class="con_content01"><input type="text" class="w180" name="c_corp_nm"></td>
                                    <td class="con_title">전화번호</td>
                                    <td class="con_content02">
										<input type="text" class="w80" name="c_tel0" value="02" maxlength="3">&nbsp;&#8211;&nbsp;
										<input type="text" class="w80"name="c_tel1" maxlength="4">&nbsp;&#8211;&nbsp;
										<input type="text" class="w80"name="c_tel2" maxlength="4"></td>
                                </tr>
                                <tr>
                                    <td class="con_apart02">주소</td>
                                    <td colspan="3" class="bg_f9">
                                        <div class="dong_name">
                                            동&nbsp;이름<input type="text" class="w130"><img src="/img/search_addr.png" alt="검색" onclick="move_zip_search_popup('1');">
											<span class="search_tip">검색할&nbsp;동&nbsp;이름을&nbsp;입력해주세요&#46;</span>
                                        </div>
                                        <div class="addr">
                                            <input type="text" class="w50" id="c_jibun1" name="c_jibun1">&nbsp;&#8211;&nbsp;
											<input type="text" class="w50" id="c_jibun2" name="c_jibun2">&nbsp;
											<input type="text" class="w350" id="c_addr" name="c_addr" value="" onkeydown="CopyValue01();">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="con_title" colspan="2">광고물&nbsp;등의&nbsp;종류</td>
                                    <td class="con_content01">
                                        <select id="outdoor_act_cate" name="outdoor_act_cate" onchange="change_view_input(this.value);">
											<?
												$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='01' order by order_idx");
												while($rs = mysql_fetch_array($result)){
											?>
                                            <option value="<?=$rs["en_nm"]?>"><?=$rs["ko_nm"]?></option>
											<? } ?>
                                        </select>
                                    </td>
                                    <td class="con_title">사용자재</td>
                                    <td class="con_content02"><input type="text" class="w180" name="use_item"></td>
                                </tr>
                                <tr>
                                    <td class="con_title" colspan="2">검사수수료</td>
                                    <td class="con_content01">
										<input type="text" class="w100" name="check_pay" onkeyup="commaNum(this.value);" maxlength="10">원&#40;숫자만&nbsp;가능&#41;
									</td>
                                    <td class="con_title">광고물&nbsp;형식</td>
                                    <td class="con_content02">
                                        <select name="outdoor_act_type">
                                            <?
												$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='05'");
												while($rs = mysql_fetch_array($result)){
											?>
                                            <option value="<?=$rs["en_nm"]?>"><?=$rs["ko_nm"]?></option>
											<? } ?>
                                        </select><img src="/img/mini_bar.png" class="mini_bar" alt="bar">광고물&nbsp;구분
                                        <input type="radio" class="mar_lr" name="outdoor_act_type_gubun" value="N" checked="checked">신규
										<input type="radio" class="mar_lr" name="outdoor_act_type_gubun" value="R">연장
                                        <input type="radio" class="mar_lr" name="outdoor_act_type_gubun" value="E">기타</td>
                                </tr>
                                <tr>
                                    <td class="con_title" colspan="2">표시&nbsp;위치&nbsp;&amp;&nbsp;장소</td>
                                    <td colspan="3" class="bg_f9">
                                        <div class="dong_name">
                                            동&nbsp;이름<input type="text" class="w130"><img src="/img/search_addr.png" alt="검색" onclick="move_zip_search_popup('2');">
											<span class="search_tip">검색할&nbsp;동&nbsp;이름을&nbsp;입력해주세요&#46;</span>
                                        </div>
                                        <div class="addr">
                                            <input type="text" class="w50" id="outdoor_real_jibun1" name="outdoor_real_jibun1">&nbsp;&#8211;&nbsp;
											<input type="text" class="w50" id="outdoor_real_jibun2" name="outdoor_real_jibun2">&nbsp;
											<input type="text" class="w350" id="outdoor_real_addr" name="outdoor_real_addr" value="" onkeydown="CopyValue02();">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="con_title" colspan="2">해당구청</td>
                                    <td class="con_content01">
                                        <select class="gu_office" id="gu_office" name="gu_office">
											<?
												$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='10' order by order_idx");
												while($rs = mysql_fetch_array($result)){
											?>
                                            <option value="<?=$rs["en_nm"]?>"><?=$rs["ko_nm"]?></option>
											<? } ?>
                                        </select>
                                    </td>
                                    <td class="con_title">광고물&nbsp;등의&nbsp;규격&nbsp;&nbsp;
										<input type="button" class="btn" id="outdoorSizeCnt" value="add" onclick="addInputText(document.form.outdoor_act_cate.value);">&nbsp;
									</td>
                                    <td class="con_content02" id="outdoor_sizeA">
                                        &nbsp;&nbsp;<input type="text" class="w60 m_left" name="outdoor_size0">x
										<input type="text" class="w60 mar" name="outdoor_size1">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="con_apart01" rowspan="3">시<br>공<br>업<br>소</td>
                                    <td class="con_apart02">대표자</td>
                                    <td class="con_content01"><input type="text" class="w180" name="s_ceo_nm"></td>
                                    <td class="con_title">사업자등록번호</td>
                                    <td class="con_content02">
                                        <input type="text" class="w80" name="s_biz_no0" maxlength="3">&nbsp;&#8211;&nbsp;<input type="text" class="w80" name="s_biz_no1" maxlength="2">&nbsp;&#8211;&nbsp;<input type="text" class="w80" name="s_biz_no2" maxlength="5">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="con_apart02">업소명</td>
                                    <td colspan="3" class="bg_f9"><input type="text" class="w180" name="s_corp_nm"></td>
                                </tr>
                                <tr>
                                    <td class="con_apart02">주소</td>
                                    <td colspan="3" class="bg_f9">
                                        <div class="dong_name">

                                            동&nbsp;이름<input type="text" class="w130"><img src="/img/search_addr.png" alt="검색" onclick="move_zip_search_popup('3');">
											<span class="search_tip">검색할&nbsp;동&nbsp;이름을&nbsp;입력해주세요&#46;</span>
                                        </div>
                                        <div class="addr">
                                            <input type="text" class="w50" id="s_jibun1" name="s_jibun1">&nbsp;&#8211;&nbsp;
											<input type="text" class="w50" id="s_jibun2" name="s_jibun2">&nbsp;
											<input type="text" class="w350" id="s_addr" name="s_addr">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="con_title" colspan="2">기타사항</td>
                                    <td colspan="3" class="bg_f9"><textarea class="etc" name="memo1"></textarea></td>
                                </tr>
								<tr>
									<td class="con_title" colspan="2">등급</td>
                                    <td class="con_content01" colspan="3">
										<select name="bigad_Grade">
											<option value="">&nbsp;&nbsp;선택&nbsp;&nbsp;</option>
											<option value="A">A</option>
											<option value="A">B</option>
											<option value="A">C</option>
											<option value="A">D</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="con_title" colspan="2">현장사진1</td>
                                    <td class="con_content01" colspan="1">
										<input type="file" name="bigad_PlacePic1">
									</td>
									<td class="con_title" colspan="1">현장사진2</td>
                                    <td class="con_content01" colspan="1">
										<input type="file" name="bigad_PlacePic2">
									</td>
								</tr>
								<tr>
                                    <td class="con_title" colspan="2">지시사항1</td>
                                    <td colspan="1" class="bg_f9">
										<textarea class="etc" name="bigad_OrderIndi1"></textarea>
									</td>
									<td class="con_title" colspan="1">지시사항 사진1</td>
									<td class="con_content01" colspan="1">	
										<input type="file" name="bigad_OrderIndi1Pic">
									</td>
                                </tr>
								<tr>
                                    <td class="con_title" colspan="2">지시사항2</td>
                                    <td colspan="1" class="bg_f9">
										<textarea class="etc" name="bigad_OrderIndi2"></textarea>
									</td>
									<td class="con_title" colspan="1">지시사항 사진2</td>
									<td class="con_content01" colspan="1">	
										<input type="file" name="bigad_OrderIndi2Pic">
									</td>
                                </tr>
								<tr>
                                    <td class="con_title" colspan="2">점검내용</td>
                                    <td colspan="3" class="bg_f9">
										<input type="radio" name="chkContent" value="N" onclick="viewChkContent('nonview');" checked >특이사항 없음.
										<input type="radio" name="chkContent" value="Y" onclick="viewChkContent('view');">특이사항 있음.
									</td>
								</tr>
                            </table>
							<table id="viewChkContent"></table>
						</form>

                        </div><!--receive_table-->
                        <div class="receive_btn">
                            <input type="button" value="검사접수" id="submit_btn01" onclick="soaa_reg_proc();">
                        </div><!--receive_btn-->
                        <div class="add_file">
							<form name="excelform" enctype="multipart/form-data" method="post">
								<table>
									<tr>
										<td class="addf_title">엑셀&nbsp;첨부</td>
										<td class="addf_con"><input type="file" name="src"><input type="button" value="전송" id="submit_btn02" onclick="excelUpload();"></td>
									</tr>
								</table>
							</form>
                        </div>

						<div class="sample_file">
							<table>
								<tr>
									<td class="addf_title">파일&nbsp;양식</td>
									<td class="addf_con">
										<a href="javascript:void(0);" onclick="ExcelSampleDown('sampleDownload');">SoaaUploadExcel.xls</a>
									</td>
								</tr>
							</table>
						</div>
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>