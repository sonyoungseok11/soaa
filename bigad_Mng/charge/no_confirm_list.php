<?  include $_SERVER["DOCUMENT_ROOT"] . "/bigad_Mng/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="/css/admin/no_confirm_list.css">

<?
	if($_POST['st_date1'] <> "" || $_POST['st_date2'] <> "" || $_POST['ed_date1'] <> "" || $_POST['ed_date2'] <> ""
		|| $_POST['input_pay_type'] <> "" || $_POST['gu_office'] <> "" ||$_POST['c_corp_nm'] <> "" ||$_POST['c_ceo_nm'] <> "" || $_POST['c_tel'] <> "" || $_POST["select_page_num"]){

		$st_date1	=	$_POST["st_date1"];
		$st_date2	=	$_POST["st_date2"];

		$ed_date1	=	$_POST["ed_date1"];
		$ed_date2	=	$_POST["ed_date2"];

		$input_pay_type	= 	$_POST["input_pay_type"];
		$gu_office	= 	$_POST["gu_office"];

		$c_corp_nm	=	$_POST["c_corp_nm"];
		$c_ceo_nm	=	$_POST["c_ceo_nm"];
		$c_tel	=	$_POST["c_tel"];

		$select_page_num = $_POST["select_page_num"];

		include "./no_confirm_list_where.php";
	}else{
		$st_date1	=	$_GET["st_date1"];
		$st_date2	=	$_GET["st_date2"];

		$ed_date1	=	$_GET["ed_date1"];
		$ed_date2	=	$_GET["ed_date2"];

		$input_pay_type	= 	$_GET["input_pay_type"];
		$gu_office	= 	$_GET["gu_office"];

		$c_corp_nm	=	$_GET["c_corp_nm"];
		$c_ceo_nm	=	$_GET["c_ceo_nm"];
		$c_tel		=	$_GET["c_tel"];

		$select_page_num = $_GET["select_page_num"];
		
		include "./no_confirm_list_where.php";
	}

	if($where == ""){
		$tot_cnt = fn_select_cnt("idx", "no_confirm_list", "idx <> ''");
	}else{
		$tot_cnt = fn_select_cnt("idx", "no_confirm_list", $where);
	}

	$excel_where = 1;	//엑셀 저장 스크립트로 넘길 참, 거짓 구분값.
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
//	if($_GET['reg_no']){
//		$reg_no	=	$_GET['reg_no'];
//		$return_regNo = fn_select_fetch_array("*", "bigad_SoaaRegCheck", "reg_no='$reg_no' and payment_state='PC'");
//		$reg_no = $return_regNo[0];
//	}
?>
<form name="form" method="post">
		<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump"><a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전도&nbsp;관리</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">미확인&nbsp;리스트</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="/img/set_icon.png" alt="icon">미확인&nbsp;리스트<span class="contop_tip">입금내역&nbsp;중&nbsp;미확인된&nbsp;내역을&nbsp;조회할&nbsp;수&nbsp;있습니다&#46;</span><span class="info_notice"><a href="#"><img src="/img/notice.png" alt="알림"></a></span></p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <div class="con01">
                            <table>
                                <tr>
                                    <td class="con01_title">기간검색</td>
                                    <td class="con01_cons">
                                        <div class="period_paid">
                                            납입일자&nbsp;
											시작일&nbsp;&#58;&nbsp;<input type="text" class="w90" id="st_date1" name="st_date1" value="<?=$st_date1?>"
											onclick="se_date('no_confirm_list','st_date1')">&nbsp;&nbsp;&nbsp;&#126;&nbsp;&nbsp;&nbsp;
											종료일&nbsp;&#58;&nbsp;<input type="text" class="w90" id="st_date2" name="st_date2" value="<?=$st_date2?>">
                                        </div>
                                        <div class="period_reg">
                                            등록일자&nbsp;
											시작일&nbsp;&#58;&nbsp;<input type="text" class="w90" id="ed_date1" name="ed_date1" value="<?=$ed_date1?>"
											onclick="se_date('no_confirm_list','ed_date1')">&nbsp;&nbsp;&nbsp;&#126;&nbsp;&nbsp;&nbsp;
											종료일&nbsp;&#58;&nbsp;<input type="text" class="w90" id="ed_date2" name="ed_date2" value="<?=$ed_date2?>">
                                        </div>
                                    </td>
                                    <td class="click_btn" rowspan="3">
                                        <a href="javascript:void(0);"><img src="/img/search.png" class="c_btn_srh" alt="검색" onclick="giro_search('no_confirm_list');"></a>
                                        <a href="javascript:void(0);"><img src="/img/refresh.png" class="refresh" alt="새로고침" onclick="movePage('no_confirm_list');"></a>
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
                                            <option value="<?=$InPayTypeRs['en_nm']?>" <? if($input_pay_type==$InPayTypeRs['en_nm']){ echo "selected=selected";}?>><?=$InPayTypeRs['ko_nm']?></option>
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
																onkeydown="javascript: if(event.keyCode == 13) { giro_search('no_confirm_list'); }">
										성명&nbsp;&#58;<input type="text" class="w90 mar"  name="c_ceo_nm" value="<?=$c_ceo_nm?>" 
																onkeydown="javascript: if(event.keyCode == 13) { giro_search('no_confirm_list'); }">
										연락처&nbsp;&#58;<input type="text" class="w90 m_left"  name="c_tel" value="<?=$c_tel?>" 
																onkeydown="javascript: if(event.keyCode == 13) { giro_search('no_confirm_list'); }">
                                    </td>
                                </tr>
                            </table>
                        </div><!--con01-->
                        <div class="con02">
                            <div class="receive">
                                <p class="paging">
                                    데이터&nbsp;갯수
                                    <select class="data_num" name="select_page_num">
                                        <? for($i=5; $i<=100;){?>
                                        <option value="<?=$i?>" <? if($i==$select_page_num){ echo "selected=selected";}?>><?=$i?></option>
										<? $i += 5;
											}
										?>
                                    </select>개
									<?
										//총 건수와 합계
										include "./no_confirm_list_cal_sum.php";
									?>
                                    <p class="total_search">총&nbsp;<?=$rs['tot_cnt']?>건의&nbsp;접수건&nbsp;&#47;&nbsp;총&nbsp;<?=number_format($rs['tot_sum'])?>원</p>
                                </p>
                            </div><!--receive-->
                            <div class="receive_table">
                                <table>
                                	<colgroup>
                                    	<col width="355px">
                                        <col width="280px">
                                        <col width="100px">
                                        <col width="130px">
                                        <col width="150px">
                                        <col width="70px">
                                        <col width="100px">
                                        <col width="100px">
                                        <col width="75px">
                                        <col width="75px">
                                    </colgroup>
                                    <tr>
                                        <th>업체명</th>
                                        <th>성명</th>
                                        <th>해당구</th>
                                        <th>연락처</th>
                                        <th>금액</th>
                                        <th>구분</th>
                                        <th>확인여부</th>
                                        <th>입금날짜</th>
                                        <th>검색</th>
                                        <th>삭제</th>
                                    </tr>
									<?
										if($where){
											$result	=	fn_select("*", "no_confirm_list", "$where order by insert_date desc");
										}else{
											$result	=	fn_select_orderby("*", "no_confirm_list", "insert_date desc");
										}

										if($tot_cnt > 0){
											while($rs = mysql_fetch_array($result)){
												$c_ceo_nm	=	$rs['c_ceo_nm'];
												$c_corp_nm	=	$rs['c_corp_nm'];
												$gu_office	=	$rs['gu_office'];

												$rs_office	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='10' and en_nm='" .$rs['gu_office'] . "'");

												switch($rs['input_pay_type']){
													case "BB":
														$input_pay_type="통장";break;
													case "EB":
														$input_pay_type="지로";break;
												}

												$input_date	=	explode(" ",$rs['input_date']);
									?>
                                    <tr class="listColorChange">
                                        <td class="corp_name"><?=$rs['c_corp_nm']?></td>
                                        <td class="name"><?=$rs['c_ceo_nm']?></td>
                                        <td class="damdang_gu"><?=$rs_office['ko_nm']?></td>
                                        <td class="phone"><?=$rs['c_tel']?></td>
                                        <td class="cash"><?=number_format($rs['chk_pay'])?><span class="bold">원</span></td>
                                        <td class="gubun"><?=$input_pay_type?></td>
                                        <td class="chk_yn">미확인</td>
                                        <td class="deposit_date"><?=$input_date[0]?></td>
                                        <td class="search_btn">
											<img src="/img/search_btn.png" alt="검색" 
											onclick="noConfirmSearch('charge_search','<?=$gu_office?>', '1250', '<? echo urlencode(mb_substr($rs['c_ceo_nm'], 0, 2, "UTF-8"));?>', 'auto');">
										</td>
                                        <td class="del"><img src="/img/del.png" alt="삭제" onclick="soaa_list_Del('no_confirm_list_DelProc','<?=$page?>','<?=$rs['idx']?>');"></td>
                                    </tr>
                                    <? 
											}//end while
										}else{
											echo "
												<tr>
													<td class=\"non_result\" colspan=10>검색결과가 없습니다.</td>
												</tr>
												";
										}//end if
									?>
                                </table>
                            </div><!--receive_table-->
                            <div class="arrow_navi">
                                <?
										//1페이로 이동
										if($block > 1){
										$go_page=1;
									?>
									<a href="javascript:void(0);" onclick="navi_giro_list('no_confirm_list','<?=$go_page?>','<?=$select_page_num?>','<?=$st_date1?>','<?=$st_date2?>'
									,'<?=$ed_date1?>','<?=$ed_date2?>',
									,'<?=$TMP?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$c_tel?>');">
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
									<a href="javascript:void(0);" onclick="navi_giro_list('no_confirm_list','<?=$go_page?>','<?=$select_page_num?>','<?=$st_date1?>','<?=$st_date2?>'
									,'<?=$ed_date1?>','<?=$ed_date2?>',
									,'<?=$TMP?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$c_tel?>');">
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
											<a href="javascript:void(0);" onclick="navi_giro_list('no_confirm_list','<?=$go_page?>','<?=$select_page_num?>','<?=$st_date1?>','<?=$st_date2?>'
									,'<?=$ed_date1?>','<?=$ed_date2?>',
									,'<?=$TMP?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$c_tel?>');"><?=$page_link?></a>
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
								   <a href="javascript:void(0);" onclick="navi_giro_list('no_confirm_list','<?=$go_page?>','<?=$select_page_num?>','<?=$st_date1?>','<?=$st_date2?>'
									,'<?=$ed_date1?>','<?=$ed_date2?>',
									,'<?=$TMP?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$c_tel?>');">
								   <img src="../img/next.png" alt="오른쪽 버튼" class="next"></a>
								   <? } ?>
								   <? 
									//*개뒤 마지막
									if($block < $total_block){
										$go_page = $total_page;
									?>
								   <a href="javascript:void(0);" onclick="navi_giro_list('no_confirm_list','<?=$go_page?>','<?=$select_page_num?>','<?=$st_date1?>','<?=$st_date2?>'
									,'<?=$ed_date1?>','<?=$ed_date2?>',
									,'<?=$TMP?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$c_tel?>');">
								   <img src="../img/f.f.png" alt="오른쪽 버튼"></a>
								   <? } ?>
                            </div>
                            <p class="btns">
								<input type="button" value="엑셀저장" id="submit_btn01" onclick="ExcelDown_2('no_confirm_list_excel','<?=$excel_where?>');">
								<span class="btns_write">
									<input type="button" value="글쓰기" id="submit_btn02" onclick="movePage('giro_reg');">
								</span>
							</p>
                        </div><!--con02-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>
