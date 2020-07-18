<?php include("./header.php"); ?>

<body class="bg-img bg-img1">
    <input type="hidden" id="MyID" value="<?php print $array[0]; ?>">
    <div class="container-fluid m-0 p-0">
        <?php if ($array[4] == 'Logisticien') : ?>
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
    <?php include("./footer.php"); ?>