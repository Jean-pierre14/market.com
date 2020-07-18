<?php

include("../config/db.min.php");

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
                <span class="">
                    <b class="">Compte: </b>
                    ' . $row['Compte'] . '
                </span>
                ';
            }
        } else {
            $output .= '<p class="alert alert-danger">Erreur de compte vous serez arret par la police dans peu de temps</p>';
        }
        print $output;
    }
}