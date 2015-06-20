<?  include $_SERVER["DOCUMENT_ROOT"] . "/settings/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="../css/admin/notice_list.css">

<?
	//left 메뉴에서 넘어오는 안전점검, 대형옥외물 구분값
	$idx = $_GET["idx"];

	//스크립트 select_change get값.
	$idx_sub	=	$_GET["idx_sub"];
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
                            <!--
								// menu 테이블에서 가져와야 하므로 추가되면 안됨.
								<div class="notice_btn"><input type="button" value="추가" id="submit_btn" onclick="moveWritePage('notice_insert')"></div>
							-->
                            <div class="clear"></div>
                            <div class="notice_select">
                            	<select onchange="select_change('notice_list', '<?=$idx?>', this.value);">
								<?
									if($idx == "1"){
										$wehre_idx_sub = "idx_sub between '10' and '40'";
									}else{
										$wehre_idx_sub = "idx_sub between '50' and '70'";
									}
									$result = fn_select("idx_sub, menu_nm", "menu", "length(idx_sub) < 3 and $wehre_idx_sub");
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
										$result = fn_select("idx, idx_sub, title, insert_date, update_date", "notice", "length(idx_sub) >2 and idx_sub like '$idx_sub%'");
										$i=1;
										while($rs = mysql_fetch_array($result)){
											$idx = $rs["idx"];
											$idx_sub = $rs["idx_sub"];
											$in_date_tmp = explode(" ",$rs["insert_date"]);
											$in_date =  explode("-", $in_date_tmp[0]);

											$up_date_tmp = explode(" ",$rs["update_date"]);
											$up_date =  explode("-", $up_date_tmp[0]);
									?>
                                    <tr>
                                        <td class="no"><?=$i?></td>
                                        <td class="type"><a href="javascript:void(0);" onclick="moveUpdatePage('notice_update','<?=$idx?>','<?=$idx_sub?>')"><?=$rs["title"]?></a></td>
                                        <td class="reg_date"><?=$in_date[0]?>/<?=$in_date[1]?>/<?=$in_date[2]?></td>
                                        <td class="mod_date"><?=$up_date[0]?>/<?=$up_date[1]?>/<?=$up_date[2]?></td>
                                    </tr>
									<? 
										$i++;
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
