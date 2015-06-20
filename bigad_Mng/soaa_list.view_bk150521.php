<?  include $_SERVER["DOCUMENT_ROOT"] . "/bigad_Mng/left_menu.php"; ?>

<link rel="stylesheet" type="text/css" href="/css/admin/soaa_view.css">

<?
	$reg_no	=	$_GET['reg_no'];
	$page_no	=	$_GET['page_no'];

	$rs = fn_select_fetch_array("*", "bigad_SoaaRegCheck", "reg_no='$reg_no'");

	$c_biz_no	=	explode("-", $rs['c_biz_no']);
	$s_biz_no	=	explode("-", $rs['s_biz_no']);
	$c_tel		=	explode("-", $rs['c_tel']);

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
									<select name="outdoor_act_cate" onchange="change_view_input(this.value);">
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
                                <td class="con_title">광고물&nbsp;등의&nbsp;규격
								<input type="button" class="btn" id="outdoorSizeCnt" value="add" onclick="addInputText(document.form.outdoor_act_cate.value);">&nbsp;
								</td>
                                <td class="con_content02">
                                    <?
									$outdoor_size = "";
									$spChar = "&#42;";
									$dataCnt = 0;
									$outdoor_size = "<input type=\"text\" class=\"w20 mar\" name=\"outdoor_size0\" value=" . $rs["outdoor_size0"] . ">" . $spChar;

									/* 광고물 규격 전체 필드중(outdoor_size0~7) 비어 있지 않은 필드만 카운트시작 */
									for($i=0; $i<=7; $i++){
										if($rs['outdoor_size' . $i] <> ""){
											$dataCnt++;
										}	
									}
									/* 광고물 규격 전체 필드중(outdoor_size0~7) 비어 있지 않은 필드만 카운트종료 */

									for($i=1; $i<=$dataCnt-1; $i++){
										if($rs["outdoor_size" . $i] <> ""){
											
											$outdoor_size .= "<input type=\"text\" class=\"w20 mar\" name=\"outdoor_size$i\" value=" . $rs["outdoor_size" . $i] . ">";
											
											//input type text 다음에 * 문자 출력 여부.
											// outdoor_size5 다음 필드인 outdoor_size6에 데터가 있으면서 현 레코드의 총 광고물 규격 갯수 안에 있으면 * 덧붙여서 출력
											if($rs["outdoor_size" . $i+1] <> "" && $i<$dataCnt-1) {
												$outdoor_size .= $spChar;
											}
										}
									}

									if($rs['outdoor_act_cate'] === "jiju"){
										$outdoor_size .= "&nbsp;H<input type='text' class='w20 mar' name='outdoor_sizeH0' value=" . $rs["outdoor_sizeH0"] . ">";
									}else{

									}

									echo $outdoor_size;
									?>
                                </td>
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
                                <td class="con_content01"><input type="text" class="w100" id="st_date" name="real_chkday" value="<?=$rs['real_chkday']?>"></td>
                                <td class="con_title">검사료&nbsp;납부일</td>
                                <td class="con_content02"><input type="text" class="w100" id="pay_checkin_date" name="payment_in_day" value="<?=$rs['payment_in_day']?>"></td>
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
                                <td colspan="3" class="bg_f9"><textarea class="opinion" name="memo1"></textarea></td>
                            </tr>
                            <tr>
                                <td class="con_title" colspan="2">기타사항</td>
                                <td colspan="3" class="bg_f9"><textarea class="etc" name="etc_memo1"></textarea></td>
                            </tr>
                        </table>
                        </div><!--receive_table-->
                        <div class="btns">
                            <input type="button" value="돌아가기" id="submit_btn01" onclick="javascript:history.back(-1);">
							<!--<input type="button" value="삭제" id="submit_btn02" onclick="Del_regNo('<?=$page_no?>','<?=$rs['reg_no']?>');">-->
							<input type="button" value="삭제" id="submit_btn02" onclick="View_Del_regNo();">
                            <input type="button" value="검사접수" id="submit_btn03" onclick="View_regNo_update();">
                        </div><!--btns-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
		</form>
	</div><!--wrap-->
</body>
</html>
