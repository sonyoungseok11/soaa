<?

//	$outdoor_act_cate	=	array("oksang", "dolchul",  'jiju', 'garo', 'hyunsugesi');

	$sql = "select

				ifnull(sum(case when gu_office <> '' and outdoor_act_cate = 'oksang' then 1 else 0 end),0) oksang_tot,
				ifnull(sum(if(gu_office <> ''and outdoor_act_cate = 'oksang', chk_pay, 0)),0) oksang_sum,

				ifnull(sum(case when gu_office <> '' and outdoor_act_cate = 'dolchul' then 1 else 0 end),0) dolchul_tot,
				ifnull(sum(if(gu_office <> ''and outdoor_act_cate = 'dolchul', chk_pay, 0)),0) dolchul_sum,

				ifnull(sum(case when gu_office <> '' and outdoor_act_cate = 'jiju' then 1 else 0 end),0) jiju_tot,
				ifnull(sum(if(gu_office <> ''and outdoor_act_cate = 'jiju', chk_pay, 0)),0) jiju_sum,
				 
				ifnull(sum(case when gu_office <> '' and outdoor_act_cate = 'garo' then 1 else 0 end),0) garo_tot,
				ifnull(sum(if(gu_office <> ''and outdoor_act_cate = 'garo', chk_pay, 0)),0) garo_sum,

				ifnull(sum(case when gu_office <> '' and outdoor_act_cate = 'hyunsugesi' then 1 else 0 end),0) hyunsugesi_tot,
				ifnull(sum(if(gu_office <> ''and outdoor_act_cate = 'hyunsugesi', chk_pay, 0)),0) hyunsugesi_sum,

				ifnull(sum(case when outdoor_act_cate not in('oksang','dolchul','jiju','garo','hyunsugesi') then 1 else 0 end),0) etc_cnt,
				ifnull(sum(if(outdoor_act_cate not in('oksang','dolchul','jiju','garo','hyunsugesi'), chk_pay, 0)),0) etc_sum,

				ifnull(sum(case when gu_office <> '' and outdoor_act_cate <> '' then 1 else 0 end),0) all_tot,
				ifnull(sum(if(gu_office <> ''and outdoor_act_cate <> '' , chk_pay, 0)),0) all_sum

			from soaa_reg_check
			where gu_office <> ''" . $where;

		$result	=	mysql_query($sql);
		while($rs	=	mysql_fetch_array($result)){
		
?>
			<tr>
				<td class="guchung">총계</td>
				<td class="case"><?=number_format($rs['oksang_tot']);?></td>
				<td class="sum"><?=number_format($rs['oksang_sum']);?><span class="bold">원</span></td>

				<td class="case"><?=number_format($rs['dolchul_tot']);?></td>
				<td class="sum"><?=number_format($rs['dolchul_sum']);?><span class="bold">원</span></td>

				<td class="case"><?=number_format($rs['jiju_tot']);?></td>
				<td class="sum"><?=number_format($rs['jiju_sum']);?><span class="bold">원</span></td>

				<td class="case"><?=number_format($rs['garo_tot']);?></td>
				<td class="sum"><?=number_format($rs['garo_sum']);?><span class="bold">원</span></td>

				<td class="case"><?=number_format($rs['hyunsugesi_tot']);?></td>
				<td class="sum"><?=number_format($rs['hyunsugesi_sum']);?><span class="bold">원</span></td>

				<td class="case"><?=number_format($rs['etc_cnt']);?></td>
				<td class="sum"><?=number_format($rs['etc_sum']);?><span class="bold">원</span></td>

				<td class="case"><?=number_format($rs['all_tot']);?></td>
				<td class="sum"><?=number_format($rs['all_sum']);?><span class="bold">원</span></td>
			</tr>
<?
		}
?>
