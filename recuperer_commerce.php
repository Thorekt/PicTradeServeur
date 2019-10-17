<?php
require "./connexion_bdd.php";

function ajouter_commerce($placeid, $nom, $longitude, $latitude){
  $mysqli = connexion_bdd();
  $preparedQuery = $mysqli->prepare("INSERT INTO
                commerce(placeID,nom_commerce,longitude,latitude) values(?,?,?,?)");
  $preparedQuery->bind_param("ssdd",$placeid, $nom, $longitude, $latitude);
  $preparedQuery->execute();
  $preparedQuery->close();
  $mysqli->close();
}

function select_avec_placeID($placeid){
  $mysqli = connexion_bdd();
  $preparedQuery = $mysqli->prepare("SELECT * from commerce where placeID = ?");
  $preparedQuery->bind_param("s",$placeid);
  $preparedQuery->execute();
  $resultat = $preparedQuery->get_result()->fetch_all(MYSQLI_ASSOC);
  $preparedQuery->close();
  $mysqli->close();
  return $resultat;
}

function select_avec_id($id){
  $mysqli = connexion_bdd();
  $preparedQuery = $mysqli->prepare("SELECT * from commerce where id_commerce = ?");
  $preparedQuery->bind_param("i",$id);
  $preparedQuery->execute();
  $resultat = $preparedQuery->get_result()->fetch_all(MYSQLI_ASSOC);
  $preparedQuery->close();
  $mysqli->close();
  return $resultat;
}


$mysqli = connexion_bdd();

if(
  isset($_POST["placeID"],$_POST["nom_commerce"],$_POST["longitude"],$_POST["latitude"])
  )
{

   $resultat = select_avec_placeID($_POST["placeID"]);

   if (sizeof($resultat) == 0){
     ajouter_commerce($_POST["placeID"], $_POST["nom_commerce"], $_POST["longitude"],
                      $_POST["latitude"]);
     $resultat = select_avec_placeID($_POST["placeID"]);

   }


}elseif (isset($_POST["id_commerce"])) {
   $resultat = select_avec_id($_POST["id_commerce"]);
}else{
    echo "<etat>0</etat>";
   exit();
}


$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?><resultat>";
if (sizeof($resultat) == 1){


  $reponse.="<etat>1</etat>";
  $reponse.="<message>BDD OK!</message>";

  $commerceXML = "<commerce ";
  foreach ($resultat[0] as $cle => $valeur) {
    if($cle == "id_commerce"){
      $commerceXML .= $cle.'="'.$valeur.'">';
    }else{
      $commerceXML .= "<".$cle.">";
      $commerceXML .= $valeur;
      $commerceXML .= "</".$cle.">";
    }
  }
  $commerceXML .= "</commerce>";
  $reponse .= $commerceXML;

}else {
  $reponse.="<etat>0</etat>";
  $reponse.="<message>".$mysqli->error."</message>";
}

$reponse.="<nombreDeResultats>".sizeof($resultat)."</nombreDeResultats></resultat>";



$mysqli->close();
echo $reponse;

 ?>
