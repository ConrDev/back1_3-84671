<?php
require 'backend/config/db.php';
session_start();

$artiestid = "";
$artiestnaam = "";
$instrument = "";
$gd = "";
$geslacht = "";
$band = "";
$info = "";
$errors=[];
$succes="";

if (isset($_POST['submit'])){

    if (empty($_POST['artiestnaam'])) {
        $errors['artiestnaam'] = 'Vul een artiest naam in';
    }

    if (empty($_POST['instrument'])) {
        $errors['instrument'] = 'Vul een instrument in';
    }

    if (empty($_POST['gd'])) {
        $errors['gd'] = 'Vul een geboortedatum in';
    }

    if (empty($_POST['geslacht'])) {
        $errors['geslacht'] = 'Vul geslacht in';
    }

    if (empty($_POST['bandVeld'])) {
        $errors['bandVeld'] = 'Kies een band';
    }
    
    $artiestid = $_GET['id'];
    $artiestnaam = $_POST['artiestnaam'];
    $instrument = $_POST['instrument'];
    $gd = $_POST['gd'];
    $geslacht = $_POST['geslacht'];
    $band = $_POST['bandVeld'];
    $info = htmlentities($_POST ['info'], ENT_QUOTES);

    if (count($errors) === 0) {
        $query = "UPDATE artiesten SET naam='$artiestnaam', instrument='$instrument', geboortedatum='$gd', geslacht='$geslacht', info='$info', band='$band' WHERE ID_Artiest='$artiestid'";
        $bandsql = mysqli_query($link, $query);

        if($bandsql) {
            $succes = "$artiestnaam is succesvol gewijzigd!";
        } else {
            $errors['wijzig-gefaald'] = "Wijzegingen mislukt!";
        }
    }    
} 
?>