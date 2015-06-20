<?  include $_SERVER["DOCUMENT_ROOT"] . "/safeChk_Mng/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="/css/admin/chk_result_report.css">
<?
	if($_POST["st_date"] <> "" || $_POST["ed_date"] <> "" ||$_POST["gu_office"] <> "" ||$_POST["c_corp_nm"] <> "" ||$_POST["c_ceo_nm"] <> "" ||$_POST["reg_no"] <> "" ||
		$_POST["outdoor_act_cate"] <> "" || $_POST["chk_paytype"] <> "" ||$_POST["report_certi"] <> "" || $_POST["chk_result"] <> "" || $_POST["chk_person"] <> ""
		|| $_POST["select_page_num"]){

		$st_date	=	$_POST["st_date"];
		$ed_date	= 	$_POST["ed_date"];
		$gu_office	= 	$_POST["gu_office"];

		$c_corp_nm	=	$_POST["c_corp_nm"];
		$c_ceo_nm	=	$_POST["c_ceo_nm"];
		$reg_no		=	$_POST["reg_no"];

		$outdoor_act_cate		=	$_POST["outdoor_act_cate"];
		$chk_paytype		=	$_POST["chk_paytype"];
		$report_certi		=	$_POST["report_certi"];
		$chk_result		=	$_POST["chk_result"];
		$chk_person		=	$_POST["chk_person"];

		$select_page_num	=	$_POST["select_page_num"];

		include "./check_result_report_where.php";
	}else{
		$st_date	=	$_GET["st_date"];
		$ed_date	= 	$_GET["ed_date"];

		$gu_office	= 	$_GET["gu_office"];
		$c_corp_nm	=	$_GET["c_corp_nm"];
		$c_ceo_nm	=	$_GET["c_ceo_nm"];
		$reg_no		=	$_GET["reg_no"];

		$outdoor_act_cate	=	$_GET["outdoor_act_cate"];
		$chk_paytype		=	$_GET["chk_paytype"];
		$report_certi		=	$_GET["report_certi"];
		$chk_result			=	$_GET["chk_result"];
		$chk_person			=	$_GET["chk_person"];

		$select_page_num = $_GET["select_page_num"];
		
		include "./check_result_report_where.php";
	}

	if($where == ""){
//		$tot_cnt = fn_select_cnt("reg_no", "soaa_reg_check", "reg_no <> '' and insert_id is not null");
		$tot_cnt = 0;
		$excel_where = 0;
	}else{
		$tot_cnt = fn_select_cnt("reg_no", "soaa_reg_check", $where);
		$excel_where = 1;
	}

	$page				= $_GET["page"];

	if (!$page) $page = 1;

	if(!$select_page_num){
		$select_page_num = 20;
	}
	$page_cnt = 10;

	$list_num = $select_page_num; //y축 갯수
	$tot_page_num = ceil($tot_cnt / $select_page_num);	//x축 갯수

	$offset = $list_num	*	($page-1);

	$total_page = ceil($tot_cnt / $select_page_num);
	$total_block = ceil($total_page / $page_cnt);
	$block = ceil($page / $page_cnt);

?>
<section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump"><a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전점검&nbsp;관리</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전점검&nbsp;결과보고서</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="/img/set_icon.png" alt="icon">안전점검&nbsp;결과보고서<span class="contop_tip">안전점검&nbsp;결과에&nbsp;대한&nbsp;현황을&nbsp;조회&#44;&nbsp;출력할&nbsp;수&nbsp;있습니다&#46;</span><span class="info_notice"><a href="#"><img src="/img/notice.png" alt="알림"></a></span></p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                	<div class="con01">
						<form name="form" method="post">
                    	<table>
                        	 <tr>
                                    <td class="con01_title">기간검색</td>
                                    <td class="con01_cons">
                                        시작날짜&nbsp;&#58;&nbsp;<input type="text" class="w90" id="st_date" name="st_date" value="<?=$st_date?>"
										onclick="se_date('check_result_report')">&nbsp;&nbsp;&nbsp;&#126;&nbsp;&nbsp;&nbsp;
										종료날짜&nbsp;&#58;&nbsp;<input type="text" class="w90" id="ed_date" name="ed_date" value="<?=$ed_date?>">
                                        <span class="con1_cons_tip">연도&#8211;월&#8211;일&#40;2014&#8211;01&#8211;01&#41;형식으로&nbsp;입력해주세요&#46;</span>
                                    </td>
                                     <td class="click_btn" rowspan="3">
                                        <a href="javascript:void(0);"><img src="/img/search.png" class="c_btn_srh" alt="검색" onclick="soaa_search('check_result_report');"></a>
										<a href="javascript:void(0);"><img src="/img/refresh.png" class="refresh" alt="새로고침"></a>
                                    </td>
                                </tr>
                        	<tr>
                            	<td class="con01_title">일반검색</td>
                                <td class="con01_cons">
                                	구청
									<select name="gu_office" class="guchung">
										<option value="">구청을&nbsp;선택하시오&#46;</option>
										<?
											$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='10' order by order_idx");
											while($rs = mysql_fetch_array($result)){
										?>
										<option value="<?=$rs["en_nm"]?>" <? if($gu_office == $rs["en_nm"]) { echo "selected=selected";}?>><?=$rs["ko_nm"]?></option>
										<? } ?>
									</select>
                                     업소명&nbsp;&#58;<input type="text" class="w90 mar" name="c_corp_nm" value="<?=$c_corp_nm?>"
										onkeydown="javascript: if(event.keyCode == 13) { soaa_search('check_result_report'); }">
										성명&nbsp;&#58;<input type="text" class="w90 mar" name="c_ceo_nm" value="<?=$c_ceo_nm?>"
										onkeydown="javascript: if(event.keyCode == 13) { soaa_search('check_result_report'); }">
										접수번호&nbsp;&#58;<input type="text" class="w90 mar" name="reg_no" value="<?=$reg_no?>"
										onkeydown="javascript: if(event.keyCode == 13) { soaa_search('check_result_report'); }">
                                </td>
                            </tr>
                        	<tr>
								<td class="con01_title">기타검색</td>
								<td class="con01_cons">
									<select class="ads_sort m_right30" name="outdoor_act_cate">
										<option value="">광고물&nbsp;종류</option>
										<?
											$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='01' order by order_idx");
											while($rs = mysql_fetch_array($result)){
										?>
										<option value="<?=$rs["en_nm"]?>" <? if($outdoor_act_cate == $rs["en_nm"]) { echo "selected=selected";}?>><?=$rs["ko_nm"]?></option>
										<? } ?>
									</select>
									<select class="gumsa_cash m_right30" name="chk_paytype">
										<option value="">검사료&nbsp;납부</option>
										<?
											$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='35'");
											while($rs = mysql_fetch_array($result)){
										?>
										<option value="<?=$rs["en_nm"]?>" <? if($chk_paytype == $rs["en_nm"]) { echo "selected=selected";}?>><?=$rs["ko_nm"]?></option>
										<? } ?>
									</select>
									<select class="deliver_certificate m_right30" name="report_certi">
										<option value="">필증교부</option>
										<?
											$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='40'");
											while($rs = mysql_fetch_array($result)){
										?>
										<option value="<?=$rs["en_nm"]?>" <? if($report_certi == $rs["en_nm"]) { echo "selected=selected";}?>><?=$rs["ko_nm"]?></option>
										<? } ?>
									</select>
									<select class="result m_right30" name="chk_result">
										<option value="">검사결과</option>
										<?
											$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='30'");
											while($rs = mysql_fetch_array($result)){
										?>
										<option value="<?=$rs["en_nm"]?>" <? if($chk_result == $rs["en_nm"]) { echo "selected=selected";}?>><?=$rs["ko_nm"]?></option>
										<? } ?>
									</select>
									<select class="result m_right30" name="chk_person">
										<option value="">검사자</option>
										<?
											$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='15'");
											while($rs = mysql_fetch_array($result)){
										?>
										<option value="<?=$rs["en_nm"]?>" <? if($chk_result == $rs["en_nm"]) { echo "selected=selected";}?>><?=$rs["ko_nm"]?></option>
										<? } ?>
									</select>
								</td>
							</tr>
                        </table>
                    </div><!--con01-->
                        <div class="con02">
                            <div class="receive">
                                <p class="paging">
                                    페이지&nbsp;데이터&nbsp;갯수
                                   <select class="data_num" name="select_page_num" onchange="page_list('check_result_report', this.value);">
										<? for($i=5; $i<=100;){?>
                                        <option value="<?=$i?>" <? if($i==$select_page_num){ echo "selected=selected";}?>><?=$i?></option>
										<? $i += 5;
											}
										?>
                                    </select>개
                                    <span class="total_search">총&nbsp;<?=$tot_cnt?>건의&nbsp;접수건이&nbsp;검색되었습니다&#46;</span>
                                </p>
                                <p class="paging_search">
                                    저장
                                    <select class="paging_print">
                                        <option value="">인쇄형식1</option>
                                    </select>

									<!-- 하단은 print 라는 id 내용 자체를 html 에 넣어서 인쇄창 띄움-->

                                    <!--<input type="button" value="결과보고서인쇄" id="submit_btn01" onclick="print(document.getElementById('print').innerHTML);">-->
									<input type="button" value="결과보고서인쇄" id="submit_btn01" onclick="move_print_page('check_result_report','<?=$st_date;?>','<?=$ed_date;?>','<?=$select_page_num?>');">
									<input type="button" value="저장" id="submit_btn02" onclick="ExcelDown_1('check_result_excel', '<?=$excel_where?>');">
                                </p>
                            </div><!--receive-->
                            <div class="receive_table" id="print">
                                <table>
                                	<colgroup>
                                    	<col width="50px">
                                        <col width="110px">
                                        <col width="200px">
                                        <col width="220px">
                                        <col width="295px">
                                        <col width="100px">
                                        <col width="130px">
                                        <col width="100px">
                                        <col width="80px">
                                        <col width="75px">
                                        <col width="75px">
                                    </colgroup>
                                    <tr>
                                        <th><a href="javascript:void(0);" id="checkAll" onclick="chk_reverse();">선택</a></th>
                                        <th>접수번호</th>
                                        <th>성명</th>
                                        <th>업체이름</th>
                                        <th>설치장소</th>
                                        <th>광고물종류</th>
                                        <th>규격</th>
                                        <th>검사일자</th>
                                        <th>검사결과</th>
                                        <th>검사자</th>
                                        <th>보기</th>
                                    </tr>
									<?
										if($where <> ""){
											$where .= " and insert_id is not null order by reg_no desc LIMIT $offset, $list_num";
											$result = fn_select("*", "soaa_reg_check", $where);
										}

										$i=1;
										while($rs = mysql_fetch_array($result)) {
											if($i > $select_page_num){
												continue;
											}

											/* 검사서 인쇄 조건 S*/
											if($i < $select_page_num){
												$Prn_reg_no .= $rs['reg_no'] . ",";
												$Prn_gu_office .=$rs['gu_office'] . ",";
											}else{
												$Prn_reg_no .= $rs['reg_no'];
												$Prn_gu_office .=$rs['gu_office'];
											}
											/* 검사서 인쇄 조건 E*/

											$reg_date = explode(" ", $rs["reg_date"]);
											$reg_date = explode("-", $reg_date[0]);

											$td_chk_result = "";
											switch($rs['chk_result']){
												case "pass":
													$td_chk_result = "합격";	break;
												case "failed":
													$td_chk_result = "불합격";	break;
												case "NonMake":
													$td_chk_result = "미설치";	break;
												case "NonTarget":
													$td_chk_result = "비대상";	break;
												case "PlaceModify":
													$td_chk_result = "현장시정";	break;
												case "defer":
													$td_chk_result = "보류";	break;
												case "pullDown":
													$td_chk_result = "철거";	break;
												case "NonChk":
													$td_chk_result = "미검사";	break;
											}
//
//											if($rs['chk_personA']){
//												$chk_person = $rs['chk_personA'];
//											}else{
//												$chk_person = $rs['chk_personB'];
//											}

											if($rs['outdoor_act_cate'] == "garo" || $rs['outdoor_act_cate'] == "oksang"){
												$size	=	$rs['outdoor_size0'] . "*" . $rs['outdoor_size1'] . "*" . $rs['outdoor_size2'] . "*" . $rs['outdoor_size3']. "*" . $rs['outdoor_size4']. "*" . $rs['outdoor_size5'];
											}else{
												$size	=	$rs['outdoor_size0'] . "*" . $rs['outdoor_size1'] . "*" . $rs['outdoor_size2'] . "*" . $rs['outdoor_size3'];												
											}

											$chk_personA		=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='" . $rs['chk_personA'] . "'");
											$chk_personB		=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='" . $rs['chk_personB'] . "'");
									?>
                                    <tr class="listColorChange">
                                        <td class="choice"><input type="checkbox" name="chkbox[]" value="<?=$rs["reg_no"]?>"></td>
                                        <td class="receive_num"><?=$rs["reg_no"]?></td>
                                        <td class="offeror"><?=$rs["c_ceo_nm"]?></td>
                                        <td class="corp_name"><?=$rs["c_corp_nm"]?></td>
                                        <td class="locate"><?=$rs["outdoor_real_addr"]?></td>
                                        <td class="ads_type"><img src="/img/<?=$rs["outdoor_act_cate"]?>.png" alt="지주"></td>
                                        <td class="standard"><?=$size;?></td>
                                        <td class="check_date">2014.10.21</td>
                                        <td class="check_result"><?=$td_chk_result?></td>
                                        <td class="inspector">
											<?
												echo $chk_personA[0];
												if($chk_personB[0]){
													echo "," . $chk_personB[0];
												}

											?>
										</td>
                                        <td class="view">
											<a href="javascript:void(0);" onclick="soaa_list_view('soaa_list.view','<?=$page?>','<?=$rs["reg_no"]?>');">
												<img src="/img/view.png" alt="보기">
											</a>
										</td>
                                    </tr>
									<? 
											$i++;
										} //end while
									?>
                                </table>
                            </div><!--receive_table-->
                            <? if($tot_cnt > 0) { ?>
								<div class="arrow_navi">
									<?
										//1페이로 이동
										if($block > 1){
										$go_page=1;
									?>
									<a href="javascript:void(0);" onclick="navi_move('check_result_report','<?=$go_page?>','<?=$select_page_num?>','<?=$st_date?>',
									'<?=$ed_date?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$reg_no?>','<?=$outdoor_act_cate?>',
									'<?=$chk_paytype?>','<?=$report_certi?>','<?=$chk_result?>');">
									<img src="/img/pre.png" alt="왼쪽 버튼"></a>
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
									<a href="javascript:void(0);" onclick="navi_move('check_result_report','<?=$go_page?>','<?=$select_page_num?>','<?=$st_date?>',
									'<?=$ed_date?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$reg_no?>','<?=$outdoor_act_cate?>',
									'<?=$chk_paytype?>','<?=$report_certi?>','<?=$chk_result?>');">
									<img src="/img/before.png" alt="왼쪽 버튼" class="before"></a>
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
											<a href="javascript:void(0);" onclick="navi_move('check_result_report','<?=$page_link?>','<?=$select_page_num?>','<?=$st_date?>',
											'<?=$ed_date?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$reg_no?>','<?=$outdoor_act_cate?>',
											'<?=$chk_paytype?>','<?=$report_certi?>','<?=$chk_result?>');"><?=$page_link?></a>
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
								   <a href="javascript:void(0);" onclick="navi_move('check_result_report','<?=$go_page?>','<?=$select_page_num?>','<?=$st_date?>',
								   '<?=$ed_date?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$reg_no?>','<?=$outdoor_act_cate?>',
								   '<?=$chk_paytype?>','<?=$report_certi?>','<?=$chk_result?>');">
								   <img src="/img/next.png" alt="오른쪽 버튼" class="next"></a>
								   <? } ?>
								   <? 
									//*개뒤 마지막
									if($block < $total_block){
										$go_page = $total_page;
									?>
								   <a href="javascript:void(0);" onclick="navi_move('check_result_report','<?=$go_page?>','<?=$select_page_num?>','<?=$st_date?>',
								   '<?=$ed_date?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$reg_no?>','<?=$outdoor_act_cate?>',
								   '<?=$chk_paytype?>','<?=$report_certi?>','<?=$chk_result?>');">
								   <img src="/img/f.f.png" alt="오른쪽 버튼"></a>
								   <? } ?>
								</div>
							<? } //End If Tot_cnt ?>
                            <div class="print_area">인쇄시&nbsp;이름
                                <select class="print01" name="tests">
                                    <option value="society">서울시옥외광고협회</option>
                                    <!--<option value="jibu">서울시지부</option>-->
                                </select>
                                <img src="/img/inspection_print.png" class="inspection_print" alt="검사서인쇄" onclick="Print_ChkReport('<?=$Prn_reg_no;?>','<?=$Prn_gu_office;?>','<?=$select_page_num?>','<?=$tot_cnt?>');">
								<!--
								기존 asp 출력물
								<img src="/img/inspection_print.png" class="inspection_print" alt="검사서인쇄" onclick="Print_t('<?=$Prn_reg_no;?>','<?=$Prn_gu_office;?>','<?=$select_page_num?>');">
								-->
								<img src="/img/mini_bar.png" class="print_bar" alt="bar" >
                                <select class="print03">
                                    <option value="">인쇄형식1</option>
                                </select>
                                <img src="/img/certificate_print.png" class="certificate_print" alt="필증인쇄" onclick="Print_PrtPrt('print_prt_prt','<?=$Prn_reg_no;?>','<?=$Prn_gu_office;?>','<?=$select_page_num?>','<?=$tot_cnt?>');">
                                <img src="/img/addr_print.png" class="addr_print" alt="주소인쇄"></div>
                        </div><!--con02-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
		</form>
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>