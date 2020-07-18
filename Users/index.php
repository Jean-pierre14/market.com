<?php include("./security.hash.php"); ?>
<?php require_once("./e.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php print $boutique . '/' . $array[1]; ?></title>
    <link rel="shortcut icon" href="../images/BarcodeScanner.PNG" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/semantic/semantic.min.css">
    <link rel="stylesheet" href="../js/dist/Chart.min.css">
    <link rel="stylesheet" href="../css/lightbox.min.css">
    <script src="../js/jquery-3.4.0.min.js"></script>
    <script src="../js/dist/Chart.bundle.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/lightbox-plus-jquery.min.js"></script>
</head>

<body class="bg-img bg-img1">
    <input type="hidden" id="MyID" value="<?php print $array[0]; ?>">
    <div class="container-fluid m-0 p-0">
        <?php if ($array[4] == 'Gerant') : ?>
        <!-- Gerant page -->
        <?php include("./includes/logisticien.php"); ?>
        <!-- Gerant page -->
        <?php elseif ($array[4] == 'Comptable') : ?>
        <h3 class="display-1">Comptable</h3>
        <?php elseif ($array[4] == 'Reception') : ?>
        <h3 class="display-1">Reception</h3>
        <?php elseif ($array[4] == 'Ouvrie') : ?>
        <h3 class="display-1">Ouvrie</h3>
        <?php else : ?>
        <div class="card m-5">
            <div class="card-body">
                <h3 class="display-4 text-danger">404</h3>
                <h1 class="text-danger">Page not found</h1>
                <a href="../login.php" class="btn btn-primary btn-sm">Retour</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <script src="../js/User.js"></script>
</body>

</html>