<?php
include_once  'BDDInit.php'; ////////////////////
//AMP ?
$codeMembre = false;
if (isset($_POST['codeMembre']) ){
	$codeMembre = $_POST['codeMembre'];
}
if (isset($_GET['codeMembre'])) { // Test connexion l'API
	$codeMembre = $_GET['codeMembre'];
}

if (isset($_POST['isDebug']) ){
	$isDebug = ($_POST['isDebug'] == 'Debug');
}
if (isset($_GET['isDebug'])) { // Test connexion l'API
	$isDebug = ($_GET['isDebug'] == 'Debug');
}

//$maConnexionAPI = new CConnexionAPI($codeMembre, $isDebug);

$EnteteHTML = 
    '<!DOCTYPE html>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <html>
    <head>
	<link rel="stylesheet" type="text/css" href="css/Couleurs' . (($codeMembre == 'OK')?'AMP':'') .'.css">
    <link rel="stylesheet" type="text/css" href="css/COMNoteAuteur.css">
    </head>
    <body>
';
	

	
$BotomHTML = '
    </body>
    </html>';

		

if (isset($_GET['validationNote']) ) { 
	echo $EnteteHTML . DemandeNoteAuteur() . $BotomHTML;	
}

function DemandeNoteAuteur(){
	$retourMSG = 
'<div id="apiReponse" class="modal">
	<div class="modal-content animate" >
		<div class="imgcontainer">
			<a href="../LOGNoteAuteur.php' . ArgumentURL() .'" class="close" title="Annuler et retour écran général des commandes">&times;</a>
			<img src="img/Logo.png" alt="Image de fichier" class="apiReponseIMG">
		</div>';	
		
	$retourMSG = $retourMSG . '	<div class="msgcontainer">';
	$retourMSG = $retourMSG . '<h1>Note de '. $_GET['validationNote'].' €</h1>';
	$retourMSG = $retourMSG . ""  ;
	$retourMSG = $retourMSG . '
	<form class="modal-content animate" action="../LOGNoteAuteur.php?apiNoteAuteur=-1&validationNote='. $_GET['validationNote']. ArgumentURL(true) .'" method="post" enctype="multipart/form-data">
				<br><h3>Nom de la Note</h3><br>
				<input type="text" name="apiNomNote" value="Note ...">

				<h3>Date de la Note : </h3> <input type="date" name="apiDateNote" value="'.date("Y-m-d").'">
				<button type="submit" value="Submit">Valider la Note</button>

				
				</form>';
	

	$retourMSG = $retourMSG . '
		</div>	  
	</div>
</div>';	
	return $retourMSG;
}
	
?>