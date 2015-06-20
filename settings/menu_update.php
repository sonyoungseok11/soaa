<?  include $_SERVER["DOCUMENT_ROOT"] . "/settings/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="../css/admin/confi_insert.css">
<?
	$idx = $_GET["idx"];
	$idx_sub = $_GET["idx_sub"];
	$rs = fn_select_fetch_array("idx_sub, menu_nm, url", "menu","idx='$idx' and idx_sub='$idx_sub'");
	$menu_nm = $rs["menu_nm"];
	$url	 = $rs["url"];
?>
<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump">
							<a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;
							<a href="#">환경&nbsp;설정</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;
							<a href="#">메뉴관리</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="../img/set_icon.png" alt="icon">메뉴 관리</p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <div class="insert_box">
                            <div class="insert_txt">&#91;메뉴&#93;수정</div>
                            <div class="insert_table">
								<form name="form" method="post">
									<input type="hidden" name="actions" value="update">
									<table>
										<tr>
											<td class="insert_title">Title</td>
											<td class="insert_con"><input type="text" class="w450" name="menu_nm" value="<?=$menu_nm?>"></td>
										</tr>
										<tr>
											<td class="insert_title">링크주소</td>
											<td class="insert_con"><input type="text" class="w450" name="url" value="<?=$url?>"></td>
										</tr>
									</table>
								</form>
                            </div><!--insert_table-->
                            <div class="insert_btn">
								<input type="button" value="취소" id="submit_btn01">
									<input type="button" value="저장" id="submit_btn02" onclick="cate_modify_process('<?=$idx?>','<?=$idx_sub?>','update')">
							</div>
                        </div><!--insert_box-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>