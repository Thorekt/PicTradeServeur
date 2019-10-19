<?php
require "./connexion_bdd.php";

$mysqli = connexion_bdd();

$reponse = "<?xml version=\"1.0\" encoding=\"utf-8\"?><resultat>";
if (isset($_POST["id_commerce"])){
  $id_commerce = $_POST["id_commerce"];


  $preparedQuery = $mysqli->prepare("SELECT * from photo where id_commerce = ?");
  $preparedQuery->bind_param("i",$id_commerce);
  $preparedQuery->execute();
  $resultat = $preparedQuery->get_result()->fetch_all(MYSQLI_ASSOC);
  $preparedQuery->close();


  if($resultat != null){
    $reponse.="<etat>1</etat>";
    $reponse.="<message>BDD OK!</message>";

    $listePhotoXML = "<listePhoto id_commerce=".$id_commerce.">";
    foreach ($resultat as $photo) {
      $listePhotoXML .= "<photo id_photo=".$photo[id_photo].">";
      $listePhotoXML .= "<image>";
      $cheminFichier = "photo_commerce/".$id_commerce."/".$photo[id_photo].".txt";

      $fichierPhoto = fopen($cheminFichier,"r");

      $listePhotoXML.= fread($fichierPhoto,filesize($cheminFichier));
      fclose($fichierPhoto);
      $listePhotoXML .= "</image>";
      $listePhotoXML .= "</photo>";
    }
    $listePhotoXML .= "</listePhoto>";

    $reponse .= $listePhotoXML;

  }else {
    $reponse.="<etat>0</etat>";
    $reponse.="<message>".$mysqli->error." ou pas de photos</message>";
  }

}else {
  $reponse.="<etat>0</etat>";
  $reponse.="<message>id_commerce pas set</message>";
}

$mysqli->close();

$reponse.="</resultat>";
echo $reponse;


?>
