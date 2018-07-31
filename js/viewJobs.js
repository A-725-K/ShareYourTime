"use strict";

/*
    questo file contiene tutte 
    le funzioni js utilizzate per
    gestire viewJobs
*/

/**
 * @description
 * questa funzione ci permette
 * di riempire il modalJobs in 
 * fase di modifica 
 */

function timeFunction(oldValue, idValue, idJob) 
{
	return function() {
		var value = document.getElementById(idValue).value;
	
		console.log('************** DEBUG *************');
		console.log('value = ' + value);
		console.log('oldValue = ' + oldValue);
		console.log('idValue = ' + idValue);
		console.log('************** DEBUG *************');

		if (oldValue !== value)
			checkTime('modalDateStart', 'modalTimeStart', 'modalDateEnd', 'modalTimeEnd', 'errTime', idJob);
	}
}

function fillModalFieldJobs(id)
{
    var num = id.split("_");
    document.getElementById('modalDescription').value =
        document.getElementById('cardDescription_' + num[1]).getAttribute('value');

    document.getElementById('modalCost').value =
        document.getElementById('cardCost_' + num[1]).getAttribute('value');
    
    var startDate = document.getElementById('cardTimeStart_' + num[1]).getAttribute('value').split(" ");
    document.getElementById('modalDateStart').value = startDate[0];
	document.getElementById('modalDateStart').addEventListener('focusout', timeFunction(startDate[0], 'modalDateStart', num[1]));

    var startTime = startDate[1].split(":");
    document.getElementById('modalTimeStart').value = startTime[0] + ":" + startTime[1];
    document.getElementById('modalTimeStart').addEventListener('focusout', timeFunction(startTime[0] + ":" + startTime[1], 'modalTimeStart', num[1]));

    var endDate = document.getElementById('cardTimeEnd_' + num[1]).getAttribute('value').split(" ");
    document.getElementById('modalDateEnd').value = endDate[0];
	document.getElementById('modalDateEnd').addEventListener('focusout', timeFunction(endDate[0], 'modalDateEnd', num[1]));

    var endTime = endDate[1].split(":")
    document.getElementById('modalTimeEnd').value = endTime[0] + ":" + endTime[1];
	document.getElementById('modalTimeEnd').addEventListener('focusout', timeFunction(endTime[0] + ":" + endTime[1], 'modalTimeEnd', num[1]));

    document.getElementById('modalDistance').value =
        document.getElementById('cardDistance_' + num[1]).getAttribute('value');
    document.getElementById('modalStreet').value =
        document.getElementById('cardStreet_' + num[1]).getAttribute('value');
  
	document.getElementById('optionModalTag').value =
		document.getElementById('cardTag_' + num[1]).getAttribute('value');

	//bottone all'interno del modal
	var button = document.getElementById('modButton');
	button.innerHTML = 'Salva modifiche';
}

/**
 * @description
 * questa funzione pulisce tutti
 * i campi del modal dei lavori
 */

function emptyModalJobs()
{
    document.getElementById('modalDescription').value = "";
    document.getElementById('modalCost').value = "";
    document.getElementById('modalDateStart').value = "";
    document.getElementById('modalTimeStart').value = "";
    document.getElementById('modalDateEnd').value = "";
    document.getElementById('modalTimeEnd').value = "";
    document.getElementById('modalDistance').value = "";
    document.getElementById('modalStreet').value = "";
	document.getElementById('optionModalTag').value = "";
	
	//bottone all'interno del modal
	var button = document.getElementById('modButton');
	button.innerHTML = 'Inserisci lavoro';
	
	document.getElementById('modalDateStart').addEventListener('focusout', timeFunction('', 'modalDateStart', null));
	document.getElementById('modalTimeStart').addEventListener('focusout', timeFunction('', 'modalTimeStart', null));
	document.getElementById('modalDateEnd').addEventListener('focusout', timeFunction('', 'modalDateEnd', null));
	document.getElementById('modalTimeEnd').addEventListener('focusout', timeFunction('', 'modalTimeEnd', null));
}

/*
 * @description
 * questa funzione abilita
 * l'autocompletamento degli
 * indirizzi delle api di google
 */

function initAddr() 
{	
	//Autocompletamento google maps per inserire indirizzi in fase di inserimento/modifica di un lavoro
	var addrJob = document.getElementById('modalStreet');
	var autocompleteJob = new google.maps.places.Autocomplete(addrJob, {types:['geocode']});
	google.maps.event.addListener(autocompleteJob, 'place_changed', function () {
                var place = autocompleteJob.getPlace();
                console.log(place.name);
                console.log('cityLat: ' + place.geometry.location.lat());
                console.log('cityLng: ' + place.geometry.location.lng());
				latitude = place.geometry.location.lat();
				longitude = place.geometry.location.lng();
    });
}

/**
 * @description
 * questa funzione pulisce tutti
 * i campi di errore nel modal 
 * dei lavori
 */

function emptyErrorModalJobs()
{
    document.getElementById('errModalDescription').innerHTML = "";
    document.getElementById('errModalCost').innerHTML = "";
    document.getElementById('errTime').innerHTML = "";
    document.getElementById('errModalDistance').innerHTML = "";
    document.getElementById('errModalStreet').innerHTML = "";
	document.getElementById('errModalTag').innerHTML = "";
}

function closeDialog(id) {
    $(id).modal('hide');
}