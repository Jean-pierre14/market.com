<?php

require_once("../../config/db.min.php");
// Boutique name
$boutique = "l'alimation Kivu";

// Varibles
$output = '';
$errors = [];
$success = [];

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'profil') {
        $id = $_POST['id'];
        $sql = mysqli_query($con, "SELECT * FROM `login` WHERE id = '$id'");

        if (@mysqli_num_rows($sql) == 1) {
            while ($row = mysqli_fetch_array($sql)) {
                $output .= '
                <span class="d-flex justify-content-between align-items-center">
                    <b class="">Compte: </b>
                    ' . $row['Compte'] . '
                </span>
                <span class="d-flex justify-content-between align-items-center">
                    <b class="">Nom: </b>
                    ' . $row['Nom'] . '
                </span>
                <span class="d-flex justify-content-between align-items-center">
                    <b class="">Fonction: </b>
                    ' . $row['Fonction'] . '
                </span>
                ';
            }
        } else {
            $output .= '<p class="alert alert-danger">Erreur de compte vous serez arret par la police dans peu de temps</p>';
        }
        print $output;
    }
}