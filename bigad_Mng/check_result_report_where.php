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
		if($gu_office <> ""){
			if($where <> ""){
				$where .= " and gu_office='$gu_office'";
			}else{
				$where .= " gu_office='$gu_office'";
			}
		}
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
		if($outdoor_act_cate <> ""){
			if($where <> ""){
				$where .= " and outdoor_act_cate='$outdoor_act_cate'";
			}else{
				$where .= " outdoor_act_cate='$outdoor_act_cate'";
			}
		}
		if($chk_paytype <> ""){
			if($where <> ""){
				$where .= " and chk_paytype='$chk_paytype'";
			}else{
				$where .= " chk_paytype='$chk_paytype'";
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
		if($chk_person <> ""){
			if($where <> ""){
				$where .= " and chk_personA='$chk_person' or chk_personB='$chk_person'";
			}else{
				$where .= " chk_personA='$chk_person' or chk_personB='$chk_person'";
			}
		}
?>