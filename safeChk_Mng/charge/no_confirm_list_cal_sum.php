<?
	if($where){
		$where .= " and gu_office <> ''";
	}else{
		$where_1 = " idx <> ''";
	}

	$sql = "select

			ifnull(sum(case when gu_office <> '' and idx <> '' then 1 else 0 end),0) tot_cnt,
			ifnull(sum(if(gu_office <> ''and idx <> '' , chk_pay, 0)),0) tot_sum

		from no_confirm_list
		where " .$where . $where_1;

	$result	=	mysql_query($sql);
	$rs		=	mysql_fetch_array($result);

?>