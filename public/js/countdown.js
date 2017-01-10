var currentDate, tagetDate, timeDif;
	
currentDate = Math.floor(new Date().getTime()/1000);

init(targetD, id_pre);

function init(targetD, id_preicfes){
	var days, hours, minutes, seconds;

	targetDate = targetD;
	timeDif = targetDate - currentDate;

	function updateTime(){
		seconds = timeDif;
				
		days = Math.floor(seconds/86400);
		seconds -= days * 86400;

		hours = Math.floor(seconds/3600);
		seconds -=hours * 3600;

		minutes = Math.floor(seconds/60);
		seconds -=minutes*60;

		seconds = Math.floor(seconds);
	}

	function tick(){
		clearTimeout(timer);
		updateTime();
		displayTime();

		if(timeDif>0){
			timeDif--;
			timer = setTimeout(tick, 1*1000);
		}else{
			$('#countdown').html("Listo");
			$.get('/ajax/changeStatus&change=finalizado&preicfes='+id_preicfes, function(resp, state){
				
				if(state == "success"){
					$('#formTest').submit();
				}
				console.log(resp);
				console.log(state);
			});
		}
	}

	function displayTime(){
		var out = "<b>"+days+" dias "+hours+" horas "+minutes+" minutos "+seconds+" segundos </b>";
		$('#countdown').html(out);
		
	}

	var timer = setTimeout(tick, 1*1000);
}