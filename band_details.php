<?php
require 'backend/config/db.php';
session_start();

$bandid = $_GET['id'];

$query = "SELECT * FROM bands WHERE id='$bandid'";
$queryArtiest = "SELECT * FROM artiesten WHERE band='$bandid'";

$resultaat = mysqli_query($link, $query);
$resultaatArtiest = mysqli_query($link, $queryArtiest);

$band = "";
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
      <div class="modal-content col-10 mx-auto p-5">
        <h1 for="" class="text-center">Info</h1><br>
        <table class="table table-striped table-hover">
        <?php
            if (mysqli_num_rows($resultaat) == 0) {
        ?>
                <p class="p-3 mb-2 text-white text-center bg-danger">Sorry! geen bands gevonden in de database</p>
        <?php
            } else {
        ?>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Bandnaam</th>
                    <th scope="col">Muzieksoort</th>
                    <th scope="col">Land</th>
                    <th scope="col">Aantal Leden</th>
                    <th scope="col">Info</th>
                </tr>
            </thead>
            <tbody>
        <?php
                while ($rij = mysqli_fetch_array($resultaat)) {
                    $band = $rij['naam'];
        ?> 
                <tr>
                    <th><?=$rij['naam']; ?></td>
                    <td><?=$rij['muzieksoort']; ?></td>
                    <td><?=$rij['land']; ?></td>
                    <td><?=$rij['aantalLeden']; ?></td>
                    <td><?=$rij['info']; ?></td>
                </tr>
        <?php
                } 
        ?>
            </tbody>
        <?php
            }
        ?>
        </table>

        <table class="table table-striped table-hover">
        <?php
            if (mysqli_num_rows($resultaatArtiest) == 0) {
        ?>
                <p class="p-3 mb-2 text-white text-center bg-danger">Sorry! geen leden gevonden in de database</p>
        <?php
            } else {
        ?>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Artiest</th>
                    <th scope="col">Instrument/Rol</th>
                    <th scope="col">Geboortedatum</th>
                    <th scope="col">Geslacht</th>
                    <th scope="col">Info</th>
                    <th scope="col"> </th>
                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>
        <?php
                while ($rij = mysqli_fetch_array($resultaatArtiest)) {
        ?> 
                <tr>
                    <th><?=$rij['naam']; ?></td>
                    <td><?=$rij['instrument']; ?></td>
                    <td><?=$rij['geboortedatum']; ?></td>
                    <td><?=$rij['geslacht']; ?></td>
                    <td><?=$rij['info']; ?></td>

                    <?php
                        if ($_SESSION['level'] > 0) {
                    ?>
                        <td><a href='artiest_wijzig_verwerk.php?id=<?=$rij['ID_Artiest'];?>'>Pas aan</a></td>
                        <td><a href='artiest__verwijder.php?id=<?=$rij['ID_Artiest'];?>'>Verwijder</a></td>
                    <?php
                        }
                    ?>
                </tr>
                
        <?php
                } 
        ?>
            </tbody>
        <?php
            }
        ?>
        </table>
        <a href="artiest_toevoegen.php?band=<?=$band; ?>" name="artiest" class="float-right btn btn-primary">Artiest Toevoegen</a>
        <a href="band_uitlees.php" name="bands" class="float-right btn btn-secondary">Terug</a>
      </div>
  </body>
</html>