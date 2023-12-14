<?php
//DEBUG ?

$isDebug = file_exists ('debug.txt'); // A supprimer ?
if (isset($_POST['isDebug']) ){
	$isDebug = ($_POST['isDebug'] == 'Debug');
}
if (isset($_GET['isDebug'])) { // Test connexion l'API
	$isDebug = ($_GET['isDebug'] == 'Debug');
} 

//if ($isDebug) echo  'MODE DEBUG - Session :: ' . $_SESSION['mail'];
include_once 'BDDInit.php'; ////////////////////

$bdd = InitBDD_PDO();

function nettoyerChaine($string) {
	$string = str_replace(' ', '-', $string);
	$string = preg_replace('/pratique/[^A-Za-z0-9-]/', '', $string);
	return preg_replace('/pratique/-+/', '-', $string);
}
 
if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = md5($_POST['mdp']);
   $mdp2 = md5($_POST['mdp2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) { 
	$pseudolength = strlen($pseudo);   
      if($pseudolength <= 255) {
		 $CodeClient = $pseudo;//"dfdf";
		 //echo = nettoyerChaine($pseudo);
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM photolabmembre WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $longueurKey = 15;
                     $key = "";
                     for($i=1;$i<$longueurKey;$i++) {
                        $key .= mt_rand(0,9);
                     }
                     $insertmbr = $bdd->prepare("INSERT INTO photolabmembre(pseudo, mail, mdp, CodeClient, confirmkey) VALUES(?, ?, ?, ?, ?)");
                     //$insertmbr = $bdd->prepare("INSERT INTO photolabmembre(pseudo, mail, mdp, confirmkey) VALUES(?, ?, ?, ?)"); 
                     $insertmbr->execute(array($pseudo, $mail, $mdp, $CodeClient, $key));
 
                     $header="MIME-Version: 1.0\r\n";
                     $header.='From:"PhotoLab"<contact@photolab-site.fr>'."\n";
                     $header.='Content-Type:text/html; charset="uft-8"'."\n";
                     $header.='Content-Transfer-Encoding: 8bit';
					 $url = ($isDebug?'http://localhost/API_photolab/res/':'https://photolab-site.fr/res/');
                     $message='
                     <html>
                        <body>
							Bonjour '.$pseudo.',<br>
							merci de confirmer la création de votre compte.<br>
                           <div align="center">
							  '.$isDebug.'
                              <a href="'.$url.'LOGConfirmation.php?pseudo='.urlencode($pseudo).'&key='.$key.'">Confirmez votre compte !</a>
                           </div>
                        </body>
                     </html>
                     ';
                     mail($mail, "Confirmation de votre compte PhotoLab", $message, $header);
                     $erreur = "Votre compte PhotoLab a bien été créé ! Vérifiez vos emails pour confirmer.";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
<head>
	<title id="PHOTOLAB">PhotoLab : inscription</title>
    <link rel="stylesheet" type="text/css" href="css/Couleurs<?php echo ($isDebug?'DEBUG':'PROD'); ?>.css">
	<link rel="stylesheet" type="text/css" href="css/LOGInscription.css">
	<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
	<!-- <script type="text/javascript" src="res/js/CATFonctions.js"></script>
	<script type="text/javascript" src="res/APIConnexion.js"></script>	 -->
</head>
<body>

<div class="logo">
	<img src="img/Logo.png" alt="Image de fichier">
</div>
	<h1>Phot<img src="img/Logo-Ultra-mini.png" width="20">Lab <?php echo $GLOBALS['ANNEE'] ?></h1>	
		 <div class="bg-img">
		 
         <form method="POST" action="" class="container">
		 <h3>Inscrivez vous : </h3>
            <table>
               <tr>
                  <td align="right">
                     <label for="pseudo">Pseudo :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail">Mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail2">Confirmation du mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="forminscription" class="btn" value="Je m'inscris" />
                  </td>
               </tr>
            </table>
         </form>
         <?php
         if(isset($erreur))
         {
            echo '		 <div class="msgErreur">'.$erreur."</div>";
         }
         ?>
      </div>
   </body>
</html>
