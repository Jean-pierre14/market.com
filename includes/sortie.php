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
        $array[5] = $data['Admin'];
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
            <li class="nav-item active">
              <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="stock.php"><i class="fa fa-database"></i> Stock </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php"><i class="fa fa-users"></i> Personnelles </a>
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
    <h3 class="display-1">Sortie</h3>
    <div class="container-fluid m-0 pb-5 pt-5 bg-img bg-img1">
        <div class="row justify-content-center">
            <div class="col-md-8 bg-white p-5">
                <h3 class="text-warning">Evoluction du systeme</h3>
                <p class="font-18">
                    Ce systeme a etait concu dans le but de vous mettrez au courant de tout les actions faites par dans vont entreprises boutique, alimentation, et autres chose il suffut juste de demande et vous avez de reponses en temps reel!, nous vous offrons le meilleur de nous meme, pour votre bien et dans l'evolution de la technologies dans notre ville de Goma
                </p>
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
        window.addEventListener('scroll', function(){
            let scroll = document.querySelector('#TopBtn');
            scroll.classList.toggle("active", window.screenY > 50);
        });
    </script>
    <script>
        $().ready(()=>{
            MyProfil();
        })
        
        function MyProfil(){
            let action = 'MyProfil';
            let id = $('#MyAccountId').val();
            $.ajax({
                url: './config/event.php',
                method: 'post',
                data: {action: action, id: id},
                success: function(data){
                    $('#MyProfil').html(data)
                }
            })
        }
    </script>
    <script src="./js/myjQuery.js"></script>
    <!-- <script>
        Chart.defaults.global.title.display = true;
        Chart.defaults.global.title.text = 'Finance';
        Chart.defaults.globals.elements.point.radius = 10;
    </script> -->
    <script>
        let ctx = document.getElementById('myChart').getContext('2d');
        let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Situation du mois',
                backgroundColor: 'rgb(255, 99, 132, 0.4)',
                borderColor: 'rgb(255, 99, 132, 0.9)',
                borderWidth: 1,
                data: [0, 11, 5, 19, 21]
            }]
        },
    
        // Configuration options go here
        options: {
            responsive: true,
            maintainApectRatio: false,
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