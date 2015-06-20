<input type="hidden" name="gubun" value="period">

<select class="con2_year" name="select_y">
<? for($i=$start_y; $i<=$now_y; $i++){ ?>
	<option value="<?=$i?>" <? if($i==$select_y){ echo "selected=selected"; }?>><?=$i?></option>
<? } ?>
</select>년

<select class="con2_month" name="select_m">
<?
	for($i=1; $i<=12; $i++){
		if($i<=9){
			$i="0" . $i;
		}
?>
	<option value="<?=$i?>" <? if($i==$select_m){ echo "selected=selected"; }?>><?=$i?></option>
<? } ?>
</select>월

<select class="con2_day" name="select_d">
<? 
	for($i=1; $i<=31; $i++){
		if($i<=9){
			$i="0" . $i;
		}
?>
	<option value="<?=$i?>" <? if($i==$select_d){ echo "selected=selected"; }?>><?=$i?></option>
<? } ?>
</select><span class="mar_r">일</span>&#126;




<select class="con2_year" name="select_yy">
<? for($i=$start_y; $i<=$now_y; $i++){ ?>
	<option value="<?=$i?>" <? if($i==$select_y){ echo "selected=selected"; }?>><?=$i?></option>
<? } ?>
</select>년
<select class="con2_month" name="select_mm">
<?
	for($i=1; $i<=12; $i++){
		if($i<=9){
			$i="0" . $i;
		}
?>
	<option value="<?=$i?>" <? if($i==$select_mm){ echo "selected=selected"; }?>><?=$i?></option>
<? } ?>
</select>월
<select class="con2_day" name="select_dd"  onchange="search_stats_d('<?=$this_page[0];?>');">
<?
	for($i=1; $i<=31; $i++){
		if($i<=9){
			$i="0" . $i;
		}
?>
	<option value="<?=$i?>" <? if($i==$select_dd){ echo "selected=selected"; }?>><?=$i?></option>
<? } ?>
</select><span class="mar_r">일</span>