<?  include $_SERVER["DOCUMENT_ROOT"] . "/bigad_Mng/left_menu.php"; ?>

<link rel="stylesheet" type="text/css" href="/css/admin/giro_reg.css">


<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump"><a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전도&nbsp;관리</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">입금&nbsp;입력</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="/img/set_icon.png" alt="icon">입금&nbsp;입력<span class="contop_tip">입금된&nbsp;수수료&nbsp;내역을&nbsp;입력할&nbsp;수&nbsp;있습니다&#46;</span><span class="info_notice"><a href="#"><img src="/img/notice.png" alt="알림"></a></span></p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <p class="contain_tip">구청&#44;&nbsp;일자를&nbsp;선택하면&nbsp;해당&nbsp;항목&nbsp;밑으로&nbsp;같은&nbsp;구청&#44;&nbsp;날짜가&nbsp;자동으로&nbsp;선택됩니다&#46;</p>
                        <div class="con_table">
							<form name="form" method="post">
                            <table>
                                <colgroup>
                                    <col width="140px">
                                    <col width="264px">
                                    <col width="140px">
                                    <col width="*">
                                    <col width="200px">
                                    <col width="*">
                                    <col width="230px">
                                </colgroup>
                                <tr>
                                    <th>일자</th>
                                    <th>구분</th>
                                    <th>구청</th>
                                    <th>업소</th>
                                    <th>성명</th>
                                    <th>연락처</th>
                                    <th>금액</th>
                                </tr>
								<? for($i=1; $i<=20; $i++){	?>
								<input type="hidden" name="lineNum" value="<?=$i?>">
								<tr>
                                    <td class="date">
										<input type="text" class="w100" id="input_date<?=$i;?>" name="input_money_date[]" onclick="date_loop('<?=$i;?>')">
									</td>
                                    <td class="radio_choose">
                                        <input type="radio" name="<?=$i?>_input_pay_type[]" class="gubun_rd" value="BB" >통장
										<input type="radio" name="<?=$i?>_input_pay_type[]" class="gubun_rd01" value="EB"  checked>지로
                                    </td>
                                    <td class="con_table_guchung">
                                        <select name="gu_office[]" onchange="selectbox_allChange(this.value, '<?=$i?>');">
											<?
												$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='10' order by order_idx");
												while($rs = mysql_fetch_array($result)){
											?>
                                            <option value="<?=$rs["en_nm"]?>" <? if($gu_office == $rs["en_nm"]) { echo "selected=selected";}?>><?=$rs["ko_nm"]?></option>
											<? } ?>
                                        </select>
                                    </td>
                                    <td class="corp_name"><input type="text" class="w120" name="c_corp_nm[]"></td>
                                    <td class="name"><input type="text" class="w100" name="c_ceo_nm[]"></td>
                                    <td class="phone"><input type="text" class="w100" name="c_tel[]"></td>
                                    <td class="cash"><input type="text" class="w130" name="check_pay[]" value="" onkeyup="commaNumArray('<?=$i?>',this.value);" maxlength="10">원</td>
                                </tr>
								<? } ?>
                            </table>

                            <p class="con_table_btn">
								<input type="button" value="확인" id="submit_btn" onclick="giro_reg_proc('giro_reg_proc');">
							</p>
							</form>
                        </div><!--con_table-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>