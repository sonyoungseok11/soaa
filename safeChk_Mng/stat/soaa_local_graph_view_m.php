<input type="hidden" name="gubun" value="day">

<select class="con2_year" name="select_y">
<? for($i=$start_y; $i<=$now_y; $i++){ ?>
	<option value="<?=$i?>" <? if($i==$select_y){ echo "selected=selected"; }?>><?=$i?></option>
<? } ?>
</select>년

<select class="con2_month" name="select_m" onchange="search_stats_m('<?=$this_page[0];?>', this.value);">>
<? for($i=1; $i<=12; $i++){
		if($i<=9){
			$i="0" . $i;
		}
	?>
	<option value="<?=$i?>" <? if($i==$select_m){ echo "selected=selected"; }?>><?=$i?></option>
<? } ?>
</select>월