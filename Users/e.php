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
    $output = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market.org</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/semantic/semantic.min.css">
    <link rel="stylesheet" href="./js/dist/Chart.min.css">
    <link rel="stylesheet" href="./css/lightbox.min.css">
    <script src="./js/jquery-3.4.0.min.js"></script>
    <script src="./js/dist/Chart.bundle.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/lightbox-plus-jquery.min.js"></script>
</head>
<body>
    <div class="container-fluid m-0 p-0">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header p-1">
                        <h3 class="text-primary">Market kivu</h3>
                    </div>
                    <div class="card-body">
                        <h3>Welcome dear <?php print $_SESSION['username'];?></h3>
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur ipsa saepe debitis odio culpa, natus vel facilis ipsum ea dicta, voluptates error sequi quas. Corrupti amet consectetur accusamus provident? Vero?
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>