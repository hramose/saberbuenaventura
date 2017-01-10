(function(){
	$(".question").each(function(ind, ele){
		$(this).attr('id', 'question_'+(ind+1));
	});
}());

$(".question").first().removeClass('hidden');

(function(){
	
	if($('.check').length > 0){
		var anwser = '';
		
		$('.check').each(function(){
			anwser += $(this).attr('data-info')+';';
		});

		$('#anwser').val(anwser.slice(0,-1));
	}

	$('.uncheck').click(function(){

		var id = $(this).attr('id'),
			anwser = '';

		$('[id*='+ id +']').removeClass('check').addClass('uncheck');
		$(this).removeClass('uncheck').addClass('check');

		$('.check').each(function(){
			anwser += $(this).attr('data-info')+';';
		});

		$('#anwser').val(anwser.slice(0,-1));
	});

}());

(function(){
	$('#sendtest').click(function(){
		$('#formTest').submit();
	});
}())