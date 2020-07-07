<?php
include 'backend/controllers/artiest_wijzig.php';

// require 'backend/config/db.php';
// session_start();

$albumid = $_GET['id'];

$query = "SELECT * FROM albums WHERE id='$albumid'";
$queryBands = "SELECT * FROM bands";

$resultaat = mysqli_query($link, $query);
$resultaatBands = mysqli_query($link, $queryBands);

$errors=[];
?>

<html lang="en">
  <head>
    <title>Artiest</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  </head>
  <body style="background-color: lightgray;">
      <div class="modal-content col-5 mx-auto p-5">
        <?php
            if (mysqli_num_rows($resultaat) == 0) {
        ?>
                <p class="p-3 mb-2 text-white text-center bg-danger">Er is niks om te laten zien kom later terug.</p>
        <?php
            } else {
               $rij = mysqli_fetch_array($resultaat);
        ?>
            <form class="form" method="POST" action="album_wijzig_verwerk.php?id=<?=$albumid; ?>">
                <h1 for="" class="text-center">Wijzig <?=$rij['titel'];?> info!</h1><br>
                <div class="form-group">
                    <label class="font-weight-bold" for="">#</label>
                    <input type="text" class="form-control" name="id" id="id disabledInput" value="<?=$rij['id']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Cover</label>
                    <input type="file" class="form-control" name="cover" id="cover" placeholder="" accept="image/png, image/jpeg, image/gif">
                    <input type="hidden" name="origCover" value="<?=$rij['afbeelding']; ?>">
                    <img src="<?=$rij['afbeelding']; ?>" width="300" height="300">
                    <small name="coverError" id="coverError" class="form-text text-muted">
                        <?php if (!empty($errors['cover'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['cover']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Titel</label>
                    <input type="text" class="form-control" name="titel" id="titel" placeholder="" value="<?=$rij['titel']; ?>">
                    <small name="titelError" id="titelError" class="form-text text-muted">
                        <?php if (!empty($errors['titel'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['titel']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">jaar</label>
                    <input type="number" class="form-control" name="jaar" id="jaar" placeholder="" value="<?=$rij['jaar']; ?>">
                    <small name="jaarError" id="jaarError" class="form-text text-muted">
                        <?php if (!empty($errors['jaar'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['jaar']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Band</label>
                    <!-- <input type="text" class="form-control" name="muzieksoort" id="muzieksoort" placeholder=""> -->
                    <?php
                        if (isset($_GET['band'])) {
                    ?>
                            <input type="text" class="form-control" name="bandVeld" id="band" value="<?=$_GET['id']; ?>" placeholder="<?=$_GET['band']; ?>" disabled> 
                    <?php
                        } else {
                    ?>
                            <select class="form-control" name="bandVeld" id="band">
                                <?php
                                    while ($rijBand = mysqli_fetch_array($resultaatBands)) {
                                        echo "<option value=" .$rijBand['id']. ">" .$rijBand['naam']. "</option>";
                                    }
                                ?>
                            </select>
                    <?php
                        }
                    ?>
                    <small name="bandError" id="bandError" class="form-text text-muted">
                        <?php if (!empty($errors['band'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['band']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Algemene info</label>
                    <textarea class="form-control" name="info" id="info" rows="3"><?=$rij['info']; ?></textarea>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Wijzig</button>
                    <small name="succes" id="succes" class="form-text text-muted">
                        <?php if (!empty($succes) && count($errors) === 0) : ?>
                            <div class="alert alert-success">
                                <li>
                                <?php echo $succes; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                    <a href="albums_uitlees.php" name="bands" class="float-left btn btn-secondary">Terug</a>
            </form>
        <?php
            }
        ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>