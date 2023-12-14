<?php
include_once 'BDDInit.php';

$codeMembre = false;
if (isset($_POST['codeMembre']) ){
	$codeMembre = $_POST['codeMembre'];
}
if (isset($_GET['codeMembre'])) { // Test connexion l'API
	$codeMembre = $_GET['codeMembre'];
}
//DEBUG ?

$isDebug = file_exists ('debug.txt');
if (isset($_POST['isDebug']) ){
	$isDebug = ($_POST['isDebug'] == 'Debug');
}
if (isset($_GET['isDebug'])) { // Test connexion l'API
	$isDebug = ($_GET['isDebug'] == 'Debug');
}


?><!DOCTYPE HTML>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
<head>
	<title id="GO-PHOTOLAB">PhotoLab : accueil</title>
    <link rel="stylesheet" type="text/css" href="css/Couleurs.css">
	<link rel="stylesheet" type="text/css" href="css/DEMOPhotoLab.css">
	<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
	<!-- <script type="text/javascript" src="res/js/CATFonctions.js"></script>
	<script type="text/javascript" src="res/APIConnexion.js"></script>	 -->
</head>
<!-- <div class="logo">	
		<img src="res/img/Logo.png" alt="Image de fichier">
	</div> -->
<body><center>



<h1>Phot<img src="img/Logo-Ultra-mini.png" width="20">Lab <?php echo $GLOBALS['ANNEE'] ?></h1>Gestion de la production des photographies scolaires

<br>

<br>

<br>
<h3>
PhotoLab est un outil pour les photographes scolaire. <br>
Il est dédié à la gestion de la production de photographies scolaires avec un laboratoire d’impression photo ou votre propre machine d’impression. <br><br>
Le métier de la photographie scolaire est particulier dans la mesure où nous produisons beaucoup de photos qui sont revendues à des prix modique. <br><br>
Pour que l’activité soit rentable, il va donc être important de réduire le temps passé sur chaque photo. <br>
C’est ce que fait PhotoLab en vous permettant d’automatiser les tâches à appliquer sur chaque photo d’une série de photo scolaire. <br>
</h3>

<br>
<br>
	<table class="t1">	
		<tr>
			<td align="center">MAC : Présentation & installation de PhotoLab<br><br><br></td>
			<td align="center">PC : Présentation & installation de PhotoLab<br><br><br></td>
		</tr>		
		<tr>
		  <td align="center"><iframe width="400" height="225" src="https://www.youtube.com/embed/rhUSRrKIPok?origin=https://photolab-site.fr/" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
		  <td align="center"><iframe width="400" height="225" src="https://www.youtube.com/embed/TgwQuBDtV4E?origin=https://photolab-site.fr/" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
		</tr>	


		
	</table>

		
<br>

	<h2>Téléchargez PhotoLab et testez avec deux séries de photos « source »<br>
	 des photos classiques et des Photos Quattro</h2>
		
	<table class="t1">
		<tr>
		  <td width= 450 align="center"><a href="../installation/Installation-PhotoLab-0.92.zip" target="_blank" rel="noopener"><img src="../res/img/ZipPhotoLab.png" alt="" width="161" height="161" /></a></td>
		  <td width= 450 align="center"><a href="../installation/Ressources-pour-tester-PhotoLab-2022.zip" target="_blank" rel="noopener"><img src="../res/img/ZipPhotos.png" alt="" width="161" height="161" /></a></td>
		</tr>	
		<tr>
			<td align="center">Zip d'installation de PhotoLab v0.92 (12/05/2022) La version sera mise à jour automatiquement) avec les Gabarits 2022 et les scripts Photoshop à jour !<br><br><br></td>
			<td align="center">Série de photos et commandes pour tester. <br> Photos classiques & Photos Quattro<br><br><br></td>
		</tr>		
		<tr>
			<td align="center"><a href="../installation/PROCEDURE-MAC-Installation-PhotoLab.pdf" target="_blank" rel="noopener"><img src="../res/img/ProcedureMAC.png" alt="" width="161" height="161" /></a></td>
			<td align="center"><a href="../installation/PROCEDURE-PC-Installation-PhotoLab.pdf" target="_blank" rel="noopener"><img src="../res/img/ProcedurePC.png" alt="" width="161" height="161" /></a></td>
		</tr>	
		<tr>
			<td align="center">PROCEDURE-MAC-Installation-PhotoLab</td>
			<td align="center">PROCEDURE-PC-Installation-PhotoLab</td>

		</tr>	
	</table>	

<br>


<br>
<h3>
L’essentiel des fonctions de PhotoLab sont opérationnelles. <br>
Il est en utilisation gratuite au moins jusqu’au 30 septembre 2022. <br>
Ensuite, pour soutenir le développement de l’outil, il sera facturé à l’utilisation. <br>
En outre le cout ne sera appliqué qu’aux produits vendu. Notre idée est de ne pas imposer une charge fixe aux photographes. <br>
</h3>


	<a href="../index.php<?php echo ArgumentURL() ;?>">
		<h3>retour</h3>
	</a> 

	</center>
	</body>
</html>