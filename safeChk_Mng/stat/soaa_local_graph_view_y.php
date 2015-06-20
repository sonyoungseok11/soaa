<input type="hidden" name="gubun" value="month">

<select class="con2_year" name="select_y" onchange="search_stats_y('<?=$this_page[0];?>', this.value);">
<? for($i=$start_y; $i<=$now_y; $i++){ ?>
	<option value="<?=$i?>" <? if($i==$select_y){ echo "selected=selected"; }?>><?=$i?></option>
<? } ?>
</select>년