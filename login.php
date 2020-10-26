<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market.org</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/semantic/semantic.min.css">
    <link rel="stylesheet" href="./js/dist/Chart.min.css">
    <link rel="stylesheet" href="./css/lightbox.min.css">
    <script src="./js/jquery-3.4.0.min.js"></script>
    <script src="./js/dist/Chart.bundle.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/lightbox-plus-jquery.min.js"></script>
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <div class="row justify-content-center mt-5">
            <div class="col-md-3 col-sm-12 col-lg-3 p-2">
                <div class="card shadow">
                    <h3 class="text-center text-warning p-0 my-3">Market kivu</h3>
                    <div class="card-body">
                        <?php require_once("./config/config.php"); ?>
                        <?php include("./config/errors.php"); ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Nom du Compte</label>
                                <input type="text" value="<?php print $username; ?>" name="username" id="username"
                                    class="form-control" placeholder="Nom du compte">
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" value="<?php print $pass; ?>" name="password" id="password"
                                    placeholder="Mot de passe" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login" class="btn btn-md btn-primary btn-block">
                                    Log In
                                    <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>