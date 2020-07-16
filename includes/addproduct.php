<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "", "marketdb") OR die("Cannot be connect to this DB");
    if(!isset($_SESSION['Compte']) && $_SESSION['Compte'] == ''){
        header("Location: ../login.php");
    }
    $idUser = $_SESSION['Compte'];

    $sql = mysqli_query($con, "SELECT * FROM login WHERE Compte = '$idUser'");
    while($data = mysqli_fetch_array($sql)){
        $array = [];
        $array[0] = $data['Compte'];
        $array[1] = $data['Nom'];
        $array[2] = $data['Mot_de_passe'];
        $array[3] = $data['Fonction'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market.org/<?php print $array[1];?></title>
    <link rel="shortcut icon" href="../images/loader.gif" type="image/x-icon">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/semantic/semantic.min.css">
    <link rel="stylesheet" href="../js/dist/Chart.min.css">
    <link rel="stylesheet" href="../css/lightbox.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/jquery-3.4.0.min.js"></script>
    <script src="../js/dist/Chart.bundle.min.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/lightbox-plus-jquery.min.js"></script>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top d-flex justify-content-between">
        <a class="navbar-brand float-left" href="index.php">Market kivu</a>      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>   
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Accueil </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="stock.php"><i class="fa fa-database"></i> Stock </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php"><i class="fa fa-users"></i> Personnelles </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="propos.php"><i class="fa fa-comment"></i> A propos </a>
            </li>
          </ul>
        </div>
    </nav>
    <div class="container-fluid m-0" style="min-height: 80vh">
        <div class="row mt-2 justify-content-center">
            <div class="col-md-7 mt-5">
                <a href="../stock.php" class="btn btn-sm btn-warning mt-1 mb-1">Retour <i class="fa fa-arrow-left"></i></a>
                <form action="" method="post" enctype="multipart/form-data">
                    <?php require_once("../config/event.php"); include("../config/errors.php");?>
                    <div class="form-row m-0 p-0">
                        <div class="form-group col-md-12 p-0">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Produit</span>
                                </div>
                                <input type="text" class="form-control" value="<?php print $ID;?>" name="id" placeholder="Id du produit">
                                <input type="text" class="form-control" value="<?php print $nom;?>" name="nom" placeholder="Nom du produit">
                                <input type="text" class="form-control" value="<?php print $quantite;?>" name="quantite" placeholder="Quantite">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 p-0">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">A propos</span>
                            </div>
                            <input type="text" class="form-control" value="<?php print $prixV;?>" name="prixV" placeholder="Prix unitaire de vente">
                            <input type="text" class="form-control" value="<?php print $prix;?>" name="prix" placeholder="Prix unitaire d'achat">
                            <select name="monnaie" class="custom-select">
                                <option selected>Monnaie</option>
                                <option value="Francs">Francs</option>
                                <option value="Dollars">Dollar</option>
                            </select>
                            <select name="parpiece" class="custom-select">
                                <option selected>Par piece</option>
                                <option value="0">Pas Par Piece</option>
                                <option value="1">Par Piece</option>
                            </select>
                        </div>
                    </div>                                    
                    <div class="form-group">
                        <button type="submit" name="ajouter" class="btn btn-sm btn-md btn-xl btn-warning">Enregistre <i class="fa fa-arrow-circle-right" name="ajouter"></i></button>
                    </div>
                </form>
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-secondary">Comment faire ici!!!</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Vous avez la possibilite d'ajoute un nouveau produit et aussi modifie un produit si il y a a modifie, peut etre si vous avez deja le nouveau produit mais qui exite deja dans notre systeme, il vous faut juste modifie! donc vous clicke sur ce button <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button> dans le table a cote de l'article a modifie, et si vous voulez efface un produit de meme vous clicke sur ce <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        </p>
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
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    
</body>
</html>