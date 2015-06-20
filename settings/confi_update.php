<?  include $_SERVER["DOCUMENT_ROOT"] . "/settings/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="../css/admin/confi_insert.css">
<?
	$code = $_GET["code"];
	$en_nm = $_GET["en_nm"];
	$rs = fn_select_fetch_array("code, en_nm, ko_nm, title_nm", "common_selectbox","code='$code' and en_nm='$en_nm'");
	$code = $rs["code"];
	$en_nm = $rs["en_nm"];
	$title_nm = $rs["title_nm"];
?>
<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                         <div class="inner_jump">
							<a href="/safeChk_Mng/soaa_list.php"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;
							<a href="/settings/outdoor_act_cate.php">환경&nbsp;설정</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;
							<a href="/settings/outdoor_act_cate.php"><?=$title_nm?></a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="../img/set_icon.png" alt="icon"><?=$title_nm?></p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <div class="insert_box">
                            <div class="insert_txt">&#91;<?=$rs["title_nm"]?>&#93;수정</div>
                            <div class="insert_table">
								<form name="form" method="post">
								<input type="hidden" name="code" value="<?=$code?>">
								<input type="hidden" name="en_nm" value="<?=$en_nm?>">
								<input type="hidden" name="actions" value="update">
                                <table>
                                    <tr>
                                        <td class="insert_title">수정위치</td>
                                        <td class="insert_con">
                                            <select>
											<?
												$result = fn_select("distinct(title_nm), code", "common_selectbox", "");
												while($rs_sel = mysql_fetch_array($result)){
											?>
											<option value="<?=$rs_sel["code"]?>" <? if($rs_sel["code"] == $code){ echo "selected=selected";}?>><?=$rs_sel["title_nm"]?></option>
											<? } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="insert_title">수정명</td>
                                        <td class="insert_con"><input type="text" class="w450" name="ko_nm" value="<?=$rs["ko_nm"]?>"></td>
                                    </tr>
                                </table>
								</form>
                            </div><!--insert_table-->
                            <div class="insert_btn">
								<input type="button" value="취소" id="submit_btn01" onclick="history.back(-1);">
								<input type="button" value="저장" id="submit_btn02" onclick="common_selectbox_update('confi_proc');">
							</div>
                        </div><!--insert_box-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>
