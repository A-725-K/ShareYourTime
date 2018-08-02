<?php
	require_once('../utils/constant.php');
	require_once('../utils/utils.php');
	require_once('../db/selectFunctions.php');
	require_once('../cardjobs/singleCard.php');

	if ( session_status() == PHP_SESSION_NONE ) {
        session_start();
	}


	$result = array();
    
	//Controlli sul costo
	if (  check_POST_IsSetAndNotEmpty('cost') && $_POST['cost'] != "Seleziona il costo" 
		 && $_POST['cost'] < CostMin )
	  	$result['errOptionCost'] = "Il costo non &egrave; valido";

	//Controlli sulla distanza
	if ( check_POST_IsSetAndNotEmpty('distance') &&  $_POST['distance'] != "Seleziona la distanza"
		 && $_POST['distance'] < DistanceMin  && !check_POST_IsSetAndNotEmpty('street') ) 
	  	$result['errOptionDistance'] = "La distanza non &egrave; valida";

	
	//Controlli sull'indirizzo
	if ( check_POST_IsSetAndNotEmpty('street')
		 && notValidString($_POST['street'], addressRegex, StreetMinLength, StreetMaxLength)) 
		$result['errOptionStreet'] = "L'indirizzo non &egrave; valido";

	//Controlli sul tag
	if (  check_POST_IsSetAndNotEmpty('tag') && $_POST['tag'] != "Scegli il tag" 
		 && !checkIfTagExistInDb($_POST['tag']) )
		$result['errOptionTag'] = "Il tag inviato non &egrave; valido";
    
    if ( count($result) === 0 ) {
		
		if(!check_POST_IsSetAndNotEmpty('cost') || $_POST['cost'] == "Seleziona il costo" )
			$_POST['cost'] = 0;

		if(!check_POST_IsSetAndNotEmpty('distance')|| $_POST['distance'] == "Seleziona la distanza")
			$_POST['distance'] = 0;

		if(!check_POST_IsSetAndNotEmpty('street'))
			$_POST['street'] = '';

		if(  !check_POST_IsSetAndNotEmpty('tag') || $_POST['tag'] == "Scegli il tag" )
			$_POST['tag'] =	'';

		$resQuery = searchInto_ShareYourJobsTime($_POST['street'], $_POST['distance'], $_POST['cost'], $_POST['tag'], $_SESSION['user'], $_POST['lat'], $_POST['lon'] );
		
		foreach($resQuery as $singleRes)
			showCard($singleRes);
		return;
	
	}
		
	//Ritorna errori
	echo json_encode($result);
	
