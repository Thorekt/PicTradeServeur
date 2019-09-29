<?php
echo "debut\n";
require "./connexion_bdd.php";


$mysqli = connexion_bdd();
$query = "SELECT * FROM commerce;";
$result = $mysqli->query($query);
$row = $result->fetch_all(MYSQLI_ASSOC);
$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
if($row != null){
  $reponse.="<etat>1</etat>";
  $reponse.="<message>BDD OK!</message>";

  $listeCommerceXML = "<listeCommerce>";
  foreach ($row as $commerce) {
    $listeCommerceXML .= "<commerce ";
    foreach ($commerce as $cle => $valeur) {
      if($cle == "id"){
          $listeCommerceXML .= $cle.'="'.$valeur.'">';
      }else{
        $listeCommerceXML .= "<".$cle.">";
        $listeCommerceXML .= $valeur;
        $listeCommerceXML .= "</".$cle.">";
      }
    }
    $listeCommerceXML .= "</commerce>";
  }
  $listeCommerceXML .= "</listeCommerce>";

  $reponse .= $listeCommerceXML;

}else {
  $reponse.="<etat>0</etat>";
  $reponse.="<message>".$mysqli->error."</message>";
}

$mysqli->close();


echo $reponse;

?>
