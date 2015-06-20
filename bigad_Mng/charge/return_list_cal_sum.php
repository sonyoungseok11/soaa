<?
	if($where){
//		$where .= " and payment_state = 'RF' and gu_office <> ''";
		$where .= " and idx <> ''";
	}else{
		$where = " idx <> ''";
	}

	$sql = "select

			ifnull(sum(case when gu_office <> '' then 1 else 0 end),0) tot_cnt,
			ifnull(sum(if(gu_office <> '', chk_pay, 0)),0) tot_sum
		from return_list
		where " .$where;

	$result	=	mysql_query($sql);
	$rs		=	mysql_fetch_array($result);

?>