<?  include $_SERVER["DOCUMENT_ROOT"] . "/settings/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="../css/admin/notice_list.css">

<?
	$idx_sub	=	$_GET["sub_idx"];
	if($idx_sub ==""){
		$idx_sub = "10";
	}
?>

<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump"><a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">환경&nbsp;설정</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">Notice</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="../img/set_icon.png" alt="icon">Notice</p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <div class="notice_box">
                            <div class="notice_btn"><input type="button" value="추가" id="submit_btn"></div>
                            <div class="clear"></div>
                            <div class="notice_select">
                            	<select onchange="select_change('notice_list_bigad', this.value);">
   								<?
									$result = fn_select("idx_sub, menu_nm", "menu", "length(idx_sub) < 3 and idx_sub between '50' and '70'");
									while($rs = mysql_fetch_array($result)){
									?>
                                	<option value="<?=$rs["idx_sub"]?>" <? if($rs["idx_sub"] == $idx_sub){ echo "selected=selected"; }?>><?=$rs["menu_nm"]?></option>
								<? } ?>
                                </select>
                            </div>
                            <div class="notice_table">
                                <table>
                                    <colgroup>
                                        <col width="80px">
                                        <col width="319px">
                                        <col width="100px">
                                        <col width="100px">
                                    </colgroup>
                                    <tr>
                                        <th>No.</th>
                                        <th>제목</th>
                                        <th>등록일</th>
                                        <th>수정일</th>
                                    </tr>
                                   <?
										$rs_cnt = fn_select_cnt("idx_sub", "menu", "length(idx_sub) >2 and idx_sub like '$idx_sub%'");
										$result = fn_select("idx_sub, menu_nm", "menu", "length(idx_sub) >2 and idx_sub like '$idx_sub%'");

										while($rs = mysql_fetch_array($result)){
									?>
                                    <tr>
                                        <td class="no"><?=$rs_cnt?></td>
                                        <td class="type"><a href="#"><?=$rs["menu_nm"]?></a></td>
                                        <td class="reg_date">2014/11/11</td>
                                        <td class="mod_date">2014/11/16</td>
                                    </tr>
									<? 
										$rs_cnt--;
										}
									?>        
                                </table>
                            </div><!--notice_table-->
                        </div><!--notice_box-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>
