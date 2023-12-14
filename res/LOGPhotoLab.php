<?php
session_start();//session_start() combiné à $_SESSION (voir en fin de traitement du formulaire) nous permettra de garder le mail en sauvegarde pendant qu'il est connecté, si vous voulez que sur une page, le mail soit (ou tout autre variable sauvegardée avec $_SESSION) soit retransmis, mettez session_start() au début de votre fichier PHP, comme ici

include_once 'BDDPhotoLab.php';

setlocale(LC_TIME, 'french');
$codeMembre = '';
$isINIT = false;

$codeMembre = false;
if (isset($_POST['codeMembre']) ){
	$codeMembre = $_POST['codeMembre'];
}
if (isset($_GET['codeMembre'])) { // Test connexion l'API
	$codeMembre = $_GET['codeMembre'];
}

if(!isset($_SESSION['mail']) || ($codeMembre == '')){
	header("Refresh: 0; url=../index.php");//redirection vers le formulaire de connexion dans 5 secondes
	echo "Vous devez vous connecter pour accéder à l'espace membre.<br><br><i>Redirection en cours, vers la page de connexion...</i>";
	exit(0);//on arrête l'éxécution du reste de la page avec exit, si le membre n'est pas connecté
}


//DEBUG ?

$isDebug = file_exists ('debug.txt'); // A supprimer ?
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

$serveurRetour = ''; 
if (isset($_GET['serveurRetour'])) { // Test connexion l'API
	$serveurRetour = $_GET['serveurRetour'];
}




/*if (!isset($_SESSION['login'])) {
	header('Location: index.php' . ArgumentURL());
	exit();
}*/
$isConnecte = (isset($_SESSION['mail']));
if ($isDebug){
	echo '<<<<<<<<<<<<<$isConnecte :  '. $isConnecte . '   $_SESSION[mail] :  ' . $_SESSION['mail'];
}	



//A CHANGER :
//$isAdmin = (isset($_SESSION['login']));
$maConnexionLocale = new CConnexionLOCAL($codeMembre, $isDebug, $pageRetour, $serveurRetour);				

if (isset($_GET['isINIT'])){$isINIT = ($_GET['isINIT'] == 'OK');}
if ($isINIT)  {echo "isINIT = " . $_GET['isINIT'] . "<BR>initialisation BDD ...";}


$bdd=InitBDD_MySQI();
$req = $bdd->query("SELECT * FROM photolabmembre WHERE CodeClient='$codeMembre'");  
if ($req->num_rows > 0) {
	$infosMembre = $req->fetch_assoc();	
	$isAdmin = ($infosMembre['IsAdmin'] == 1);	
}
else{
	session_unset();
	session_destroy();
	header('Location: ../index.php' . ArgumentURL());
	exit();
}

if($isDebug){
	header("Cache-Control: no-cache, must-revalidate");
}


?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
	<head>
		<link rel="shortcut icon" type="image/png" href="img/favicon.png">
		<title id="PHOTOLAB">Tableau de bord-PhotoLab</title>
		<link rel="stylesheet" type="text/css" href="css/Couleurs<?php echo ($isDebug?'DEBUG':'PROD'); ?>.css">
		<link rel="stylesheet" type="text/css" href="css/LOGPhotoLab.css">
	<link rel="stylesheet" type="text/css" href="css/Menu.css">
	</head>
<body>
<?php AfficheMenuPage('',$maConnexionLocale); ?>






<div class="dropdown">
<div class="container">

  <div class="half">
    <label for="profile2" class="profile-dropdown">
      <input type="checkbox" id="profile2">
      <img src="img/user.png">
      <span><?php echo $infosMembre['pseudo']; ?></span>
      <label for="profile2"><i class="mdi mdi-menu"></i></label>
      <ul>
        <li><i class="mdi mdi-account"></i><?php echo $infosMembre['mail']; ?></li>
		<li><i class="mdi mdi-account"></i>Code : <?php echo $infosMembre['CodeClient']; ?></li>
		
        <li><a href="LOGModif-Membre.php?modifier"><i class="mdi mdi-settings"></i>Modifier vos informations</a></li>
        <li><a href="LOGDeconnexion.php"><i class="mdi mdi-logout"></i>Déconnection</a></li>
      </ul>
    </label>
  </div>
</div>
</div>

	<div class="logo">
		<a href="DEMOPhotoLab.php"><img src="img/Logo-mini.png" alt="Image de fichier"></a>		
	</div>
<?php
if (isset($_GET['apiID']) && isset($_GET['apiEtat'])) { 
	ChangeEtat($_GET['apiID'], $_GET['apiEtat']);
}
if (isset($_GET['suprID']) ) { 
	SuprimeIDCMD($_GET['suprID']);
} 
if (isset($_GET['IDNote'])  && isset($_GET['datevalidePaiement'])) { 
	ValidationPaiement($_GET['IDNote'], $_GET['datevalidePaiement']);
} 

$Total = 0;
$lesCommandes = AfficherCOMMANDES($Total,'lab');

/*
if ($isConnecte) {
	echo '<p>Hello '. htmlentities(trim($_SESSION['login'])).' : <a href="LOGDeconnexion.php' . ArgumentURL().'">Déconnexion</a>';
}else{
	echo '<p>Non Connecté';
}
*/
if ($isDebug) echo  'MODE DEBUG - Session :: ' . $_SESSION['mail'];


//echo "CODDDDE " . $codeMembre;
//if ($codeMembre) echo '- MODE AMP';	
echo '</p>';
?>

<h1>Tableau de bord - PhotoLab</h1>

<br>

<div class="zoneTable" >
<!-- ////////// FIN de l'HTML Standard ////////// -->


<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'CMDLABO')" id="tabCMDLABO">Commandes au Laboratoire</button>
  <button class="tablinks" onclick="openCity(event, 'CMDWEB')">Fichiers Web pour site Lumys</button>
  <button class="tablinks" onclick="openCity(event, 'NOTEAUTEUR')">Historique Notes d'Auteur</button>
</div>

<div id="CMDLABO" class="tabcontent">
  <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
	<H3><?php 	echo 'Total commandes sélèctionnées: '. $Total . ' €';	?></H3>
  <p></p>
	<table id="commandes">
	  <tr class="header">
		<th style= ><H3>Code</H3></th>
		<th style= ><H3>Date</H3></th>
		<th style="width:50%;" ><H3>Nom de la commande laboratoire</H3></th>
		<th style="width:10%;" ><H3>Planches</H3></th>
		<th style="width:10%;" ><H3>Etat</H3></th>	
	<?php
		if ($isAdmin){
			echo '
				<th style="width:10%;" ><H3>Facturer</H3></th>
				<th style="width:10%;" ><H3>Note</H3></th>
				<th style="width:10%;" ><H3>Suprimer</H3></th>					
			';
		}
	?>
	  </tr>  
	<?php 
	//AfficherCOMMANDES_oldMySQL();
	echo $lesCommandes; 
	/**/
	if ($isINIT) { InitCMD();}
	$lesCommandes = AfficherCOMMANDES($Total,'web');
	?>	 
	</table>
	  <p></p>


</div>

	<div id="CMDWEB" class="tabcontent">
	  <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>


	<p></p>
		<table id="commandes">
		  <tr class="header">
			<th style= ><H3>Code</H3></th>
			<th style= ><H3>Date</H3></th>
			<th style="width:50%;" ><H3>Nom de la commande web</H3></th>
			<th style="width:10%;" ><H3>Planches</H3></th>
			<th style="width:10%;" ><H3>Etat</H3></th>			
		<?php
			if ($isAdmin){
				echo '
					<th style="width:10%;" ><H3>Facturer</H3></th>
					<th style="width:10%;" ><H3>Montant</H3></th>
					<th style="width:10%;" ><H3>Suprimer</H3></th>					
				';
			}
		?>	

		  </tr>  
		<?php 
		//AfficherCOMMANDES_oldMySQL();
		echo $lesCommandes; 
		/**/
		if ($isINIT) { InitCMD();}
		?>	 
		</table>	
			  <p></p>
	</div>


	<div id="NOTEAUTEUR" class="tabcontent">
	  <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>


	  <p></p>
		<table id="noteauteur">
		  <tr class="header">
			<th style= ><H3>Code</H3></th>
			<th><H3>Factures</H3></th>
			<th><H3>Etat</H3></th>
			<th><H3>Montant</H3></th>
			<th><H3>Date</H3></th>
			<th><H3>Payement</H3></th>
		  </tr>  
		  
		<?php 
		echo AfficherLesFactures();
		?>	  
		</table>
			  <p></p>	


	</div>

<br>


<p>©PhotoLab <?php echo $GLOBALS['ANNEE'] ?> Tableau de bord</p>
</div>

<script>

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
//document.getElementById("tabCMDLABO").click();

<?php 
	$tab;
	echo 'document.getElementById("tabCMDLABO").click();';
?>

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

</script>


</body>
</html>