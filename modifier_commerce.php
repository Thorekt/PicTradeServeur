<?php
require "./connexion_bdd.php";


if(isset($_POST["id"],$_POST["adresse"],$_POST["horaire_ouverture"],$_POST["horaire_fermeture"],$_POST["contact"])){
  $mysqli = connexion_bdd();
  $preparedQuery = $mysqli->prepare("UPDATE commerce
            SET adresse = ? , horaire_ouverture = ?, horaire_fermeture = ?, contact = ?
            WHERE id = ?");
  $preparedQuery->bind_param("ssssi",$_POST["adresse"],$_POST["horaire_ouverture"],$_POST["horaire_fermeture"],$_POST["contact"],$_POST["id"]);
  $preparedQuery->execute();
  $preparedQuery->close();
  $mysqli->close();
}
?>
