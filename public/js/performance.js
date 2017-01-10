// TinyMCE
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
	    menubar: false,
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
	    relative_urls: false,
	  };

	  tinymce.init(editor_config);
}());


// Load change area
$('#grade').change(function(e){

	if(e.target.value != ''){
		$.get('/ajax/'+e.target.value+'/getArea', function(resp, state){
	
			var area = $('#area_id');

			area.empty();

			area.append('<option>Seleccione un area</option>')
			for (var i = 0; i < resp.length; i++) {
				area.append(
					'<option value="'+resp[i].id+'">'+resp[i].name+'</option>'
				)
			}
		});
	}
});