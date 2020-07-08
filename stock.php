<?php
    session_start();
    $output = '';
    include("./config/db.min.php");
    if(!isset($_SESSION['Compte']) && $_SESSION['Compte'] == ''){
        header("Location: login.php");
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
<body class="bg-white">
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
    
    <div class="container-fluid p-0 m-0" style="min-height: 80vh;">
        <div class="row p-3">
            <?php if(isset($_GET['edit'])):?>
                <?php
                    $id = $_GET['edit'];
                    $selectProduct = mysqli_query($con, "SELECT * FROM savingproduct WHERE id_product = '$id'");
                    
                    if(@mysqli_num_rows($selectProduct) == 1){
                        while($row = mysqli_fetch_array($selectProduct)){
                            $array = [];
                            $array[0] = $row['id_product'];
                            $array[1] = $row['Par_Piece'];
                            $array[2] = $row['Monnaie'];
                            $output .= '
                            <div class="card shadow">
                                <div class="card-header p-1">
                                    <h3 class="text-warning m-0 p-0">'.$row['Nom'].'</h3>
                                </div>
                                <div class="card-body">
                                    
                                    <form action="" method="post">
                                        <div class="form-row">
                                            <input type="hidden" name="myId" value="'.$row['id_product'].'" class="form-control">
                                            <div class="form-group col-md-7 col-sm-12">
                                                <label for="nom">Nom</label>
                                                <input type="text" name="nom" id="nom" placeholder="Nom" class="form-control" value="'.$row['Nom'].'">
                                            </div>
                                            <div class="form-group col-md-5 col-sm-12">
                                                <label for="quantite">Qantites</label>
                                                <input type="number" name="quantite" id="quantite" placeholder="quantite" class="form-control" value="'.$row['Quantite'].'">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="prixA">Prix Unitaire D\'achat</label>
                                                <input type="number" name="prixA" id="prixA" placeholder="Prix unitaire d\'achat" class="form-control" value="'.$row['Prix_Unitaire_Achat'].'">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="prixV">Prix Unitaire de vente</label>
                                                <input type="number" name="prixV" id="prixV" placeholder="Prix unitaire de vente" class="form-control" value="'.$row['Prix_Unitaire_Vente'].'">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="edit" class="btn btn-block btn-warning">Modifie</button>
                                        </div>
                                        <p class="d-flex justify-content-between">
                                            <span>Par Piece</span>
                                            ''
                                        </p>
                                    </form>
                                </div>
                            </div>
                            ';
                        }
                    }else{
                        $output .= '
                        <p class="ui message negative alert alert-danger alert-dismissible fade show" data-role="alert">
                            Vous essaiez de cherche qui pas 
                            <a href="stock.php" class="close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </p>';
                    }
                ?>
                <div class="col-md-4 col-sm-12 col-lg-4">
                    <?php
                    $errors = [];
                    if(isset($_POST['edit'])){
                        $id = htmlentities(mysqli_real_escape_string($con, trim($_POST['myId'])));
                        $name = htmlentities(mysqli_real_escape_string($con, trim($_POST['nom'])));
                        $quantite = htmlentities(mysqli_real_escape_string($con, trim($_POST['quantite'])));
                        $pa = htmlentities(mysqli_real_escape_string($con, trim($_POST['prixA'])));
                        $pv = htmlentities(mysqli_real_escape_string($con, trim($_POST['prixV'])));

                        if(empty($name)){array_push($errors, "Le nom est vide");}
                        if(empty($pa)){array_push($errors, "Le Prix unitaire d'achat est vide");}
                        if(empty($quantite)){array_push($errors, "La Quantite est vide");}
                        if(empty($pv)){array_push($errors, "Le Prix unitaire de vente est vide");}

                        if(count($errors) == 0){
                            $sql = mysqli_query($con, "UPDATE savingproduct SET Nom = '$name',Quantite = '$quantite', Prix_Unitaire_Achat= '$pa', Prix_Unitaire_Vente='$pv' WHERE id_product = '$id'");
                            if($sql){
                                print '
                                <p class="alert alert-warning alert-dismissible fade show" data-role="alert">
                                    modifie Reussi
                                    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </p>';
                            }else{
                                print '
                                <p class="alert alert-danger alert-dismissible fade show" data-role="alert">
                                    Echec :(
                                    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </p>
                                ';
                            }
                        }
                    }
                        include("./config/errors.php");
                    ?>
                    <?php print $output;?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card shadow">
                        <div class="card-header p-1">
                            <h3 class="text-warning">Par Piece</h3>
                        </div>
                        <div class="card-body">
                            <?php
                                if($array[1] == 1){
                                    $parPiece = "<p class='text-danger'>Par Piece</p>";
                                }else{
                                    $parPiece = "<p class='text-danger'>Cet article n'est pas Par Piece</p>";
                                }
                            ?>
                            <span><?php print $parPiece;?></span>
                            <form action="" method="post">
                                <input type="hidden" name="myId" value="<?php print $array[0];?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <select name="parPiece" id="parPiece" class="custom-select">
                                        <option value="">-- selection --</option>
                                        <option value="0">Pas Par Piece</option>
                                        <option value="1">Par Piece</option>
                                    </select>
                                    <button type="submit" name="parPieceBtn" class="btn ml-3 btn-warning">
                                        <i class="icon edit"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-5 shadow">
                        <div class="card-header p-1">
                            <h3 class="text-warning">Monnaie</h3>
                        </div>
                        <div class="card-body">
                            <?php
                                if($array[2] == 'Francs'):?>
                                    <p class="text-success">
                                        <?php print $array[2];?>
                                    </p>
                                <?php elseif($array[2] == 'Dollars'):?>
                                    <p class="text-warning">
                                        <?php print $array[2];?>
                                    </p>
                                <?php else:?>
                                    <p class="text-info">
                                        <?php print $array[2];?>
                                    </p>
                            <?php endif;?>
                            <form action="" method="post">
                                <div class="d-flex justify-content-between align-items-center">
                                    <input type="hidden" name="myId" value="<?php print $array[0];?>">
                                    <select name="monnaie" id="monnaie" class="custom-select">
                                        <option value="">-- Selection --</option>
                                        <option value="Francs">Francs</option>
                                        <option value="Dollars">Dollars</option>
                                    </select>
                                    <button type="submit" class="btn ml-3 btn-warning">
                                        <i class="icon edit"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php else:?>
                <div class="col-md-8 col-sm-12 col-lg-8">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="search" class="form-control" placeholder="Recherche...">
                        </div>
                    </form>
                    <div class="table-responsive">
                        <div id="normal-stock">
                            <table class="table m-0 table-sm table-hover table-striped" style="max-height: 80vh;overflow: scroll;">
                                <tbody>
                                    <tr>
                                        <td>Goma</td>
                                        <td>Goma</td>
                                        <td>Goma</td>
                                        <td>Goma</td>
                                        <td>Goma</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="search-stock">
                            <!-- Code php ajax -->
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <div class="col-md-4">
                <a href="#ajouter" class="mb-3 btn btn-sm btn-primary d-flex justify-content-between align-items-center">
                    Ajouter Produits
                    <i class="fa fa-plus"></i>
                </a>
                <a href="./images/BarcodeScanner.PNG" data-lightbox="mygallery">
                    <img src="./images/BarcodeScanner.PNG" alt="" class="img-fluid">
                </a>
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
    <script>
        jQuery(document).ready( function(){
            normalStock();
        });
        function normalStock(){
            let action = 'normal-stock';
            $.ajax({
                url: './config/event.php',
                method: 'post',
                data: {action: action},
                success: function(data){
                    $('#normal-stock').html(data)
                }
            })
        }
    </script>
</body>
</html>