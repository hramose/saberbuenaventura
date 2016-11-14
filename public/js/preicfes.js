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

$('.area_id').chosen();