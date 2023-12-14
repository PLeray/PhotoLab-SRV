<?php
//include_once 'BDDInit.php'; ////////////////////

include_once  'CConnexionLOCAL.php';

function ValidationPaiement($numNoteAuteur, $dateValidePaiement){
	$bdd=InitBDD_MySQI();
	$sql = "UPDATE photolabfacture SET DATEPAYE = NOW() WHERE ID = ". $numNoteAuteur  ;
	if (($bdd->query($sql) === TRUE) == false) {
		echo "Error updating record: " . $bdd->error;
	}
	$bdd->close();	
}

function DateREGLEMENT($numNoteAuteur){
		$IdDate = '00-00-00';
		$bdd=InitBDD_MySQI();
		$reponse = $bdd->query("SELECT DATEPAYE FROM photolabfacture WHERE ID=". $numNoteAuteur);  
		if ($reponse){
			while ($resultats = $reponse->fetch_assoc())
			{$IdDate = $resultats['DATEPAYE'];}
		}
		$bdd->close();		
		return $IdDate;
}

function FormatDate($laDateSQL){
	$laDate = new DateTime($laDateSQL);
	return $laDate->format('d/m/Y');	
}

function AfficherNOTEAUTEUR($numNoteAuteur, &$Total){
	$bdd=InitBDD_MySQI();
	
	if ($numNoteAuteur == $GLOBALS['ETAT_PREP_FACTURE']){
		$sql = 'SELECT ID, NOMCOMMANDE, NBPLANCHES  FROM photolabcmd WHERE ETAT = ' .$numNoteAuteur.' AND FACTURE = 0 ORDER BY NOMCOMMANDE DESC';	
	}
	else {
		$sql = 'SELECT ID, NOMCOMMANDE, NBPLANCHES  FROM photolabcmd WHERE FACTURE = ' .$numNoteAuteur.' ORDER BY NOMCOMMANDE DESC';
	}
	
//$sql = 'SELECT ID, NOMCOMMANDE, NBPLANCHES  FROM photolabcmd WHERE ETAT = "6" AND FACTURE = "0" ORDER BY NOMCOMMANDE DESC';	
		
	
	$reponse=$bdd->query($sql);	
	$affiche_Tableau = '';	
	while ($donnees = $reponse->fetch_assoc())
	{
		$Prix = $GLOBALS['PRIXPLANCHE'] * $donnees['NBPLANCHES'] ;
		//$Prix = 0.1 * $donnees['NBPLANCHES'] ;
		$Total = $Total + $Prix;
		$affiche_Tableau .=
		'<tr>
			<td>' . $donnees['NOMCOMMANDE'] . '</td>
			<td>' . $donnees['NBPLANCHES'] . '</td>	
			<td>' . $Prix . ' €</td>	
		</tr>';
	}
	/*
	if ($numNoteAuteur != 6){
		$sql = "UPDATE photolabfacture SET SOLDE = ". $Total . " WHERE ID  = " .$numNoteAuteur ;
		if (($bdd->query($sql) === TRUE) == false) {
			echo "Error updating record: " . $bdd->error;
		}	
	}*/
	
	$bdd->close(); // Termine le traitement de la requète
	return $affiche_Tableau;	
}

function DateNOTEAUTEUR($numNoteAuteur){
	 if($numNoteAuteur == $GLOBALS['ETAT_PREP_FACTURE']){//DATE DU JOUR
		 $today = date("Y-m-d"); 
		 return $today;
	 }
	 else{
		$IdDate = '00-00-00';
		$bdd=InitBDD_MySQI();
		$reponse = $bdd->query("SELECT DATECREATION FROM photolabfacture WHERE ID=". $numNoteAuteur);  
		if ($reponse){
			while ($resultats = $reponse->fetch_assoc())
			{$IdDate = $resultats['DATECREATION'];}
		}
		$bdd->close();		
		return $IdDate;
	}
}

function NomNOTEAUTEUR($numNoteAuteur){
	 if($numNoteAuteur == $GLOBALS['ETAT_PREP_FACTURE']){//DATE DU JOUR
		 $nom = 'Note n° En cours ...'; 
		 return $nom;
	 }
	 else{
		$IdNOM = 'en cours ...';
		$bdd=InitBDD_MySQI();
		$reponse = $bdd->query("SELECT NOMFACTURE FROM photolabfacture WHERE ID=". $numNoteAuteur);  
		if ($reponse){
			while ($resultats = $reponse->fetch_assoc())
			{$IdNOM = $resultats['NOMFACTURE'];}
		}
		$bdd->close();		
		return $IdNOM;
	}
}
/*
function AjoutNOTEAUTEUR(){
	try {
		$bdd = InitBDD_PDO();
		$CMDdateCreation = date("Y-m-d"); 
		$CMDdatePaye = '';
		$CMDNom = 'Ma Note';
		// set the PDO error mode to exception
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO photolabfacture(DATECREATION, DATEPAYE, NOMFACTURE) 
		VALUES ('". $CMDdateCreation . "', '". $CMDdatePaye . "', '". $CMDNom . "')";
		// use exec() because no results are returned
		$bdd->exec($sql);
		$numNoteAuteur = $bdd->lastInsertId();
		$sql = "UPDATE photolabcmd SET FACTURE = ". $numNoteAuteur . " WHERE ETAT = 5"  ;
		$bdd->exec($sql);// use exec() because no results are returned				
		$sql = "UPDATE photolabcmd SET ETAT = 6 WHERE ETAT = 5"  ;
		$bdd->exec($sql);// use exec() because no results are returned				
		echo "<br>Nouvelle NoteAuteur : $CMDdateCreation, $CMDdatePaye, $CMDNom ";
		$bdd = null;
		return $numNoteAuteur;			
	}
	catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
	}
}
*/
function AjoutNOTEAUTEUR($Total, $CMDNom, $CMDdateCreation){
	//echo "<br>Ajout de AjoutNOTEAUTEUR" . $Total;
	//$CMDdateCreation = date("Y-m-d"); 
	$CMDdatePaye = '00-00-00';
	//$CMDNom = 'Ma Note';
	
	$bdd=InitBDD_MySQI();	
	$sql = "INSERT INTO photolabfacture(DATECREATION, SOLDE, DATEPAYE, NOMFACTURE) 
		VALUES ('". $CMDdateCreation . "', 2, '". $CMDdatePaye . "', '". $CMDNom . "')";
	if (($bdd->query($sql) === TRUE) == false) {
		echo "Error: " . $sql . "<br>" . $bdd->error;
	}
	$numNoteAuteur = $bdd->insert_id;   //$GLOBALS['isDebug']
	
	$sql = 'UPDATE photolabcmd SET FACTURE = '. $numNoteAuteur . ' WHERE ETAT = ' . $GLOBALS['ETAT_PREP_FACTURE']  ;
	if (($bdd->query($sql) === TRUE) == false) {
		echo 'Error updating record: ' . $bdd->error;
	}
	/**/
	$sql = 'UPDATE photolabcmd SET ETAT =' . $GLOBALS['ETAT_FACTURE_OK'] . ' WHERE ETAT = ' . $GLOBALS['ETAT_PREP_FACTURE']  ;
	if (($bdd->query($sql) === TRUE) == false) {
		echo 'Error updating record: ' . $bdd->error;
	}
	$sql = 'UPDATE photolabfacture SET SOLDE = '. $Total . ' WHERE ID  = ' .$numNoteAuteur ;
	if (($bdd->query($sql) === TRUE) == false) {
		echo 'Error updating record: ' . $bdd->error;
	}	

	return $numNoteAuteur;
	$bdd->close();	
}

function SuprimeIDNote($ID){
	$bdd=InitBDD_MySQI();
	// sql to delete a record
	$sql = "DELETE FROM photolabfacture WHERE ID = ". $ID;

	if ($bdd->query($sql) === TRUE) {
		echo 'photolabfacture deleted successfully';
	} else {
		echo 'photolabfacture deleting record: ' . $bdd->error;
	}
	$bdd->close();	
}



?>