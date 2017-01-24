(function(){

    document.getElementById('certificate_form').onsubmit = function(evt){

	    console.log(evt.target.elements[2].value);
	    $.get('/ajax/getCertificates&number_document='+evt.target.elements[2].value+'&type_document='+evt.target.elements[1].value, function(resp, state){
	    	console.log(resp);
	    	console.log(state)

	    	$('#table_container').empty().append(resp.view);
	   	});

        return false;
    }
}())