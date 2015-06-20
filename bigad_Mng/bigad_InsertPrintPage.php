<?php
$rs_Prn	=	fn_insert(
				"
				reg_no,
				one_one_result, 
				one_one_etc, 
				one_two_result, 
				one_two_etc, 
				one_three_result, 
				one_three_etc, 

				two_one_result, 
				two_one_etc, 
				two_two_result, 
				two_two_etc, 
				two_three_result, 
				two_three_etc, 
				two_four_result, 
				two_four_etc,


				three_one_result, 
				three_one_etc, 
				three_two_result, 
				three_two_etc, 
				three_three_result, 
				three_three_etc, 
				three_four_result, 
				three_four_etc, 
				three_five_result, 
				three_five_etc, 
				three_six_result, 
				three_six_etc, 
				three_seven_result, 
				three_seven_etc, 

				four_one_result, 
				four_one_etc, 
				four_two_result, 
				four_two_etc, 

				five_one_result, 
				five_one_etc, 
				five_two_result, 
				five_two_etc, 
				five_three_result, 
				five_three_etc",

				"
				'$reg_no',
				'$one_one_result', 
				'$one_one_etc', 
				'$one_two_result', 
				'$one_two_etc', 
				'$one_three_result', 
				'$one_three_etc', 

				'$two_one_result', 
				'$two_one_etc', 
				'$two_two_result', 
				'$two_two_etc', 
				'$two_three_result', 
				'$two_three_etc', 
				'$two_four_result', 
				'$two_four_etc',

				'$three_one_result', 
				'$three_one_etc', 
				'$three_two_result', 
				'$three_two_etc', 
				'$three_three_result', 
				'$three_three_etc', 
				'$three_four_result', 
				'$three_four_etc', 
				'$three_five_result', 
				'$three_five_etc', 
				'$three_six_result', 
				'$three_six_etc', 
				'$three_seven_result', 
				'$three_seven_etc', 

				'$four_one_result', 
				'$four_one_etc', 
				'$four_two_result', 
				'$four_two_etc', 

				'$five_one_result', 
				'$five_one_etc', 
				'$five_two_result', 
				'$five_two_etc', 
				'$five_three_result', 
				'$five_three_etc'
				",

				"bigad_PrintPage"
			);
?>