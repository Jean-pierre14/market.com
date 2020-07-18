<?php
require_once("../config/db.min.php");
// Boutique name
$boutique = "l'alimation Kivu";
$users = '';

$output = '';

$sqlStock = "SELECT * FROM savingproduct ORDER BY id DESC";
$result = mysqli_query($con, $sqlStock);
if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_array($result)) {
        $output .= '
        <tr class="">
            <td class="">' . $data['Nom'] . '</td>
            <td class="">' . $data['Quantite'] . '</td>
            <td class="">' . $data['Date_Expiration'] . '</td>
        </tr>
        ';
    }
} else {
    $output .= '<p class="alert alert-warning" data-role="alert">Vous n\'avez pas de produits enregistre dans votre system</p>';
}

$sqlUsers = "SELECT * FROM `login`";
$run = mysqli_query($con, $sqlUsers);
if (mysqli_num_rows($run) > 0) {
    while ($d = mysqli_fetch_array($run)) {
        $users .= '
        <tr class="">
            <td class="">' . $d['Nom'] . '</td>
            <td class="">' . $d['Compte'] . '</td>
            <td class="text-warning">' . $d['Fonction'] . '</td>
        </tr>
        ';
    }
} else {
    $users .= '<p class="alert alert-warning" data-role="alert">Vous avez un probleme!!!</p>';
}