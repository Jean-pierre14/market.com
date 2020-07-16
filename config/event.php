<?php
$con = mysqli_connect("localhost", "root", "", "marketdb") or die("Cannot be connect to this DB");

$username = '';
$pass = '';
$errors = [];
$success = [];
$imgarray = [];
$output = '';
$ID = '';
$nom = '';
$name = '';
$quantite = '';
$prix = '';
$prixV = '';
$new = '';
$password = '';

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'normal-stock') {
        $output .= '
        <table class="table m-0 table-sm table-hover table-striped" style="max-height: 80vh;overflow: scroll;">
            <thead>
                <tr>
                    <th> Nom </th>
                    <th> Quantite </th>
                    <th> Prix unitaire d\'achat </th>
                    <th> Prix unitaire de vente </th>
                    <th> Monnaie </th>
                    <th> Par Piece </th>
                    <th> --- </th>
                </tr>
            </thead>
            <tbody>
        ';

        $sql = mysqli_query($con, "SELECT * FROM savingproduct ORDER BY id DESC");
        if (@mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_array($sql)) {
                $output .= '
                    <tr class="">
                        <td class="">' . $row['Nom'] . '</td>
                        <td class="">' . $row['Quantite'] . '</td>
                        <td class="">' . $row['Prix_Unitaire_Achat'] . '</td>
                        <td class="">' . $row['Prix_Unitaire_Vente'] . '</td>';
                if ($row['Monnaie'] == 'Francs') {
                    $output .= '<td class="text-light bg-success">' . $row['Monnaie'] . '</td>';
                } elseif ($row['Monnaie'] == 'Dollars') {
                    $output .= '<td class="text-light bg-primary">' . $row['Monnaie'] . '</td>';
                } else {
                    $output .= '<td class="text-light bg-warning">' . $row['Monnaie'] . '</td>';
                }
                if ($row['Par_Piece'] == 1) {
                    $output .= '<td class="text-success text-center"><i class="fa fa-check"></i></td>';
                } else {
                    $output .= '<td class="text-center text-danger"><i class="fa fa-trash"></i></td>';
                }
                $output .= '
                        <td class="">
                            <div class="delete btn-group">
                                <a href="stock.php?edit=' . $row['id_product'] . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <a href="./config/event.php?delete=' . $row['id_product'] . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                ';
            }
        } else {
            $output .= '
            <p class="ui message negative alert alert-danger alert-dismissible fade show">
                Vous n\'avez rien en stock Desole :(
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </p>';
        }

        $output .= '
            </tbody>
        </table>
        ';
        print $output;
    }
    if ($_POST['action'] == 'search-stock') {
        $txt = $_POST['text'];
        $sql = mysqli_query($con, "SELECT * FROM savingproduct WHERE (Nom LIKE '%" . $txt . "%' OR Quantite LIKE '%" . $txt . "%' OR Prix_Unitaire_Achat LIKE '%" . $txt . "%' OR Prix_Unitaire_Vente LIKE '%" . $txt . "%')");
        if (mysqli_num_rows($sql) > 0) {
            $output .= '
            <table class="table m-0 table-sm table-hover table-striped" style="max-height: 80vh;overflow: scroll;">
                <thead>
                    <tr>
                        <th class="">Nom</th>
                        <th class="">Quantite</th>
                        <th class="pa">Prix d\'achat</th>
                        <th class="pv">Prix de vente</th>
                        <th class="">Monnaie</th>
                        <th class="">Par piece</th>
                        <th class="">----</th>
                    </tr>
                </thead>
                <tbody>
            ';
            while ($row = mysqli_fetch_array($sql)) {
                $output .= '
                    <tr class="">
                        <td class="">' . $row['Nom'] . '</td>
                        <td class="">' . $row['Quantite'] . '</td>
                        <td class="">' . $row['Prix_Unitaire_Achat'] . '</td>
                        <td class="">' . $row['Prix_Unitaire_Vente'] . '</td>';
                if ($row['Monnaie'] == 'Francs') {
                    $output .= '<td class="text-light bg-success">' . $row['Monnaie'] . '</td>';
                } elseif ($row['Monnaie'] == 'Dollars') {
                    $output .= '<td class="text-light bg-primary">' . $row['Monnaie'] . '</td>';
                } else {
                    $output .= '<td class="text-light bg-warning">' . $row['Monnaie'] . '</td>';
                }
                if ($row['Par_Piece'] == 1) {
                    $output .= '<td class="text-success text-center"><i class="fa fa-check"></i></td>';
                } else {
                    $output .= '<td class="text-center text-danger"><i class="fa fa-trash"></i></td>';
                }
                $output .= '
                        <td class="">
                            <div class="delete btn-group">
                                <a href="stock.php?edit=' . $row['id_product'] . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <a href="./config/event.php?delete=' . $row['id_product'] . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                ';
            }
            $output .= '
                <tbody>
            </table>
            ';
        } else {
            $output .= '<p class="alert alert-warning">Cette article n\'existe pas dans notre systeme</p>';
        }
        print $output;
    }
    if ($_POST['action'] == 'modification') {
        $id = htmlentities(mysqli_real_escape_string($con, trim($_POST['id'])));
        $sql = mysqli_query($con, "SELECT * FROM savingproduct WHERE id_product = '$id'");

        if (@mysqli_num_rows($sql) == 1) {
            while ($row = mysqli_fetch_array($sql)) {
                $output .= '
                <div class="card mt-3 shadow">                                
                    <div class="card-body">
                        <h5 class="card-title text-warning">Les modification</h5>
                        <p class="card-text d-flex justify-content-between align-items-center">
                            Nom du produict:
                            <span>' . $row['Nom'] . '</span>
                        </p>
                        <p class="card-text d-flex justify-content-between align-items-center">
                            Quantite:
                            <span>' . $row['Quantite'] . '</span>
                        </p>
                        <p class="card-text d-flex justify-content-between align-items-center">
                            Prix unitaire:
                            <span>' . $row['Prix_Unitaire_Achat'] . '</span>
                        </p>
                        <p class="card-text d-flex justify-content-between align-items-center">
                            Prix unitaire de vente:
                            <span>' . $row['Prix_Unitaire_Vente'] . '</span>
                        </p>
                        <div class="text-warning">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                ';
            }
        } else {
            $output .= '
            <p class="alert alert-danger alert-dismissible" data-role="alert">
                L\'Article n\'exit pas 
            </p>';
        }
        print $output;
    }

    if ($_POST['action'] == 'profile') {
        $id = $_POST['id'];
        $sql = mysqli_query($con, "SELECT * FROM `login` WHERE id = '$id'");

        if (mysqli_num_rows($sql) == 1) {
            while ($row = mysqli_fetch_array($sql)) {
                $output .= '
                <div class="row justify-content-center">
                    <div class="col-md-5 col-sm-12 col-lg-6 mt-3 bg-light border-radius p-3 shadow">
                        <p class="text-center display-5 d-flex justify-content-between align-items-center">
                            Nom: 
                            <span class="text-warning">
                                ' . $row['Nom'] . '
                            </span>
                        </p>
                        <p class="text-center display-5 d-flex justify-content-between align-items-center">
                            Compte: 
                            <span class="text-warning">
                                ' . $row['Compte'] . '
                            </span>
                        </p>
                        <p class="text-center display-5 d-flex justify-content-between align-items-center">
                            Poste: 
                            <span class="text-warning">
                                ' . $row['Fonction'] . '
                            </span>
                        </p>
                    </div>
                </div>
                ';
            }
        } else {
            $output .= '<p class="alert alert-warning alert-dismissible">Vous etez perdu</p>';
        }
        print $output;
    }

    if ($_POST['action'] == 'MyProfil') {
        $id = $_POST['id'];
        $sql = mysqli_query($con, "SELECT * FROM `login` WHERE id = '$id'");
        if (@mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_array($sql)) {
                $output .= '
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="text-light">' . $row['Compte'] . ' <span class="text-uppercase">' . $row['Nom'] . '</span></h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn border border-2 m-1 border-light text-light"><i class="fa fa-user-circle"></i></button>
                        <button class="btn border border-2 border-light text-light"><i class="fa fa-cog"></i></button>
                        <button class="btn border border-2 m-1 border-light text-light"><i class="fa fa-address-book"></i></button>
                    </div>
                </div>
                <p class="mb-5 text-light d-flex justify-content-between align-items-center">
                    <span class="">Fonction: ' . $row['Fonction'] . '</span>
                    <span class="small">marketkivu@gmail.com</span>
                </p>
                <a href="profil.php" class="btn btn-lg btn-danger shadow">Profile <i class="fa fa-user"></i></a>
                ';
            }
        } else {
            $output .= '
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-danger">Vous etez perdu d\'avance</h3>
                <div class="d-flex justify-content-between text-danger align-items-center">
                    <button class="btn border border-2 m-1 border-light text-light"><i class="fa fa-user-circle"></i></button>
                    <button class="btn border border-2 border-light text-light"><i class="fa fa-bars"></i></button>
                    <button class="btn border border-2 m-1 border-light text-light"><i class="fa fa-address-book"></i></button>
                </div>
            </div>
            <p class="mb-5 text-light">marketkivu@gmail.com</p>
            ';
        }
        print $output;
    }

    // Produit ecoule
    if ($_POST['action'] == 'produitEcoule') {
        $sql = mysqli_query($con, "SELECT * FROM product_ecoule_view");
        if (@mysqli_num_rows($sql) == 1) {
            $row = mysqli_fetch_array($sql);
            $output .= '<p>' . $row['product_ecoule'] . ' <small class="small">Articles</small></p>';
        } else {
            $output .= '<span>00,000 <small>Article</small></span>';
        }
        print $output;
    }
    if ($_POST['action'] == 'EntreFranc') {
        $sql = mysqli_query($con, "SELECT * FROM entreemontantfrancs");
        $row = mysqli_fetch_array($sql);
        print $row['SUM(Montant)'] . ' fc';
    }
}

if (isset($_POST['ajouter'])) {
    $ID = htmlentities(mysqli_real_escape_string($con, trim($_POST['id'])));
    $nom = htmlentities(mysqli_real_escape_string($con, trim($_POST['nom'])));
    $quantite = htmlentities(mysqli_real_escape_string($con, trim($_POST['quantite'])));
    $prix = htmlentities(mysqli_real_escape_string($con, trim($_POST['prix'])));
    $prixV = htmlentities(mysqli_real_escape_string($con, trim($_POST['prixV'])));
    $monnaie = htmlentities(mysqli_real_escape_string($con, trim($_POST['monnaie'])));
    $pp = htmlentities(mysqli_real_escape_string($con, trim($_POST['parpiece'])));


    if (empty($ID)) {
        array_push($errors, "Identifie le product");
    }
    if (empty($nom)) {
        array_push($errors, "Le nom est vide");
    }
    if (empty($quantite)) {
        array_push($errors, "Quantite est vide");
    }
    if (empty($prix)) {
        array_push($errors, "Prix unitaire est vide");
    }
    if (empty($prixV)) {
        array_push($errors, "Prix unitaire de Vente est vide");
    }
    if (empty($monnaie)) {
        array_push($errors, "monnaie est vide");
    }
    if (empty($pp)) {
        array_push($errors, "Marque si le produit est par piece ou non");
    }

    if (count($errors) == 0) {

        $sql = mysqli_query($con, "INSERT INTO savingproduct(ID, Nom, Quantite, Prix_Unitaire_Achat, Prix_Unitaire_Vente, Monnaie, Par_Piece) VALUES('$ID','$nom','$quantite','$prix', '$prixV', '$monnaie', '$pp')");
        if ($sql) {
            print '<p class="ui message positive alert alert-success">Enregistrement reussi ' . $nom . '</p>';
            $ID = '';
            $nom = '';
            $quantite = '';
            $prix = '';
            $prixV = '';
            $monnaie = '';
            $pp = '';
        } else {
            array_push($errors, "Probleme, verifie votre code");
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = mysqli_query($con, "DELETE FROM savingproduct WHERE id_product = '$id'");
    if ($sql)
        header("location: ../stock.php");
    else
        print '<p class="alert alert-warning">Probleme du syteme veille reessaie</p>';
}