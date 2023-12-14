<?php
//include_once 'BDDInit.php'; ////////////////////

include_once  'CConnexionLOCAL.php';
/////////////////// Les Fonctions ... ///////////////////  
function ChangeEtat($ID, $Etat){
	$bdd=InitBDD_MySQI();
	$sql = "UPDATE photolabcmd SET ETAT = ". $Etat . " WHERE ID = ". $ID  ;
	if (($bdd->query($sql) === TRUE) == false) {
		echo "Error updating record: " . $bdd->error;
	}
	$bdd->close();	
}

function SuprimeIDCMD($ID){
	$bdd=InitBDD_MySQI();
	// sql to delete a record
	$sql = "DELETE FROM photolabcmd WHERE ID = ". $ID;

	if ($bdd->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . $bdd->error;
	}
	$bdd->close();	
}

function FormatDate($laDateSQL){
	$laDate = new DateTime($laDateSQL);
	return $laDate->format('d/m/Y');	
}

function AfficherCOMMANDES(&$Total, $Type){

	$bdd=InitBDD_MySQI();
	

	/**/
	if ($GLOBALS['isAdmin']){		
		$reponse = $bdd->query('SELECT * FROM photolabcmd WHERE FACTURE = 0 AND TYPE = "'. $Type .'" ORDER BY DATECMD DESC');
	}
	else{
		//echo "GLOBALS['codeMembre']: " . $GLOBALS['codeMembre'];
		$reponse = $bdd->query('SELECT * FROM photolabcmd WHERE CodeClient = "'. $GLOBALS['codeMembre'] .'" AND FACTURE = 0 AND TYPE = "'. $Type .'" ORDER BY DATECMD DESC');
	}
	
	
	//$reponse = $bdd->query('SELECT * FROM photolabcmd WHERE FACTURE = 0 AND TYPE = "'. $Type .'" ORDER BY DATECMD DESC');  
	
	$affiche_Tableau = '';
	if ($reponse->num_rows > 0) {
		// output data of each row
		while($donnees = $reponse->fetch_assoc()) {
			$NomCMD = substr($donnees['NOMCOMMANDE'], 11) ;
			$EtatFacture = $donnees['FACTURE'];
			$Etat = $donnees['ETAT'];
			$ID = $donnees['ID'];
			$Type = $donnees['TYPE'];
			if ($Type == 'web'){
				$Prix =  $GLOBALS['PRIXPLANCHEWEB'] * $donnees['NBPLANCHES'] ;				
			}else{
				$Prix =  $GLOBALS['PRIXPLANCHE'] * $donnees['NBPLANCHES'] ;					
			}
			if (($Etat == $GLOBALS['ETAT_PREP_FACTURE']) && ($EtatFacture == 0)){$Total = $Total + $Prix;}
			$newDate = strftime("%d/%m/%Y",strtotime($donnees['DATECMD'])); //date("l d m Y", strtotime($donnees['DATECMD']));
			$affiche_Tableau .=
			'<tr>
				<td><a href="' . LienNoteAuteur($ID, $Etat, $EtatFacture, $Type) . '" title="voir '. $NomCMD . '">' . $donnees['CodeClient'] . '</a></td>
				<td><a href="' . LienNoteAuteur($ID, $Etat, $EtatFacture, $Type) . '" title="voir '. $NomCMD . '">' . $newDate . '</a></td>
				<td><a href="' . LienNoteAuteur($ID, $Etat, $EtatFacture, $Type) . '" title="voir '. $NomCMD . '">' . $NomCMD . '</a></td>
				<td><a href="' . "#" . '" title="voir '. $NomCMD . '">' . $donnees['NBPLANCHES'] . '</a></td>
				<td><a href="' . "#" . '" title="voir '. $NomCMD . '">' . LienImageETAT($Etat, $Type) . '</a></td>
			';	
		
			if ($GLOBALS['isAdmin']){
				$affiche_Tableau .= '
					<td><a href="' . LienEtatCmd($ID, $donnees['ETAT']) . '" title="Selectionne cette commande (' . $ID . ') pour facturation...">' . LienImageOKKO($donnees['ETAT']) . '</a></td>
					<td><a href="' . "#" . '" title="voir '. $NomCMD . '">' . $Prix . ' €</a></td>
					<td><a href="' . LienSuprimerCmd($ID) . '" title="voir '. $NomCMD . '">' . 'X' . '</a></td>				
				';
			}
			$affiche_Tableau .= '</tr>';
		}
	/**/
	} 
	$bdd->close();	

	return $affiche_Tableau;		
}

function AfficherLesFactures(){
	$bdd=InitBDD_MySQI();
	$affiche_Tableau = '';	
	
	if ($GLOBALS['isAdmin']){
		$reponse = $bdd->query('SELECT * FROM photolabfacture ORDER BY ID DESC'); 
	}else{
		if (date("m") > 8){ // Supérieur à Aout on affiche juste l'annee en cours
			$anneeEnCours = date("Y");	
		}else{
			$anneeEnCours = date("Y")-1;		
		}
		$reponse = $bdd->query('SELECT * FROM photolabfacture WHERE CodeClient = "'. $GLOBALS['codeMembre'] .'" AND DATECREATION > "'. $anneeEnCours .'-09-01" ORDER BY ID DESC'); 	
	}		
	if ($reponse->num_rows > 0) {
		while ($donnees = $reponse->fetch_assoc())
		{
			$NomFacture = 'Note Auteur n°' . $donnees['ID'] . ' ( ' . $donnees['NOMFACTURE']. ' )';
			$ID = $donnees['ID'];
			$isReglee = ($donnees['DATEPAYE']== '0000-00-00')?false:true;
			//LienNoteAuteur($ID, $Etat, $EtatFacture)
			$affiche_Tableau .=
			'<tr>
				<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="voir '. $NomFacture . '">' . $donnees['CodeClient'] . '</a></td>
				<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="voir '. $NomFacture . '">' . $NomFacture . '</a></td>
				<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="Notes Auteur facturés...">' . LienImageVoir($isReglee) . '</a></td>
				<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="voir '. $NomFacture . '">' . $donnees['SOLDE'] . ' €</a></td>			
				<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="voir '. $NomFacture . '">' . FormatDate($donnees['DATECREATION']) . '</a></td>
				<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="voir '. $NomFacture . '">' . ($isReglee?FormatDate($donnees['DATEPAYE']):'') . '</a></td>
			</tr>';
		}
	}
	$bdd->close();	
	return $affiche_Tableau;		
}

function TitleEtat($Etat){
	switch ($Etat) {
	case "1":
		$retourMSG = "Les planches sont crées.";
		break;		
	case "2":
		$retourMSG = "Déclarer que les planches ont été envoyés au laboratoire ?";
		break;
	case "3":
		$retourMSG = "Déclarer que les photos sont tirées au laboratoire ?";
		break;		
	case "4":
		$retourMSG = "Déclarer que les photos sont mise en carton. Fin";
		break;	
	}
	return $retourMSG;
}

function LienImageOKKO($Etat){
		$isOK = ($Etat<$GLOBALS['ETAT_PREP_FACTURE']?false:true);
	$Lien = ($isOK?'src="img/OK.png" alt="Oui"':'src="img/KO.png" alt="Non"'). ' class="OKKOIMG"';
	//return $Lien;
	return '<img ' . $Lien . '>';
} 

function LienImageETAT($Etat){
	$Lien = 'src="img/'.$Etat. '-Etat.png" ';
	return '<img ' . $Lien . '>';
}
function LienImageVoir($isOK){
	$Lien = ($isOK?'src="img/VoirON.png" alt="Oui"':'src="img/VoirOFF.png" alt="Non"'). ' class="VoirIMG"';
	return '<img ' . $Lien . '>';
}     

function LienEtatCmd($ID, $Etat) {
	$Etat = ($Etat<$GLOBALS['ETAT_PREP_FACTURE']?$GLOBALS['ETAT_PREP_FACTURE']:5);
	return "LOGPhotoLab.php" . ArgumentURL() . '&apiID='.$ID.' &apiEtat=' . $Etat ;	
}

function LienSuprimerCmd($ID) {
	return "LOGPhotoLab.php". ArgumentURL() . '&suprID='.$ID;	
}

function LienNoteAuteur($ID, $Etat, $EtatFacture) {
	$LienFichier = "#";
	
	if($EtatFacture == 0){// Pas de facture
		if($Etat>4){
			$LienFichier = "LOGNoteAuteur.php" . '?apiNoteAuteur=' . $GLOBALS['ETAT_PREP_FACTURE'];
		}/*
		else {
			$LienFichier = "LOGPhotoLab.php" . '?apiID='.$ID.' &apiEtat=1';	
		}	*/
	} else { 
		$LienFichier = "LOGNoteAuteur.php" . '?apiNoteAuteur=' . $EtatFacture;
	}
	return $LienFichier . ArgumentURL(true);
}
?>