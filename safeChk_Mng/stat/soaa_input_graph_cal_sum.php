<?
//	$sql = "select
//
//				ifnull(sum(case when payment_state='PC' then 1 else 0 end),0) pc_cnt,
// 				ifnull(sum(if(payment_state='PC', chk_pay, 0)),0) pc_sum
//
//			from soaa_reg_check
//			where" . $where;
	$sql = "select
				count(*) as pc_cnt,
				ifnull(sum(if(idx <> '', chk_pay, 0)),0) pc_sum
			from giro_list";

	

	if($where){
		$sql .= " where " . $where;
	}

		$result	=	mysql_query($sql);
		$rs		=	mysql_fetch_array($result);
?>