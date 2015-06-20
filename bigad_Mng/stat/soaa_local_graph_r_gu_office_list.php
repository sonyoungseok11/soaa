<?
	$result	=	fn_select("en_nm, ko_nm", "common_selectbox", "code='10' order by order_idx");
	while($rs = mysql_fetch_array($result)){
		$gu_office	=	$rs['en_nm'];	
		$sql = "select

					ifnull(sum(case when outdoor_act_cate='oksang' then 1 else 0 end),0) oksang_cnt,
					ifnull(sum(if(outdoor_act_cate='oksang', chk_pay, 0)),0) oksang_sum,

					ifnull(sum(case when outdoor_act_cate='dolchul' then 1 else 0 end),0) dolchul_cnt,
					ifnull(sum(if(outdoor_act_cate='dolchul', chk_pay, 0)),0) dolchul_sum,

					ifnull(sum(case when outdoor_act_cate='jiju' then 1 else 0 end),0) jiju_cnt,
					ifnull(sum(if(outdoor_act_cate='jiju', chk_pay, 0)),0) jiju_sum,

					ifnull(sum(case when outdoor_act_cate='garo' then 1 else 0 end),0) garo_cnt,
					ifnull(sum(if(outdoor_act_cate='garo', chk_pay, 0)),0) garo_sum,

					ifnull(sum(case when outdoor_act_cate='hyunsugesi' then 1 else 0 end),0) hyunsugesi_cnt,
					ifnull(sum(if(outdoor_act_cate='hyunsugesi', chk_pay, 0)),0) hyunsugesi_sum,

					ifnull(sum(case when outdoor_act_cate not in('oksang','dolchul','jiju','garo','hyunsugesi') then 1 else 0 end),0) etc_cnt,
					ifnull(sum(if(outdoor_act_cate not in('oksang','dolchul','jiju','garo','hyunsugesi'), chk_pay, 0)),0) etc_sum,

					ifnull(sum(case when outdoor_act_cate <> '' then 1 else 0 end),0) gu_cnt,
					ifnull(sum(if(outdoor_act_cate <> '', chk_pay, 0)),0) gu_sum

				from bigad_SoaaRegCheck
				where gu_office='$gu_office'" . $where;

		$resultt	=	mysql_query($sql);
		while($rss	=	mysql_fetch_array($resultt)){
?>
				<tr>
					<td class="guchung"><?=$rs['ko_nm']?></td><!--구청-->

					<td class="case"><?=$rss['oksang_cnt']?></td><!--건수-->
					<td class="sum"><?=number_format($rss['oksang_sum'])?><span class="bold">원</span></td><!--금액-->

					<td class="case"><?=$rss['dolchul_cnt']?></td>
					<td class="sum"><?=number_format($rss['dolchul_sum'])?><span class="bold">원</span></td>

					<td class="case"><?=$rss['jiju_cnt']?></td>
					<td class="sum"><?=number_format($rss['jiju_sum'])?><span class="bold">원</span></td>

					<td class="case"><?=$rss['garo_cnt']?></td>
					<td class="sum"><?=number_format($rss['garo_sum'])?><span class="bold">원</span></td>

					<td class="case"><?=$rss['hyunsugesi_cnt']?></td>
					<td class="sum"><?=number_format($rss['hyunsugesi_sum'])?><span class="bold">원</span></td>

					<td class="case"><?=$rss['etc_cnt']?></td>
					<td class="sum"><?=number_format($rss['etc_sum'])?><span class="bold">원</span></td>

					<td class="case"><?=$rss['gu_cnt']?></td>
					<td class="sum"><?=number_format($rss['gu_sum'])?><span class="bold">원</span></td>
				</tr>
<?
		}
	}
?>