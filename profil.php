<?php include("security.hacker.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market.org/<?php print $array[1]; ?></title>
    <link rel="shortcut icon" href="./images/loader.gif" type="image/x-icon">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/semantic/semantic.min.css">
    <link rel="stylesheet" href="./js/dist/Chart.min.css">
    <link rel="stylesheet" href="./css/lightbox.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery-3.4.0.min.js"></script>
    <script src="./js/dist/Chart.bundle.min.js"></script>
    <script src="./js/all.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/lightbox-plus-jquery.min.js"></script>
</head>

<body class="bg-img bg-img1">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top d-flex justify-content-between">
        <a class="navbar-brand float-left" href="index.php">Market kivu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stock.php"><i class="fa fa-database"></i> Stocket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php"><i class="fa fa-users"></i> Personnelles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="profile.php"><i class="fa fa-user"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="propos.php"><i class="fa fa-comment"></i> A propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./includes/logout.php"><i class="icon logout"></i> Se deconnecte</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid m-0" style="min-height: 82vh;">
        <div class="row justify-content-center">
            <div class="col-md-5 col-sm-12 col-lg-6 mt-3 bg-light border-radius p-1 shadow">
                <p class="text-center display-4">
                    Profile
                    <input type="hidden" id="MyAccount" value="<?php print $array[0]; ?>">
                </p>

            </div>
        </div>
        <div id="myAccount"></div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 col-lg-6 mt-3 shadow bg-light p-2">
                <h3 class="text-warning text-center">Modifie compte</h3>
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <form action="" method="post">
                                <?php
                                if (isset($_POST['btnName'])) {
                                    $id = htmlentities(mysqli_real_escape_string($con, trim($_POST['myId'])));
                                    $name = htmlentities(mysqli_real_escape_string($con, trim($_POST['name'])));

                                    if (empty($name)) {
                                        print '<p class="alert alert-warning ui success message">Le champ de nom est vide</p>';
                                    }

                                    if (!empty($name)) {
                                        $sqlName = mysqli_query($con, "UPDATE `login` SET Nom = '$name' WHERE id = '$id'");
                                        if ($sqlName) {
                                            print '<p class="alert alert-warning ui success message">Modification a reussi</p>';
                                        } else {
                                            print '<p class="alert alert-warning ui error message">Modification a Echoue</p>';
                                        }
                                    }
                                }
                                ?>
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input type="hidden" name="myId" value="<?php print $array[0]; ?>"
                                        class="form-control">
                                    <input type="text" name="name" id="name" value="<?php print $array[2]; ?>"
                                        class="form-control" placeholder="Entre votre nom">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="btnName"
                                        class="ui button labeled icon bg-warning text-light">Edit <i
                                            class="icon refresh"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <form action="" method="post">
                                <?php
                                if (isset($_POST['btnCompte'])) {
                                    $id = htmlentities(mysqli_real_escape_string($con, trim($_POST['myId'])));
                                    $compte = htmlentities(mysqli_real_escape_string($con, trim($_POST['compte'])));

                                    if (empty($compte)) {
                                        print '<p class="alert alert-warning ui success message">Le champ de nom est vide</p>';
                                    }

                                    if (!empty($compte)) {
                                        $sqlcompte = mysqli_query($con, "UPDATE `login` SET Compte = '$compte' WHERE id = '$id'");
                                        if ($sqlcompte) {
                                            print '<p class="alert alert-warning ui success message">Modification a reussi</p>';
                                        } else {
                                            print '<p class="alert alert-warning ui error message">Modification a Echoue</p>';
                                        }
                                    }
                                }
                                ?>
                                <div class="form-group">
                                    <label for="name">Compte</label>
                                    <input type="hidden" name="myId" value="<?php print $array[0]; ?>"
                                        class="form-control">
                                    <input type="text" name="compte" id="compte" value="<?php print $array[1]; ?>"
                                        class="form-control" placeholder="Entre nom de compte">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="btnCompte"
                                        class="ui button labeled icon bg-warning text-light">Edit <i
                                            class="icon refresh"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <form action="" method="post">
                                <input type="hidden" name="myId" value="<?php print $array[0]; ?>" class="form-control">
                                <div class="form-group">
                                    <?php
                                    if (isset($_POST['btnFonction'])) {
                                        $id = htmlentities(mysqli_real_escape_string($con, trim($_POST['myId'])));
                                        $fonction = htmlentities(mysqli_real_escape_string($con, trim($_POST['fonction'])));

                                        if (empty($fonction)) {
                                            print '<p class="alert alert-warning ui success message">selectione une fonction</p>';
                                        }

                                        if (!empty($fonction)) {
                                            $sqlfonction = mysqli_query($con, "UPDATE `login` SET Fonction = '$fonction' WHERE id = '$id'");
                                            if ($sqlfonction) {
                                                print '<p class="alert alert-warning ui success message">Modification a reussi</p>';
                                            } else {
                                                print '<p class="alert alert-warning ui error message">Modification a Echoue</p>';
                                            }
                                        }
                                    }
                                    ?>
                                    <label for="fonction">Fonction</label>
                                    <select name="fonction" id="fonction" class="custom-select">
                                        <option value="">-- selection --</option>
                                        <option value="Comptable">Comptable</option>
                                        <option value="Logisticien">Logisticien</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Comptoir">Comptoir</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="btnFonction"
                                        class="ui button labeled icon bg-warning text-light">Edit <i
                                            class="icon refresh"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid text-light bg-dark m-0 footer">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center p-5">
                <p>Marketkivu.com</p>
                <small>copyright Commerciale &copy; 2020</small>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Password">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-primary">Ajouter Personnelle</h4>
                    <button type="button" class="ui btn  btn-sm close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="admin">Nouveau</label>
                        </div>
                        <div class="form-group">
                            <button type="button" id="AjouterPersonnel"
                                class="btn d-flex justify-content-between align-items-center btn-md btn-block btn-primary">Enregistre
                                <i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</body>

<script>
$(document).ready(function() {
    profile();
})

function profile() {
    let id = $('#MyAccount').val();
    let action = 'profile';
    $.ajax({
        url: './config/event.php',
        method: 'post',
        data: {
            action: action,
            id: id
        },
        success: function(data) {
            $('#myAccount').html(data)
        }
    })
}
</script>

</html>