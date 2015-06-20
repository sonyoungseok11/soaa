<?  include $_SERVER["DOCUMENT_ROOT"] . "/safeChk_Mng/left_menu.php"; ?>

<link rel="stylesheet" type="text/css" href="/css/admin/soaa_list.css">

<?
	if($_POST["st_date"] <> "" || $_POST["ed_date"] <> "" ||$_POST["gu_office"] <> "" ||$_POST["c_corp_nm"] <> "" ||$_POST["c_ceo_nm"] <> "" ||$_POST["reg_no"] <> "" ||
		$_POST["outdoor_act_cate"] <> "" || $_POST["chk_paytype"] <> "" ||$_POST["report_certi"] <> "" || $_POST["chk_result"] <> "" || $_POST["select_page_num"]){

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
		$select_page_num	=	$_POST["select_page_num"];

		include "./soaa_list_where.php";
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
		$select_page_num = $_GET["select_page_num"];
		
		include "./soaa_list_where.php";
	}
	
	if($where == ""){
		$tot_cnt = fn_select_cnt("reg_no", "soaa_reg_check", "reg_no <> '' and insert_id is not null");
	}else{
		$tot_cnt = fn_select_cnt("reg_no", "soaa_reg_check", $where);
	}

	$page = $_GET["page"];
	
	if (!$page) $page = 1;

	if(!$select_page_num){
		$select_page_num = 5;
	}

	$list_num = $select_page_num;
	echo "list_num=" . $list_num . "<br>";

	$page_num = ceil($tot_cnt/$list_num);
	echo "list_num=" . $list_num . "<br>";

	$offset = $list_num	*	($page-1);

	$total_no	=	$tot_cnt;
	echo "total_no=" . $total_no . "<br>";
	

	$total_page = ceil($total_no / $list_num);
	echo "total_page=" . $total_page . "<br>";

	echo "page=" . $page . "<br>";

	$total_block = ceil($total_page / $page_num);
	echo "total_block=" . $total_block . "<br>";

	$block = ceil($page / $page_num);
	echo "block=" . $block . "<br>";

	$first = ($block-1) * $page_num;
	$last = $block * $page_num;
?>
            <section class="contents">
            	<div class="contents_con">
                    <div class="top_unit">
                        <div class="inner_jump"><a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전점검&nbsp;관리</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">안전점검&nbsp;접수현황</a></div>
                        <div class="clear"></div>
                        <p class="contop_title"><img src="/img/set_icon.png" alt="icon">안전점검&nbsp;접수현황<span class="contop_tip">안전점검&nbsp;접수를&nbsp;한&nbsp;현황에&nbsp;대해서&nbsp;조회&#44;&nbsp;관리할&nbsp;수&nbsp;있습니다&#46;</span><span class="info_notice"><a href="#"><img src="/img/notice.png" alt="알림"></a></span></p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <div class="con01">
							<form name="form" method="post">
                            <table>
                                <tr>
                                    <td class="con01_title">기간검색</td>
                                    <td class="con01_cons">
                                        시작날짜&nbsp;&#58;&nbsp;<input type="text" class="w90" id="st_date" name="st_date" value="<?=$st_date?>">&nbsp;&nbsp;&nbsp;&#126;&nbsp;&nbsp;&nbsp;
										종료날짜&nbsp;&#58;&nbsp;<input type="text" class="w90" id="ed_date" name="ed_date" value="<?=$ed_date?>">
                                        <span class="con1_cons_tip">연도&#8211;월&#8211;일&#40;2014&#8211;01&#8211;01&#41;형식으로&nbsp;입력해주세요&#46;</span>
                                    </td>
                                    <td class="click_btn" rowspan="3">
                                        <a href="javascript:void(0);"><img src="/img/search.png" class="c_btn_srh" alt="검색" onclick="soaa_search('soaa_list');"></a>
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
										onkeydown="javascript: if(event.keyCode == 13) { soaa_search('soaa_list'); }">
										성명&nbsp;&#58;<input type="text" class="w90 mar" name="c_ceo_nm" value="<?=$c_ceo_nm?>"
										onkeydown="javascript: if(event.keyCode == 13) { soaa_search('soaa_list'); }">
										접수번호&nbsp;&#58;<input type="text" class="w90 mar" name="reg_no" value="<?=$reg_no?>"
										onkeydown="javascript: if(event.keyCode == 13) { soaa_search('soaa_list'); }">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="con01_title">기타검색</td>
                                    <td class="con01_cons">
                                        <select class="ads_sort m_right30" name="outdoor_act_cate">
                                            <option value="">광고물&nbsp;종류</option>
											<?
												$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='01'");
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
                                    </td>
                                </tr>
                            </table>
                        </div><!--con01-->
                        <div class="con02">
                            <div class="receive">
                                <p class="paging">
                                    페이지&nbsp;데이터&nbsp;갯수
                                    <select class="data_num" name="select_page_num" onchange="page_list('soaa_list', this.value);">
										<? for($i=5; $i<=100;){?>
                                        <option value="<?=$i?>" <? if($i==$select_page_num){ echo "selected=selected";}?>><?=$i?></option>
										<? $i += 5;
											}
										?>
                                    </select>개
                                </p>
                                <p class="paging_search">
                                    <select class="ps_year">
										<?
											$this_year	= date("Y");
											$st_year = $this_year - 10;

											for($i=$this_year; $i>=$st_year; $i--){
										?>
                                        <option value="<?=$i?>"><?=$i?></option>
										<? } ?>
                                    </select>년
                                    <select class="ps_month">
										<?
											$this_month = date("m");
											for($i=1; $i<=12; $i++){
										?>
                                        <option value="<?=$i?>" <? if($i==$this_month){ echo "selected=selected"; }?>><?=$i?></option>
										<? } ?>
                                    </select>월
                                    <span class="total_search">총&nbsp;<?=$tot_cnt?>건의&nbsp;접수건이&nbsp;검색되었습니다&#46;</span>
                                </p>
                            </div><!--receive-->
                            <div class="receive_table">
                                <table>
                                    <tr>
                                        <th><a href="javascript:void(0);" id="checkAll" onclick="chk_reverse();">선택</a></th>
                                        <th>접수번호</th>
                                        <th>신청일자</th>
                                        <th>업체이름</th>
                                        <th>신청인</th>
                                        <th>광고물종류</th>
                                        <th>설치장소</th>
                                        <th>현상태</th>
                                        <th>검사일자</th>
                                        <th>검사결과</th>
                                        <th>납입여부</th>
                                        <th>보기</th>
                                        <th>삭제</th>
                                    </tr>
									<?
										if($where == ""){
											$where .= " insert_id is not null order by insert_date desc LIMIT $offset, $list_num";
											$result = fn_select("*", "soaa_reg_check", $where);
										}else{
											$where .= " and insert_id is not null order by insert_date desc LIMIT $offset, $list_num";
											$result = fn_select("*", "soaa_reg_check", $where);
										}
										$i=1;
										while($rs = mysql_fetch_array($result)) {
											if($i > $select_page_num){
												continue;
											}
											$reg_date = explode(" ", $rs["reg_date"]);
											$reg_date = explode("-", $reg_date[0]);
									?>
                                    <tr>
                                        <td class="choice"><input type="checkbox" name="chkbox[]" value="<?=$rs["reg_no"]?>"></td>
                                        <td class="receive_num"><?=$rs["reg_no"]?></td>
                                        <td class="date"><?=$reg_date[0]?>.<?=$reg_date[1]?>.<?=$reg_date[2]?></td>
                                        <td class="corp_name"><?=$rs["c_corp_nm"]?></td>
                                        <td class="offeror"><?=$rs["c_ceo_nm"]?></td>
                                        <td class="ads_type"><img src="/img/<?=$rs["outdoor_act_cate"]?>.png" alt="지주"></td>
                                        <td class="locate"><?=$rs["outdoor_real_addr"]?></td>
                                        <td class="state"><img src="/img/gum_on.png" alt=""><img src="/img/pil_off.png" class="m_left10" alt="" ></td>
                                        <td class="check_date"><?=$rs["real_chkday"]?></td>
                                        <td class="check_result">
											<?	
												switch($rs["chk_result"]){
													case "pass":
														$chk_result = "합격";	break;
													case "failed":
														$chk_result = "불합격";	break;
													case "NonMake":
														$chk_result = "미설치";	break;
													case "NonTarget":
														$chk_result = "비대상";	break;
													case "PlaceModify":
														$chk_result = "현장시정";	break;
													case "defer":
														$chk_result = "보류";	break;
													case "pullDown":
														$chk_result = "철거";	break;
													case "NonChk":
														$chk_result = "미검사";	break;
												}
											echo $chk_result;
											?>
										</td>
                                        <td class="pay_yn"></td>
                                        <td class="view"><img src="/img/view.png" alt="보기"></td>
                                        <td class="del"><img src="/img/del.png" alt="삭제"></td>
                                    </tr>
									<? 
										$i++;
									} ?>
                                </table>
							
                            </div><!--receive_table-->
							<? if($tot_cnt > 0) { ?>
								<div class="arrow_navi">

									<a href="#"><img src="../img/pre.png" alt="왼쪽 버튼"></a>
									<a href="#"><img src="../img/before.png" alt="왼쪽 버튼" class="before"></a>
									<ul>
									<?
									for($page_link=$first+1; $page_link<=$last; $page_link++)	{
										if($page_link==$page){	?>
											 <li class="click"><?=$page_link?></li>
										<? }else{ ?>
										 <li><a href="javascript:void(0);" onclick="navi_move('soaa_list','<?=$page_link?>','<?=$select_page_num?>','<?=$st_date?>','<?=$ed_date?>','<?=$gu_office?>','<?=$c_corp_nm?>','<?=$c_ceo_nm?>','<?=$reg_no?>','<?=$outdoor_act_cate?>','<?=$chk_paytype?>','<?=$report_certi?>','<?=$chk_result?>');">
											<?=$page_link?>
										</li>
										<? }
									}
									?>
									</ul>
									<?
									if($total_page > $page) {
										$go_page = $page + 1;
									?>
								   <a href="#"><img src="../img/next.png" alt="오른쪽 버튼" class="next"></a>
								   <? } ?>
								   <? 
									//*개뒤 마지막
									if($block < $total_block){
										$next = $last + 1;
									?>
								   <a href="#"><img src="../img/f.f.png" alt="오른쪽 버튼"></a>
								   <? } ?>
								</div>
							<? } ?>
                            <div class="check_application">
                                <span class="all_chk_app"><img src="/img/dot4.png" alt="dot">검사일자</span>
								<input type="text" class="w90 mar" id="chk_date" name="real_chkday">
                                <span class="all_chk_app"><img src="/img/dot4.png" alt="dot">검사자</span>
                                <select class="inspector" name="chk_personA">
									<option value="">선택</option>
                                    <?
										$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='15'");
										while($rs = mysql_fetch_array($result)){
									?>
									<option value="<?=$rs["en_nm"]?>"><?=$rs["ko_nm"]?></option>
									<? } ?>
                                </select>
                                <select class="inspector" name="chk_personB">
									<option value="">선택</option>
									 <?
										$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='15'");
										while($rs = mysql_fetch_array($result)){
									?>
									<option value="<?=$rs["en_nm"]?>"><?=$rs["ko_nm"]?></option>
									<? } ?>
                                </select>
                                <select class="chk_position" name="chk_p_positionA">
									<option value="">선택</option>
                                    <?
										$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='20'");
										while($rs = mysql_fetch_array($result)){
									?>
									<option value="<?=$rs["en_nm"]?>"><?=$rs["ko_nm"]?></option>
									<? } ?>
                                </select>
                                <select class="chk_position1" name="chk_p_positionB">
									<option value="">선택</option>
                                    <?
										$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='20'");
										while($rs = mysql_fetch_array($result)){
									?>
									<option value="<?=$rs["en_nm"]?>"><?=$rs["ko_nm"]?></option>
									<? } ?>
                                </select>
                                <span class="all_chk_app"><img src="/img/dot4.png" alt="dot">검사결과</span>
                                <select class="chk_outcome" name="chk_result">
									<option value="">선택</option>
                                    <?
										$result = fn_select("en_nm, ko_nm", "common_selectbox", "code='30'");
										while($rs = mysql_fetch_array($result)){
									?>
									<option value="<?=$rs["en_nm"]?>"><?=$rs["ko_nm"]?></option>
									<? } ?>
                                </select>
                                <a href="#"><img src="/img/all_application.png" alt="일괄적용" class="all_app" onclick="all_soaa_result_apply('soaa_list_proc')"></a>
                                <p class="chk_app_btn"><input type="button" value="검사접수" id="submit_btn" onclick="movePage('soaa_reg');"></p>
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