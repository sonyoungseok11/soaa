<?  include $_SERVER["DOCUMENT_ROOT"] . "/settings/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="../css/admin/configuration.css">
<?
	$rs = fn_select_fetch_array("distinct(title_nm)","common_selectbox","code='30'")
?>
<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump">
							<a href="/safeChk_Mng/soaa_list.php"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;
							<a href="/settings/outdoor_act_cate.php">환경&nbsp;설정</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;
							<a href="/settings/<?=$this_page[0]?>"><?=$rs["title_nm"]?></a>
						</div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="../img/set_icon.png" alt="icon"><?=$rs["title_nm"]?></p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <div class="confi_box">
                            <div class="confi_btn"><input type="button" value="추가" id="submit_btn" onclick="addList('30')"></div>
                            <div class="clear"></div>
                            <div class="confi_table">
                                <table>
                                    <colgroup>
                                        <col width="80px">
                                        <col width="319px">
                                        <col width="100px">
                                        <col width="100px">
                                    </colgroup>
                                    <tr>
                                        <th>No.</th>
                                        <th>Title</th>
                                        <th>등록일</th>
                                        <th>수정일</th>
                                    </tr>
									<?
										
										$tot_cnt = fn_select_cnt("*", "common_selectbox", "code='30'");
										
										$result = fn_select("code, en_nm, ko_nm, insert_date, update_date", "common_selectbox", "code='30'");
										while($rs = mysql_fetch_array($result)){
											$code = $rs["code"];
											$en_nm = $rs["en_nm"];
											$insert_date = explode("-", $rs["insert_date"]);
											$update_date = explode("-", $rs["update_date"]);
									?>
                                    <tr>
                                        <td class="no"><?=$tot_cnt?></td>
                                        <td class="type"><a href="javascript:void(0)" onclick="updateList('<?=$code?>','<?=$en_nm?>');"><?=$rs["ko_nm"]?></a></td>
                                        <td class="reg_date"><?=$insert_date[0]?>/<?=$insert_date[1]?>/<?=$insert_date[2]?></td>
                                        <td class="mod_date"><?=$update_date[0]?>/<?=$update_date[1]?>/<?=$update_date[2]?></td>
                                    </tr>
									<? 
										$tot_cnt--;
										} ?>
                                </table>
                            </div><!--confi_table-->
                        </div><!--confi_box-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>