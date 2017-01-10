// TinyMCE + FileManager
(function(){
	var editor_config = {
	    path_absolute : "/",
	    selector: "#mytextarea",
	    plugins: [
	      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	      "searchreplace wordcount visualblocks visualchars code fullscreen",
	      "insertdatetime media nonbreaking save table contextmenu directionality",
	      "emoticons template paste textcolor colorpicker textpattern"
	    ],
	    menubar: true,
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
	    relative_urls: false,
	    file_browser_callback : function(field_name, url, type, win) {
	      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
	      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

	      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
	      if (type == 'image') {
	        cmsURL = cmsURL + "&type=Images";
	      } else {
	        cmsURL = cmsURL + "&type=Files";
	      }

	      tinyMCE.activeEditor.windowManager.open({
	        file : cmsURL,
	        title : 'Filemanager',
	        width : x * 0.8,
	        height : y * 0.8,
	        resizable : "yes",
	        close_previous : "no"
	      });
	    }
	  };

	  tinymce.init(editor_config);
}());

//Select Type Question 
(function(){

	var type_question 	= document.querySelector('#option_type'),
		contentQ		= $('#contentqo');
		// area_id 		= document.querySelector('#area_id'),
		// asignature_id 	= document.querySelector('#aignature_id');

	// Functions
	var builForm = function(evt){
		var option 		= evt.target.value,
			subcontent	= $('#subcontentqo');
			
		if(option == "text"){
			if(contentQ.children().length > 0)
				subcontent.remove();

			buildOptionForm();
		}else if(option == "image"){
			if(contentQ.children().length > 0)
				subcontent.remove();

				buildImageOptionForm();
		}else{
			if(contentQ.children().length > 0)
				subcontent.remove();
		}	
	}

	var buildOptionForm = function(){

		contentQ.append($('<div>',{id:'subcontentqo'}));
		for (var i = 0; i < 4; i++) {
				$('#subcontentqo').append(
					$('<div>',{'class': 'form-group content_option radio','id': 'question'+i}).append(
						$('<label class="label_option">Opción '+(i+1)+'</label>'),
						$('<input>',{'type': 'text', 'name':'option[]', 'class': 'form-control input_option'}),
						$('<input> ',{
							'name'	: 'value[]',
							'type'	: 'radio',
							'id'	: 'option'+(i+1),
							'value' : i
						}),
						$('<label for="option'+(i+1)+'" class="radio_label" >Verdadero</label>')
					)
				)
		}

	}
	var buildImageOptionForm = function(){
		contentQ.append($('<div>',{id:'subcontentqo'}));
		for (var i = 0; i < 4; i++) {
				$('#subcontentqo').append(
					$('<div>',{'class': 'form-group content_option radio','id': 'question'+i}).append(
						$('<label class="label_option">Opción '+(i+1)+'</label>'),
						$('<input>',{'type': 'file', 'name':'option[]', 'class': 'form-control input_option'}),
						$('<input> ',{
							'name'	: 'value[]',
							'type'	: 'radio',
							'id'	: 'option'+(i+1),
							'value' : i
						}),
						$('<label for="option'+(i+1)+'" class="radio_label" >Verdadero</label>')
					)
				)
		}
	}
		 

	// Listeners
	type_question.addEventListener('change', builForm, false);
}());

// Load change area
$('#area_id').change(function(e){

	// console.log(e.target.value);
	if(e.target.value != ''){
		$.get('/ajax/'+e.target.value+'/getAsignatures', function(resp, state){
	
			var asignature = $('#asignature_id');

			asignature.empty();

			asignature.append('<option>Seleccione una asignatura</option>')
			for (var i = 0; i < resp.length; i++) {
				asignature.append(
					'<option value="'+resp[i].id+'">'+resp[i].name+'</option>'
				)
			}
		});

		$.get('/ajax/'+e.target.value+'/getCompetences', function(resp, state){
				
			var selectCompetence = $('#competence_id');
				selectCompetence.empty();
				selectCompetence.append('<option>Seleccione una competencia</option>')
				for (var i = 0; i < resp.length; i++) {
					selectCompetence.append(
						'<option value="'+resp[i].id+'">'+resp[i].name+'</option>'
					)
				}
		});
	}
});
// 