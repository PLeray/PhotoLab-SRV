<?php
include_once 'BDDInit.php'; ////////////////////
/////////////////// Les Fonctions ... ///////////////////  
function ChangeEtat($ID, $Etat){
	$bdd=InitBDD_MySQI();
	$sql = "UPDATE PhotolabCMD SET ETAT = ". $Etat . " WHERE ID = ". $ID  ;
	if (($bdd->query($sql) === TRUE) == false) {
		echo "Error updating record: " . $bdd->error;
	}
	$bdd->close();	
}

function FormatDate($laDateSQL){
	$laDate = new DateTime($laDateSQL);
	return $laDate->format('d/m/Y');	
}

function AfficherCOMMANDES( &$Total, $Type){

	$bdd=InitBDD_MySQI();
	$reponse = $bdd->query('SELECT * FROM PhotolabCMD WHERE FACTURE = 0 AND TYPE = "'. $Type .'" ORDER BY DATECMD DESC');  
	$affiche_Tableau = '';
	if ($reponse->num_rows > 0) {
		// output data of each row
		while($donnees = $reponse->fetch_assoc()) {
			$NomCMD = substr($donnees['NOMCOMMANDE'], 11) ;
			$EtatFacture = $donnees['FACTURE'];
			$Etat = $donnees['ETAT'];
			$ID = $donnees['ID'];
			$Prix =  $GLOBALS['PRIXPLANCHE'] * $donnees['NBPLANCHES'] ;
			if (($Etat == 1) && ($EtatFacture == 0)){$Total = $Total + $Prix;}
			$newDate = strftime("%d/%m/%Y",strtotime($donnees['DATECMD'])); //date("l d m Y", strtotime($donnees['DATECMD']));
			$affiche_Tableau .=
			'<tr>
				<td><a href="' . "#" . '" title="voir '. $NomCMD . '">' . $newDate . '</a></td>
				<td><a href="' . "#" . '" title="voir '. $NomCMD . '">' . $NomCMD . '</a></td>
				<td><a href="' . "#" . '" title="voir '. $NomCMD . '">' . $donnees['NBPLANCHES'] . '</a></td>
				<td><title="voir '. $NomCMD . '">' . LienImageETAT($donnees['ETAT']) . '</td>
			</tr>';
		}
	} else {
		echo "0 results";
	}
	$bdd->close();	

	return $affiche_Tableau;		
}

function AfficherLesFactures(){
	$bdd=InitBDD_MySQI();
	$affiche_Tableau = '';	
	$reponse = $bdd->query('SELECT * FROM PhotolabFACTURE ORDER BY ID DESC');  
	while ($donnees = $reponse->fetch_assoc())
	{
		$NomFacture = 'Note Auteur n°' . $donnees['ID'] . ' ( ' . $donnees['NOMFACTURE']. ' )';
		$ID = $donnees['ID'];
		$isReglee = ($donnees['DATEPAYE']== '0000-00-00')?false:true;
		$affiche_Tableau .=
		'<tr>
			<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="voir '. $NomFacture . '">' . $NomFacture . '</a></td>
			<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="Notes Auteur facturés...">' . LienImageVoir($isReglee) . '</a></td>
			<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="voir '. $NomFacture . '">' . $donnees['SOLDE'] . ' €</a></td>				
			<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="voir '. $NomFacture . '">' . FormatDate($donnees['DATECREATION']) . '</a></td>
			<td><a href="' . LienNoteAuteur($ID, 0, $ID) . '" title="voir '. $NomFacture . '">' . FormatDate($donnees['DATEPAYE']) . '</a></td>
		</tr>';
	}
	$bdd->close();	
	return $affiche_Tableau;		
}

function TitleEtat($Etat){
	$retourMSG='';
	switch ($Etat) {
	case "0":
		$retourMSG = "Les plancdsfcrées.";
		break;				
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
}

function LienImageOKKO($isOK){
	$Lien = ($isOK?'src="res/img/OK.png" alt="Oui"':'src="res/img/KO.png" alt="Non"'). ' class="OKKOIMG"';
	//return $Lien;
	return '<img ' . $Lien . '>';
} 

function LienImageETAT($Etat){
	$Lien = 'src="res/img/'.$Etat. '-Etat.png" ';
	return '<img ' . $Lien . '>';
} 

function LienImageVoir($isOK){
	$Lien = ($isOK?'src="res/img/VoirON.png" alt="Oui"':'src="res/img/VoirOFF.png" alt="Non"'). ' class="VoirIMG"';
	return '<img ' . $Lien . '>';
}     

function LienEtatCmd($ID, $Etat) {
	$Etat = ($Etat?0:1);
	return "PhotoLab.php" . ArgumentURL() . '&apiID='.$ID.' &apiEtat=' . $Etat . ArgumentURL(true);	
}

function LienNoteAuteur($ID, $Etat, $EtatFacture) {
	$LienFichier = "#";
	
	if($EtatFacture){
		$LienFichier = "NoteAuteur.php" . '?apiNoteAuteur=' . $EtatFacture;
	} else { // Pas de facture
		if($Etat){
			$LienFichier = "NoteAuteur.php" . '?apiNoteAuteur=1';
		} else {
			$LienFichier = "PhotoLab.php" . '?apiID='.$ID.' &apiEtat=1';	
		}	
	}
	return $LienFichier . ArgumentURL(true);
}
?>