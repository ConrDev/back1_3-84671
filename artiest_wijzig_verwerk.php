<?php
include 'backend/controllers/artiest_wijzig.php';

// require 'backend/config/db.php';
// session_start();

$artiestenid = $_GET['id'];

$query = "SELECT * FROM artiesten WHERE ID_Artiest='$artiestenid'";
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
            <form class="form" method="POST" action="artiest_wijzig_verwerk.php?id=<?=$artiestenid; ?>">
                <h1 for="" class="text-center">Wijzig <?=$rij['naam'];?> info!</h1><br>
                <div class="form-group">
                    <label class="font-weight-bold" for="">#</label>
                    <input type="text" class="form-control" name="id" id="id disabledInput" value="<?=$rij['ID_Artiest']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Artiest naam</label>
                    <input type="text" class="form-control" name="artiestnaam" id="artiestnaam" placeholder="" value="<?=$rij['naam']; ?>">
                    <small name="artiestnaamError" id="artiestnaamError" class="form-text text-muted">
                        <?php if (!empty($errors['artiestnaam'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['artiestnaam']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Instrument / Rol</label>
                    <input type="text" class="form-control" name="instrument" id="instrument" placeholder="" value="<?=$rij['instrument']; ?>">
                    <small name="instrumentError" id="instrumentError" class="form-text text-muted">
                        <?php if (!empty($errors['instrument'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['instrument']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Geboortedatum</label>
                    <input type="date" class="form-control" name="gd" id="gd" placeholder="" value="<?=$rij['geboortedatum']; ?>">
                    <small name="gdError" id="gdError" class="form-text text-muted">
                        <?php if (!empty($errors['gd'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['gd']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Geslacht</label>
                    <!-- <input type="number" class="form-control" name="leden" id="leden" placeholder=""> -->
                    <select class="form-control" name="geslacht" id="geslacht">
                        <option value="M">Man</option>
                        <option value="V">Vrouw</option>
                    </select>
                    <small name="geslachtError" id="geslachtError" class="form-text text-muted">
                        <?php if (!empty($errors['geslacht'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['geslacht']; ?>
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
                            <input type="text" class="form-control" name="bandVeld" id="band" placeholder="" value="<?=$_GET['band']; ?>" disabled> 
                    <?php
                        } else {
                    ?>
                            <select class="form-control" name="bandVeld" id="band">
                                <?php
                                    while ($band = mysqli_fetch_array($resultaatBands)) {
                                        echo "<option value=" .$band['id']. ">" .$band['naam']. "</option>";
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
                    <small name="infoError" id="infoError" class="form-text text-muted">
                        <?php if (!empty($errors['info'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['info']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
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
                    <a href="artiest_uitlees.php" name="bands" class="float-left btn btn-secondary">Terug</a>
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