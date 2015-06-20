$(document).ready(function(){
	$('a').focus(function(e) {
        $(this).blur();
    });

	$(".listColorChange").mouseover(function(){
		$('td', this).css({ 'background-color' : '#ffecf4' });
	});
	$(".listColorChange").mouseout(function(){
		$('td', this).css({ 'background-color' : '#ffffff' });
	});
});