<?php
session_start();
include("../config/db.min.php");
if (!isset($_SESSION['Compte']) && $_SESSION['Compte'] == '') {
    header("Location: login.php");
}
$idUser = $_SESSION['Compte'];

$sql = mysqli_query($con, "SELECT * FROM login WHERE Compte = '$idUser'");
while ($data = mysqli_fetch_array($sql)) {
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
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market.org/<?php print $array[1]; ?></title>
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

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top d-flex justify-content-between">
        <a class="navbar-brand float-left" href="../index.php">Market kivu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php"><i class="fa fa-home"></i> Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../stock.php"><i class="fa fa-database"></i> Stock </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin.php"><i class="fa fa-users"></i> Personnelles </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../profil.php"><i class="fa fa-user"></i> Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../propos.php"><i class="fa fa-comment"></i> A propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php"><i class="icon logout"></i> Se deconnecte</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="containerid-fluid" style="min-height: 80vh">
        <div class="row justify-content-center p-5">
            <div class="col-md-3 col-sm-12 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Les Entrees</h3>
                        <p>
                            Toutes les donnees sont simplifie pour vous et rien que vous
                        </p>
                        <a href="../index.php" class="hide-lg show-sm btn btn-sm btn-warning float-left mb-2">Retour <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="text-warning">
                            Les Montants
                        </h3>
                    </div>
                    <div class="card-body">
                        <p class="dflex justify-content-between align-items-center">
                            <span>
                                Dollar:
                            </span>
                            <span class="text-success" id="EntreDollar">
                                000000
                            </span>
                        </p>
                        <p class="dflex justify-content-between align-items-center">
                            <span>
                                Francs
                            </span>
                            <span class="text-danger" id="EntreFranc">
                                000000
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-lg-9">
                <div class="table-responsive">
                    <div id="table"></div>
                    <button type="button" class="btn btn-sm btn-primary" id="printEnter">Imprime</button>
                    <a href="sortie.php" class="btn btn-sm btn-warning text-light">Voir les sorties</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ScrollTop -->
    <?php include("./topBtn.php"); ?>
    <!-- ScrollTop -->
    <div class="container-fluid text-light bg-dark m-0 footer">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center p-5">
                <p>Marketkivu.com</p>
                <small>copyright Commerciale &copy; 2020</small>
            </div>
        </div>
    </div>
    <script src="../js/printthis.js"></script>
    <script>
    window.addEventListener('scroll', function() {
        let scroll = document.querySelector('#TopBtn');
        scroll.classList.toggle("active", window.screenY > 50);
    });
    </script>
    <script>
    $().ready(() => {
        MyProfil();
        EntreFranc();
        EntreDollar();
        table();
        $('#printEnter').click('click', function() {
            $('#print').printThis({
                debug: false, // show the iframe for debugging
                importCSS: true, // import parent page css
                importStyle: true, // import style tags
                printContainer: true, // print outer container/$.selector
                loadCSS: "../../css/bootstrap.min.css", // path to additional css file - use an array [] for multiple
                pageTitle: "Kivu Alimentation", // add title to print page
                removeInline: false, // remove inline styles from print elements
                removeInlineSelector: "*", // custom selectors to filter inline styles. removeInline must be true
                printDelay: 333, // variable print delay
                header: "<h3 class='text-center text-uppercase text-primary'>KiVu Alimentation</h3>", // prefix to html
                footer: null, // postfix to html
                base: false, // preserve the BASE tag or accept a string for the URL
                formValues: true, // preserve input/form values
                canvas: false, // copy canvas content
                doctypeString: '...', // enter a different doctype for older markup
                removeScripts: false, // remove script tags from print content
                copyTagClasses: false, // copy classes from the html & body tag
                beforePrintEvent: null, // function for printEvent in iframe
                beforePrint: null, // function called before iframe is filled
                afterPrint: null // function called before iframe is removed
            });
        })
    })

    function table() {
        let action = 'table';
        $.ajax({
            url: '../config/event.php',
            method: 'post',
            data: {
                action: action
            },
            success: function(data) {
                $('#table').html(data)
            }
        })
    }

    function EntreDollar() {
        let action = 'EntreDollar';
        $.ajax({
            url: '../config/event.php',
            method: 'post',
            data: {
                action: action
            },
            success: function(data) {
                $('#EntreDollar').html(data)
            }
        })
    }

    function EntreFranc() {
        let action = 'EntreFranc';
        $.ajax({
            url: '../config/event.php',
            method: 'post',
            data: {
                action: action
            },
            success: function(data) {
                $('#EntreFranc').html(data)
            }
        })
    }

    function MyProfil() {
        let action = 'MyProfil';
        let id = $('#MyAccountId').val();
        $.ajax({
            url: '../config/event.php',
            method: 'post',
            data: {
                action: action,
                id: id
            },
            success: function(data) {
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