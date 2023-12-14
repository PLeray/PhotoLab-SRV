<?php

include_once 'BDDInit.php'; ////////////////////

////////////////////////////// APIConnexion LOCAL //////////////////////////////////////////////
class CConnexionLOCAL {
	var $codeMembre;
	var $isDebug;
	var $Service;
    var $URL;
	var $Domaine;
	var $Bdd;
	var $login;
	var $mdp;	
	var $PageRetour;		
	
    function __construct($codeMembre, $isDebug, $PageRetour, $serveurRetour){
		$this->codeMembre = $codeMembre;
		$this->isDebug = $isDebug;
		$this->PageRetour = $PageRetour;
        if ($codeMembre != ''){
			$Bdd=InitBDD_MySQI();
            $sreqSQL = 'SELECT * FROM photolabmembre WHERE CodeClient = "' . $codeMembre . '"' ; 
			$req = $Bdd->query($sreqSQL );  
			$infosMembre = $req->fetch_assoc();
            if ($serveurRetour == ''){            
                $this->URL = $infosMembre['URLLocal'];   // De la Base de Donnée
                if ($isDebug){		
                    echo '<br>RECUP URL localhost de la BDD : ' . $this->URL;
                }                
            }
            else{
                $this->URL = $serveurRetour;
                //update !
                    $sreqSQL = 'UPDATE photolabmembre SET URLLocal = "'. $serveurRetour . '" WHERE CodeClient = "' . $codeMembre . '"' ; 
                    if (($Bdd->query($sreqSQL) === TRUE) == false) {
                        echo "Error updating record: " . $Bdd->error;
                    }
                    $this->URL = $serveurRetour;
            }
			$Bdd->close();		
            
        }
        else {            		
			$this->URL = 'PAS URL !!!';	
        }
        //$this->Service = '/Code/res/CATPhotolab.php';	
		$this->Service = '/Code/res/' . $this->PageRetour . '.php';
	
    }
    function AdresseLOCAL($CMDLocal){
		$cmd = '?codeMembre=' . $this->codeMembre . '&versionDistante=' . $GLOBALS['VERSIONSERVEUR'] . '&isDebug=' .($this->isDebug ? 'Debug' : 'Prod');
        return $this->URL . $this->Service . $cmd . $CMDLocal;
    }

    function AccueilLOCAL(){
        return $this->URL . '/Code/res/index.php' . ArgumentURL() ;
    } 
    function CatalogueLOCAL(){
        return $this->URL . '/Code/res/CATListeCatalogues.php' . ArgumentURL() ;
    }     
    function SourceLOCAL(){
		return $this->URL . '/Code/res/CATSources.php' . ArgumentURL() ;
    } 	    
    function CommandesLOCAL(){
		return $this->URL . '/Code/res/CATPhotolab.php' . ArgumentURL() ;
    } 	
    function HistoriqueLOCAL(){
		return $this->URL . '/Code/res/CATHistorique.php' . ArgumentURL() ;
    } 	
    function ConnectBDD(){
        return $Bdd;
    } 	
    /*function TalkServeurSUPR($CMDLocal){
        return 'res/LOGtalkServeur.php' . $CMDLocal;
    } 	*/
}
//$GLOBALS['maConnexionLocale']

function AfficheMenuPage($Page,$maConnexionLocale) {
    $menuPage = '<center>
            <div id="mySidenav">';
    $menuPage .= '<a href="'. $maConnexionLocale->SourceLOCAL().'" id="sourcePhotos" title="Sources des photos par écoles ...">
        <span class="titreMenu"><br>Photos par écoles</span></a>';
    $menuPage .= '<a href="'. $maConnexionLocale->CatalogueLOCAL().'" id="listeCatalogues" title="Catalogues de produits ...">
        <span class="titreMenu">Catalogues de produits</span></a>';    
    $menuPage .= '<a href="'. $maConnexionLocale->AccueilLOCAL().'" id="ajoutCommandeGroupee" title="Ajouter une commande groupée ...">
        <span class="titreMenu">Ajouter des commandes</span></a>';    
    $menuPage .= '<a href="'. $maConnexionLocale->CommandesLOCAL().'" id="commandesEnCours" title="Commandes en cours de préparation ...">
    <span class="titreMenu">Gestion commandes</span></a>';
    $menuPage .= '<a href="'. $maConnexionLocale->HistoriqueLOCAL().'" id="commandesExpediees" title="Historique des commandes expediées ...">
    <span class="titreMenu">Commandes livrées</span></a>';
    $menuPage .= '<a href="LOGPhotoLab.php' . ArgumentURL().'" class="actif" id="administration" title="Administration ...">
    <span class="titreMenu">Adminitration PhotoLab</span></a>';
    $menuPage .= '</div>
          </center>';
    echo $menuPage;          
    }

?>