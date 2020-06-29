<?php
require 'backend/config/db.php';
// include 'backend/controllers/band_verwijder.php';

$bandid = $_GET['id'];

$query = "SELECT * FROM bands WHERE id='$bandid'";

$resultaat = mysqli_query($link, $query);

$rij = mysqli_fetch_array($resultaat);
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Band</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  </head>
  <body style="background-color: lightgray;">
      <div class="modal-content col-5 mx-auto p-5">
        <h1 for="" class="text-center">Weet je zeker dat je de band <?=$rij['naam']; ?> wilt verwijderen?</h1><br>
        <form class="form-row align-items-center" method="POST" action="band_verwijder_confirm.php?id=<?=$bandid; ?>&naam=<?=$rij['naam']; ?>">
            <div class="form-group col-auto center_div container">
                <button type="submit" name="submit" class="btn btn-success btn-lg">ja</button>
                <a href="band_uitlees.php" class="btn btn-danger btn-lg ">nee</a>
            </div>
        </form>
        
      </div>
  </body>
</html>