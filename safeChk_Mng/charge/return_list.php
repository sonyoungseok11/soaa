<?  include $_SERVER["DOCUMENT_ROOT"] . "/safeChk_Mng/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="/css/admin/return_list.css">

<?
	echo "<b><font color='red'>일반검색의 구분(통장, 지로)는 검사수수료 관리 페이지로 추정되며 협회문의후 작업 진행 가능함</font></b><br>";

	if($_POST['st_date1'] <> "" || $_POST['st_date2'] <> "" || $_POST['ed_date1'] <> "" || $_POST['ed_date2'] <> ""
		|| $_POST['reg_date'] <> "" || $_POST['input_pay_type'] <> "" || $_POST['gu_office'] <> "" ||$_POST['c_corp_nm'] <> "" ||$_POST['c_ceo_nm'] <> "" || $_POST["select_page_num"]){

		$st_date1	=	$_POST["st_date1"];
		$st_date2	=	$_POST["st_date2"];

		$ed_date1	=	$_POST["ed_date1"];
		$ed_date2	=	$_POST["ed_date2"];

		$input_pay_type	= 	$_POST["input_pay_type"];
		$gu_office	= 	$_POST["gu_office"];

		$c_corp_nm	=	$_POST["c_corp_nm"];
		$c_ceo_nm	=	$_POST["c_ceo_nm"];

		$select_page_num = $_POST["select_page_num"];

		include "../return_list_where.php";
	}else{
		$st_date1	=	$_GET["st_date1"];
		$st_date2	=	$_GET["st_date2"];

		$ed_date1	=	$_GET["ed_date1"];
		$ed_date2	=	$_GET["ed_date2"];

		$input_pay_type	= 	$_POST["input_pay_type"];
		$gu_office	= 	$_GET["gu_office"];

		$c_corp_nm	=	$_GET["c_corp_nm"];
		$c_ceo_nm	=	$_GET["c_ceo_nm"];

		$select_page_num = $_GET["select_page_num"];
		
		include "../return_list_where.php";
	}

	if($where == ""){
		$tot_cnt = fn_select_cnt("idx", "return_list", "idx <> ''");
		$excel_where = 1;	//엑셀 저장 스크립트로 넘길 참, 거짓 구분값.
	}else{
		$tot_cnt = fn_select_cnt("idx", "return_list", $where);
		$excel_where = 1;
	}

	$page				= $_GET["page"];

	if (!$page) $page = 1;

	if(!$select_page_num){
		$select_page_num = 15;
	}
	$page_cnt = 10;

	$list_num = $select_page_num; //y축 갯수
	$tot_page_num = ceil($tot_cnt / $select_page_num);	//x축 갯수

	$offset = $list_num	*	($page-1);

	$total_page = ceil($tot_cnt / $select_page_num);
	$total_block = ceil($total_page / $page_cnt);
	$block = ceil($page / $page_cnt);

	//수정 버튼 클릭시 reg_no 를 GET 으로 받아오는데 수동으로 입력하는걸 방지하기 위해 쿼리를 실행하고
	//등록번호 존재유무를 반환받음.
	if($_GET['idx']){
		$idx	=	$_GET['idx'];
		$return_idx = fn_select_fetch_array("idx", "return_list", "idx='$idx'");
	}
//echo "where=" . $where;
?>
<form name="form" method="post">
		<?
			if($_GET['idx']){
				$idx	=	$_GET['idx'];
				$return_idx = fn_select_fetch_array("*", "return_list", "idx='$idx'");
				
				echo "<input type=\"hidden\" name=\"idx\" value=\"" . $return_idx['idx'] . "\">";
			}
		?>
		<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump"><a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전도&nbsp;관리</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">환불&nbsp;입력&nbsp;목록</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="/img/set_icon.png" alt="icon">환불&nbsp;입력&nbsp;목록<span class="contop_tip">환불&nbsp;내역을&nbsp;조회&#44;&nbsp;입력할&nbsp;수&nbsp;있습니다&#46;</span><span class="info_notice"><a href="#"><img src="/img/notice.png" alt="알림"></a></span></p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <div class="con01">
                            <table>
                            	<colgroup>
                                	<col width="130px">
                                    <col width="1130px">
                                    <col width="160px">
                                </colgroup>
                                <tr>
                                    <td class="con01_title">기간검색</td>
                                    <td class="con01_cons">
                                        <div class="period_paid">
                                            납입일자&nbsp;
											시작일&nbsp;&#58;&nbsp;<input type="text" class="w90" id="st_date1" name="st_date1" value="<?=$st_date1?>"
											onclick="se_date('return_list','st_date1')">&nbsp;&nbsp;&nbsp;&#126;&nbsp;&nbsp;&nbsp;
											종료일&nbsp;&#58;&nbsp;<input type="text" class="w90" id="st_date2" name="st_date2" value="<?=$st_date2?>">
                                        </div>
                                        <div class="period_reg">
                                            등록일자&nbsp;
											시작일&nbsp;&#58;&nbsp;<input type="text" class="w90" id="ed_date1" name="ed_date1" value="<?=$ed_date1?>"
											onclick="se_date('return_list','ed_date1')">&nbsp;&nbsp;&nbsp;&#126;&nbsp;&nbsp;&nbsp;
											종료일&nbsp;&#58;&nbsp;<input type="text" class="w90" id="ed_date2" name="ed_date2" value="<?=$ed_date2?>">
                                        </div>
                                    </td>
                                    <td class="click_btn" rowspan="3">
                                        <a href="javascript:void(0);"><img src="/img/search.png" class="c_btn_srh" alt="검색" onclick="giro_search('return_list');"></a>
                                        <a href="javascript:void(0);"><img src="/img/refresh.png" class="refresh" alt="새로고침" onclick="movePage('return_list');"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="con01_title">일반검색</td>
                                    <td class="con01_cons">
                                        구분
                                        <select class="con01_gubun" name="input_pay_type">
                                            <option value="">전체</option>
											<?
												$InPayTypeResult	=	fn_select("*", "common_selectbox", "code='45'");
												while($InPayTypeRs = mysql_fetch_array($InPayTypeResult)){
											?>
                                            <option value="<?=$InPayTypeRs['en_nm']?>" <? if($InPayTypeRs['en_nm']==$input_pay_type){ echo "selected=selected";}?>><?=$InPayTypeRs['ko_nm']?></option>
											<? } ?>
                                        </select>
                                        구청
                                        <select class="con01_guchung" name="gu_office">
                                            <option value="">구청&nbsp;선택</option>
                                             <?
												$GuOfficeResult = fn_select("en_nm, ko_nm", "common_selectbox", "code='10' order by order_idx");
												while($GuOfficeRs = mysql_fetch_array($GuOfficeResult)){
											?>
                                            <option value="<?=$GuOfficeRs["en_nm"]?>" <? if($GuOfficeRs['en_nm'] == $gu_office){ echo "selected=selected"; }?>><?=$GuOfficeRs["ko_nm"]?></option>
											<? } ?>
                                        </select>
                                        <img src="/img/mini_bar.png" class="minibar" alt="bar">
                                         업소명&nbsp;&#58;<input type="text" class="w90 mar" name="c_corp_nm" value="<?=$c_corp_nm?>" 
																onkeydown="javascript: if(event.keyCode == 13) { giro_search('return_list'); }">
										성명&nbsp;&#58;<input type="text" class="w90 mar"  name="c_ceo_nm" value="<?=$c_ceo_nm?>" 
																onkeydown="javascript: if(event.keyCode == 13) { giro_search('return_list'); }">
                                    </td>
                                </tr>
                            </table>
                        </div><!--con01-->
                        <div class="con02">
                            <div class="receive">
								<? 
									if($return_idx <> "") {
										$rs = fn_select_fetch_array("*", "return_list", "idx='$idx'");
								?>
	                           <div class="paging_modify">
									<p class="p_mod">
									환불&nbsp;일자<input type="text" class="w100 mar_lr" id="st_date" name="return_payment_date" value="협회문의">
													<img src="/img/mini_bar.png" alt="bar" class="p_mod_bar" name="c_ceo_nm">
									환불자명<input type="text" class="w100 mar_lr" name="c_ceo_nm" value="<?=$rs['c_ceo_nm']?>"><img src="/img/mini_bar.png" alt="bar" class="p_mod_bar">
									금액<input type="text" class="w90 mar_lr" name="rf_payment" value="<?=number_format($rs['rf_payment'])?>" onkeyup="commaNum1(this.value);">원
										<img src="/img/mini_bar.png" alt="bar" class="p_mod_bar">
									환불&nbsp;이유<input type="text" class="w250 mar_lr" name="memo1" value="<?=$rs['memo1']?>">
									</p>
									<input type="button" value="수정" id="submit_btn03" onclick="content_update('return_list_update_proc','<?=$rs['idx']?>')">
								</div>
								<? 
									}
										//총 건수와 합계
										include "./return_list_cal_sum.php";
									?>
                                <p class="total_search">총&nbsp;<?=$rs['tot_cnt']?>건의&nbsp;접수건&nbsp;&#47;&nbsp;총&nbsp;<?=number_format($rs['tot_sum'])?>원</p>
                            </div><!--receive-->
                            <div class="receive_table">
                                <table>
                                	<colgroup>
                                    	<col width="*">
                                        <col width="*">
                                        <col width="80px">
                                        <col width="*">
                                        <col width="*">
                                        <col width="80px">
                                        <col width="80px">
                                        <col width="90px">
                                        <col width="90px">
                                        <col width="70px">
                                        <col width="70px">
                                    </colgroup>
                                    <tr>
                                        <th>업체명</th>
                                        <th>성명</th>
                                        <th>해당구</th>
                                        <th>입금금액</th>
                                        <th>환불금액</th>
                                        <th>구분</th>
                                        <th>확인여부</th>
                                        <th>입금날짜</th>
                                        <th>환불날짜</th>
                                        <th>수정</th>
                                        <th>삭제</th>
                                    </tr>
									<?
									if($tot_cnt > 0){
										if($where){
											$result	=	fn_select("*", "return_list", " idx <> '' and $where");
										}else{
											$result	=	fn_select("*", "return_list", "idx <> ''");
										}

										while($rs = mysql_fetch_array($result)){
											$gu_office	=	$rs['gu_office'];
											$input_payment_date	=	explode(" ", $rs['input_payment_date']);
											$refund_date	=	explode(" ", $rs['refund_date']);

											switch($rs['input_pay_type']){
												case "BB":
													$input_pay_type="<font color='red'>통장환불</font>";break;
												case "EB":
													$input_pay_type="<font color='red'>지로환불</font>";break;
											}
									?>
                                    <tr class="listColorChange">
                                        <td class="corp_name"><?=$rs['c_corp_nm']?></td>
                                        <td class="name"><?=$rs['c_ceo_nm']?></td>
                                        <td class="damdang_gu">
										<?
											$gu_rs = fn_select_fetch_array("ko_nm", "common_selectbox", "en_nm='$gu_office'");
											echo $gu_rs['ko_nm'];
										?>
										</td>
                                        <td class="cash"><?=number_format($rs['chk_pay'])?><span class="bold">원</span></td>
                                        <td class="refund_cash"><?=number_format($rs['rf_payment'])?><span class="bold">원</span></td>
                                        <td class="gubun" onclick="return_list_gubun();"><?=$input_pay_type?></td>
                                        <td class="chk_yn">미정</td>
                                        <td class="deposit_date"><?=$input_payment_date[0]?></td>
                                        <td class="refund_date"><?=$refund_date[0]?></td>
                                        <td class="modify"><img src="/img/modify.png" alt="수정" onclick="returnlist_modify('return_list','<?=$rs['idx']?>')"></td>
                                        <td class="del"><img src="/img/del.png" alt="삭제"></td>
                                    </tr>
                                    <?
										}
									}else{
										echo "
											<tr>
												<td class=\"non_result\" colspan=11>검색결과가 없습니다.</td>
											</tr>";
									}
										?>
                                </table>
                            </div><!--receive_table-->

							<? 
								if($tot_cnt > 0) { ?>
                            <div class="arrow_navi">
									<?
										//1페이로 이동
										if($block > 1){
										$go_page=1;
									?>
									<a href="javascript:void(0);" onclick="navi_return_list('giro_list','<?=$go_page?>','<?=$st_date1?>','<?=$st_date2?>'
									,'<?=$ed_date1?>','<?=$ed_date2?>',
									,'<?=$TMP?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>');">
									<img src="../img/pre.png" alt="왼쪽 버튼"></a>
									<?
										//1페이지로 이동end
										}

									//이전 블록이동
									if($block != 1 && $block <= $total_block){
										
										if($block >= 3){
											$go_page = (($block - 2) * 10) +1;
										}else{
											$go_page = 1;
										}

										if($go_page == 0){
											$go_page = 1;
										}
									?>
									<a href="javascript:void(0);" onclick="navi_return_list('giro_list','<?=$go_page?>','<?=$st_date1?>','<?=$st_date2?>'
									,'<?=$ed_date1?>','<?=$ed_date2?>',
									,'<?=$TMP?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>');">
									<img src="../img/before.png" alt="왼쪽 버튼" class="before"></a>
									<? }
										//이전 블록이동End
									?>

									<ul>
									<?
									//페이지 리스트1~10 etc...
									$first = ($block-1) * $page_cnt;
									$last = $block * $page_cnt;

									if($block >= $total_block){
										$last=$total_page;
									}

									for($page_link=$first+1; $page_link <= $last; $page_link++)	{
										if($page_link==$page){
									?>
										<li class="click"><a href="javascript:void(0);"><?=$page_link?></a></li>
									<? }else{ ?>
										<li>
											<a href="javascript:void(0);" onclick="navi_return_list('giro_list','<?=$go_page?>','<?=$st_date1?>','<?=$st_date2?>'
									,'<?=$ed_date1?>','<?=$ed_date2?>',
									,'<?=$TMP?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>');"><?=$page_link?></a>
										</li>
									<? }//end if
									}//end for
									?>
									</ul>
									<?
									//다음 블록 이동
									if($block < $total_block){
										$go_page = ($block * 10) + 1;
									?>
								   <a href="javascript:void(0);" onclick="navi_return_list('giro_list','<?=$go_page?>','<?=$st_date1?>','<?=$st_date2?>'
									,'<?=$ed_date1?>','<?=$ed_date2?>',
									,'<?=$TMP?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>');">
								   <img src="../img/next.png" alt="오른쪽 버튼" class="next"></a>
								   <? } ?>
								   <? 
									//*개뒤 마지막
									if($block < $total_block){
										$go_page = $total_page;
									?>
								   <a href="javascript:void(0);" onclick="navi_return_list('giro_list','<?=$go_page?>','<?=$st_date1?>','<?=$st_date2?>'
									,'<?=$ed_date1?>','<?=$ed_date2?>',
									,'<?=$TMP?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>');">
								   <img src="../img/f.f.png" alt="오른쪽 버튼"></a>
								   <? } ?>
								</div>
							<? } ?>
                            <p class="btns">
								<input type="button" value="엑셀저장" id="submit_btn01">
								<span class="btns_write">
								<input type="button" value="글쓰기" id="submit_btn02" onclick="movePage('giro_reg');">
								</span>
							</p>
                        </div><!--con02-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
			</form>
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>
