<?php 

include_once  'CConnexionLOCAL.php';

setlocale(LC_TIME, 'french');


//$google = 'DEMOAccueil.php';



$google = 'https://docs.google.com/document/d/e/2PACX-1vQ4nJnRg6l9qIJGxporl00cYmtacQDDcjvhLNeCUk3A6LPUO5MW-ZMaQNThLHuAC54PWKz1h41YKMDA/pub?embedded=true';


if (isset($_GET['google']) ){
	$google = $_GET['google'];
}

//DEBUG ?

$isDebug = file_exists ('debug.txt'); // A supprimer ?
if (isset($_POST['isDebug']) ){
	$isDebug = ($_POST['isDebug'] == 'Debug');
}
if (isset($_GET['isDebug'])) { // Test connexion l'API
	$isDebug = ($_GET['isDebug'] == 'Debug');
} 
?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
	<head>
		<link rel="shortcut icon" type="image/png" href="img/favicon.png">
		<title id="PHOTOLAB">Aide PhotoLab</title>
		<link rel="stylesheet" type="text/css" href="css/Couleurs<?php echo ($isDebug?'DEBUG':'PROD'); ?>.css">
		<link rel="stylesheet" type="text/css" href="css/LOGPhotoLab.css">
	<link rel="stylesheet" type="text/css" href="css/Menu.css">


<style>

html, body, iframe { height: 100%; }
html { overflow: hidden; text-align: center;}


body {
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

/* Create a column layout with Flexbox */
.row {
  display: flex;
  height: 100%;
}

/* Left column (menu) */
.left {
  flex: 35%;
  padding: 15px 0;
    background-color:var(--boutonRouge);
}

.left h2 {
  padding-left: 8px;
}

/* Right column (page content) */
.right {
  flex: 65%;
  padding: 15px;
  min-width: 1000px;

  background-color:white;

}

/* Style the search box */
#mySearch {
  width: 100%;
  font-size: 18px;
  padding: 11px;
  border: 1px solid #ddd;
}

/* Style the navigation menu inside the left column */
#myMenu {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myMenu li a {
  padding: 12px;
  text-decoration: none;
  color: black;
  display: block
}

#myMenu li a:hover {
  background-color: #eee;
}
</style>
</head>
<body>

<div class="row">
  <div class="left" style="background-color:#bbb;">
  <h1>Phot<img src="img/Logo-Ultra-mini.png" width="20">Lab <?php echo $GLOBALS['ANNEE'] ?>
</h1>
Thématiques conseils aide

<br>
    <h2>Menu</h2>
    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Chercher..." title="Type in a category">
    
	
	
	
	<ul id="myMenu">
      <?php 
				$affiche_Tableau = '';

        // Les fichier pour edition sont  là :
        // G:\Mon Drive\Drive Studio²\03-Production\Specs PhotoLab\Aide-PhotoLab
		
		//% ATTENTION LLes lien doivent etre en mode  EMBED   (Dans Gdoc, Faire Fichier > Partager > Publier sur le web)

				$affiche_Tableau .= LienAide('Présentation PhotoLab'
,'https://docs.google.com/document/d/e/2PACX-1vQ4nJnRg6l9qIJGxporl00cYmtacQDDcjvhLNeCUk3A6LPUO5MW-ZMaQNThLHuAC54PWKz1h41YKMDA/pub?embedded=true');  // Page par defaut


$affiche_Tableau .= LienAide('Essayer PhotoLab avec un set de photos fournies '
,'DEMOAccueil.php');


				$affiche_Tableau .= LienAide('Installation sur PC '
,'https://docs.google.com/document/d/e/2PACX-1vSIyBJVK4vS2D9rnha9nAtjdnF2AE_CfYUR4ZsI93vg8YcDLXWQM2HRB8gdteIo7P80azJE3AVyWzUZ/pub?embedded=true');
                
                $affiche_Tableau .= LienAide('Installation sur MAC '
,'https://docs.google.com/document/d/e/2PACX-1vTeJSM6EA_56R8UwXsOdZ1HE0SzDpt5kumXOW-H_i6C0VScTUsIpvNBgVw1Er41M2g5CRcz4rS9IiV_/pub?embedded=true');


				echo $affiche_Tableau; 
		?>	

    </ul>
  </div>
  
  <div class="right" >
  <iframe src="<?php echo $google ?>" width="980px" scrolling="yes" frameborder="0"></iframe>
    
  </div>
</div>

<script>
function myFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("mySearch");
  filter = input.value.toUpperCase();
  ul = document.getElementById("myMenu");
  li = ul.getElementsByTagName("li");
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>

</body>
</html>

<?php 
function LienAide($Titre,$lienGD) {


	$lienGD = 'DEMOPhotoLab.php'  . '?isDebug=' .($GLOBALS['isDebug'] ? 'Debug' : 'Prod') . '&google=' .urlencode($lienGD)    ;

	return '<li><a href="' . $lienGD . '">' . $Titre . '</a></li>';


    
}
?>