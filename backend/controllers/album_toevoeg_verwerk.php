<?php
session_start();
require 'backend/config/db.php';

$errors = [];

if(isset($_POST["submit"])) {
  if (empty($_POST['titel'])) {
    $errors['titel'] = 'Vul een titel in';
  }

  if (empty($_POST['jaar'])) {
    $errors['jaar'] = 'Vul een jaar in';
  }

  if (empty($_POST['bandVeld'])) {
    $errors['band'] = 'Vul een instrument in';
  }

  // var_dump($_FILES['cover']);

  $cover = $_FILES['cover'];

  $temp = $cover['tmp_name'];
  $naam = $cover['name'];
  $type = $cover['type'];
  $size = $cover['size'];
  $map = 'albums/';
  $existing = $map . basename($naam);

  $imgType = array('image/gif', 'image/png', 'image/jpeg');

  if (file_exists($existing)) {
    $errors['cover'] = 'De cover bestaat al';
  }
  if ($size > 8000000) {
    $errors['cover'] = 'De cover is te groot (max 8 MB)';
  }
  if (!in_array($type, $imgType)) {
    $errors['cover'] = 'De cover is niet het goede type (*.png, *.jpg, *.gif)';
  }

  $titel = $_POST['titel'];
  $band = $_POST['bandVeld'];
  $jaar = $_POST['jaar'];
  $info = htmlentities($_POST ['info'], ENT_QUOTES);

  if (count($errors) === 0) {
      if (move_uploaded_file($temp, $map.$naam)) {
        $query = "INSERT INTO albums SET titel='$titel', id_Band='$band', jaar='$jaar', info='$info', afbeelding='$map$naam'";
        $bandsql = mysqli_query($link, $query);

        if($bandsql) {
            $succes = "Het album $titel is succesvol toegevoegd!";
        } else {
            $errors['tevoegen-gefaald'] = "Gevens zijn verkeerd!";
        }
      }

  }    
}
?>
