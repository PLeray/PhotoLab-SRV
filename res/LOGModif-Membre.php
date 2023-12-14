<?php
include_once 'BDDInit.php'; ////////////////////
	/*************************
	*  Page: Modif-membre.php
	*  Page encodée en UTF-8
	**************************/

session_start();//session_start() combiné à $_SESSION (voir en fin de traitement du formulaire) nous permettra de garder le mail en sauvegarde pendant qu'il est connecté, si vous voulez que sur une page, le mail soit (ou tout autre variable sauvegardée avec $_SESSION) soit retransmis, mettez session_start() au début de votre fichier PHP, comme ici
if(!isset($_SESSION['mail'])){
	header("Refresh: 0; url=index.php");//redirection vers le formulaire de connexion dans 5 secondes
	echo "Vous devez vous connecter pour accéder à l'espace membre.<br><br><i>Redirection en cours, vers la page de connexion...</i>";
	exit(0);//on arrête l'éxécution du reste de la page avec exit, si le membre n'est pas connecté
}
$mail=$_SESSION['mail'];//on défini la variable $mail (Plus simple à écrire que $_SESSION['mail']) pour pouvoir l'utiliser plus bas dans la page

//on se connecte une fois pour toutes les actions possible de cette page:
//$mysqli=mysqli_connect('localhost','root','','nom_de_la_base_de_donnees');//'serveur','nom d'utilisateur','pass','nom de la table'

$mysqli=InitBDD_MySQI();
/*
if(!$mysqli) {
	echo "Erreur connexion BDD";
	//Dans ce script, je pars du principe que les erreurs ne sont pas affichées sur le site, vous pouvez donc voir qu'elle erreur est survenue avec mysqli_error(), pour cela décommentez la ligne suivante:
	//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
	exit(0);
}
*/
//on récupère les infos du membre si on souhaite les afficher dans la page:
//$req=mysqli_query($mysqli,"SELECT * FROM photolabmembre WHERE mail='$mail'");
$req = $mysqli->query("SELECT * FROM photolabmembre WHERE mail='$mail'");  

//$infosMembre=mysqli_fetch_assoc($req);
$infosMembre = $req->fetch_assoc()

?>


<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Modif membre</title>

</head>
<body>

<h2>Espace membre</h2>
<p>Infos du membre :</p>


		<?php
		echo "['pseudo'] : " . $infosMembre['pseudo'] .'<br>';
		echo "['mail'] : " . $infosMembre['mail'] .'<br>';
		



		//si "?modifier" est dans l'URL:
		if(isset($_GET['modifier'])){
			?>
			<h1>Modification du compte</h1>
			Choisissez une option: 
			<p>
				<a href="Modif-membre.php?modifier=mail">Modifier l'adresse mail</a>
				<br>
				<a href="Modif-membre.php?modifier=mdp">Modifier le mot de passe</a>
			</p>
			<hr/>
			<?php
			if($_GET['modifier']=="mail"){
				echo "<p>Renseignez le formulaire ci-dessous pour modifier vos informations:</p>";
				if(isset($_POST['valider'])){
					if(!isset($_POST['mail'])){
						echo "Le champ mail n'est pas reconnu.";
					} else {
						if(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,30}$#i",$_POST['mail'])){
							//cette preg_match est un petit peu complexe, je vous invite à regarder l'explication détaillée sur mon site c2script.com
							echo "L'adresse mail est incorrecte.";
							//normalement l'input type="email" vérifie que l'adresse mail soit correcte avant d'envoyer le formulaire mais il faut toujours être prudent et vérifier côté serveur (ici) avant de valider définitivement
						} else {
							//tout est OK, on met à jours son compte dans la base de données:

							if(mysqli_query($mysqli,"UPDATE photolabmembre SET mail='".htmlentities($_POST['mail'],ENT_QUOTES,"UTF-8")."' WHERE mail='$mail'")){
								echo "Adresse mail {$_POST['mail']} modifiée avec succès!" ;
								echo '<a href="deconnexion.php">cliquez ici pour vous reconnecter !!!</a>';
								$TraitementFini=true;//pour cacher le formulaire
							} else {
								echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
								//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
							}
						}
					}
				}
				if(!isset($TraitementFini)){
					?>
					<br>
					<form method="post" action="Modif-membre.php?modifier=mail">
					<label>Nouvel e-mail :</label>					
						<input type="email" name="mail" value="<?php echo $infosMembre['mail']; ?>" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
						<input type="submit" name="valider" value="Valider la modification">
					</form>
					<?php
				}
			} elseif($_GET['modifier']=="mdp"){
				echo "<p>Renseignez le formulaire ci-dessous pour modifier vos informations:</p>";
				//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
				if(isset($_POST['valider'])){
					//vérifie si tous les champs sont bien pris en compte:
					if(!isset($_POST['nouveau_mdp'],$_POST['confirmer_mdp'],$_POST['mdp'])){
						echo "Un des champs n'est pas reconnu.";
					} else {
						if($_POST['nouveau_mdp']!=$_POST['confirmer_mdp']){
							echo "Les mots de passe ne correspondent pas.";
						} else {
							$Mdp=md5($_POST['mdp']);
							$NouveauMdp=md5($_POST['nouveau_mdp']);
							$req=mysqli_query($mysqli,"SELECT * FROM photolabmembre WHERE mail='$mail' AND mdp='$Mdp'");
							//on regarde si le mot de passe correspond à son compte:
							if(mysqli_num_rows($req)!=1){
								echo "Mot de passe actuel incorrect.";
							} else {
								//tout est OK, on met à jours son compte dans la base de données:
								if(mysqli_query($mysqli,"UPDATE photolabmembre SET mdp='$NouveauMdp' WHERE mail='$mail'")){
									echo "Mot de passe modifié avec succès!";
									$TraitementFini=true;//pour cacher le formulaire
								} else {
									echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
									//echo "<br>Erreur retournée: ".mysqli_error($mysqli);
								}
							}
						}
					}
				}
				if(!isset($TraitementFini)){
					?>
					<br>
					<form method="post" action="Modif-membre.php?modifier=mdp">
					<label>Nouveau Mot de passe :</label>
						<input type="password" name="nouveau_mdp" placeholder="Nouveau mot de passe..." required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
					<label>Confirmer nouveau Mot de passe :</label>
						<input type="password" name="confirmer_mdp" placeholder="Confirmer nouveau passe..." required>
					<label>Mot de passe actuel :</label>						
						<input type="password" name="mdp" placeholder="Votre mot de passe actuel..." required>
						<input type="submit" name="valider" value="Valider la modification">
					</form>
					<?php
				}
			}
		}
		$mysqli->close();
		?>
		
		
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
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