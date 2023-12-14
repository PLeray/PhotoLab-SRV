<?php
//include_once 'BDDInit.php'; ////////////////////

include_once 'CConnexionLOCAL.php';
/////////////////// Les Fonctions ... ///////////////////  
function TypeFichier($myfileName){
	return substr($myfileName, -4, 3);
}

function ChangeEtatCMDNom($CMDnomcommande, $Etat){
	$ID = IDCommandeNom($CMDnomcommande);
	$bdd=InitBDD_MySQI();
	$sql = "UPDATE photolabcmd SET ETAT = ". $Etat . " WHERE ID = ". $ID  ;
	if (($bdd->query($sql) === TRUE) == false) {
		echo "Error updating record: (" . $bdd->error . ') ID : ' . $ID. ' Etat : ' . $Etat;
	}
	$bdd->close();	
}

function VerifCOMMANDE($CodeClient, $CMDdateCmd, $CMDnomcommande, $CMDnbPlanches, $CMDtype, $CMDetat, $CMDfacture, $CMDpaye, $CMDcommentaires, $AncienNomcommande = ''){
	$IdCmd = IDCommandeNom($AncienNomcommande);
	echo "IdCmd ancienne cmd : " . $IdCmd . " AncienNomcommande : " . $AncienNomcommande .  " CMDnbPlanches : " . $CMDnbPlanches;
	if ($IdCmd != 0){ // La commande existe
		$bdd=InitBDD_MySQI();
		echo "$IdCmd:  :" . $IdCmd;
		$sql = "UPDATE photolabcmd SET NOMCOMMANDE = '". $CMDnomcommande . "', DATECMD = '". $CMDdateCmd . "' WHERE ID = ". $IdCmd  ;
		if (($bdd->query($sql) === TRUE) == false) {
			echo "Error updating record: (" . $bdd->error . ') ID : ' . $IdCmd. ' Nom : ' . $CMDnomcommande;
		}
		//Cas des RECO En cours MENAGE ...
		if ($AncienNomcommande == '9999-99-99-(RECOMMANDES)-EN-COURS'){
			SuprimeCMDParNom($AncienNomcommande);
		}
		$bdd->close();
	}else{ // C'est une nouvelle commande
		$IdCmd = IDCommande($CMDnomcommande, $CMDnbPlanches);
		if ($IdCmd == 0){
			//echo "<br>$IdCmd ";
			echo " : (NEW !!)";
			$IdCmd = AjoutLaCOMMANDE($CodeClient, $CMDdateCmd, $CMDnomcommande, $CMDnbPlanches, $CMDtype, $CMDetat, $CMDfacture, $CMDpaye, $CMDcommentaires);
			//$IdCmd = IDCommande($CMDnomcommande, $CMDnbPlanches);
		}
	}
	return $IdCmd;
}

function AjoutLaCOMMANDE($CodeClient, $CMDdateCmd, $CMDnomcommande, $CMDnbPlanches, $CMDtype, $CMDetat, $CMDfacture, $CMDpaye, $CMDcommentaires){
	echo "<br>Ajout de $CodeClient, $CMDdateCmd, $CMDnomcommande, $CMDnbPlanches, $CMDtype, $CMDetat, $CMDfacture, $CMDpaye, $CMDcommentaires";
	
	$bdd=InitBDD_MySQI();	
	$sql = "INSERT INTO photolabcmd(CodeClient, DATECMD, NOMCOMMANDE, NBPLANCHES, TYPE, ETAT, FACTURE, PAYE, commentaires) 
	VALUES ('". $GLOBALS['codeMembre'] . "',
		'". $CMDdateCmd . "',
		'". $CMDnomcommande . "',
		". $CMDnbPlanches . ",
		'". $CMDtype . "',
		". $CMDetat . ",
		". $CMDfacture . ",
		". $CMDpaye . ",
		'". $CMDcommentaires . "')";
	if (($bdd->query($sql) === TRUE) == false) {
		echo "Error: " . $sql . "<br>" . $bdd->error;
	}
	return $bdd->insert_id;
	$bdd->close();	
}

function IDCommande($CMDnomcommande, $CMDnbPlanches){
	$IdCmd=0;
	$bdd=InitBDD_MySQI();
	$reponse = $bdd->query("SELECT ID FROM photolabcmd WHERE NOMCOMMANDE='". $CMDnomcommande . "' AND NBPLANCHES=". $CMDnbPlanches);  
	if ($reponse){
		while ($resultats = $reponse->fetch_assoc())
		{$IdCmd = $resultats['ID'];}
	}
	$bdd->close();		
	return $IdCmd;
}

function IDCommandeNom($CMDnomcommande){
	$IdCmd=0;
	$bdd=InitBDD_MySQI();
	$reponse = $bdd->query("SELECT ID FROM photolabcmd WHERE NOMCOMMANDE='". $CMDnomcommande. "'");  
	if ($reponse){
		while ($resultats = $reponse->fetch_assoc())
		{$IdCmd = $resultats['ID'];}
	}
	$bdd->close();		
	return $IdCmd;
}

function SuprimeCMDParNom($NomdecommandeASupprimer){//9999-99-99-(RECOMMANDES)-EN-COURS
	$bdd=InitBDD_MySQI();
	// sql to delete a record
	$sql = "DELETE FROM photolabcmd WHERE NOMCOMMANDE='". $NomdecommandeASupprimer. "'";

	if ($bdd->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . $bdd->error;
	}
	$bdd->close();	
}

/*
function zzIDCommandeNom($CMDnomcommande){
	$IdCmd=0;
	$bdd=InitBDD_MySQI();
	$reponse = $bdd->query("SELECT ID FROM photolabcmd WHERE NOMCOMMANDE='". $CMDnomcommande. "'");  
	if ($reponse){
		while ($resultats = $reponse->fetch_assoc())
		{$IdCmd = $resultats['ID'];}
	}
	$bdd->close();		
	return $IdCmd;
}

//9999-99-99-(RECOMMANDES)-EN-COURS

function SuprimeCMDParNom($NomdecommandeASupprimer){
	$ID = IDCommandeNom($NomdecommandeASupprimer);
	while ($ID!=0){  // Y a ce Nom On le supprime
		$bdd=InitBDD_MySQI();
		// sql to delete a record
		$sql = "DELETE FROM photolabcmd WHERE NOMCOMMANDE='". $CMDnomcommande. "'";

		if ($bdd->query($sql) === TRUE) {
			echo "Record deleted successfully";
		} else {
			echo "Error deleting record: " . $bdd->error;
		}
		$bdd->close();		

	}

	
}	
*/




?>