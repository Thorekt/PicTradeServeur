<?php
require "./connexion_bdd.php";


if(isset($_POST["id_commerce"],$_POST["image"])){
  $id_commerce = $_POST["id_commerce"];
  $image = $_POST["image"];

  $mysqli = connexion_bdd();
  $preparedQuery = $mysqli->prepare("INSERT INTO
                photo(id_commerce) values(?)");
  $preparedQuery->bind_param("i",$id_commerce);
  $preparedQuery->execute();
  $preparedQuery->close();

  $id_photo = $mysqli->insert_id;

  if(!is_dir("./photo_commerce/".$id_commerce)){
    mkdir("./photo_commerce/".$id_commerce, 0777, true);

      echo "is_dir";
  }else {
    echo "is_NOT_dir";
  }

  $fichierPhoto = fopen("./photo_commerce/".$id_commerce."/".$id_photo.".txt", "w");
  fwrite($fichierPhoto, $image);
  fclose($fichierPhoto);

  $mysqli->close();

  echo "ok";

}else {
  echo "echec";
}




?>
