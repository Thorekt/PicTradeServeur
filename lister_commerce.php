<?php
echo "debut\n";
require "./connexion_bdd.php";


$mysqli = connexion_bdd();
$query = "SELECT * FROM commerce;";
$result = $mysqli->query($query);
$row = $result->fetch_all(MYSQLI_ASSOC);
if($row != null){
  $reponse["etat"] = 1;
  $reponse["donnee"] = $row;
}else {
  $reponse["etat"] = 0;
  $reponse["message"] = $mysqli->error;
}

$mysqli->close();

$listeCommerceXML = "<listeCommerce>";
foreach ($row as $commerce) {
  $listeCommerceXML .= "<commerce>";
  foreach ($commerce as $cle => $valeur) {
      $listeCommerceXML .= "<".$cle.">";
      $listeCommerceXML .= $valeur;
      $listeCommerceXML .= "</".$cle.">";
  }
  $listeCommerceXML .= "</commerce>";
}
$listeCommerceXML .= "</listeCommerce>";

echo $listeCommerceXML;

?>
