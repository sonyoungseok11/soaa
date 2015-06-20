<?
	//기간선택 월이 1~9월 사이면 01월 으로 변경.
	if(strlen($select_gigan_m) == 1){
		$select_gigan_m = "0" . $select_gigan_m;
	}

	//기간선택 년도만 할경우
	if($select_gigan_y <> ""){
		$gigan = $select_gigan_y;
		$where = " date_format(reg_date, '%Y') between '$gigan' and '$gigan'";
	}

	//기간선택 년+월을 할경우.. (년도는 선택했다고 가정)
	if($select_gigan_m <> ""){
		$gigan .= "-" . $select_gigan_m;
		$where = " date_format(reg_date, '%Y-%m') between '$gigan' and '$gigan'";
	}

	$today = date("m") . "-" . date("d");
	if($st_date <> "" && $ed_date == ""){
		if($where){
			$where .= " and reg_date between '$st_date' and '$today";
		}else{
			$where .= " reg_date between '$st_date' and '$today";
		}
	}

	if($st_date <> "" && $ed_date <> ""){
		if($where){
			$where .= " and reg_date between '$st_date' and '$ed_date'";
		}else{
			$where .= " reg_date between '$st_date' and '$ed_date'";
		}
	}

	if($gu_office <> ""){
//		$Print_where .= ",'$gu_office'";
		if($where <> ""){
			$where .= " and gu_office='$gu_office'";
		}else{
			$where .= " gu_office='$gu_office'";
		}
	}
	if($c_corp_nm <> ""){
//		$Print_where .= ",'$c_corp_nm'";
		if($where <> ""){
			$where .= " and c_corp_nm like '%$c_corp_nm%'";
		}else{
			$where .= " c_corp_nm like '%$c_corp_nm%'";
		}
	}
	if($c_ceo_nm <> ""){
//		$Print_where .= ",'$c_ceo_nm'";
		if($where <> ""){
			$where .= " and c_ceo_nm like '%$c_ceo_nm%'";
		}else{
			$where .= " c_ceo_nm like '%" . $c_ceo_nm . "%'";
		}
	}

	if($rega_no <> ""){
		if($where <> ""){
			$where .= " and reg_no like '%$rega_no%'";
		}else{
			$where .= " reg_no like '%$rega_no%'";
		}
	}
	if($chk_personA <> ""){
		if($where <> ""){
			$where .= " and chk_personA like '%$chk_personA%'";
		}else{
			$where .= " chk_personA like '%$chk_personA%'";
		}
	}

	if($outdoor_act_cate <> ""){
		if($where <> ""){
			$where .= " and outdoor_act_cate='$outdoor_act_cate'";
		}else{
			$where .= " outdoor_act_cate='$outdoor_act_cate'";
		}
	}

	if($payment_state <> ""){
		if($where <> ""){
			$where .= " and payment_state='$payment_state'";
		}else{
			$where .= " payment_state='$payment_state'";
		}
	}
	
	if($report_certi <> ""){
		if($where <> ""){
			$where .= " and report_certi='$report_certi'";
		}else{
			$where .= " report_certi='$report_certi'";
		}
	}
	if($chk_result <> ""){
		if($where <> ""){
			$where .= " and chk_result='$chk_result'";
		}else{
			$where .= " chk_result='$chk_result'";
		}
	}

	if($outdoor_real_addr <> ""){
		if($where <> ""){
			$where .= " and outdoor_real_addr like '%$outdoor_real_addr%'";
		}else{
			$where .= " outdoor_real_addr like '%$outdoor_real_addr%'";
		}
	}
?>