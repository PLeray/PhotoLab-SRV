<?php
include_once 'CConnexionLOCAL.php';
include_once  'BDDInit.php'; ////////////////////

session_start();//session_start() combiné à $_SESSION (voir en fin de traitement du formulaire) nous permettra de garder le pseudo en sauvegarde pendant qu'il est connecté, si vous voulez que sur une page, le pseudo soit (ou tout autre variable sauvegardée avec $_SESSION) soit retransmis, mettez session_start() au début de votre fichier PHP, comme ici

$errorMessage = '';

$codeMembre = '';
if (isset($_POST['codeMembre']) ){
	$codeMembre = $_POST['codeMembre'];
}
if (isset($_GET['codeMembre'])) { // Test connexion l'API
	$codeMembre = $_GET['codeMembre'];
}
$isDebug = file_exists ('debug.txt');
if (isset($_POST['isDebug']) ){
	$isDebug = ($_POST['isDebug'] == 'Debug');
}
if (isset($_GET['isDebug'])) { // Test connexion l'API
	$isDebug = ($_GET['isDebug'] == 'Debug');
}
	
$serveurRetour = ''; 
if (isset($_GET['serveurRetour'])) { // Test connexion l'API
	$serveurRetour = urldecode($_GET['serveurRetour']);
}

if (isset($_GET['PourConnexionLOCAL'])){
	$maConnexionLocale = new CConnexionLOCAL($codeMembre,$isDebug,'index', $serveurRetour);				
	$urlAccueil = $maConnexionLocale->AccueilLOCAL();
}else{
	$urlAccueil = 'LOGPhotoLab.php' . ArgumentURL();
}	

//echo '<br>$urlAccueil : ' . $urlAccueil ;

//si une session est déjà "isset" avec ce visiteur, on l'informe:
//$urlAccueil = 'LOGPhotoLab.php' . ArgumentURL();
if(isset($_SESSION['mail']) && ($codeMembre != '')){
	//echo '<br>Test _SESSION[mail]';
	header("Refresh: 0; url=$urlAccueil");//redirection vers le formulaire de connexion dans 5 secondes
	//echo "Vous êtes déjà connecté, vous pouvez accéder à l'espace membre en <a href='espace-membre.php'>cliquant ici</a>.";
} else {
	//echo '<br>PAS Test _SESSION[mail]';
	//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
	if(isset($_POST['valider'])){
		//vérifie si tous les champs sont bien pris en compte:
		if(!isset($_POST['mail'],$_POST['mdp'])){
			echo '<font color="red">Un des champs n\'est pas reconnu.</font>';
		} else {
			//tous les champs sont précisés, on regarde si le membre est inscrit dans la bdd:
			//d'abord il faut créer une connexion à la base de données dans laquelle on souhaite regarder:
			//$mysqli=mysqli_connect('localhost','root','','nom_de_la_base_de_donnees');//'serveur','nom d'utilisateur','pass','nom de la table'
			//$mysqli=InitBDD_MySQI();
			$Bdd=InitBDD_MySQI();
			if(!$Bdd) {
				echo '<font color="red">Erreur connexion BDD</font>';
				//Dans ce script, je pars du principe que les erreurs ne sont pas affichées sur le site, vous pouvez donc voir qu'elle erreur est survenue avec mysqli_error(), pour cela décommentez la ligne suivante:
				//echo "<br>Erreur retournée: ".mysqli_error($Bdd);
			} else {
				//on défini nos variables:
				$mail=htmlentities($_POST['mail'],ENT_QUOTES,"UTF-8");//htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
				$Mdp=md5($_POST['mdp']);
				$req = $Bdd->query("SELECT * FROM photolabmembre WHERE mail='$mail' AND mdp='$Mdp'");  												
				//$req=mysqli_query($mysqli,"SELECT * FROM photolabmembre WHERE mail='$mail' AND mdp='$Mdp'");
				//on regarde si le membre est inscrit dans la bdd:
				if(mysqli_num_rows($req)!=1){
					echo '<font color="red">mail ou mot de passe incorrect.</font>';
				} else {
					$infosMembre = $req->fetch_assoc();
					$codeMembre = $infosMembre['CodeClient'];
					$Bdd->close();	
					
					if (isset($_GET['PourConnexionLOCAL'])){
						$maConnexionLocale = new CConnexionLOCAL($codeMembre,$isDebug,'index', $serveurRetour);					
						$urlAccueil = $maConnexionLocale->AccueilLOCAL();
					}else{
						$urlAccueil = 'LOGPhotoLab.php' . ArgumentURL();
					}		
											
					//mail et mot de passe sont trouvé sur une même colonne, on ouvre une session:
					$_SESSION['mail']=$mail;
					header("Refresh: 0; url=$urlAccueil");//redirection vers le formulaire de connexion dans 5 secondes
					//echo "Vous êtes connecté avec succès $mail! Vous pouvez accéder à l'espace membre en <a href='espace-membre.php'>cliquant ici</a>.";
					$TraitementFini=true;//pour cacher le formulaire
				}
			}
		}
	}
	if(!isset($TraitementFini)){//quand le membre sera connecté, on définira cette variable afin de cacher le formulaire
?>
			
			
			
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>

<head>
	<title id="PHOTOLAB">PhotoLab : accueil</title>
    <!--  --><link rel="stylesheet" type="text/css" href="css/Couleurs.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
		<link rel="stylesheet" type="text/css" href="css/Menu.css">
	<!-- <script type="text/javascript" src="js/CATFonctions.js"></script>
	<script type="text/javascript" src="APIConnexion.js"></script>	 -->
</head>
<!-- <div class="logo">	
		<img src="img/Logo.png" alt="Image de fichier">
	</div> -->

<body>
<?php //if (isset($_GET['PourConnexionLOCAL'])){ AfficheMenuPage('',$maConnexionLocale);} 

//echo $_GET['PourConnexionLOCAL'];?>

	<center>

	<p><a href="<?php echo 'DEMOPhotoLab.php'; ?>"><img src="img/Logo-mini.png" alt="Installation et demonstration de PhotoLab"><br>C'est quoi PhotoLab ?</a></p>

	<h1>Phot<img src="img/Logo-Ultra-mini.png" width="20">Lab <?php echo $GLOBALS['ANNEE'] ?></h1>				
			
	</center>
<div class="bg-img">
  <form method="post" action="index.php<?php if (isset($_GET['PourConnexionLOCAL'])){ echo '?PourConnexionLOCAL=true&serveurRetour='.urlencode($serveurRetour);}?>" class="container">
    <h3>Connectez vous : </h3>

    <label for="email"><b>eMail</b></label>
    <input type="email" name="mail" placeholder="Votre eMail..."  required>

    <label for="psw"><b>Mot de passe :</b></label>
    <input type="password" name="mdp" placeholder="Votre mot de passe..." required>

	<input type="submit" name="valider" class="btn" value="Connexion!">
	<p><br><a href="<?php echo 'LOGInscription.php'; ?>">Création compte</a></p>
  </form>
</div>

<p><?php echo VersionPhotoLab();?> </p>
</body>
</html>	

			
			
<?php
// Fermeture du php avant html
	}
}
?>