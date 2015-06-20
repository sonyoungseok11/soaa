<?
	$sql = "select

			ifnull(sum(case when gu_office <> '' and outdoor_act_cate <> '' then 1 else 0 end),0) all_tot,
			ifnull(sum(if(gu_office <> ''and outdoor_act_cate <> '' , chk_pay, 0)),0) all_sum

		from soaa_reg_check
		where gu_office <> ''" . $where;

	$result	=	mysql_query($sql);
	$rs		=	mysql_fetch_array($result);
?>