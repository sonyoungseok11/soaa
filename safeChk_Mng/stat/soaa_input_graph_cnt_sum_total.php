<?

//	$outdoor_act_cate	=	array("oksang", "dolchul",  'jiju', 'garo', 'hyunsugesi');

	$sql = "select

				ifnull(sum(case when chk_pay <> '' then 1 else 0 end),0) pc_TotCnt,
 				ifnull(sum(if(chk_pay <> '', chk_pay, 0)),0) pc_TotSum
				
			from giro_list
			where" . $where . " and gu_office <> ''";

	$result	=	mysql_query($sql);
	while($rs	=	mysql_fetch_array($result)){

		$pc_TotCnt	=	$rs['pc_TotCnt'];
		$pc_TotSum	=	$rs['pc_TotSum'];
	
?>
		<tr>
			<td class="guchung">총계</td>
			<td class="case"><?=number_format($pc_TotCnt);?></td>
			<td class="sum"><?=number_format($pc_TotSum);?><span class="bold">원</span></td>
<?
	}	
	$sql = "select

				ifnull(sum(case when rf_payment <> '' then 1 else 0 end),0) rf_TotCnt, 
				ifnull(sum(if( rf_payment <> '', chk_pay, 0)),0) rf_TotSum

			from return_list
			where" . $where . " and gu_office <> ''";

	$result	=	mysql_query($sql);
	while($rs	=	mysql_fetch_array($result)){

		$rf_TotCnt	=	$rs['rf_TotCnt'];
		$rf_TotSum	=	$rs['rf_TotSum'];

		if($pc_TotCnt - $rf_TotCnt > 0){
				$tot_cnt = $pc_TotCnt - $rf_TotCnt;
				$tot_sum = $pc_TotSum - $rf_TotSum;
			}else{
				$tot_cnt = -($rf_TotCnt - $pc_TotCnt);
				$tot_sum = -($rf_TotSum- $pc_TotSum);
			}
?>
			<td class="case"><?=number_format($rf_TotCnt)?></td>
			<td class="sum"><?=number_format($rf_TotSum)?><span class="bold">원</span>
			</td>

			<td class="case"><?=number_format($tot_cnt)?></td>
			<td class="sum"><?=number_format($tot_sum)?><span class="bold">원</span></td>

<?
	}
?>




		</tr>