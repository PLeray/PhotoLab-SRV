<?php
session_start();
include_once 'BDDNoteAuteur.php';



setlocale(LC_TIME, 'french');
$codeMembre = true;
$isINIT = false;

$codeMembre = false;
if (isset($_POST['codeMembre']) ){
	$codeMembre = $_POST['codeMembre'];
}
if (isset($_GET['codeMembre'])) { // Test connexion l'API
	$codeMembre = $_GET['codeMembre'];
}
//DEBUG ?

//$isDebug = file_exists ('debug.txt');

$isDebug = false;

if (isset($_POST['isDebug']) ){
	$isDebug = ($_POST['isDebug'] == 'Debug');
}
if (isset($_GET['isDebug'])) { // Test connexion l'API
	$isDebug = ($_GET['isDebug'] == 'Debug');
} 
//if ($isDebug) echo 'MODE DEBUG';
//else echo 'MODE NORMAL'; 
$numNoteAuteur = 0;

$Total = 0;
?>	

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
<head>
	<title id="PHOTOLAB">PhotoLab - Note Auteur</title>
    <link rel="stylesheet" type="text/css" href="css/Couleurs<?php echo ($isDebug?'DEBUG':'PROD'); ?>.css">
	<link rel="stylesheet" type="text/css" href="css/PrintNoteAuteur.css" media="print" />	
	<link rel="stylesheet" type="text/css" href="css/LOGNoteAuteur.css">
	<link rel="shortcut icon" type="image/png" href="img/favicon.png">
	<!--<script type="text/javascript" src="APIConnexion.js"></script>	 -->
</head>
<body>
<?php 	
if (isset($_GET['apiNoteAuteur'])) { $numNoteAuteur = $_GET['apiNoteAuteur'];} 

if (($numNoteAuteur == -1) && isset($_GET['validationNote']) && isset($_POST['apiNomNote'])  && isset($_POST['apiDateNote']))
{ 	$numNoteAuteur = AjoutNOTEAUTEUR($_GET['validationNote'],$_POST['apiNomNote'],$_POST['apiDateNote']);
} 

if (isset($_GET['datevalidePaiement'])) { 
	ValidationPaiement($numNoteAuteur, $_GET['datevalidePaiement']);
} 
$NoteAUTEUR = AfficherNOTEAUTEUR($numNoteAuteur, $Total);	

?>	



<div class="topnav">
  <a href="LOGPhotoLab.php<?php echo ArgumentURL() ;?>">Accueil des Commandes</a>
  <?php //if ($numNoteAuteur == 6) { echo '<a href="NoteAuteur.php?apiNoteAuteur=-1'. ArgumentURL(true).'">Valider la Note Auteur</a>';}
	if ($numNoteAuteur == $GLOBALS['ETAT_PREP_FACTURE']) { 
		echo '<a href="COMNoteAuteur.php'. ArgumentURL() . '&validationNote=' . $Total .'">Valider la Note Auteur</a>';
	}else{
		if ($numNoteAuteur > 100) {
			echo '<a href="#">Valider Paiement de la Note Auteur</a>';				
		}
	}
	?>
  
  <?php 
  $DateValidation = DateREGLEMENT($numNoteAuteur);
  $NONPaye = ($DateValidation == '0000-00-00');
	/*
	if ($NONPaye){  
		echo '<a href="LOGNoteAuteur.php?datevalidePaiement=GO&apiNoteAuteur='. $numNoteAuteur . ArgumentURL(true).'">Valider réglement : ' . $DateValidation; '</a>';
	}else  {  
		echo '<a href="#">REGLEE le ' . $DateValidation; '</a>';
	}
	*/
	

	
?>
</div>







<!--
<div class="facture" > -->
<div class="facture" >
	<div class="zoneEntete" > 
		Leray Pierre - Siret : 482 798 154 000 35<BR>
		Auteur affilié à l'Agessa - Titulaire d'une attestation annuelle de dispense de précompte<BR>
		(Art. R382-27-3ème alinéa du Code de la Sécurité Sociale)
	</div>
	
	<div class="zoneNumFacture"> 
		<img src="img/Logo-mini.png" alt="Image de fichier LOGO "><br>
		Note Auteur num° <?php echo ($numNoteAuteur==6)?'PROVISOIRE':$numNoteAuteur ;?>
		
		<br>Date Creation : <?php echo FormatDate(DateNOTEAUTEUR($numNoteAuteur));?>
		<br>Date Reglement : <?php if (!$NONPaye){echo FormatDate($DateValidation) ;}?>		
	</div>
	
	<div class="zoneDestinataire" >  
		À L’ATTENTION DE : <BR>
		Arnaud Monfort Photographie<BR>
		109 Bd Ernest Dalby, 44000 Nantes
	</div>
<div class="listecommande" >	
<center><B>NOTE D'AUTEUR</B><BR>

<?php echo NomNOTEAUTEUR($numNoteAuteur);?> du <?php echo FormatDate(DateNOTEAUTEUR($numNoteAuteur));?></center>

<B>Description des droits cédés</B><BR>
<div class="zoneAdministration" >
Le cédant cède au cessionnaire les droits patrimoniaux attachés à l’œuvre, et notamment les droits de l'exploiter en vue de générer de fichiers photographiques numériques pour une exploitation commerciale. La présente cession est consentie pour les modes d’exploitation suivants :<BR>
• Création de fichiers photographiques numérique au format JPG à destination d'un laboratoire en vue de les imprimer.<BR>
• Visualisation via une interface web des fichiers photographiques numérique au format JPG sous forme de commandes client en vue de faciliter la vérification des tirages provenant du laboratoire et la mise en colis.<BR>
En contrepartie de la cession des droits d’auteur, le cessionnaire verse au cédant une rémunération proportionnelle aux revenus perçus lors de l’exploitation de l’œuvre à hauteur de 0,15 € pour chaque la planche crée en vue d'être imprimée et mise en carton. Le détails des planches commandées et crées est listé en fin du présent document. <BR>
</div>
<BR>


<table id="myTable">
	<tr>
		<td>TOTAL HT</td>
		<td><?php 
		$DroitPSL = $Total/1.011;
		echo number_format($DroitPSL, 2) . ' €';?></td> 
	</tr>
	<tr>
		<td>TVA non applicable - Art. 293B du CGI</td>
		<td>0,00 €</td>	
	</tr>
	<tr>
		<td><FONT size="2"><B>TOTAL A PAYER A L'AUTEUR</B></FONT></td>
		<td><FONT size="3"><B><?php echo number_format($DroitPSL, 2) . ' €';?></B></FONT></td>	
	</tr>
</table>

<br><B>Contributions à verser à l'Agessa</B><br>

<table id="myTable">
	<tr>
		<td>- 1% diffuseur <br>Art L 382-1 et R-382-1 et suivants du Code de la Sécurité sociale)</td>
		<td><?php echo number_format($DroitPSL*0.01, 2) . ' €';?></td>	
	</tr>
	<tr>
		<td>- 0,10% Contribution diffuseur à la	formation professionnelle des auteurs<br>(Loi n° 2011-1977 du 28/12/2011 -Art. L 6331-1 du Code du Travail)</td>
		<td><?php echo number_format($DroitPSL*0.001, 2) . ' €';?></td>	
	</tr>
	<tr>
		<td><FONT size="2"><B>TOTAL A VERSER A L'AGESSA</B></FONT></td>
		<td><FONT size="3"><B><?php echo number_format($Total - $DroitPSL, 2) . ' €';?></B></FONT></td>	
	</tr>
</table>

<br><B>Conditions générales de cession</B><br>
<div class="zoneAdministration" >
La présente note d’auteur est payable à la livraison ou au plus tard 60 jours. Tout retard de paiement donnera lieu au paiement d'intérêts au taux minimal prévu par l'article L441-6 du Code de commerce (intérêt légal multiplié par trois), exigibles de plein droit et sans rappel, calculés sur les montants hors taxes. Tout professionnel en retard de paiement sera de plein droit débiteur d'une indemnité forfaitaire pour frais de recouvrement d'un montant de 40 €, sans préjudice du droit de justifier de frais de recouvrement supérieurs (Art. L441-6 du Code de Commerce et Décret n°2012-1115 du 2/10/2012). Le non-paiement entraine la résolution de plein droit du contrat de cession et l'impossibilité d'utiliser le logiciel concerné. L'utilisation du logiciel es soumi aux dispositions du Code de la Propriété intellectuelle. Toute utilisation non prévue à la présente cession devra faire l'objet d'une nouvelle cession calculée sur base des barèmes en vigueur.<br>
</div>
<br><B>Détail des commandes de planches<?php 	echo ' (Total : '. $Total . ' €)';	?></B><br>
	<!-- ////////// FIN de l'HTML Standard ////////// -->

	<table id="myTable">
	  <tr class="header">
		<th style="width:55%;" >Référence de la commande</th>
		<th style="width:25%;" >Nb de Planches créées</th>
		<th ALIGN=RIGHT style="width:20%;" >prix (€)</th>
	  </tr>  
	<?php 	echo $NoteAUTEUR;
	//AfficherNOTEAUTEUR($numNoteAuteur, $Total);	?>
	</table>
	</div> 	
</div>



</body>
</html>
