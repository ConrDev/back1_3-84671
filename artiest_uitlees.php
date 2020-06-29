<?php
    require 'backend/config/db.php';
    session_start();

    $query = "SELECT * FROM artiesten";

    $resultaat = mysqli_query($link, $query);

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header('location: ./index.php');
    }

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
        <!-- <h1 for="" class="text-center">Welkom <?=$_SESSION['user']; ?>!</h1><br> -->
        <p for="" class="text-center">Alle artiesten</p><br>
        <table class="table table-striped table-hover">
        <?php
            if (mysqli_num_rows($resultaat) == 0) {
        ?>
                <p class="p-3 mb-2 text-white text-center bg-danger">Sorry! geen artiesten gevonden in de database</p>
        <?php
            } else {
        ?>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Artiest</th>
                    <th scope="col">Instrument/Rol</th>
                    <th scope="col">Geboortedatum</th>
                    <th scope="col">Geslacht</th>
                    <th scope="col">Info</th>
                    <th scope="col">Band</th>
                    <?php
                        if ($_SESSION['level'] > 0) {
                    ?>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                    <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
        <?php
                while ($rij = mysqli_fetch_array($resultaat)) {
                    $artiestBand = $rij['band'];
                    $queryBands = "SELECT * FROM bands WHERE id='$artiestBand'";
                    $resultaatBands = mysqli_query($link, $queryBands);
        ?> 
                <tr>
                    <th scope="row"><?=$rij['ID_Artiest']; ?></th>
                    <th><?=$rij['naam']; ?></td>
                    <td><?=$rij['instrument']; ?></td>
                    <td><?=$rij['geboortedatum']; ?></td>
                    <td><?=$rij['geslacht']; ?></td>
                    <td><?=$rij['info']; ?></td>
                    <?php
                        while ($band = mysqli_fetch_array($resultaatBands)) {
                    ?>
                            <td><a href='band_details.php?id=<?=$artiestBand;?>'><?=$band['naam']; ?></a></td>
                    <?php
                        }
                    ?>
                    <?php
                        if ($_SESSION['level'] > 0) {
                    ?>
                        <td><a href='artiest_wijzig_verwerk.php?id=<?=$rij['ID_Artiest'];?>'>Pas aan</a></td>
                        <td><a href='artiest_verwijder.php?id=<?=$rij['ID_Artiest'];?>'>Verwijder</a></td>
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
        <a href="artiest_toevoegen.php" name="bands" class="float-left btn btn-primary">Artiest Toevoegen</a>
        <a href="band_uitlees.php" name="artiesten" class="float-left btn btn-secondary">Terug</a>
      </div>
  </body>
</html>