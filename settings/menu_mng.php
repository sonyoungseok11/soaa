<?  include $_SERVER["DOCUMENT_ROOT"] . "/settings/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="/css/admin/menu_mng.css">

<?
	$idx_sub = $_GET["idx_sub"];
?>
<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump">
							<a href="/safeChk_Mng/soaa_list.php"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;
							<a href="/settings/outdoor_act_cate.php">환경&nbsp;설정</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;
							<a href="/settings/<?=$this_page[0]?>"><?=$rs["title_nm"]?>메뉴&nbsp;관리</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="../img/set_icon.png" alt="icon">메뉴&nbsp;관리</p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <div class="confi_box">
                        	<div class="choose">
                            	<input type="button" value="대메뉴추가" id="submit_btn01"><input type="button" value="소메뉴추가" id="submit_btn02">
                            </div>
                            <div class="menu_mod">
                            	<table>
                                	<colgroup>
                                    	<col width="200px">
                                        <col width="804px">
                                    </colgroup>
									<!--
									 <tr>
                                    	<td colspan="2" class="sel">
                                            <select onchange="select_change('menu_mng1',this.value)">
												<?
													$result = fn_select("idx_sub, menu_nm","menu","idx_sub='10' or idx_sub='50'");
													while($rs = mysql_fetch_array($result)){
												?>
                                                <option value="<?=$rs["idx_sub"]?>" <? if($rs["idx_sub"] == $idx_sub){ echo "selected=selected";}?>><?=$rs["menu_nm"]?></option>
												<? } ?>
                                            </select>
                                        </td>
                                    </tr>
									-->
                                    <?
									//상단 큰 메뉴 총 갯수(td rowspan 에 필요함)
									$tot_main_cate	=	"SELECT count(*) as count FROM menu where length(idx_sub) <= 2 and idx='1'";
									$tot_main_cate_result	=	mysql_query($tot_main_cate);
									$tot_main_cate_cnt	=	mysql_fetch_array($tot_main_cate_result);

									//상단 서브메뉴 총 갯수
									$tot_sub_cate	=	"SELECT count(*) as count FROM menu where length(idx_sub) > 2 and idx='1'";
									$tot_cate_result	=	mysql_query($tot_sub_cate);
									$end_sub_cate_cnt	=	$sub_rs["count"];


									$i = 1;
									$td_rowspan=0;

									$main_cate	=	"SELECT idx, idx_sub, menu_nm, use_gubun FROM menu where length(idx_sub) <= 2 and idx='1'";
									$main_result	=	mysql_query($main_cate);

									while($main_rs = mysql_fetch_array($main_result)){
										$tot_main_cate			=	"SELECT count(*) as count FROM menu where length(idx_sub) > 2 and idx_sub like '$i" . "0%' and idx='1'";
										$tot_main_cate_result	=	mysql_query($tot_main_cate);
										$tot_main_cate_cnt		=	mysql_fetch_array($tot_main_cate_result);

										$sub_cate		=	"SELECT * FROM menu where length(idx_sub) > 2 and idx_sub like '$i" . "0%' and idx='1'";
										$sub_result		=	mysql_query($sub_cate);
										$sub_cate_cnt = mysql_num_rows($sub_result);

										//main 메뉴
										if($td_rowspan==0){
											echo "<tr><td class='tlt' rowspan=" . $tot_main_cate_cnt["count"] . ">";
											if(trim($main_rs["use_gubun"]) == "N"){
												echo "<p><font color=#ff0000>" . $main_rs["menu_nm"]."</font></p>";
											}else{
												echo "<p><font color=#1e90ff>" . $main_rs["menu_nm"]."</font></p>";
											}
										?>
											<!--<a href="javascript:;" onclick="modify_cate('<?=$main_rs["idx_sub"];?>', 'modify');">[수정]</a>&nbsp;&nbsp;-->
											<p class="tlt_btn">
												<a href="javascript:void(0);" onclick="modify_cate('<?=$main_rs["idx"];?>','<?=$main_rs["idx_sub"];?>', 'update');"><img src="../img/modify.png" class="mod" alt="수정"></a>
												<a href="javascript:void(0);" onclick="modify_cate('<?=$main_rs["idx"];?>','<?=$main_rs["idx_sub"];?>', 'delete');"><img src="../img/del.png" class="del" alt="삭제"></a>
											</p>
										<?
											echo "</td>";
										}

										//sub메뉴
										//sub 메뉴가 있으면 td안에 출력
										if($sub_cate_cnt > 0){
											while($sub_rs = mysql_fetch_array($sub_result)){
											?>
												<td class="con">
													<?
													if(trim($sub_rs["use_gubun"]) == "N"){
														echo "<font color=ff0000>(N) " . $sub_rs["menu_nm"] . "</font>";

													}else{
														echo "<font color=#1e90ff>" . $sub_rs["menu_nm"] . "</font>";
													}
													?>
													<span class="btns">
														<a href="javascript:void(0);" onclick="modify_cate('<?=$sub_rs["idx"]?>','<?=$sub_rs["idx_sub"];?>', 'update');"><img src="../img/modify.png" class="mod" alt="수정"></a>
														<a href="javascript:void(0);" onclick="modify_cate('<?=$sub_rs["idx"]?>','<?=$sub_rs["idx_sub"];?>', 'delete');"><img src="../img/del.png" class="del" alt="삭제"></a>
													</span>
												</td>
												</tr>
											</tr>
											<?
											}
										//sub 메뉴가 없으면 td만 만들고 출력
										}else{
											echo "<td></td>";
										}

										//최초 while 돌때 대메뉴 rowspan 합치기 위한 용도.
										$i = $i +1;
									}
									?>
                                </table>
                            </div>
                        </div><!--confi_box-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>
