 <?php
 /*
		$servername = "localhost";
		$username = 'id4963524_admin';
		$password = '0314delphine314';
		$dbname = 'id4963524_photolab';	

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$result = $conn->query('SELECT * FROM PhotolabCMD WHERE FACTURE = 0 ORDER BY DATECMD DESC');  

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["NOMCOMMANDE"]. " - Name: " . $row["ID"]. " " . $row["DATECMD"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

*/


$tot = 4;
echo AfficherCOMMANDES($tot);
echo 'AfficherCOMMANDES($tot)';



function AfficherCOMMANDES(&$Total){
		$servername = "localhost";
		$username = 'id4963524_admin';
		$password = '0314delphine314';
		$dbname = 'id4963524_photolab';	
		
	try	{// On se connecte à MySQL
		// Create connection
		$bdd = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($bdd->connect_error) {
			die("Connection failed: " . $bdd->connect_error);
		} 
		
	}
	catch(Exception $e)	{// En cas d'erreur, on affiche un message et on arréte tout
		die('Erreur : '.$e->getMessage());
	}




	$reponse = $bdd->query('SELECT * FROM PhotolabCMD WHERE FACTURE = 0 ORDER BY DATECMD DESC');  

	if ($reponse->num_rows > 0) {
		// output data of each row
		while($donnees = $reponse->fetch_assoc()) {
			$NomCMD = substr($donnees['NOMCOMMANDE'], 11) ;
			$EtatFacture = $donnees['FACTURE'];
			$Etat = $donnees['ETAT'];
			$ID = $donnees['ID'];
			$Prix =  0.2 * $donnees['NBPLANCHES'] ;
			if (($Etat == 1) && ($EtatFacture == 0)){$Total = $Total + $Prix;}
			$newDate = strftime("%A %d %b %Y",strtotime($donnees['DATECMD'])); //date("l d m Y", strtotime($donnees['DATECMD']));
			$affiche_Tableau .=
			'<tr>
				<td><a href="#" title="voir '. $NomCMD . '">' . $newDate . '</a></td>
				<td><a href="#" title="voir '. $NomCMD . '">' . $NomCMD . '</a></td>
				<td><a href="#">' . $donnees['NBPLANCHES'] . '</a></td>
			</tr>';
		}
	} else {
		echo "0 results";
	}
	$bdd->close();	
	return $affiche_Tableau;		
}


?> 