<?
		if($st_date <> ""){
			$where .= " reg_date >= '$st_date'";
		}
		if($ed_date <> ""){
			if($where <> ""){
				$where .= " and reg_date <= '$ed_date'";
			}else{
				$where .= " reg_date <= '$ed_date'";
			}
		}

		//입금,수수료관리->입금입력목록S
			//납입일자
		if($st_date1 && $st_date2){
			if($where <> ""){
				$where .= " and input_payment_date between '$st_date1' and '$st_date2'";
			}else{
				$where .= " input_payment_date between '$st_date1' and '$st_date2'";
			}
		}

			//등록일자
		if($ed_date1 && $ed_date2){
			if($where <> ""){
				$where .= " and reg_date between '$ed_date1' and '$ed_date2'";
			}else{
				$where .= " reg_date between '$ed_date1' and '$ed_date2'";
			}
		}	//연락처
		if($c_tel){
			if($where <> ""){
				$where .= " and c_tel like '%$c_tel%'";
			}else{
				$where .= " c_tel like '%$c_tel%'";
			}
		}

		//입금,수수료관리->입금입력목록E

		if($gu_office <> ""){
			if($where <> ""){
				$where .= " and gu_office='$gu_office'";
			}else{
				$where .= " gu_office='$gu_office'";
			}
		}

		//확인리스트
		if($input_pay_type <> ""){
			if($where <> ""){
				$where .= " and input_pay_type='$input_pay_type'";
			}else{
				$where .= " input_pay_type='$input_pay_type'";
			}
		}
		//확인리스트E


		if($c_corp_nm <> ""){
			if($where <> ""){
				$where .= " and c_corp_nm like '%$c_corp_nm%'";
			}else{
				$where .= " c_corp_nm like '%$c_corp_nm%'";
			}
		}
		if($c_ceo_nm <> ""){
			if($where <> ""){
				$where .= " and c_ceo_nm like '%$c_ceo_nm%'";
			}else{
				$where .= " c_ceo_nm like '%$c_ceo_nm%'";
			}
		}
		if($reg_no <> ""){
			if($where <> ""){
				$where .= " and reg_no like '%$reg_no%'";
			}else{
				$where .= " reg_no like '%$reg_no%'";
			}
		}

		if($outdoor_real_addr <> ""){
			if($where <> ""){
				$where .= " and outdoor_real_addr like '%$outdoor_real_addr%'";
			}else{
				$where .= " outdoor_real_addr like '%$outdoor_real_addr%'";
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
?>