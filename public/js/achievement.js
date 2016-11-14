$('#area_id').change(function(e){
	$.get('/ajax/'+e.target.value+'/getCompetences', function(resp, state){
		
		var selectCompetence = $('#competence_id');

		selectCompetence.empty();

		for (var i = 0; i < resp.length; i++) {
			selectCompetence.append(
				'<option value="'+resp[i].id+'">'+resp[i].name+'</option>'
			)
		}
	});
});

window.addEventListener('load', init);

function init(){
	document.querySelector('.btnAchievement').addEventListener('click', ClickAchievement, false);
}

function ClickAchievement(evt){
	
	var prefix_id = {
		input 	: 'name_',
		tag_icon: 'n_'
	},

	classes = {
		add 	: 'addAchievement',
		delete 	: 'deleteAchievement'
	},

	action	 		= $(this).attr('data-action'),

	div_container 	= $('#achievements'),
	div_form_group	= $(this).parent().parent().parent(),

	button 	 		= $(this),
	input 	 		= $(this).parent().prev(),
	tag_icon 		= $(this).find('i'),
	old_id 	 		= parseInt(input.attr('id').replace('name_',''));

	if(action === classes.add){

		if(old_id == 1 && button.attr('data-action') == classes.add){
			button.attr('data-action','');
			button.addClass('disabled');
		}

		btnAdd = $('<button>', {
					class: 'btn btn-success btnAchievemen',
					type: 'button',
					id:prefix_id.tag_icon + (old_id+1),"data-action": classes.add
				});
		btnDel = $('<button>', {
					class: 'btn btn-danger btnAchievemen',
					type: 'button',
					id:prefix_id.tag_icon + (old_id+1),"data-action": classes.delete
				});

		btnAdd.click(ClickAchievement);
		btnDel.click(ClickAchievement);

		new_div = 	$('<div>', {class: 'form-group'}).append(
						$('<div>',{class: 'input-group'}).append(
							$('<input>',{type: 'text',name: 'name[]',class: 'form-control', id: prefix_id.input + (old_id+1), placeholder: 'nombre del logro'}),
							$('<div>', {class: 'input-group-btn'}).append(
								btnAdd.append($('<i>',{class: 'fa fa-plus'})),
								btnDel.append($('<i>',{class: 'fa fa-minus'}))
							)
						)
				  	);

		div_container.append(new_div);
	}else if(action === classes.delete){
		
		div_form_group.remove();

		if(div_container.children().length == 1){
			btnDefault = $('#n_1');
			btnDefault.removeClass('disabled');
			btnDefault.attr('data-action', classes.add);
		}
	}
}