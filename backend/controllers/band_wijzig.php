<?php
require 'backend/config/db.php';
session_start();

$bandid = "";
$bandnaam = "";
$land = "";
$leden = "";
$muziek = "";
$info = "";
$errors=[];
$succes="";

if (isset($_POST['submit'])){

    if (empty($_POST['band'])) {
        $errors['band'] = 'Vul een bandnaam in';
    }

    if (empty($_POST['land'])) {
        $errors['land'] = 'Vul een land in';
    }

    if (empty($_POST['leden'])) {
        $errors['leden'] = 'Vul aantal leden in';
    }

    if (empty($_POST['muzieksoort'])) {
        $errors['muzieksoort'] = 'Vul een muzieksoort in';
    }
    
    $bandid = $_GET['id'];
    $bandnaam = $_POST['band'];
    $land = $_POST['land'];
    $leden = $_POST['leden'];
    $muziek = $_POST['muzieksoort'];
    $info = htmlentities($_POST ['info'], ENT_QUOTES);

    if (count($errors) === 0) {
        $query = "UPDATE bands SET naam='$bandnaam', land='$land', aantalLeden='$leden', muzieksoort='$muziek', info='$info' WHERE id='$bandid'";
        $bandsql = mysqli_query($link, $query);

        if($bandsql) {
            $succes = "$bandnaam is succesvol gewijzigd!";
        } else {
            $errors['wijzig-gefaald'] = "Wijzegingen mislukt!";
        }
    }    
} 
?>