<?
	$result	=	fn_select("en_nm, ko_nm", "common_selectbox", "code='10' order by order_idx");
	while($rs = mysql_fetch_array($result)){
		$gu_office	=	$rs['en_nm'];	
?>
	 <tr>
		<td class="guchung"><?=$rs['ko_nm']?></td><!--구청-->
<?
		$sql = "select

					ifnull(sum(case when chk_pay <> '' then 1 else 0 end),0) pc_cnt, 
					ifnull(sum(if( chk_pay <> '', chk_pay, 0)),0) pc_sum

				from giro_list
				where" . $where . " and gu_office='$gu_office'";

		$resultt	=	mysql_query($sql);
		while($giro	=	mysql_fetch_array($resultt)){
			$pc_cnt	=	$giro['pc_cnt'];
			$pc_sum	=	$giro['pc_sum'];
?>
		<td class="case"><?=$giro['pc_cnt']?></td><!--입금금액건수-->
		<td class="sum"><?=number_format($giro['pc_sum'])?><span class="bold">원</span></td><!--입금금액-->
<?
		}
		$sql = "select

					ifnull(sum(case when rf_payment <> '' then 1 else 0 end),0) rf_cnt, 
					ifnull(sum(if( rf_payment <> '', chk_pay, 0)),0) rf_sum

				from return_list
				where" . $where . " and gu_office='$gu_office'";
		$resultt	=	mysql_query($sql);
		while($return	=	mysql_fetch_array($resultt)){

			$rf_cnt = $return['rf_cnt'];
			$rf_sum = $return['rf_sum'];

			if($pc_cnt - $rf_cnt > 0){
				$tot_cnt = $pc_cnt - $rf_cnt;
				$tot_sum = $pc_sum - $rf_sum;
			}else{
				$tot_cnt = -($rf_cnt - $pc_cnt);
				$tot_sum = -($rf_sum- $pc_sum);
			}
			?>
		<!--환불금액-->
		<td class="case"><?=$return['rf_cnt']?></td>
		<td class="sum"><?=number_format($rf_sum);?><span class="bold">원</span>
		</td>
		<!--환불금액E-->

		<!-- 합계-->
		<td class="case"><?=$tot_cnt?></td>
		<td class="sum"><?=number_format($tot_sum)?><span class="bold">원</span></td>
		<!-- 합계-->
<?
		}

	}
?>
	</tr>