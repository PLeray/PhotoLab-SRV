<?php
//include_once 'CConnexionLOCAL.php';
include_once 'BDDtalkServeur.php';

$codeMembre = false;
if (isset($_POST['codeMembre']) ){
	$codeMembre = $_POST['codeMembre'];
}
if (isset($_GET['codeMembre'])) { // Test connexion l'API
	$codeMembre = $_GET['codeMembre'];
}
//DEBUG ?
$isDebug = false;
if (isset($_POST['isDebug']) ){
	$isDebug = ($_POST['isDebug'] == 'Debug');
}
if (isset($_GET['isDebug'])) { // Test connexion l'API
	$isDebug = ($_GET['isDebug'] == 'Debug');
}

$pageRetour = 'CATPhotolab';
if (isset($_GET['pageRetour'])) { // Test connexion l'API
	$pageRetour = $_GET['pageRetour'];
}

$serveurRetour = 'localhost';
if (isset($_GET['serveurRetour'])) { // Test connexion l'API
	$serveurRetour = $_GET['serveurRetour'];
}

$CMDnbPlanches = 0;
if (isset( $_GET['CMDnbPlanches'])) { // Test connexion l'API
	$CMDnbPlanches = $_GET['CMDnbPlanches'];
}

$CodeEcole = '';
if (isset($_GET['CodeEcole'])) { $CodeEcole = $_GET['CodeEcole'];}
$AnneeScolaire = '';
if (isset($_GET['AnneeScolaire'])) { $AnneeScolaire = $_GET['AnneeScolaire'];}
$Side = '';
if (isset($_GET['Side'])) { $Side = $_GET['Side'];}
$fichierLAB = '';
if (isset($_GET['fichierLAB'])) { $fichierLAB = $_GET['fichierLAB'];}

//CMDnbPlanches Ajout d'un fichier lab
$leBDDFileLab='';
$CMDhttpLocal = '';

$Commentaire = 'Back ...Back ...Back ... ';



if (isset($_POST['apiNomCommande']) ){

	$leBDDFileLab = utf8_decode($_GET['CMDdate']) . '-' . $_POST['apiNomCommande'] . '.lab3';
	echo '<br><br><br>>>>>>>>>>>>>>leBDDFileLab :  '. $leBDDFileLab;
	$AncienNom = utf8_decode(substr($_GET['BDDFileLab'], 0, -5));
	VerifCOMMANDE($codeMembre, $_GET['CMDdate'], substr($leBDDFileLab, 0, -5), $CMDnbPlanches, 'lab', 3, 0, 0, 'drop', $AncienNom);
	//$CMDhttpLocal = '?codeMembre=' . $codeMembre . '&isDebug=' . $isDebug . '&code=' . md5($leBDDFileLab); // AJOUTER NB DE PLANCHE !!
	$CMDhttpLocal = '&ValideNomCommande=' . urlencode( $leBDDFileLab)   .'&BDDFileLab='. urlencode( $_GET['BDDFileLab']) . '&BDDRECCode=' . md5(substr($leBDDFileLab, 0, -5)); // AJOUTER NB DE PLANCHE !!
	$Commentaire = 'Change NOM CMD : ' . ChangeEtatCMDNom(utf8_decode(substr($leBDDFileLab, 0, -4)), '3');
}
elseif (isset($_GET['BDDFileLab'])) { // Test connexion l'API
	$Commentaire = 'ENREGISTREMENT COMMANDES Back ...Back ...Back ... ';
	//$Extension =  TypeFichier($_GET['BDDFileLab']);
	$Extension =  substr($_GET['BDDFileLab'], -3, 3);

	//$leBDDFileLab = substr($_GET['BDDFileLab'], 0, strpos($_GET['BDDFileLab'], $Extension));
	$leBDDFileLab = utf8_decode(substr($_GET['BDDFileLab'], 0, -4));
	VerifCOMMANDE($codeMembre, $_GET['CMDdate'], $leBDDFileLab, $CMDnbPlanches, $Extension, 0, 0, 0, 'drop');
	//$CMDhttpLocal = '?codeMembre=' . $codeMembre . '&isDebug=' . $isDebug . '&code=' . md5($leBDDFileLab); // AJOUTER NB DE PLANCHE !!
	$CMDhttpLocal = '&BDDRECFileLab=' . urlencode($_GET['BDDFileLab']) . '&BDDRECCode=' . md5($leBDDFileLab); // AJOUTER NB DE PLANCHE !!
	
	
}
elseif (isset($_GET['BDDARBOwebfile'])) {
	//$Extension =  TypeFichier($_GET['CMDwebArbo']);
	$Commentaire = 'ENREGISTREMENT FICHIERS WEB Back ...Back ...Back ... ';
	$Extension =  substr($_GET['BDDARBOwebfile'], -3, 3);
	$lesFichiersBoutique = '';
	if (isset($_POST['lesFichiersBoutique']) ){
		$lesFichiersBoutique = $_POST['lesFichiersBoutique'];
		if ($isDebug){
			echo '<br><br>VOILA LES $_POST[lesFichiersBoutique :  ' . $_POST['lesFichiersBoutique']  . ' : ' . $lesFichiersBoutique;
		}	
	}
	$leBDDARBOwebfile = utf8_decode(substr($_GET['BDDARBOwebfile'], 0, -4));
	VerifCOMMANDE($codeMembre, $_GET['CMDdate'], $leBDDARBOwebfile, $CMDnbPlanches, $Extension, 0, 0, 0, 'drop');
	$CMDhttpLocal = '&CodeEcole=' . urlencode($_GET['CodeEcole']) .
		  '&AnneeScolaire=' . urlencode($_GET['AnneeScolaire']) .  '&BDDARBOwebfile=' . urlencode($_GET['BDDARBOwebfile']) . 
		  '&CMDwebArbo=' . urlencode($lesFichiersBoutique) . '&BDDRECCode=' . md5($leBDDARBOwebfile); // AJOUTER NB DE PLANCHE !!

	//CAS des FICHIER LIBRE A revoir pour envoie en Local
	if (isset($_GET['BDDRECFileLab']) ){
		if ($isDebug){
			echo '<br><br>CAS des FICHIER LIBRE  $_GET[BDDRECFileLab] : '. $_GET['BDDRECFileLab'];
		}	

		$leBDDFileLab = utf8_decode(substr($_GET['BDDRECFileLab'], 0, -4));
		VerifCOMMANDE($codeMembre, $_GET['CMDdate'], $leBDDFileLab, $CMDnbPlanches, $Extension, 0, 0, 0, 'drop');
		//$CMDhttpLocal = '?codeMembre=' . $codeMembre . '&isDebug=' . $isDebug . '&code=' . md5($leBDDFileLab); // AJOUTER NB DE PLANCHE !!
		$CMDhttpLocal = '&BDDRECFileLab=' . urlencode($_GET['BDDRECFileLab']) . '&BDDRECLibreCode=' . md5($leBDDFileLab); // AJOUTER NB DE PLANCHE !!
		
	}

} 
elseif (isset($_GET['apiFichierChgEtat'])) { // Cas du changement d'etat de fichier
	if (isset($_GET['apiFichierChgEtat']) && isset($_GET['apiEtat'])) { 
		$Commentaire = 'ChangeEtatCMD : ' . ChangeEtatCMDNom(utf8_decode(substr($_GET['apiFichierChgEtat'], 0, -4)), $_GET['apiEtat']);
		if ($isDebug){
			echo '<br><br>ChangeEtatCMD : ' . $_GET['apiFichierChgEtat']; // utf8_decode($_GET['apiFichierChgEtat']);
		}
	} 
	$CMDhttpLocal = '&apiFichierChgEtat=' . urlencode($_GET['apiFichierChgEtat']) . '&apiEtat=' . urlencode($_GET['apiEtat']) ; // AJOUTER NB DE PLANCHE !!
	/*
	$strGET = '<BR>';
	$premier = true;

	$_GET = array_map('htmlentities', $_GET); // on applique la fonction htmlentities() sur chaque donnée du tableau $_GET

	foreach($_GET as $i =>$var) { // pour chaque valeur du tableau $_GET on crée une variable $var
		$strGET = $strGET  .'<BR>' . $i . '=>' .$var;
		if($premier) {
			$strGET = $strGET . '(Le Premier)';
			//$CMDhttpLocal = $CMDhttpLocal .'?' .  $i . '=' . urlencode($var);
			$premier = false;
		}
		else{
			//$CMDhttpLocal = $CMDhttpLocal .'&' .  $i . '=' . urlencode($var);
		}
	}
	*/
}

$CMDhttpLocal .= '&CodeEcole='.$CodeEcole.'&AnneeScolaire='.$AnneeScolaire.'&Side='. $Side .'&fichierLAB=' . $fichierLAB;


$maConnexionLOCAL = new CConnexionLOCAL($codeMembre, $isDebug, $pageRetour, $serveurRetour);

echo '	
	<html>
	<head>
	<title>Serveur PhotoLab</title>
	<meta http-equiv="refresh" content="0; URL=' . $maConnexionLOCAL->AdresseLOCAL($CMDhttpLocal) .'"> 
	</head>
	<body>'.
		'<FONT size="1">
		Le Serveur PhotoLab appele le CLIENT PhotoLabLOCAL... en utilisant cette URL  : (Cliquez pour accelerer)
		<BR> <BR><a href="' . $maConnexionLOCAL->AdresseLOCAL($CMDhttpLocal) .'" >' . $maConnexionLOCAL->AdresseLOCAL($CMDhttpLocal) .'</a><br>
		<BR> <BR>Traitement autre : ' . $Commentaire . '
		<BR> <BR> PATIENTER ... 
		</FONT>
	</body>
	</html>	';
?>