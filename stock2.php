<?php
    session_start();
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
        $array[2] = $data['Mot_de_pass'];
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
        <?php if(isset($_GET['edit'])):?>
            <?php
                $id = $_GET['edit'];
                $edit = mysqli_query($con, "SELECT * FROM savingproduct WHERE id_product = '$id'");
                while($dataEdit = mysqli_fetch_array($edit)){
                    $editArray = [];
                    $editArray[0] = $dataEdit['ID'];
                    $editArray[1] = $dataEdit['Nom'];
                    $editArray[2] = $dataEdit['Quantite'];
                    $editArray[3] = $dataEdit['Prix_Unitaire'];
                    $editArray[4] = $dataEdit['Par_Piece'];
                    $editArray[5] = $dataEdit['id_product'];
                    $editArray[6] = $dataEdit['product_image'];
                    $editArray[7] = $dataEdit['monnaie'];
                }
            ?>
            <div class="row mt-2">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-0 d-flex justify-content-between align-items-center">
                            <h3 class="m-0 ml-2 mt-1">Modifie <span class="text-primary"><?php print $editArray[1];?></span></h3>
                            <a href="stock.php" class="m-1 btn btn-sm btn-danger"><i class="fa fa-arrow-left"></i> Retour</a>
                        </div>
                        <div class="card-body">
                            <?php require_once("./config/config.php");include("./config/errors.php");?>
                            <form action="" method="POST">
                                <div class="form-row m-0 p-0">
                                    <input type="hidden" value="<?php print $editArray[5];?>" name="id">
                                    <div class="form-group col-md-12 p-0">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Produit</span>
                                            </div>
                                            <input type="text" class="form-control disabled" name="ID" value="<?php print $editArray[0];?>" placeholder="Id du produit">
                                            <input type="text"value="<?php print $editArray[1];?>" class="form-control" name="name" placeholder="Nom du produit">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 p-0">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">A Propos</span>
                                        </div>
                                        <input type="text" value="<?php print $editArray[2];?>" class="form-control" name="quantite" placeholder="Quantite">
                                        <input type="text" class="form-control" value="<?php print $editArray[3];?>" name="prix" placeholder="Prix unitaire">
                                        <select name="monnaie" value="<?php print $editArray[7];?>" class="custom-select">
                                            <option value="">Monnaie</option>
                                            <option value="Francs">Francs</option>
                                            <option value="Dollars">Dollars</option>
                                        </select>
                                    </div>
                                </div>                    
                                <!-- <div class="form-group col-md-12 p-0">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>                     -->
                                <div class="form-group btn-group">
                                    <button type="submit" name="update" class="btn btn-sm btn-md btn-xl btn-primary">Mettre a jour <i class="fa fa-arrow-circle-right" name="update"></i></button>
                                    <a href="stock.php?edit=<?php print $editArray[5];?>" class="btn btn-sm text-white btn-md btn-xl btn-warning ui icon labeled">Actualise <i class="icon refresh"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="aboutThis" id="<?php print $editArray[5];?>"></div>
                </div>
                <div class="col-md-4">
                    <!-- <a href="stock.php" class="btn btn-sm btn-danger">Retour <i class="fa fa-arrow-left"></i></a><br> -->
                    <?php if($editArray[6] == ''):?>
                        <form action="" enctype="multipart/form-data" method="post">
                            <?php require_once("./config/config.php");?>
                            <input type="hidden" name="id_product" value="<?php print $editArray[5]; ?>" class="form-control">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group m-0 p-0">
                                <button type="submit" name="ajouteImage" class="btn btn-lg m-0 btn-block btn-primary">Ajouter image <i class="fa fa-image"></i></button>
                            </div>
                        </form>
                        <?php if(count($imgarray) > 0):?>
                            <?php foreach($imgarray as $imgError):?>
                                <p class="ui message negative alert alert-danger">
                                    <?php print $imgError;?>
                                </p>
                            <?php endforeach;?>
                        <?php endif;?>
                        <p class="mt-5 ui message negative alert alert-danger">Vous pouvez ajoute l'image a ce produit, c'est vraiment prudent</p>
                    <?php else:?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <a href="<?php print $editArray[6];?>" data-lightbox="mygallery" title="<?php print $editArray[1];?>">
                                    <img src="<?php print $editArray[6];?>" alt="" class="img-fluid ui image img-hover">
                                </a>
                            </div>
                            <div class="card-footer p-1">
                                <button class="btn btn-sm btn-primary ui editImg">Modifie l'image <i class="fa fa-edit"></i></button>
                            </div>
                        </div>
                        <div class="card mt-4 mb-4" id="card-img-add" style="display: none;">
                            <div class="card-header p-1 d-flex justify-content-between align-items-center">
                                <p class="p-0 m-0 text-primary">Modifie l'image</p>
                                <button class="btn btn-sm close text-danger" id="close-add-img">&Cross;</button>
                            </div>
                            <div class="card-body">
                                <?php require_once("./config/config.php");?>
                                <?php if(count($imgarray) > 0):?>
                                    <?php foreach($imgarray as $imgError):?>
                                        <p class="ui message negative alert alert-danger">
                                            <?php print $imgError;?>
                                        </p>
                                    <?php endforeach;?>
                                <?php endif;?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_product" value="<?php print $editArray[5];?>" class="form-control">
                                    <div class="custom-file">
                                        <input type="file" name="img" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <button type="submit" name="updateImg" class="btn btn-block btn-primary mt-2">Modifie <i class="fa fa-image"></i></button>
                                </form>
                            </div>
                        </div>                        
                    <?php endif;?>
                </div>
            </div>
        <?php else:?>
            <?php if(isset($_GET['ajoute'])):?>
                <div class="row mt-2">
                    <div class="col-md-5">
                        <a href="stock.php" class="btn btn-sm btn-danger mt-1 mb-1">Retour <i class="fa fa-arrow-left"></i></a>
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php require_once("./config/config.php"); include("./config/errors.php");?>
                            <div class="form-row m-0 p-0">
                                <div class="form-group col-md-12 p-0">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Produit</span>
                                        </div>
                                        <input type="text" class="form-control" value="<?php print $ID;?>" name="id" placeholder="Id du produit">
                                        <input type="text" class="form-control" value="<?php print $nom;?>" name="nom" placeholder="Nom du produit">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12 p-0">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">A propos</span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php print $quantite;?>" name="quantite" placeholder="Quantite">
                                    <input type="text" class="form-control" value="<?php print $prix;?>" name="prix" placeholder="Prix unitaire">
                                    <select name="monnaie" class="custom-select">
                                        <option selected>Monnaie</option>
                                        <option value="Francs">Francs</option>
                                        <option value="Dollars">Dollar</option>
                                    </select>
                                </div>
                            </div>                
                            <div class="form-group col-md-12 p-0">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="customFile"  value="<?php print $image;?>">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>                    
                            <div class="form-group">
                                <button type="submit" name="ajouter" class="btn btn-sm btn-md btn-xl btn-primary">Enregistre <i class="fa fa-arrow-circle-right" name="ajouter"></i></button>
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
                    <div class="col-md-7">
                        <form action="" method="post">
                            <div class="input-group mb-3 mt-1">
                                <input type="search" class="form-control" placeholder="Recherche" id="search_txt" name="search">
                                <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <div class="ui stocket"></div>
                        </div>
                    </div>
                </div>
            <?php else:?>
                <div class="row">
                    <div class="col-md-12 p-0 m-0">
                        <div class="container-fluid m-0">
                            <div class="row justify-content-center">
                                <div class="col-md-10 m-0">
                                    <div id="demo" class="carousel slide" data-ride="carousel">
                                        <ul class="carousel-indicators">
                                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                                        <li data-target="#demo" data-slide-to="1"></li>
                                        <li data-target="#demo" data-slide-to="2"></li>
                                        </ul>
                                        <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="container-fluid m-0">
                                                <div class="row">
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/vetementFemme.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Grand wax</small>
                                                                <h3 class="text-danger">200 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/soulier1.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Grand wax</small>
                                                                <h3 class="text-danger">200 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/soulierHomme.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Hommes</small>
                                                                <h3 class="text-danger">200 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/iphone.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Grand wax</small>
                                                                <h3 class="text-danger">200 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="container-fluid m-0">
                                                <div class="row">
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/chemiseSlide.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Grand wax</small>
                                                                <h3 class="text-danger">200 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/vetementFemme.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Super Panie</small>
                                                                <h3 class="text-danger">450 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/soulier2.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Men</small>
                                                                <h3 class="text-danger">348 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/poisson.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Grand wax</small>
                                                                <h3 class="text-danger">200 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="container-fluid m-0">
                                                <div class="row">
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/rolex.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Grand wax</small>
                                                                <h3 class="text-danger">200 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/soulier3.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Soulier</small>
                                                                <h3 class="text-danger">200 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/viande.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Viande</small>
                                                                <h3 class="text-danger">7500fc / 1Kg</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 p-1">
                                                        <div class="card">
                                                            <img src="./images/poisson.jpg" alt="" class="img-fluid">
                                                            <div class="card-body">
                                                                <small>Grand wax</small>
                                                                <h3 class="text-danger">200 Pieces</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                        </a>
                                        <a class="carousel-control-next" href="#demo" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="card">
                                        <img src="./images/soulier.jpg" alt="" class="card-img-top">
                                        <div class="card-body">
                                            <a href="stock.php?ajoute" class="btn btn-block btn-primary">Ajouter article</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="stock-card row"></div>
                        </div>
                    </div>                       
                </div>
                <div class="row justify-content-center p-5 bg-img bg-img1">
                    <div class="col-md-10 bg-light p-3 m-0">
                        <div class="bg-primary p-2 mt-1 d-flex justify-content-between align-items-center">
                            <h3 class="text-light">Stocket</h3>
                            <a href="stock.php?ajoute" class="btn btn-sm btn-danger">Ajouter <i class="fa fa-plus"></i></a>
                        </div>
                        <div class="p-3">
                            <div class="input-group mb-3">
                                <input type="text" id="myInput" class="form-control" placeholder="Recherche...">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="stocket"></div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif;?>
    </div>
    <div class="container-fluid text-light bg-dark m-0 footer">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center p-5">
                <p>Marketkivu.com</p>
                <small>copyright Commerciale &copy; 2020</small>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myList">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Voir tout <i class="fa fa-list"></i></h4>
              <button type="button" class="close btn" data-dismiss="modal">&times;</button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                <h2 class="display-1">All about this product</h2>
                <div class="stocket"></div>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
      
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
            
            $('.editImg').click( function(){
                $('#card-img-add').show(300)
            });
            $('#close-add-img').click( function(){
                $('#card-img-add').hide(350)
            })
            $(".custom-file-input").on("change", function() {
                let fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
            stocket();
            $("#myInput").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            stockCard();
            aboutThis();
        })
        function aboutThis(){
            let action = 'aboutThis';
            let id = $('.aboutThis').attr('id');
            $.ajax({
                url: './config/config.php',
                method: 'post',
                data: {action: action, id: id},
                success: function(data){
                    $('.aboutThis').html(data);
                }
            })
        }
        function stockCard(){
            let action = 'stockCard';
            $.ajax({
                url: './config/config.php',
                method: 'post',
                data: {action: action},
                success: function(data){
                    $('.stock-card').html(data);
                }
            })
        }
        function stocket(){
            let action = 'stocket';
            $.ajax({
                url: './config/config.php',
                method: 'post',
                data: {action: action},
                success: function(data){
                    $('.stocket').html(data);
                }
            })
        }
    </script>
</body>
</html>