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
              <a class="nav-link" href="admin.php"><i class="fa fa-users"></i> Personnelles</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="propos.php"><i class="fa fa-comment"></i> A propos</a>
            </li>
          </ul>
        </div>
    </nav>
    <div class="container-fluid p-0 m-0" style="min-height: 80vh;">
        <h3 class="display-1">About</h3>
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