<?php
require 'backend/config/db.php';
session_start();

$errors=[];

if (isset($_POST['submit'])){

    if (empty($_POST['titel'])) {
        $errors['titel'] = 'Vul een titel in';
    }
    
    if (empty($_POST['jaar'])) {
        $errors['jaar'] = 'Vul een jaar in';
    }
    
    if (empty($_POST['bandVeld'])) {
        $errors['band'] = 'Vul een instrument in';
    }

    if ($_FILES['cover']['size'] == 0 && $_FILES['cover']['error'] == 0) {

        $cover = $_FILES['cover'];

        $temp = $cover['tmp_name'];
        $naam = $cover['name'];
        $type = $cover['type'];
        $size = $cover['size'];
        $map = 'albums/';
        $existing = $map . basename($naam);
        $afbeelding = $map . $naam;

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
    }

    if ($_FILES['cover']['size'] != 0) {
        $afbeelding = $_POST['origCover'];
    }
    $titel = $_POST['titel'];
    $band = $_POST['bandVeld'];
    $jaar = $_POST['jaar'];
    $info = htmlentities($_POST ['info'], ENT_QUOTES);

    if (count($errors) === 0) {
        if (move_uploaded_file($temp, $map.$naam)) {
            $query = "UPDATE albums SET titel='$titel', id_Band='$band', jaar='$jaar', info='$info', afbeelding='$afbeelding'";
            $bandsql = mysqli_query($link, $query);

            if($bandsql) {
                $succes = "De album $titel is succesvol gewijzigd!";
            } else {
                $errors['tevoegen-gefaald'] = "Gevens zijn verkeerd!";
            }
        }

    }    
} 
?>