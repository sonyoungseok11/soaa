<?  include $_SERVER["DOCUMENT_ROOT"] . "/settings/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="../css/admin/notice_insert.css">

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
                            <div class="notice_table">
								<form name="form" method="post">
								<input type="hidden" name="idx" value="1">
								<input type="hidden" name="actions" value="insert">
								<table>
                                    <colgroup>
                                        <col width="80px">
                                        <col width="520px">
                                    </colgroup>
                                    <tr>
                                        <td class="subject">제목</td>
                                        <td class="tlb_con"><input type="text" class="w450" name="title"></td>
                                    </tr>
                                    <tr>
                                        <td class="subject">내용</td>
                                        <td class="tlb_con">
                                        	<div class="notice_con">
                                               <textarea id="ir1" name="content" rows="20" cols="20"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
								</form>
                            </div><!--notice_table-->
                            <div class="notice_btn">
								<input type="button" value="취소" id="submit_btn1" onclick="javascript:history.back(-1);">
								<input type="button" value="저장" id="submit_btn2" onclick="notice_write_proc();">
							</div>
                        </div><!--notice_box-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>
<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ir1",

    sSkinURI: "/se2/SmartEditor2Skin.html",

    fCreator: "createSEditor2"

});

</script>