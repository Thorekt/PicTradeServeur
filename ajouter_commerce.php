<?php
require "./connexion_bdd.php";

function ajouter_commerce(string $placeid, string $nom,
                        double $longitude, double $latitude){
  $mysqli = connexion_bdd();
  $preparedQuery = $mysqli->prepare("INSERT INTO
                commerce(placeID,nom,longitude,latitude) values(?,?,?,?);");
  $preparedQuery->bind_param("ssdd",$placeid, $nom, $longitude, $latitude);
  $preparedQuery->execute();
  $stmt->close();
  $mysqli->close();
}


 ?>
