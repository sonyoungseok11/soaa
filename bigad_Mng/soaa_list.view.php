<?  include $_SERVER["DOCUMENT_ROOT"] . "/bigad_Mng/left_menu.php"; ?>

<link rel="stylesheet" type="text/css" href="/css/admin/soaa_view.css">

<?
	$reg_no	=	$_GET['reg_no'];
	$page_no	=	$_GET['page_no'];

	$rs = fn_select_fetch_array("*", "bigad_SoaaRegCheck", "reg_no='$reg_no'");
	$return_rs = fn_select_fetch_array("*", "return_list", "reg_no='$reg_no'");

	$c_biz_no	=	explode("-", $rs['c_biz_no']);
	$s_biz_no	=	explode("-", $rs['s_biz_no']);
	$c_tel		=	explode("-", $rs['c_tel']);

	//******** 검사일*********//
	$real_chkDay		=	explode(" ", $return_rs['real_chkDay']);
	$real_chkDay		=	explode("-", $real_chkDay[0]);
	$real_chkDay = $real_chkDay[0] . "-" . $real_chkDay[1] . "-" . $real_chkDay[2];
	//******** 검사일*********//

	//******** 검사료납부일*********//
	$input_payment_date		=	explode(" ", $return_rs['input_payment_date']);
	$input_payment_date		=	explode("-", $input_payment_date[0]);
	$input_payment_date = $input_payment_date[0] . "-" . $input_payment_date[1] . "-" . $input_payment_date[2];
	//******** 검사료납부일*********//

	$outdoor_act_cate	=	$rs['outdoor_act_cate'];
?>
<form name="form" method="post">
<input type="hidden" name="reg_no" value="<?=$rs['reg_no']?>">
<input type="hidden" name="page_no" value="<?=$page_no?>">
<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump"><a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전점검&nbsp;관리</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전점검&nbsp;접수현황</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="../img/set_icon.png" alt="icon">안전점검&nbsp;접수현황<span class="contop_tip">안전점검&nbsp;접수를&nbsp;한&nbsp;현황에&nbsp;대해서&nbsp;조회&#44;&nbsp;관리할&nbsp;수&nbsp;있습니다&#46;</span><span class="info_notice"><a href="#"><img src="../img/notice.png" alt="알림"></a></span></p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <div class="receive_table">
                        <table>
                        	<colgroup>
                                <col span="2" width="70px">
                                <col width="*">
                                <col width="140px">
                                <col width="*">
                            </colgroup>
                            <tr>
                                <td class="con_title" colspan="2">접수번호</td>
                                <td class="con_content01"><input type="text" class="w140 readonly" name="reg_no" value="<?=$rs['reg_no']?>" readonly></td>
                                <td class="con_title">접수날짜</td>
                                <td class="con_content02"><input type="text" class="w140 readonly" name="reg_date" value="<?=$rs['reg_date']?>" readonly></td>
                            </tr>
                            <tr>
                                <td class="con_apart01" rowspan="3">신<br>청<br>자</td>
                                <td class="con_apart02">성명</td>
                                <td class="con_content01"><input type="text" class="w140" name="c_ceo_nm" value="<?=$rs['c_ceo_nm']?>"></td>
								<td class="con_title">주민등록번호</td>
                                    <td class="con_content02">
										<input type="text" class="w80" name="c_rrn1" maxlength="6" value="<?=$rs['c_rrn1']?>">&nbsp;&#8211;&nbsp;
										<input type="text" class="w80 readonly" name="c_rrn2" value="*******" maxlength="7" readonly>
									</td>
                            </tr>
                            <tr>
                                <td class="con_apart02">업소명</td>
                                <td class="con_content01"><input type="text" class="w140" name="c_corp_nm" value="<?=$rs['c_corp_nm']?>"></td>
                                <td class="con_title">전화번호</td>
                                <td class="con_content02">
									<input type="text" class="w80" name="c_tel0" value="<?=$c_tel[0]?>">&nbsp;&#8211;&nbsp;
									<input type="text" class="w80" name="c_tel1" value="<?=$c_tel[1]?>" maxlength="4">&nbsp;&#8211;&nbsp;
									<input type="text" class="w80" name="c_tel2" value="<?=$c_tel[2]?>" maxlength="4">
								</td>
                            </tr>
                            <tr>
                                <td class="con_apart02">주소</td>
                                <td colspan="3" class="bg_f9">
                                    <div class="dong_name">
                                        동&nbsp;이름<input type="text" class="w130"><img src="../img/search_addr.png" alt="검색"><span class="search_tip">검색할&nbsp;동&nbsp;이름을&nbsp;입력해주세요&#46;</span>
                                    </div>
                                    <div class="addr">
                                        <input type="text" class="w50" name="c_jibun1" value="<?=$rs['c_jibun1']?>">&nbsp;&#8211;&nbsp;
										<input type="text" class="w50" name="c_jibun2" value="<?=$rs['c_jibun2']?>">&nbsp;
										<input type="text" class="w350" name="c_addr" value="<?=$rs['c_addr']?>" onkeydown="CopyValue01();">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="con_title" colspan="2">광고물&nbsp;등의&nbsp;종류</td>
                                <td class="con_content01">
									<select name="outdoor_act_cate" onchange="change_view_input_viewPage(this.value);">
                                    <?
										$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='01'  order by order_idx");
										while($rs_cate = mysql_fetch_array($result)){
									?>
									<option value="<?=$rs_cate["en_nm"]?>" <? if ($rs_cate["en_nm"] == $rs['outdoor_act_cate']) { echo "selected=selected"; } ?> ><?=$rs_cate["ko_nm"]?></option>
									<? } ?>
									</select>
                                </td>
                                <td class="con_title">광고물&nbsp;형식</td>
                                <td class="con_content02">
                                    <select name="outdoor_act_type">
									<?
										$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='05'");
										while($rs_type = mysql_fetch_array($result)){
									?>
									<option value="<?=$rs_type["en_nm"]?>" <? if ($rs_type["en_nm"] == $rs['outdoor_act_type']) { echo "selected=selected"; } ?>><?=$rs_type["ko_nm"]?></option>
									<? } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="con_title" colspan="2">표시&nbsp;위치<br>&amp;&nbsp;장소</td>
                                <td colspan="3" class="bg_f9">
                                    <div class="dong_name">
                                        동&nbsp;이름<input type="text" class="w130"><img src="../img/search_addr.png" alt="검색"><span class="search_tip">검색할&nbsp;동&nbsp;이름을&nbsp;입력해주세요&#46;</span>
                                    </div>
                                    <div class="addr">
                                        <input type="text" class="w50" name="outdoor_real_jibun1" value="<?=$rs['outdoor_real_jibun1']?>">&nbsp;&#8211;&nbsp;
										<input type="text" class="w50" name="outdoor_real_jibun2" value="<?=$rs['outdoor_real_jibun2']?>">&nbsp;
										<input type="text" class="w350" name="outdoor_real_addr" value="<?=$rs['outdoor_real_addr']?>" onkeydown="CopyValue02();">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="con_title" colspan="2">해당구청</td>
                                <td class="con_content01">
                                    <select class="seoul_gu" name="gu_office">
									<?
										$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='10' order by order_idx");
										while($rs_office = mysql_fetch_array($result)){
									?>
									<option value="<?=$rs_office["en_nm"]?>" <? if ($rs_office["en_nm"] == $rs['gu_office']) { echo "selected=selected"; } ?>><?=$rs_office["ko_nm"]?></option>
									<? } ?>
                                    </select>
                                </td>
                                <td class="con_title">광고물&nbsp;등의&nbsp;규격</td>
									<? if($rs['outdoor_act_cate'] <> "jiju"){ ?>
									<td class="con_content02" id="notjiju" style="display:block;">
                                        &nbsp;&nbsp;
										<input type="text" class="w60 m_left" name="outdoor_size0" value="<?=$rs['outdoor_size0']?>">&nbsp;x
										<input type="text" class="w60 mar" name="outdoor_size1" value="<?=$rs['outdoor_size1']?>">,
										<input type="text" class="w60 mar" name="outdoor_size2" value="<?=$rs['outdoor_size2']?>">&nbsp;x
										<input type="text" class="w60 mar" name="outdoor_size3" value="<?=$rs['outdoor_size3']?>">,
										<input type="text" class="w60 m_left" name="outdoor_size4" value="<?=$rs['outdoor_size4']?>">&nbsp;x
										<input type="text" class="w60 mar" name="outdoor_size5" value="<?=$rs['outdoor_size5']?>">,
										<input type="text" class="w60 mar" name="outdoor_size6" value="<?=$rs['outdoor_size6']?>">&nbsp;x
										<input type="text" class="w60 mar" name="outdoor_size7" value="<?=$rs['outdoor_size7']?>">
                                    </td>
									<td class="con_content02" id="jiju" style="display:none;">
                                        &nbsp;&nbsp;
										<input type="text" class="w60 m_left" name="j_outdoor_size0" value="<?=$rs['outdoor_size0']?>"> &nbsp;x
										<input type="text" class="w60 mar" name="j_outdoor_size1"value="<?=$rs['outdoor_size1']?>">,
										<input type="text" class="w60 mar" name="j_outdoor_size2" value="<?=$rs['outdoor_size2']?>">&nbsp;x
										<input type="text" class="w60 mar" name="j_outdoor_size3" value="<?=$rs['outdoor_size3']?>">,
										<input type="text" class="w60 m_left" name="j_outdoor_size4" value="<?=$rs['outdoor_size4']?>">&nbsp;x
										<input type="text" class="w60 mar" name="j_outdoor_size5" value="<?=$rs['outdoor_size5']?>">,
										<input type="text" class="w60 mar" name="j_outdoor_size6" value="<?=$rs['outdoor_size6']?>">&nbsp;x
										<input type="text" class="w60 mar" name="j_outdoor_size7" value="<?=$rs['outdoor_size7']?>">&nbsp;H
										<input type="text" class="w60 mar" name="j_outdoor_sizeH0" value="<?=$rs['outdoor_sizeH0']?>">
                                    </td>
									<? } else { ?>
									<td class="con_content02" id="notjiju" style="display:none;">
                                        &nbsp;&nbsp;
										<input type="text" class="w60 m_left" name="outdoor_size0" value="<?=$rs['outdoor_size0']?>">&nbsp;x
										<input type="text" class="w60 mar" name="outdoor_size1" value="<?=$rs['outdoor_size1']?>">,
										<input type="text" class="w60 mar" name="outdoor_size2" value="<?=$rs['outdoor_size2']?>">&nbsp;x
										<input type="text" class="w60 mar" name="outdoor_size3" value="<?=$rs['outdoor_size3']?>">,
										<input type="text" class="w60 m_left" name="outdoor_size4" value="<?=$rs['outdoor_size4']?>">&nbsp;x
										<input type="text" class="w60 mar" name="outdoor_size5" value="<?=$rs['outdoor_size5']?>">,
										<input type="text" class="w60 mar" name="outdoor_size6" value="<?=$rs['outdoor_size6']?>">&nbsp;x
										<input type="text" class="w60 mar" name="outdoor_size7" value="<?=$rs['outdoor_size7']?>">
                                    </td>
									<td class="con_content02" id="jiju" style="display:block;">
                                        &nbsp;&nbsp;
										<input type="text" class="w60 m_left" name="j_outdoor_size0" value="<?=$rs['outdoor_size0']?>"> &nbsp;x
										<input type="text" class="w60 mar" name="j_outdoor_size1"value="<?=$rs['outdoor_size1']?>">,
										<input type="text" class="w60 mar" name="j_outdoor_size2" value="<?=$rs['outdoor_size2']?>">&nbsp;x
										<input type="text" class="w60 mar" name="j_outdoor_size3" value="<?=$rs['outdoor_size3']?>">,
										<input type="text" class="w60 m_left" name="j_outdoor_size4" value="<?=$rs['outdoor_size4']?>">&nbsp;x
										<input type="text" class="w60 mar" name="j_outdoor_size5" value="<?=$rs['outdoor_size5']?>">,
										<input type="text" class="w60 mar" name="j_outdoor_size6" value="<?=$rs['outdoor_size6']?>">&nbsp;x
										<input type="text" class="w60 mar" name="j_outdoor_size7" value="<?=$rs['outdoor_size7']?>">&nbsp;H
										<input type="text" class="w60 mar" name="j_outdoor_sizeH0" value="<?=$rs['outdoor_sizeH0']?>">
                                    </td>
									<? } ?>
                            </tr>
                            <tr>
                                <td class="con_title" colspan="2">검사자</td>
                                <td class="con_content01">
                                    <select class="chk_inspector" name="chk_personA">
									<option value="">선택</option>
                                    <?
										$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='15'");
										while($rs_chk_psn = mysql_fetch_array($result)){
									?>
										<option value="<?=$rs_chk_psn["en_nm"]?>" <? if($rs['chk_personA'] == $rs_chk_psn['en_nm']){ echo "selected";}?>><?=$rs_chk_psn["ko_nm"]?></option>
									<? } ?>
                                    </select>
                                    <select class="chk_inspector" name="chk_personB">
									<option value="">선택</option>
									<? 
										$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='15'");
										while($rs_chk_psn = mysql_fetch_array($result)){
									?>
										<option value="<?=$rs_chk_psn["en_nm"]?>" <? if($rs['chk_personB'] == $rs_chk_psn['en_nm']){ echo "selected";}?>><?=$rs_chk_psn["ko_nm"]?></option>
									<? } ?>
                                    </select>
                                </td>
                                <td class="con_title">검사결과</td>
                                <td class="con_content02">
                                    <input type="radio" class="mar_lr m_left0" name="chk_result" value="pass" <? if($rs['chk_result'] == "pass"){ echo "checked=checked";} ?> checked="checked">안전
									<input type="radio" class="mar_lr" name="chk_result" value="failed" <? if($rs['chk_result'] == "failed"){ echo "checked=checked";} ?>>불합격
                                    <input type="radio" class="mar_lr" name="chk_result" value="NonMake" <? if($rs['chk_result'] == "NonMake"){ echo "checked=checked";} ?>>미설치
									<input type="radio" class="mar_lr" name="chk_result" value="NonTarget" <? if($rs['chk_result'] == "NonTarget"){ echo "checked=checked";} ?>>비대상
                                    <input type="radio" class="mar_lr" name="chk_result" value="PlaceModify" <? if($rs['chk_result'] == "PlaceModify"){ echo "checked=checked";} ?>>현장시정
									<input type="radio" class="mar_lr" name="chk_result" value="defer" <? if($rs['chk_result'] == "defer"){ echo "checked=checked";} ?>>보류
                                    <input type="radio" class="mar_lr" name="chk_result" value="pullDown" <? if($rs['chk_result'] == "pullDown"){ echo "checked=checked";} ?>>철거
									<input type="radio" class="mar_lr" name="chk_result" value="NonChk" <? if($rs['chk_result'] == "NonChk"){ echo "checked=checked";} ?>>미검사
                                </td>
                            </tr>
                            <tr>
                                <td class="con_title" colspan="2">검사료</td>
                                <td class="con_content01"><input type="text" class="w100" name="check_pay" value="<?=$rs['chk_pay']?>" onkeyup="commaNum(this.value);" maxlength="10">원</td>
                                <td class="con_title">검사료납부&nbsp;여부</td>
                                <td class="con_content02">
									<input type="radio" name="payment_state" value="PC" class="mar_lr m_left0" <? if($rs['payment_state'] == "PC"){ echo "checked=checked";} ?> checked="checked">입금
									<input type="radio" name="payment_state" value="PN" class="mar_lr" <? if($rs['payment_state'] == "PN"){ echo "checked=checked";} ?>>미수금
									<input type="radio" name="payment_state" value="RF" class="mar_lr" <? if($rs['payment_state'] == "RF"){ echo "checked=checked";} ?>>환불</td>
                            </tr>
                            <tr>
                                <td class="con_title" colspan="2">검사일</td>
                                <td class="con_content01"><input type="text" class="w100" id="st_date" name="real_chkday" value="<?=$real_chkDay?>"></td>
                                <td class="con_title">검사료&nbsp;납부일</td>
                                <td class="con_content02"><input type="text" class="w100" id="pay_checkin_date" name="payment_in_day" value="<?=$input_payment_date?>"></td>
                            </tr>
                            <tr>
                                <td class="con_title" colspan="2">필증교부</td>
                                <td colspan="3">
									<input type="radio" name="report_certi" class="mar_lr" value="N" <? if($rs['report_certi'] == "N"){ echo "checked=checked";} ?>>미교부
									<input type="radio" name="report_certi" class="mar_lr" value="Y" <? if($rs['report_certi'] == "Y"){ echo "checked=checked";} ?>>교부
								</td>
                            </tr>
                            <tr>
                                <td class="con_apart01" rowspan="3">시<br>공<br>업<br>소</td>
                                <td class="con_apart02">대표자</td>
                                <td class="con_content01"><input type="text" class="w140" name="s_ceo_nm" value="<?=$rs['s_ceo_nm']?>"></td>
                                <td class="con_title">사업자등록번호</td>
                                <td class="con_content02">
                                    <input type="text" class="w80" name="s_biz_no0" value="<?=$s_biz_no[0]?>">&nbsp;&#8211;&nbsp;
									<input type="text" class="w80" name="s_biz_no1" value="<?=$s_biz_no[1]?>">&nbsp;&#8211;&nbsp;
									<input type="text" class="w80" name="s_biz_no2" value="<?=$s_biz_no[2]?>">
                                </td>
                            </tr>
                            <tr>
                                <td class="con_apart02">업소명</td>
                                <td colspan="3" class="bg_f9"><input type="text" class="w140" name="s_corp_nm" value="<?=$rs['s_corp_nm']?>"></td>
                            </tr>
                            <tr>
                                <td class="con_apart02">주소</td>
                                <td colspan="3" class="bg_f9">
                                    <div class="dong_name">
                                        동&nbsp;이름<input type="text" class="w130"><img src="../img/search_addr.png" alt="검색"><span class="search_tip">검색할&nbsp;동&nbsp;이름을&nbsp;입력해주세요&#46;</span>
                                    </div>
                                    <div class="addr">
                                        <input type="text" class="w50" name="s_jibun1" value="<?=$rs['s_jibun1']?>">&nbsp;&#8211;&nbsp;
										<input type="text" class="w50" name="s_jibun2" value="<?=$rs['s_jibun2']?>">&nbsp;
										<input type="text" class="w350" name="s_addr" value="<?=$rs['s_addr']?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="con_title" colspan="2">검사의견</td>
                                <td colspan="3" class="bg_f9"><textarea class="opinion" name="memo1"><?=$rs['memo1']?></textarea></td>
                            </tr>
                            <tr>
                                <td class="con_title" colspan="2">기타사항</td>
                                <td colspan="3" class="bg_f9"><textarea class="etc" name="etc_memo"> <?=$rs['etc_memo']?></textarea></td>
                            </tr>
                        </table>

						<?
							$rs_Print = fn_select_fetch_array("*", "bigad_PrintPage", "reg_no='$reg_no'");

//							echo "idx=" . $rs_PringPage['idx'];
							if($rs_Print['idx']){
						?>
						<table>
							<tr>
								<td width='100px' style='background-color:#919191;text-align:center;'>구&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;분</td>
								<td width='550px' style='background-color:#919191;text-align:center;'>점&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;검&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;내&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;용</td>
								<td width='200px' style='background-color:#919191;text-align:center;'>점&nbsp;&nbsp;검&nbsp;&nbsp;결&nbsp;&nbsp;과</td>
								<td width='200px' style='background-color:#919191;text-align:center;'>비&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;고
							</tr>
							<!--기초부분-->
							<tr>
								<td rowspan='3' style='padding-left:10px;'>1.기초부분</td>
								<td style='padding-left:10px;'> ▶ 앵커 등 광고물 고정 시설물 상태</td>
								<td style='padding-left:10px;'><input type="text" name="1_1_result" value="<?=$rs_Print['one_one_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="1_1_etc" value="<?=$rs_Print['one_one_etc']?>"></td>
							</tr>
							<tr>
								<td style='padding-left:10px;'> ▶ 기초콘크리트 상태</td>
								<td style='padding-left:10px;'><input type="text" name="1_2_result" value="<?=$rs_Print['one_two_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="1_2_etc" value="<?=$rs_Print['one_two_etc']?>"></td>
							</tr>
							<tr>
								<td style='padding-left:10px;'> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(

								<? 
						for($i=0; $i<=50; $i++){
							echo "&nbsp;";
						}
						?>

								)
								</td>
								<td style='padding-left:10px;'> <input type="text" name="1_3_result" value="<?=$rs_Print['one_three_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="1_3_etc" value="<?=$rs_Print['one_three_etc']?>"></td>
							</tr>
							<!--기초부분-->
							<!--철골부분-->
							<tr>
								<td rowspan="3" style='padding-left:10px;'>2.철골부분</td>
								<td style='padding-left:10px;'> ▶ 앵글연결분 용접 또는 볼트조임상태</td>
								<td style='padding-left:10px;'><input type="text" name="2_1_result" value="<?=$rs_Print['two_one_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="2_1_etc" value="<?=$rs_Print['two_one_etc']?>"></td>
							</tr>
							<tr>
								<td style='padding-left:10px;'> ▶ 게시시설에 광고물 게시상태</td>
								<td style='padding-left:10px;'><input type="text" name="2_2_result" value="<?=$rs_Print['two_two_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="2_2_etc" value="<?=$rs_Print['two_two_etc']?>"></td>
							</tr>
							<tr>
								<td style='padding-left:10px;'> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(
						<? 
						for($i=0; $i<=50; $i++){
							echo "&nbsp;";
						}
						?>

								)
								</td>
								<td style='padding-left:10px;'> <input type="text" name="2_3_result" value="<?=$rs_Print['two_three_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="2_3_etc" value="<?=$rs_Print['two_three_etc']?>"></td>
							</tr>
							<!--철골부분-->


							<!--전기설비-->
							<tr>
								<td rowspan="7" style='padding-left:10px;'>3.전기설비</td>
								<td style='padding-left:10px;'> ▶ 안전기등 전기설비 부착상태</td>
								<td style='padding-left:10px;'><input type="text" name="3_1_result" value="<?=$rs_Print['three_one_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="3_1_etc" value="<?=$rs_Print['three_one_etc']?>"></td>
							</tr>
							<tr>
								<td style='padding-left:10px;'> ▶ 전기배선 등 절연 상태</td>
								<td style='padding-left:10px;'><input type="text" name="3_2_result" value="<?=$rs_Print['three_two_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="3_2_etc" value="<?=$rs_Print['three_two_etc']?>"></td>
							</tr>
							<tr>
								<td style='padding-left:10px;'> ▶ 피뢰침상태</td>
								<td style='padding-left:10px;'> <input type="text" name="3_3_result" value="<?=$rs_Print['three_three_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="3_3_etc" value="<?=$rs_Print['three_three_etc']?>"></td>
							</tr>
							<tr>
								<td style='padding-left:10px;'> ▶ 누전차단기 작동여부</td>
								<td style='padding-left:10px;'><input type="text" name="3_4_result" value="<?=$rs_Print['three_four_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="3_4_etc" value="<?=$rs_Print['three_four_etc']?>"></td>
							</tr>
							<tr>
								<td style='padding-left:10px;'> ▶ 접지시설 상태</td>
								<td style='padding-left:10px;'> <input type="text" name="3_5_result" value="<?=$rs_Print['three_five_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="3_5_etc" value="<?=$rs_Print['three_five_etc']?>"></td>
							</tr>
							<tr>
								<td style='padding-left:10px;'> ▶ 전기사용 자재 규격품 사용여부</td>
								<td style='padding-left:10px;'><input type="text" name="3_6_result" value="<?=$rs_Print['three_six_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="3_6_etc" value="<?=$rs_Print['three_six_etc']?>"></td>
							</tr>
							<tr>
							<td style='padding-left:10px;'> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(

								<? 
						for($i=0; $i<=50; $i++){
							echo "&nbsp;";
						}
						?>

								)
								</td>
								<td style='padding-left:10px;'> <input type="text" name="3_7_result" value="<?=$rs_Print['three_seven_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="3_7_etc" value="<?=$rs_Print['three_seven_etc']?>"></td>
							</tr>
							<!--전기설비-->


							<!--도색상태-->
							<tr>
								<td rowspan="2" style='padding-left:10px;'>4.도색상태</td>
								<td style='padding-left:10px;'> ▶ 광고면 페이트 도장상태(미관저해여부)</td>
								<td style='padding-left:10px;'><input type="text" name="4_1_result" value="<?=$rs_Print['four_one_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="4_1_etc" value="<?=$rs_Print['four_one_etc']?>"></td>
							</tr>
							<tr>
							<td style='padding-left:10px;'> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(

								<? 
						for($i=0; $i<=50; $i++){
							echo "&nbsp;";
						}
						?>

								)
								</td>
								<td style='padding-left:10px;'><input type="text" name="4_2_result" value="<?=$rs_Print['four_two_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="4_2_etc" value="<?=$rs_Print['four_two_etc']?>"></td>
							</tr>


							<!--기타-->
							<tr>
								<td rowspan="3" style='padding-left:10px;'>5. 기타</td>
								<td style='padding-left:10px;'> ▶ 설계서 및 시방서와 일치여부</td>
								<td style='padding-left:10px;'><input type="text" name="5_1_result" value="<?=$rs_Print['five_one_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="5_1_etc" value="<?=$rs_Print['five_one_etc']?>"></td>
							</tr>
							<tr>
								<td style='padding-left:10px;'> ▶ 외관상 구조전문가의 점검 필요하거나 붕괴위험 여부</td>
								<td style='padding-left:10px;'><input type="text" name="5_2_result" value="<?=$rs_Print['five_two_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="5_2_etc" value="<?=$rs_Print['five_two_etc']?>"></td>
							</tr>
							<tr>
							<td style='padding-left:10px;'> ▶ 기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;타&nbsp;&nbsp;(

								<? 
								for($i=0; $i<=50; $i++){
									echo "&nbsp;";
								}
								?>

								)
								</td>
								<td style='padding-left:10px;'><input type="text" name="5_3_result" value="<?=$rs_Print['five_three_result']?>"></td>
								<td style='padding-left:10px;'><input type="text" name="5_3_etc" value="<?=$rs_Print['five_three_etc']?>"></td>
							</tr>
						</table>

						<? } ?>
                        </div><!--receive_table-->
                        <div class="btns">
                            <input type="button" value="돌아가기" id="submit_btn01" onclick="javascript:history.back(-1);">
							<!--<input type="button" value="삭제" id="submit_btn02" onclick="Del_regNo('<?=$page_no?>','<?=$rs['reg_no']?>');">-->
							<input type="button" value="삭제" id="submit_btn02" onclick="View_Del_regNo();">
                            <input type="button" value="검사접수" id="submit_btn03" onclick="View_regNo_update('soaa_chkStart_proc');">
                        </div><!--btns-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
		</form>
	</div><!--wrap-->
</body>
</html>
