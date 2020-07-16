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
                <a class="nav-link" href="profil.php"><i class="fa fa-user"></i> Profil</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="propos.php"><i class="fa fa-comment"></i> A propos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./includes/logout.php"><i class="icon logout"></i> Se deconnecte</a>
            </li>
          </ul>
        </div>
    </nav>
    <div class="container-fluid p-0 m-0" style="min-height: 80vh;">
        <div class="row p-5 justify-content-center">
            <div class="col-md-7 col-lg-7 col-sm-12 shadow p-5 m-5 bg-light">
                <h3 class="text-warning display-4">Comment ca marche????</h3>
                <p class="font-18">
                    Dans cette parti nous essaie d'explique un peu sur le system, comment il fonctionne et aussi comme l'utilise, tout ce qu'il vous faut se de lire sa juste qu cas ou vous etait perdu, mais nous esperons que tout va se passe a meilleur, dans le systeme nous avons insert de icon pour vous   enfin que vous vous familliarise avec. comme dans les autres application que vous avez deja vu.
                </p>
            </div>
            <div class="col-lg-7 col-sm-12 col-md-7 bg-light shadow p-5 m-5">
                <h3 class="text-center text-primary display-4">Evoluction du systeme</h3>
                <p class="font-18">
                    Ce systeme a etait concu dans le but de vous mettrez au courant de tout les actions faites par dans vont entreprises boutique, alimentation, et autres chose il suffut juste de demande et vous avez de reponses en temps reel!, nous vous offrons le meilleur de nous meme, pour votre bien et dans l'evolution de la technologies dans notre ville de Goma
                </p>
            </div>
        </div>
        <div class="row bg-light p-5">
            <div class="col-md-8 col-lg-8 col-sm-12 p-5">
                <h3>Capacite du site</h3>
                <p class="font-18">
                    Ce system gerant le donnees de taill de plus de 1tera, comme vous pouvez le voir tout les produits que votre entripres a vendu depuis que le system est operation se trouve ici dans cet platform, a vous de voir si vous voulez les ou les gardes pour le invateur dans le jours avenir
                </p>
            </div>
            <div class="p-5 col-md-4 col-lg-4 col-sm-12 justify-content-center align-items-center text-center">
                <img src="./images/icons/Coins_104px.png" alt="" class="img-hover-scale">
            </div>
        </div>
        <div class="row p-5 bg-warning justitify-content-center">
            <div class="col-sm-12 col-lg-6 col-md-8 p-5 bg-light text-center">
                <img src="./images/icons/Timer_104px.png" alt="" class="img-hover-scale">
            </div>
            <div class="col-sm-12 col-lg-6 col-md-4 p-5 bg-light">
                <p class="font-18">
                    Toute les information qui sont sur cette site sont instantane avec l'alimentation, juste quand il y a changement vous avez de notitfication ici parce que nous avons notre base des donnees qui est enligne. de qu'il y a du nouveau vous avez changement...
                </p>
            </div>
        </div>
        <div class="row p-5 bg-img bg-img2 justify-content-center">
            <div class="col-sm-12 col-lg-7 col-md-6">
                <p class="font-18">
                    Vous en tant que administrateur vous avez tout les autorisation sur tout, sur vos utilisateur chaque d'eux, de meme vous etez aussi celui qui le ajouter dans le system, aussi vous pouvez les effaces pour evite de dire de le renvoie. tout le pouvoir vous est donnees, vous etez le boss, non seulement dans le site et aussi dans le finance.
                </p>
            </div>
            <div class="col-md-6 col-lg-5 col-sm-12 text-center justify-content-center align-items-center">
                <img src="./images/icons/User Groups_104px.png" alt="" class="img-hover-scale">
            </div>
        </div>
        <div class="row p-5 bg-secondary justify-content-center">
            <div class="col-md-6 col-lg-6 col-m-12">
                <h3 class="text-warning display-4 text-center">Programmation</h3>
                <p class="font-18 text-light text-center">
                    Voici le outils qui on cree cet application, tous sont des language des programmations de developpement web
                </p>
                <!-- Programmning languages -->
                <div class="container-fluid m-0 p-0">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-6 p-2 text-center">
                            <img src="./images/icons/Html 5_100px.png" alt="" class="img img-hover-scale img-opacity">
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 p-2 text-center">
                            <img src="./images/icons/CSS Filetype_100px.png" alt="" class="img img-hover-scale img-opacity">
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 p-2 text-center">
                            <img src="./images/icons/MySQL_100px.png" alt="" class="img img-hover-scale img-opacity">
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 p-2 text-center">
                            <img src="./images/icons/Javascript_100px.png" alt="" class="img img-hover-scale img-opacity">
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 p-2 text-center">
                            <img src="./images/icons/PHP_100px.png" alt="" class="img img-hover-scale img-opacity">
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 p-2 text-center">
                            <img src="./images/icons/Adobe Photoshop_100px.png" alt="" class="img img-hover-scale img-opacity">
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 p-2 text-center">
                            <img src="./images/icons/Code_100px.png" alt="" class="img img-hover-scale img-opacity">
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-6 p-2 text-center">
                            <img src="./images/icons/Html 5_100px.png" alt="" class="img img-hover-scale img-opacity">
                        </div>
                    </div>
                </div>
                <!-- Programming languages -->
            </div>
        </div>
        <div class="row bg-dark p-5 justify-content-center">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <h3 class="text-center text-primary display-4">Les Programmeurs</h3>
                <p class="text-light text-center font-18">
                    Ce systeme a etait developpe par deux jeunes etudiant de l'unversite libre de kigali ULK.
                </p>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12 m-2 text-center" style="width: 50%;">
                <div class="card">
                    <img src="./images/grace_el_bisimwa.png" alt="" class="img-fluid">
                    <div class="card-body">
                        <h3 class="text-primary">Grace El Bisimwa</h3>
                        <p>
                            Trouve moi sur facebook en cliquant sur ce button
                        </p>
                        <a href="#" class="btn btn-sm btn-primary">Facebook <i class="icon facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-danger">Gmail <i class="icon mail"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12 m-2 text-center" style="width: 50%;">
                <div class="card">
                    <img src="./images/grace_el_bisimwa.png" alt="" class="img-fluid">
                    <div class="card-body">
                        <h3 class="text-primary">Arnold KAMBALE</h3>
                        <p>
                            Trouve moi sur facebook en cliquant sur ce button
                        </p>
                        <a href="#" class="btn btn-sm btn-primary">Facebook <i class="icon facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-danger">Gmail <i class="icon mail"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ScrollTop -->
    <?php include("./includes/topBtn.php");?>
    <!-- ScrollTop -->
    <div class="container-fluid text-light bg-dark m-0 footer">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center p-5">
                <p>Marketkivu.com</p>
                <small>copyright Commerciale &copy; 2020</small>
            </div>
        </div>
    </div>
    <script>
        Chart.defaults.global.title.display = true;
        Chart.defaults.global.title.text = 'Finance';
        Chart.defaults.globals.elements.point.radius = 10;
    </script>
    <script>
        let ctx = document.getElementById('myChart').getContext('2d');
        let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Situation du mois',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 11, 5, 19, 21]
            }]
        },
    
        // Configuration options go here
        options: {
            title: {
                text: "Evolution financiere"
            },
            elements: {
                point: {
                    radius: 5
                }
            }
        }
    });
    </script>
</body>
</html>