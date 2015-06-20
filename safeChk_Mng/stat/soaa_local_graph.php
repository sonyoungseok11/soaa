<?  include $_SERVER["DOCUMENT_ROOT"] . "/safeChk_Mng/left_menu.php"; ?>
<link rel="stylesheet" type="text/css" href="/css/admin/soaa_local_graph.css">
<?
	if($_GET['gubun']){
		$gubun	=	$_GET['gubun'];
	}else{
		$gubun	=	$_POST['gubun'];
	}

	$select_y	=	$_POST['select_y'];
	$select_m	=	$_POST['select_m'];
	$select_d	=	$_POST['select_d'];

	$select_yy	=	$_POST['select_yy'];
	$select_mm	=	$_POST['select_mm'];
	$select_dd	=	$_POST['select_dd'];

	if(!$gubun){
		$gubun = "month";
	}

	$now_y	=	date("Y");
	$now_m	=	date("m");
	$now_d	=	date("d");

	if($select_y == ""){	$select_y	=	$now_y;		}
	if($select_m == ""){	$select_m	=	$now_m;		}
	if($select_d == ""){	$select_d	=	"01";			}

	if($select_yy == ""){	$select_yy	=	$now_y;		}
	if($select_mm == ""){	$select_mm	=	$now_m;		}
	if($select_dd == ""){	$select_dd	=	$now_d;		}

	$where = "";
	switch($gubun){
		case "month":
			$where		=	" and date_format(insert_date, '%Y') in('$select_y')";	break;
		case "day":
			$where		=	" and date_format(insert_date, '%Y-%m') in('$select_y" . "-" ."$select_m')";	break;
		case "period":
			$where =	" and date_format(insert_date, '%Y-%m-%d') between ('$select_y" . "-" ."$select_m" . "-" . "$select_d') and ('$select_yy" . "-" ."$select_mm" . "-" . "$select_dd')";	
			break;
	}

	$start_y = $now_y -20;

	if($where){
		$excel_where = 1;
	}else{
		$excel_where = 0;
	}

	//검색조건 switch 문에서 현재 페이지명을 스크립트로 넘기기 위해 사용
	$this_page = array_pop(explode("/",$_SERVER['REQUEST_URI']));
	$this_page = explode(".", $this_page);

?>
            <section class="contents">
            	<div class="contents_con">
					<form name="form" method="post">
					<input type="hidden" name="gubun" value="<?=$gubun;?>">
                    <div class="top_unit">
                        <div class="inner_jump"><a href="#"><span class="first">HOME</span></a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">통계&nbsp;관리</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">검사&nbsp;접수&nbsp;통계&#40;구청별&#41;</a></div>
                        <div class="clear"></div>
                        <p class="contop_title">
							<img src="/img/set_icon.png" alt="icon">검사&nbsp;접수&nbsp;통계&#40;구청별&#41;
							<span class="contop_tip">환불건은&nbsp;제외</span>
							<span class="info_notice">
								<a href="#">
									<img src="/img/notice.png" alt="알림">
								</a>
							</span>
						</p>
                    </div>
                    <div class="line"></div>
                    <div class="contain">
                        <div class="con1">
                            <input type="button" value="년도별" id="submit_btn01" onclick="move_report_cate('soaa_local_graph','month')";>
							<input type="button" value="월별" id="submit_btn02"  onclick="move_report_cate('soaa_local_graph','day')";>
                            <input type="button" value="기간별" id="submit_btn03" onclick="move_report_cate('soaa_local_graph','period')";>
                        </div>
                        <div class="con2">
                            <div class="con2_toptip">
							<?
								switch($gubun){
									case "month":
										include "./soaa_local_graph_view_y.php";	break;
									case "day":
										include "./soaa_local_graph_view_m.php";	break;
									case "period":
										include "./soaa_local_graph_view_d.php";	break;
								}
							?>
								<span class="toptip_bold">구청별&nbsp;검사&nbsp;접수&nbsp;통계</span>
								<span class="con2_time">
									현재시간&nbsp;&#58;&nbsp;
									<?=date("Y")?>&#8211;
									<?=date("m")?>&#8211;
									<?=date("d")?>&nbsp;&nbsp;&nbsp;
									<?
									$ampm	=	date("H");
									if($ampm <=12){
										echo "오전";
									}else{
										echo "오후";
									}
									?>
									&nbsp;
									<?=date("g")?>&nbsp;&#58;&nbsp;
									<?=date("i")?>&nbsp;&#58;&nbsp;
									<?=date("s")?></span> 

								<?
									//총 건수와 합계
									include "./soaa_local_graph_cal_sum.php";
								?>
                                <div class="stats">
                                	<p class="stats_txt">총 <span class="c_red"><?=$rs['all_tot'];?></span>건&nbsp;&#47;&nbsp;<span class="c_red"><?=number_format($rs['all_sum'])?></span>원</p>
									<span class="f_right">
										<!--<input type="button" value="인쇄" id="submit_btn04" onclick="window.print()">-->
											<input type="button" value="인쇄" id="submit_btn04"  onclick="move_print_page('soaa_local_graph');">
										<input type="button" value="엑셀저장" id="submit_btn05" onclick="ExcelDown_2('soaa_local_graph_excel','<?=$excel_where?>');">
									</span>
								</div>
                            </div><!--con2_toptip-->
                            <div class="receive_table">
                            <table>
                            	<colgroup>
                                	<col width="85px">
                                    <col width="60px">
                                    <col width="132px">
                                    <col width="60px">
                                    <col width="132px">
                                    <col width="60px">
                                    <col width="132px">
                                    <col width="60px">
                                    <col width="132px">
                                    <col width="60px">
                                    <col width="132px">
                                    <col width="60px">
                                    <col width="132px">
                                    <col width="60px">
                                    <col width="138px">
                                </colgroup>
                                <tr>
                                    <th rowspan="2">구청</th>
                                    <th colspan="2">옥상간판</th>
                                    <th colspan="2">돌출간판</th>
                                    <th colspan="2">지주간판</th>
                                    <th colspan="2">가로형간판</th>
                                    <th colspan="2">현수막게시시설</th>
                                    <th colspan="2">기타안내</th>
                                    <th colspan="2">합계</th>
                                </tr>
                                <tr>
                                    <th>건수</th>
                                    <th>금액</th>
                                    <th>건수</th>
                                    <th>금액</th>
                                    <th>건수</th>
                                    <th>금액</th>
                                    <th>건수</th>
                                    <th>금액</th>
                                    <th>건수</th>
                                    <th>금액</th>
                                    <th>건수</th>
                                    <th>금액</th>
                                    <th>건수</th>
                                    <th>금액</th>
                                </tr>
								<?
									//구청별로 리스트 출력
									include "./soaa_local_graph_gu_office_list.php";

									//총계 출력
									include "./soaa_local_graph_cnt_sum_total.php";
								?>
                            </table>
                            </div><!--receive_table-->
                        </div><!--con2-->
                    </div><!--contain-->
                </div><!--contents_con-->
				</form>
            </section><!--contents-->
        </section><!--section-->
	</div><!--wrap-->
</body>
</html>

