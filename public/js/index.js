(function(){
    var selectprofile = document.getElementById('profile'),
    	form_login 		= document.getElementById('login_form'),
    	url				= form_login.getAttribute('action');

    var setMethod = function(evt){
    	form_login.setAttribute('action', url+'/login/'+evt.target.value);
    }

    form_login.onsubmit = function(){

    	if(!selectprofile.value){
    		console.log('valor'+selectprofile.value+'valor');
			document.getElementById('error_message').innerHTML = "Seleccione un perfil";
    		return false;    		
    	}
    	return true;

    }

    selectprofile.addEventListener('change', setMethod, false);

}());