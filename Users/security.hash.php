<?php
session_start();
include("../config/db.min.php");
if (!isset($_SESSION['Compte']) && $_SESSION['Compte'] == '') {
    header("Location: ../login.php");
}
if ($_SESSION['Admin'] != 0) {
    header("Location: ../login.php");
}
$idUser = $_SESSION['id'];

$sql = mysqli_query($con, "SELECT * FROM `login` WHERE id = '$idUser'");
while ($data = mysqli_fetch_array($sql)) {
    $array = [];
    $array[0] = $data['id'];
    $array[1] = $data['Compte'];
    $array[2] = $data['Nom'];
    $array[3] = $data['Mot_de_passe'];
    $array[4] = $data['Fonction'];
}
$output = '';