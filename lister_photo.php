<?php
require "./connexion_bdd.php";




function select_avec_id($id){
  $mysqli = connexion_bdd();
  $preparedQuery = $mysqli->prepare("SELECT * from photo where id_commerce = ?");
  $preparedQuery->bind_param("i",$id);
  $preparedQuery->execute();
  $resultat = $preparedQuery->get_result()->fetch_all(MYSQLI_ASSOC);
  $preparedQuery->close();
  $mysqli->close();
  return $resultat;
}

if ($_POST["id_commerce"]){
  $id_commerce = $_POST["id_commerce"];
  $resultat = select_avec_placeID($id_commerce);

  $reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?><resultat>";
  if($resultat != null){
    $reponse.="<etat>1</etat>";
    $reponse.="<message>BDD OK!</message>";

    $listeCommerceXML = "<listePhoto id_commerce=".$id_commerce.">";
    foreach ($resultat as $photo) {
      $listeCommerceXML .= "<photo id_photo=".$photo->id_photo">";
      $cheminFichier = $id_commerce."/".$photo->id_id_photo.".txt";
      $fichierPhoto = fopen($cheminFichier,"r");
      $listeCommerceXML.= fread($fichierPhoto,filesize($cheminFichier));
      fclose($fichierPhoto);
      $listeCommerceXML .= "</photo>";
    }
    $listeCommerceXML .= "</listePhoto>";

    $reponse .= $listeCommerceXML;

  }else {
    $reponse.="<etat>0</etat>";
    $reponse.="<message>".$mysqli->error."</message>";
  }

  $reponse.="</resultat>";
}
echo $reponse;


?>
