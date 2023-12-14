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
$isDebug = false;
if (isset($_POST['isDebug']) ){
	$isDebug = ($_POST['isDebug'] == 'Debug');
}
if (isset($_GET['isDebug'])) { // Test connexion l'API
	$isDebug = ($_GET['isDebug'] == 'Debug');
}

session_start();
session_unset();
session_destroy();
header('Location: ../index.php' . ArgumentURL());
exit();
?>


<?php

	/*************************
	*  Page: deconnexion.php
	*  Page encodée en UTF-8
	**************************/

session_start();//session_start() nous permet ici d'appeler toutes les sessions actives de l'utilisateur, enregistrées avec $_SESSION['nom_que_vous_souhaitez']

unset($_SESSION['mail']);//unset() détruit une variable, si vous enregistrez aussi l'id du membre (par exemple) vous pouvez comme avec isset(), mettre plusieurs variables séparés par une virgule:
//unset($_SESSION['pseudo'],$_SESSION['id']);

header("Refresh: 0; url=./");//redirection vers le formulaire de connexion dans 5 secondes
echo "Vous avez été correctement déconnecté du site.<br><br><i>Redirection en cours, vers la page d'accueil...</i>";

?>



