<?
	$sql = "select

			ifnull(sum(case when gu_office <> '' and chk_pay <> '' then 1 else 0 end),0) tot_cnt,
			ifnull(sum(if(gu_office <> ''and chk_pay <> '' , chk_pay, 0)),0) tot_sum

		from confirm_list";

	if($where){
		$sql .= " where " . $where;
	}

	$result	=	mysql_query($sql);
	$rs		=	mysql_fetch_array($result);

?>