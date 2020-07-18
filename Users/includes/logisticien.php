<?php require_once("./e.php"); ?>
<div class="col-md-12 col-lg-12 col-sm-12 m-0">
    <div class="container-fluid">
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
        </ul>
        <div class="tab-content">
            <div class="tab-pane container-fluid active" id="home">
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
                                <h3>Bienvenu <?php print $array[1]; ?></h3>
                                <p>
                                    Vous etez le Logisticien de <?php print $boutique; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 m-2 col-lg-9 col-md-9"></div>
                </div>
            </div>
            <div class="tab-pane container fade" id="menu1">
                stock
            </div>
            <div class="tab-pane container fade" id="menu2">
                Personnelles
            </div>
        </div>
    </div>
</div>