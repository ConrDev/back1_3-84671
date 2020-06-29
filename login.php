<?php include 'backend/controllers/users.php'; 

if(isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
    header('location: index.php');
}
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  </head>
  <body style="background-color: lightgray;">
      <div class="modal-content col-5 mx-auto p-5">
            <form class="form" method="post" action="./login.php">
                <h1 for="" class="text-center">Login</h1><br>
                <div class="form-group">
                    <label for="">Gebruikersnaam</label>
                    <input type="text" class="form-control" name="naam" id="naam" placeholder="">
                    <small name="naamError" id="naamError" class="form-text text-muted">
                        <?php if (!empty($errors['naam'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['naam']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="">Wachtwoord</label>
                    <input type="password" class="form-control" er name="wachtwoord" id="wachtwoord" placeholder="">
                    <small name="wachtwoordError" id="wachtwoordError" class="form-text text-muted">
                        <?php if (!empty($errors['wachtwoord'])) : ?>
                            <div class="alert alert-danger">
                                <li>
                                <?php echo $errors['wachtwoord']; ?>
                                </li>
                            </div>
                        <?php endif; ?>
                    </small>
                </div>
                <button name="login" type="submit" class="btn btn-primary">Login</button>
            </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>