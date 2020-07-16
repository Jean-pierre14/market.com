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
        $array[0] = $data['id'];
        $array[1] = $data['Compte'];
        $array[2] = $data['Nom'];
        $array[3] = $data['Mot_de_passe'];
        $array[4] = $data['Fonction'];
    }
    $output = '';
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

<body>
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
                    <a class="nav-link active" href="admin.php"><i class="fa fa-users"></i> Personnelles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php"><i class="fa fa-user"></i> Profil</a>
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
    <div class="container-fluid m-0 p-0" style="min-height: 80vh;">
        <div class="row">
            <div class="col-md-3">
                <form action="" method="post">
                    <div class="input-group m-2">
                        <input type="text" name="search" placeholder="Recherche..." id="search" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </form>
                <div class="result" id="result"></div>
                <div class="ui" id="personnel"></div>
                <a href="admin.php?ajouter" class="btn btn-sm btn-warning text-light ml-2 mb-3">Ajouter <i
                        class="fa fa-user"></i></a>
            </div>
            <div class="col-md-9">
                <input type="hidden" class="form-control" id="userID" value="<?php print $idUser;?>">
                <div class="container-fluid p-0 m-0">
                    <div class="row">
                        <?php if(isset($_GET['ajouter'])):?>
                        <div class="col-md-10">
                            <div class="box bg-primary p-2">
                                <h3 class="text-light">Ajouter Personnel <i class="fa fa-user"></i></h3>
                            </div>
                            <?php require_once("./config/config.php");?>
                            <form method="post">
                                <?php include("./config/errors.php");?>
                                <div class="form-row">
                                    <div class="form-group col-md-5 p-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Nom d'utilisateur</span>
                                            </div>
                                            <input type="text" value="<?php print $username;?>" name="username" class="form-control"
                                                placeholder="Nom d'utilisateur...">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-7 p-2">
                                        <div class="input-group mb-2">
                                            <input type="text" name="name"  value="<?php print $name;?>" class="form-control" placeholder="Nom...">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Nom</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 m-0 mt-1 p-0">
                                        <label for="post">Poste</label>
                                        <select name="post" id="post" class="custom-select">
                                            <option value="">-- Selection --</option>
                                            <option value="Gerant">Gerant</option>
                                            <option value="Reception">Reception</option>
                                            <option value="Ouvrile">Ouvriel</option>
                                            <option value="Comptable">Comptable</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 p-2">
                                        <div class="input-group mb-2">
                                            <input type="text" value="<?php print md5(1234);?>" disabled
                                                class="form-control disabeled">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Mot de passe</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 m-0 btn-group">
                                    <button type="submit" name="ajouterPersonnel"
                                        class="btn text-light btn-sm btn-warning d-flex justify-content-between align-items-center">
                                        Enregistre
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                    <a href="admin.php" class="btn btn-sm btn-primary d-flex justify-content-between align-items-center">Retour <i
                                            class="fa fa-arrow-circle-left"></i></a>
                                </div>
                            </form>
                        </div>
                        <?php else:?>
                        <?php if(isset($_GET['username'])):?>
                        <?php
                                    $UsernameGet = $_GET['username'];
                                    $idUser = $UsernameGet;
                                    $sqlUser = mysqli_query($con, "SELECT * FROM `login` WHERE id = '$idUser'");

                                    if(@mysqli_num_rows($sqlUser) == 1){
                                        while($data = mysqli_fetch_array($sqlUser)){
                                            $arryUser = [];
                                            $arryUser[0] = $data['id'];
                                            $arryUser[1] = $data['Compte'];
                                            $arryUser[2] = $data['Nom'];
                                            $arryUser[3] = $data['Fonction'];
                                            $arryUser[4] = $data['Mot_de_passe'];
                                            $output .= '
                                                <div class="card shadow">
                                                    <div class="card-header p-1">
                                                        <p class="text-primary p-0 m-0">'.$data['Nom'].'</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="d-flex justify-content-between align-items-center">
                                                            Nom d\'utilisateur
                                                            <span class="">'.$data['Compte'].'</span> 
                                                        </p>
                                                        <p class="d-flex justify-content-between align-items-center">
                                                            Nom 
                                                            <span class="">'.$data['Nom'].'</span> 
                                                        </p>
                                                        <p class="d-flex justify-content-between align-items-center">
                                                            Fonction:
                                                            <span class="">'.$data['Fonction'].'</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    }else{
                                        $output .= '<p class="alert alert-danger ui message negative">Cette compte n\'existe plus</p>';
                                    }
                                ?>
                        <div class="col-md-10">
                            <div class="box bg-primary p-2">
                                <h3 class="text-light">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    <?php print $arryUser[1];?>
                                </h3>
                            </div>
                            <div class="container-fluid p-0 m-0">
                                <div class="row">
                                    <div class="col-md-5">
                                        <?php print $output;?>
                                        <div class="card mt-3 shadow">
                                            <div class="card-header p-1">
                                                <h3 class="m-0 p-0 text-warning">Info personnel <i
                                                        class="fa fa-lock"></i></h3>
                                            </div>
                                            <div class="card-body">
                                                <a href="admin.php?password=<?php print $arryUser[0];?>"
                                                    class="ChangePassword btn btn-sm btn-block btn-secondary d-flex justify-content-between align-items-center">
                                                    Change mot de pass
                                                    <i class="fa fa-lock"></i>
                                                </a>
                                                <a href="#password"
                                                    class="btn btn-sm btn-block btn-danger d-flex justify-content-between align-items-center">Supprime
                                                    cet compte <i class="fa fa-user-alt"></i></a>
                                            </div>
                                        </div>
                                        <a href="profil.php" class="btn btn-warning btn-md mt-3 text-light shadow">Mon profil</a>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card shadow">
                                            <div class="card-header p-1">
                                                <h3 class="text-warning">Modifie cet compte <i class="fa fa-user"></i>
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                        require_once("./config/config.php");
                                                        include("./config/errors.php");
                                                    ?>
                                                <form action="" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="username">Nom d'utilisateur</label>
                                                            <input type="text" name="username" id="username"
                                                                value="<?php print $arryUser[1];?>"
                                                                placeholder="Nom d'utilisateur" class="form-control">
                                                            <input type="hidden" name="id" id="id"
                                                                value="<?php print $arryUser[0];?>"
                                                                placeholder="Nom d'utilisateur" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="name">Nom</label>
                                                            <input type="text" name="name" id="name"
                                                                value="<?php print $arryUser[2];?>" placeholder="Nom..."
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <input type="text" disabled name="fonction"
                                                                class="form-control" placeholder="Poste"
                                                                value="<?php print $arryUser[3];?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Mot de pass</label>
                                                        <input type="password" disabled name="password"
                                                            value="<?php print md5($arryUser[3]);?>" id="password"
                                                            placeholder="Mot de pass" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <button name="updatePersonnel" type="submit"
                                                            class="btn btn-block btn-md btn-warning">Modifie</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <?php
                                    if(isset($_POST['fonctionBTN'])){
                                        $idFonction = htmlentities(mysqli_real_escape_string($con, trim($_POST['fonctionID'])));
                                        $fonction = htmlentities(mysqli_real_escape_string($con, trim($_POST['fonction'])));
                                        $err = [];

                                        if(empty($fonction)){array_push($err, "Le fonction est vide");}
                                        if(count($err) == 0){
                                            $sqlFonction = mysqli_query($con, "UPDATE `login` SET Fonction = '$fonction' WHERE id = '$idFonction'");
                                            print '<p class="ui message positive alert alert-success">Fonction modifie</p>';
                                        }
                                        if(count($err) > 0)
                                            foreach($err as $er)
                                                print $er;
                                    }
                                ?>
                            <form action="" class="form-group" method="post">
                                <label for="fonction display-4 text-warning">Fonction</label>
                                <input type="hidden" name="fonctionID" value="<?php print $arryUser[0];?>">
                                <select name="fonction" id="fonction" class="custom-select">
                                    <option value="">-- selection --</option>
                                    <option value="Gerant">Gerant</option>
                                    <option value="Reception">Reception</option>
                                    <option value="Ouvriel">Ouvriel</option>
                                    <option value="Comptable">Comptable</option>
                                </select>
                                <button type="submit" name="fonctionBTN"
                                    class="btn text-light btn-sm btn-warning mt-2">Fonction</button>
                            </form>
                        </div>
                        <?php else:?>
                        <?php if(isset($_GET['password'])):?>
                        <?php $idGETPassword = $_GET['password'];?>
                        <div class="col-md-10 p-0">
                            <div class="box bg-primary p-2">
                                <h3 class="text-light d-flex justify-content-between align-items-center">
                                    Change Mot de pass
                                    <i class="fa fa-lock text-light"></i>
                                </h3>

                            </div>
                            <div class="container-fluid m-0 p-0">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <form action="" method="post">
                                                    <?php require_once("./config/config.php");include("./config/errors.php");?>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="new">Nouveau Mot de pass</label>
                                                            <input type="password" value="<?php print $new;?>"
                                                                name="new" id="new" placeholder="Nouveau mot de pass"
                                                                class="form-control">
                                                            <input type="hidden" name="idGet" id="idGet"
                                                                value="<?php print $idGETPassword;?>">
                                                            <input type="hidden" name="idADM"
                                                                value="<?php print $array[0];?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="pass">Confirme Mot de pass</label>
                                                            <input type="password" value="<?php print $pass;?>"
                                                                name="pass" id="pass" placeholder="Nouveau mot de pass"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Votre mot de pass</label>
                                                        <input type="password" value="<?php print $password;?>"
                                                            name="password" id="password"
                                                            placeholder="Nouveau mot de pass" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="changePassword"
                                                            class="btn btn-block btn-primary btn-sm d-flex justify-content-between align-items-center">
                                                            Change
                                                            <i class="fas fa-sync-alt"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                                        $idChange = $_GET['password'];
                                                        $sqlChange = mysqli_query($con, "SELECT * FROM `login` WHERE id = '$idChange'");
                                                        while($Change = mysqli_fetch_array($sqlChange))
                                                            $output .= '
                                                            <div class="card">
                                                                <div class="card-header p-1">
                                                                    <p class="d-flex justify-content-between align-items-center">
                                                                        Compte
                                                                        <span class="text-uppercase text-warning">
                                                                            '.$Change['Nom'].'
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="d-flex justify-content-between align-items-center">
                                                                        Nom d\'utilisateur: 
                                                                        <span class="text-primary">'.$Change['Compte'].'</span>
                                                                    </p>
                                                                    <p class="d-flex justify-content-between align-items-center">
                                                                        Nom: 
                                                                        <span class="text-primary">'.$Change['Nom'].'</span>
                                                                    </p>
                                                                    <p class="d-flex justify-content-between align-items-center">
                                                                        Poste:
                                                                        <span class="text-uppercase text-warning">
                                                                            '.$Change['Fonction'].'
                                                                        </span>
                                                                    </p>
                                                                    <p class="d-flex justify-content-between align-items-center">
                                                                        Mot de pass: 
                                                                        <i class="text-danger fas fa-sync-alt fa-spin fa-spin"></i>
                                                                        <i class="text-danger fas fa-sync-alt fa-spin fa-spin"></i>
                                                                    </p>
                                                                    <span class=" text-center small text-primary">'.md5($Change['Mot_de_pass']).'</span>
                                                                </div>
                                                            </div>
                                                            ';
                                                        print $output;
                                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card m-1">
                                <div class="card-body">
                                    <p class="d-flex justify-content-between align-items-center">
                                        Date:
                                        <small><?php print date('d:m:Y');?></small> </p>
                                </div>
                            </div>
                        </div>
                        <?php else:?>
                        <div class="col-md-10">
                            <div class="box bg-primary p-2">
                                <h3 class="text-light">Personnels</h3>
                            </div>
                            <div class="box">
                                <p>
                                    Vous avez tout le pouvoir sur vos agents, vous pouvez soit edit un compte ou meme
                                    l'efface en cas de besoin ou limogenge
                                </p>
                                <div class="container-fluid m-0 p-0">
                                    <div class="row">
                                        <div class="col-md-4 p-2">
                                            <div class="card card-hover">
                                                <img src="./images/icons/Meeting_104px.png" alt="" class="img-caree">
                                                <div class="card-body">
                                                    <h3>Le controle</h3>
                                                    <p>
                                                        Vous pouver aussi evalue vos travail, apartire du moment
                                                        d'arrive au travail et de depart, la connection et la
                                                        deconnection
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 p-2">
                                            <div class="card card-hover">
                                                <img src="./images/icons/Unlock_104px.png" alt="" class="img-caree">
                                                <div class="card-body">
                                                    <h3>La securite</h3>
                                                    <p>
                                                        Vous avez l'access a tout le compte de cette entreprise, nous
                                                        somme vraiment desole de vous rappelle mais ce commenca
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 p-2">
                                            <div class="card card-hover">
                                                <img src="./images/icons/Advertising_104px.png" alt=""
                                                    class="img-caree">
                                                <div class="card-body">
                                                    <h3>Les notifications</h3>
                                                    <p>
                                                        Toute les actualite sur vos service vous pouvez le partage avec
                                                        le personnelle de votre entreprise en temps reel
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <img src="./images/icons/adminPanel.jpg" alt="Logo de vente" class="ui image img-fluid">
                            </div>
                        </div>

                        <?php endif;?>
                        <?php endif;?>
                        <!-- <div class="col-md-2">
                                <div id="myAccount"></div>
                                <div class="card m-1">
                                    <div class="card-body">
                                        <p>
                                            Dieu est au controle de tout
                                        </p>
                                    </div>
                                </div>
                            </div> -->
                        <?php endif;?>
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
    <script>
    jQuery(document).ready(() => {
        personnel();
        myAccount();
        $('#search').keyup( function(){
            let txt = $(this).val();
            let action = 'searchPersonnel';
            
            if(txt != ''){
                $.ajax({
                    url: './config/config.php',
                    method: 'post',
                    data: {action: action, txt: txt},
                    success: function(data){
                        $('#personnel').hide(300);
                        $('#result').html(data);
                    }
                })
            }else{
                $('#personnel').show(300);
                $('#result').html('');
            }
        })
    });

    function personnel() {
        let action = 'personnel';
        let id = $('#userID').val();
        $.ajax({
            url: './config/config.php',
            method: 'post',
            data: {
                action: action,
                id: id
            },
            success: function(data) {
                $('#personnel').html(data)
            }
        })
    }

    function myAccount() {
        let action = 'myAccount';
        let id = $('#userID').val();
        $.ajax({
            url: './config/config.php',
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
</body>

</html>