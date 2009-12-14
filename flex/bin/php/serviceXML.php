<?php

include("../config.php");



function exportXML($cat) {
   	$sql = sprintf("SELECT * FROM taniere WHERE categorie='%s'",
   			mysql_real_escape_string($cat));

	// Exécution de la requête
	$result = mysql_query($sql);

	 // Vérification du résultat
	if (!$result) {
		$message  = 'Requete invalide : ' . mysql_error() . "\n";
		$message .= 'Requete complete : ' . $sql;
		die($message);
	}

	while ($row = mysql_fetch_assoc($result)) {
		extract($row);
		print("\t<element>\n");
		print("\t\t<id>$id</id>\n");
		print("\t\t<categorie>$categorie</categorie>\n");
		print("\t\t<objet>\n");
		print("\t\t\t<nom>$nom</nom>\n");
		print("\t\t\t<magie>$qualite</magie>\n");
		print("\t\t</objet>\n");
		print("\t\t<details>$details</details>\n");
		print("\t\t<poids>$poids</poids>\n");
		print("\t\t<prix>$prix</prix>\n");
		print("\t</element>\n");
	}

}





  // Connexion a la base
  $db = mysql_connect($dbhost,$dbuser,$dbpasswd) or die("impossible de se connecter");
  mysql_select_db($dbname, $db);


  print("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");
  
  if(isset($_GET['composant'])) {
    print("<composants>\n");
    exportXML('Composant');
    print("</composants>\n");
  } else if (isset($_GET['equipement'])) {
    print("<equipements>\n");
    exportXML('Arme (1 main)');
    exportXML('Arme (2 mains)');
    exportXML('Armure');
    exportXML('Bottes');
    exportXML('Bouclier');
    exportXML('Casque');
    exportXML('Talisman');
    print("</equipements>\n");
  } else if (isset($_GET['champignon'])) {
    print("<champignons>\n");
    exportXML('Champignon');
    print("</champignons>\n");
  } else if (isset($_GET['parchemin'])) {
    print("<parchemins>\n");
    exportXML('Parchemin');
    print("</parchemins>\n");
  }
  

?>


