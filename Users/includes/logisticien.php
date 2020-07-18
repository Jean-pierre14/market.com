<?php require_once("./e.php"); ?>
<div class="col-md-12 col-lg-12 col-sm-12 m-0">
    <div class="container-fluid m-0">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Stock</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">Personnelles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../includes/logout.php">Se deconnecter</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane container-fluid m-0 p-0 active" id="home">
                <div class="row">
                    <div class="col-sm-12 m-2 col-lg-3 col-md-3 p-0">
                        <div class="card shadow">
                            <div class="card-header p-">
                                <h3 class="text-warning">Mon Profil <i class="fa fa-user"></i></h3>
                            </div>
                            <div class="card-body">
                                <div class="Show-profil">
                                    <?php
                                    $UserSql = mysqli_query($con, "SELECT * FROM `login` WHERE id = '$array[0]'");
                                    ?>
                                    <p class="d-flex justify-content-between align-items-center">
                                        <span>
                                            <b>Compte:</b>
                                        </span>
                                        <span><?php print $array[1]; ?></span>
                                    </p>
                                    <p class="d-flex justify-content-between align-items-center">
                                        <span>
                                            <b>Nom:</b>
                                        </span>
                                        <span><?php print $array[2]; ?></span>
                                    </p>
                                    <p class="d-flex justify-content-between align-items-center">
                                        <span>
                                            <b>fonction:</b>
                                        </span>
                                        <span><?php print $array[4]; ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <h3>Bienvenu
                                    <?php print $array[1]; ?>
                                </h3>
                                <p>
                                    Vous etez le Logisticien de
                                    <?php print $boutique; ?>, Vous devez vous tout controle savoir comments les
                                    produits sont entree et comment il sortee!!! nous vous faisons confiance, bonne
                                    journee
                                    <?php print date('d/m/Y'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 m-2 col-lg-8 col-md-8">
                        <h3 class="display-4 text-uppercase text-center text-warning hide-sm">
                            <?php print $boutique; ?>
                        </h3>
                        <div class="container-fluid m-0 p-0">
                            <div class="row hide-sm">
                                <div class="col-md-6 col-lg-6 col-sm-12 p-2">
                                    <div class="card">
                                        <img src="../images/BarcodeScanner.PNG" alt="" class="card-img-top">
                                        <div class="card-body">
                                            <h4 class="text-warning">Mon Profil</h4>
                                            <a href="profil.php" class="btn btn-primary btn-sm">Voir plus</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12 p-2">
                                    <div class="card">
                                        <img src="../images/icons/Coins_104px.png" alt="" class="card-img">
                                        <div class="card-body">
                                            <h4 class="text-warning">Stock</h4>
                                            <a href="stock.php" class="btn btn-primary btn-sm">Voir plus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane container-fluid m-0 p-0 fade" id="menu1">
                <div class="container-fluid m-0 p-0">
                    <div class="row">
                        <div class="col-sm-10 col-lg-5 col-md-6">
                            <form action="./config/config.php" method="post">
                                <div class="form-inline my-2">
                                    <input class="form-control" type="search" name="search" id="search_id"
                                        placeholder="Recherche...">
                                    <button type="submit" name="search" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nom du produit</th>
                                            <th>Quantite</th>
                                            <th>Date d'expiration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        print $output;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane container fade" id="menu2">
                <div class="container-fluid m-0 p-0">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6 col-lg-5">
                            <form action="" method="post">
                                <div class="form-inline my-2">
                                    <input type="search" name="searchP" id="searchP" class="form-control"
                                        placeholder="Recherche...">
                                    <button type="submit" class="btn btn-warning text-light">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Compte</th>
                                            <th>Post</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php print $users; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>