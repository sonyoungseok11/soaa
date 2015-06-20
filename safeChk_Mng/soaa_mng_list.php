<?  include $_SERVER["DOCUMENT_ROOT"] . "/safeChk_Mng/left_menu.php"; ?>

<link rel="stylesheet" type="text/css" href="/css/admin/soaa_mng_list.css">
<?

//##################
// POST 또는 GET으로 받을때 reg_no 로 받거나 보내면
// &c_ceo_nm=경숙®_ 처럼 특수문자가 붙음... (페이지 링크 -> common.js->function navi_mng_list -> soaa_mng_list)
// 부득이하게 rega_no 로 임시처리함.
//###################
if($_POST['select_gigan_y'] <> "" ||$_POST['select_gigan_m'] <> "" || $_POST['st_date'] <> "" || $_POST['ed_date'] <> ""
|| $_POST['gu_office'] <> "" || $_POST['c_corp_nm'] <> "" || $_POST['c_ceo_nm'] <> "" || $_POST['rega_no'] <> "" || $_POST['chk_personA'] <> "" || $_POST["outdoor_real_addr"] <> ""
|| $_POST['outdoor_act_cate'] <> ""|| $_POST['payment_state'] <> "" || $_POST['report_certi'] <> ""  || $_POST['chk_result'] <> "" || $_POST["select_page_num"] <> ""){

	//기간선택 년도, 월
	$select_gigan_y	=	$_POST['select_gigan_y'];
	$select_gigan_m	=	$_POST['select_gigan_m'];


	//시작날짜, 종료날짜
	$st_date	=	$_POST['st_date'];
	$ed_date	=	$_POST['ed_date'];

	$gu_office	=	$_POST['gu_office']; 
	$c_corp_nm	=	$_POST['c_corp_nm'];
	$c_ceo_nm	=	$_POST['c_ceo_nm'];

	$rega_no		=	$_POST['rega_no'];
	$chk_personA	=	$_POST['chk_personA']; 
	$outdoor_real_addr		=	$_POST["outdoor_real_addr"];
	$outdoor_act_cate		=	$_POST['outdoor_act_cate'];

	$payment_state	=	$_POST['payment_state'];
	$report_certi	=	$_POST['report_certi'];
	$chk_result		=	$_POST['chk_result'];
	$select_page_num	=	$_POST["select_page_num"];

	include "./soaa_mng_list_where.php";
}else{

	$select_gigan_y	=	$_GET['select_gigan_y'];
	$select_gigan_m	=	$_GET['select_gigan_m'];


	$st_date	=	$_GET['st_date'];
	$ed_date	=	$_GET['ed_date'];

	$gu_office	=	$_GET['gu_office']; 
	$c_corp_nm	=	$_GET['c_corp_nm'];
	$c_ceo_nm	=	$_GET['c_ceo_nm'];

	$rega_no			=	$_GET['rega_no'];
	$chk_personA		=	$_GET['chk_personA']; 
	$outdoor_real_addr	=	$_POST["outdoor_real_addr"];
	$outdoor_act_cate	=	$_GET['outdoor_act_cate'];

	$payment_state	=	$_GET['payment_state'];
	$report_certi	=	$_GET['report_certi'];
	$chk_result		=	$_GET['chk_result'];
	$select_page_num	=	$_GET["select_page_num"];

	include "./soaa_mng_list_where.php";
}

	if($where == ""){
		//최초에는 빈 화면만 띄워줌.
		$tot_cnt = 0;
		$rs_sum_total = 0;
	}else{
		$tot_cnt = fn_select_cnt("reg_no", "soaa_reg_check", $where);
		$rs_sum_total = fn_total_sum("chk_pay", "soaa_reg_check", $where);
	}

	$page	=	$_GET["page"];

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
                        <div class="inner_jump"><a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전점검&nbsp;관리</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전점검&nbsp;관리대장&nbsp;조회</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="/img/set_icon.png" alt="icon">안전점검&nbsp;관리대장&nbsp;조회<span class="contop_tip">안전점검&nbsp;관리대장을&nbsp;조회할&nbsp;수&nbsp;있습니다&#46;</span><span class="info_notice"><a href="#"><img src="/img/notice.png" alt="알림"></a></span></p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
						<form  name="form" method="post">
                        <div class="con01">
                            <table>
                                <tr>
                                    <td class="con01_title">기간검색</td>
                                    <td class="con01_cons">
                                        <div class="period_ym">
                                            기간선택&nbsp;&#58;&nbsp;
                                            <select name="select_gigan_y">
												<option value="">선택</option>
												<?

													$now_year	=	date("Y");
													$st_year = $now_year - 10;
													for($gigan_y=$now_year; $gigan_y>=$st_year; $gigan_y--){
												?>
                                                <option value="<?=$gigan_y?>" <? if($gigan_y==$select_gigan_y){echo "selected=selected";}?>><?=$gigan_y?></option>
												<?
													}
												?>
                                            </select>
													 년
                                            <select name="select_gigan_m">
												<option value="">선택</option>
                                               	<?
													$now_month =  date("m");
													for($gigan_m=1; $gigan_m<=12; $gigan_m++){
												?>
                                                <option value="<?=$gigan_m?>" <? if($gigan_m==$select_gigan_m){echo "selected=selected";}?>><?=$gigan_m?></option>
												<?
													}
												?>
                                            </select>월
                                        </div>
                                        <div class="period_date">
                                            시작날짜&nbsp;&#58;&nbsp;<input type="text" class="w90" id="st_date" name="st_date" value="<?=$st_date;?>"
											onclick="se_date('soaa_mng_list');">&nbsp;&nbsp;&nbsp;&#126;&nbsp;&nbsp;&nbsp;
											종료날짜&nbsp;&#58;&nbsp;<input type="text" class="w90" id="ed_date" name="ed_date" value="<?=$ed_date;?>">
                                        <span class="con1_cons_tip">연도&#8211;월&#8211;일&#40;2014&#8211;01&#8211;01&#41;형식으로&nbsp;입력해주세요&#46;</span>
                                        </div>
                                    </td>
                                    <td class="click_btn" rowspan="3">
                                        <a href="javascript:void(0);"><img src="/img/search.png" class="c_btn_srh" alt="검색" onclick="soaa_search('soaa_mng_list');"></a>
										<a href="#"><img src="/img/refresh.png" class="refresh" alt="새로고침"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="con01_title">일반검색</td>
                                    <td class="con01_cons">
                                        구청
                                        <select class="guchung" name="gu_office">
                                            <option value="">구청&nbsp;선택</option>
											<?
												$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='10' order by order_idx");
												while($rs = mysql_fetch_array($result)){
											?>
                                            <option value="<?=$rs["en_nm"]?>" <? if($gu_office == $rs["en_nm"]) { echo "selected=selected";}?>><?=$rs["ko_nm"]?></option>
											<? } ?>
                                        </select>
                                        업소명&nbsp;&#58;<input type="text" class="w80 mar" name="c_corp_nm" value="<?=$c_corp_nm?>"
										onkeydown="javascript: if(event.keyCode == 13) { soaa_search('soaa_mng_list'); }">
										성명&nbsp;&#58;<input type="text" class="w80 mar" name="c_ceo_nm" value="<?=$c_ceo_nm?>"
										onkeydown="javascript: if(event.keyCode == 13) { soaa_search('soaa_mng_list'); }">
										접수번호&nbsp;&#58;<input type="text" class="w80 mar" name="rega_no" value="<?=$rega_no?>"
										onkeydown="javascript: if(event.keyCode == 13) { soaa_search('soaa_mng_list'); }">
										설치장소&nbsp;검색&nbsp;&#58;<input type="text" class="w200 mar" name="outdoor_real_addr" value="<?=$outdoor_real_addr?>"
										onkeydown="javascript: if(event.keyCode == 13) { soaa_search('soaa_mng_list'); }">
                                        검사자
                                        <select class="gch_inspector" name="chk_personA">
                                            <option value="">전체보기</option>
                                            <?
												$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='15'");
												while($rs = mysql_fetch_array($result)){
											?>
											<option value="<?=$rs["en_nm"]?>"><?=$rs["ko_nm"]?></option>
											<? } ?>
                                        </select>
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
                                        <select class="gumsa_cash m_right30" name="payment_state">
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
                                    </td>
                                </tr>
                            </table>
                        </div><!--con01-->

                        <div class="con02">
                            <div class="receive">
                                <p class="paging">
                                    페이지&nbsp;데이터&nbsp;갯수
                                    <select class="data_num"name="select_page_num" onchange="page_list('soaa_mng_list', this.value);">
										<? for($i=5; $i<=100;){?>
                                        <option value="<?=$i?>" <? if($i==$select_page_num){ echo "selected=selected";}?>><?=$i?></option>
										<? $i += 5;
											}
										?>
                                    </select>개
                                    <span class="total_search">총&nbsp;<?=number_format($rs_sum_total[0])?>원&#47;총&nbsp;<?=$tot_cnt?>건의&nbsp;접수건이&nbsp;검색되었습니다&#46;</span>
                                </p>
                                <p class="paging_search">
                                    <span class="total_alrim">모든&nbsp;인쇄는&nbsp;페이지&nbsp;단위로&nbsp;인쇄가&nbsp;됩니다&#46;</span>
                                    <span class="ps_btns">
										<input type="button" value="관리대장인쇄" id="submit_btn01" onclick="move_print_page('soaa_mng_list','<?=$select_gigan_y;?>','<?=$select_gigan_m;?>');">
										<input type="button" value="관리대장저장" id="submit_btn02" onclick="ExcelDown_0('soaa_mng_excel');">
										<!--<input type="button" value="관리대장저장" id="submit_btn02" onclick="ThisWindowsPrint();">-->
									</span>
                                </p>
                            </div><!--receive-->
							
                            <div class="receive_table">
                                <table>
                                   <tr>
                                      <th rowspan="2">접수번호</th>
                                      <th rowspan="2">신청일자</th>
                                      <th rowspan="2">성명</th>
                                      <th rowspan="2">업소명</th>
                                      <th rowspan="2">전화번호</th>
                                      <th rowspan="2">구청명</th>
                                      <th rowspan="2">광고물종류</th>
                                      <th rowspan="2">형식</th>
                                      <th rowspan="2">표시위치</th>
                                      <th rowspan="2">표시규격</th>
                                      <th>검사일자</th>
                                      <th>검사결과</th>
                                      <th rowspan="2">입금일자</th>
                                   </tr>
                                   <tr>
                                      <th>검사자</th>
                                      <th>수수료</th>
                                   </tr>
                                   <!--2개의 tr이 한 세트-->

								   <?
									if($tot_cnt > 0) {
									   if($where == ""){
											$where .= " insert_id is not null order by reg_no desc LIMIT $offset, $list_num";
											$result = fn_select("*", "soaa_reg_check", $where);
										}else{
											$where .= " and insert_id is not null order by reg_no desc LIMIT $offset, $list_num";
											$result = fn_select("*", "soaa_reg_check", $where);
										}

//										echo "where=" . $where . "<br>";

										$i=1;
										while($rs = mysql_fetch_array($result)){
											if($i > $select_page_num){
												continue;
											}
											$lst_gu_office			=	$rs['gu_office'];
											$lst_outdoor_act_cate	=	$rs['outdoor_act_cate'];

											$size	=	"";
											if($lst_outdoor_act_cate == "oksang" || $lst_outdoor_act_cate == "garo"){
												for($j=0; $j<=7; $j++){
													if($j<=6){
														$size .= $rs['outdoor_size' . $j] . "*";
													}else{
														$size .= $rs['outdoor_size' . $j];
													}
												}
											}
											
											$lst_outdoor_act_type	=	$rs['outdoor_act_type'];
											$lst_chk_result			=	$rs['chk_result'];
											$lst_outdoor_real_addr	=	str_replace("서울특별시 ", "", $rs['outdoor_real_addr']);
											$chk_personA			=	$rs['chk_personA'];
											$chk_personB			=	$rs['chk_personB'];
											
											$rs_gu_office	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='10' and en_nm='$lst_gu_office'");
											$rs_outdoor_act_cate	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='01' and en_nm='$lst_outdoor_act_cate'");
											$rs_outdoor_act_type	=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='05' and en_nm='$lst_outdoor_act_type'");
											$rs_chk_result				=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='30' and en_nm='$lst_chk_result'");
											$chk_personA				=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='$chk_personA'");
											$chk_personB				=	fn_select_fetch_array("ko_nm", "common_selectbox", "code='15' and en_nm='$chk_personB'");

											$reg_no	=	$rs['reg_no'];
									?>
                                   <tr class="listColorChange">
									  <!-- fetch_array 는 배열 형태로 리턴값을 반환하므로 [0] 을 써줘야함.-->
                                      <td rowspan="2" class="receive_num" onclick="soaa_list_view('soaa_list.view','1','<?=$reg_no?>');"><a href="javascript:void(0);"><?=$rs['reg_no']?></a></td>
                                      <td rowspan="2" class="date"><?=$rs['reg_date']?></td>
                                      <td rowspan="2" class="name" onclick="soaa_list_view('soaa_list.view','1','<?=$reg_no?>');"><a href="javascript:void(0);"><?=$rs['c_ceo_nm']?></a></td>
                                      <td rowspan="2" class="corp_name" onclick="soaa_list_view('soaa_list.view','1','<?=$reg_no?>');"><a href="javascript:void(0);"><?=$rs['c_corp_nm']?></a></td>
                                      <td rowspan="2" class="tel"><?=$rs['c_tel']?></td>
                                      <td rowspan="2" class="guchung_name"><?=$rs_gu_office[0]?></td>
                                      <td rowspan="2" class="ads_type"><?=$rs_outdoor_act_cate[0]?></td>
                                      <td rowspan="2" class="sort"><?=$rs_outdoor_act_type[0]?></td>
                                      <td rowspan="2" class="locate"><?=$lst_outdoor_real_addr?></td>
                                      <td rowspan="2" class="size"><?=$size;?></td>
                                      <td class="check_con01"><?=$rs['real_chkday']?></td>
                                      <td class="check_con02"><?=$rs_chk_result[0]?></td>
                                      <td rowspan="2" class="deposit_date"><?=$rs['payment_in_day']?></td>
                                   </tr>
                                   <tr>
                                      <td class="check_con01">
										<?
											if($rs['chk_personA'] <> ""){
												echo $chk_personA[0];
											}

											if($rs['chk_personB'] <> ""){
												echo " / " . $chk_personB[0];
											}

										?>	
									  </td>
                                      <td class="check_con03"><?=number_format($rs['chk_pay'])?><span class="bold">원</span></td>
                                   </tr>
								<? 
										$i++;
										}	//end while
									}else{
										echo "
											<tr>
												<td class=\"non_result\" colspan=13>검색결과가 없습니다.</td>
											</tr>
											";
									}
									
									// end if tot_cnt
								?>
								
                                   <!--2개의 tr이 한 세트-->
                                </table>
								<div class="arrow_navi">
									<?
										//1페이로 이동
										if($block > 1){
										$go_page=1;
									?>
									<a href="javascript:void(0);" 
									onclick="navi_mng_list('soaa_mng_list','<?=$go_page?>','<?=$select_page_num?>'
									,'<?=$select_gigan_y?>','<?=$select_gigan_m?>','<?=$st_date?>','<?=$ed_date?>'
									,'<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$rega_no?>','<?=$chk_personA?>','<?=$outdoor_act_cate?>'
									,'<?=$payment_state?>','<?=$report_certi?>','<?=$chk_result?>');">
										<img src="../img/pre.png" alt="왼쪽 끝버튼">
									</a>
									<? } ?>


									<?
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
									<a href="javascript:void(0);" 
									onclick="navi_mng_list('soaa_mng_list','<?=$go_page?>','<?=$select_page_num?>'
									,'<?=$select_gigan_y?>','<?=$select_gigan_m?>','<?=$st_date?>','<?=$ed_date?>'
									,'<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$rega_no?>','<?=$chk_personA?>','<?=$outdoor_act_cate?>'
									,'<?=$payment_state?>','<?=$report_certi?>','<?=$chk_result?>');">
										<img src="../img/before.png" alt="왼쪽 이전버튼" class="before">
									</a>
								<? }//이전 블록이동End	?>
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
											<a href="javascript:void(0);" onclick="navi_mng_list('soaa_mng_list','<?=$page_link?>','<?=$select_page_num?>'
									,'<?=$select_gigan_y?>','<?=$select_gigan_m?>','<?=$st_date?>','<?=$ed_date?>'
									,'<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$rega_no?>','<?=$chk_personA?>','<?=$outdoor_act_cate?>'
									,'<?=$payment_state?>','<?=$report_certi?>','<?=$chk_result?>');"><?=$page_link?></a>
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
								<a href="javascript:void(0);" onclick="navi_mng_list('soaa_mng_list','<?=$go_page?>','<?=$select_page_num?>'
								,'<?=$select_gigan_y?>','<?=$select_gigan_m?>','<?=$st_date?>','<?=$ed_date?>'
									,'<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$rega_no?>','<?=$chk_personA?>','<?=$outdoor_act_cate?>'
									,'<?=$payment_state?>','<?=$report_certi?>','<?=$chk_result?>');">
									<img src="../img/next.png" alt="오른쪽 다음버튼" class="next">
								</a>
								<?	}	?>
								
								<?
									//*개뒤 마지막
								if($block < $total_block){
										$go_page = $total_page;
								?>
								<a href="javascript:void(0);" onclick="navi_mng_list('soaa_mng_list','<?=$go_page?>','<?=$select_page_num?>'
								,'<?=$select_gigan_y?>','<?=$select_gigan_m?>','<?=$st_date?>','<?=$ed_date?>'
									,'<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$rega_no?>','<?=$chk_personA?>','<?=$outdoor_act_cate?>'
									,'<?=$payment_state?>','<?=$report_certi?>','<?=$chk_result?>');">
									<img src="../img/f.f.png" alt="오른쪽 끝버튼">
								</a>
							   <? } ?>
                            </div><!--receive_table-->
                        </div><!--con02-->
                    </div><!--contain-->
                </div><!--contents_con-->
            </section><!--contents-->
		</form>
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>