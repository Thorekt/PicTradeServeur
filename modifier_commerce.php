<?php
require "./connexion_bdd.php";


if(isset($_POST["id_commerce"],$_POST["adresse"],$_POST["horaire_ouverture"],$_POST["horaire_fermeture"],$_POST["contact"])){
  $mysqli = connexion_bdd();
  $preparedQuery = $mysqli->prepare("UPDATE commerce
            SET adresse = ? , horaire_ouverture = ?, horaire_fermeture = ?, contact = ?
            WHERE id_commerce = ?");
  $preparedQuery->bind_param("ssssi",$_POST["adresse"],$_POST["horaire_ouverture"],$_POST["horaire_fermeture"],$_POST["contact"],$_POST["id_commerce"]);
  $preparedQuery->execute();
  $preparedQuery->close();
  $mysqli->close();
  echo "<etat>1</etat>";
}else {
  echo "<etat>0</etat>";
}
?>
