"use strict";

/*
*	Questa funzione ci permette di creare 
*	una richiesta in post per controllare
*	ogni singolo campo che l'utente ha inserito.  
*/

function checkRegistrationSingleField(idField,idErrField,checkField)
{
	var request = getRequest();
	request.open("POST", "modalRegistrazione-Login/checkRegistrationSingleField.php", true);	
	request.onreadystatechange = validateCheckRegistrationSingleField(idErrField, request);
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var htmlTag = document.getElementById(idField);
	if(checkField==null)
		request.send(htmlTag.name + "=" + htmlTag.value);
	else{
		var htmlTag1 = document.getElementById(checkField);

		request.send(htmlTag.name + "=" + htmlTag.value + '&_' + 
						htmlTag1.name+"=" + htmlTag1.value);
	}
}

/*
*	Questa callback ci permette di
*	informare l'utente sull'esito
*	dei controlli fatti
*/

function validateCheckRegistrationSingleField(idErrField, request)
{
	return function(){
		if (request.readyState === 4 && request.status === 200) {
			if (request.responseText != null) {
				var jsonObj = JSON.parse(request.responseText);
				var notify = document.getElementById(idErrField);
				notify.style.fontSize = '0.9em';
				if (jsonObj['code'] === -1) {
					notify.style.color = 'darkred';
					notify.innerHTML = jsonObj['msg'];
				} else {
					if(jsonObj['code'] === 0){
						notify.style.color = 'green';
					}else{
						return;
					}
						
				}
				
			}
		}
	}
}
