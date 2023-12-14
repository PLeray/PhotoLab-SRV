<?php
$VERSIONSERVEUR = 0.880;
$ANNEE = '2022';

$ETAT_PREP_FACTURE = 10;
$ETAT_FACTURE_OK = 20;

$PRIXPLANCHE = 0.15;
$PRIXPLANCHEWEB = 0.0;

function InitBDD_PDO(){
	if ($GLOBALS['isDebug']){		
		$servername = "localhost";
		$username = 'root';
		$password = '';
		$dbname = 'psl_Test_photolab';
		//echo ' Base : test';
	}
	else{
		$servername = "localhost";
		$username = 'lepi6711_photolab';
		$password = 'O314paddock314';
		$dbname = 'lepi6711_PhotoLab';	
		/*
		$servername = "localhost";
		$username = 'id4963524_admin';
		$password = '0314delphine314';
		$dbname = 'id4963524_photolab';	
*/		
	}
	try	{
		$bdd = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);

		return $bdd;
	}
	catch(Exception $e)	{// En cas d'erreur, on affiche un message et on arréte tout
		die('Erreur : '.$e->getMessage());
		return null;
	}	
}

// Pour la gestion des comptes
function InitBDD_MySQI(){
	if ($GLOBALS['isDebug']){		
		$servername = "localhost";
		$username = 'root';
		$password = '';
		$dbname = 'psl_Test_photolab';
		//echo ' Base : test';
	}
	else{
		$servername = "localhost";
		$username = 'lepi6711_photolab';
		$password = 'O314paddock314';
		$dbname = 'lepi6711_PhotoLab';	
		/*
		$servername = "localhost";
		$username = 'id4963524_admin';
		$password = '0314delphine314';
		$dbname = 'id4963524_photolab';	
*/		
	}
	try	{// On se connecte à MySQL
		// Create connection
		$bdd = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($bdd->connect_error) {
			die("Connection failed: " . $bdd->connect_error);
		} 
		return $bdd;
	}
	catch(Exception $e)	{// En cas d'erreur, on affiche un message et on arréte tout
		die('Erreur : '.$e->getMessage());
		return null;
	}	
}

function ArgumentURL($isEnPlus = false){
	$SymboleDepart = ($isEnPlus ? '&' : '?');
	return $SymboleDepart . 'codeMembre=' . $GLOBALS['codeMembre'] . '&version=' . $GLOBALS['VERSIONSERVEUR'] . '&versionDistante=' . $GLOBALS['VERSIONSERVEUR'] . '&isDebug=' .($GLOBALS['isDebug'] ? 'Debug' : 'Prod');
}

function VersionPhotoLab(){
	return '©PhotoLab ' . $GLOBALS['ANNEE'] . ' (v'.$GLOBALS['VERSIONSERVEUR'].') : Création et visualisation de commandes de photographies scolaires';
}
?>