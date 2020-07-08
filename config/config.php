<?php
include("db.min.php");

$username = '';
$pass = '';
$errors = [];
$imgarray = [];
$output = '';
$ID = '';
$nom = '';
$name = '';
$quantite = '';
$prix = '';
$new = '';
$password = '';
if(isset($_POST['login'])){

    $username = htmlentities(mysqli_real_escape_string($con, trim($_POST['username'])));
    $pass = htmlentities(mysqli_real_escape_string($con, trim($_POST['password'])));

    if(empty($username)){array_push($errors, "Compte est vide");}
    if(empty($pass)){array_push($errors, "Mot de pass est vide");}

    if(count($errors) == 0){
        $sql = mysqli_query($con, "SELECT * FROM `login` WHERE Compte = '$username' AND `Mot_de_passe`='$pass'");
        if(@mysqli_num_rows($sql) == 1){
            session_start();
            $_SESSION = @mysqli_fetch_array($sql, MYSQLI_ASSOC);
            $_SESSION['Admin'] = (int)$_SESSION['Admin'];
            
            $url = ($_SESSION['Admin'] === 1) ? 'index.php' : '404.php';

            header("Location: ". $url);
            exit();

            mysqli_free_result($sql);
            mysqli_close($con);
        }else{
            array_push($errors, "Compte ou mot de pass invalide");
        }
    }
}

if(isset($_POST['action'])){
    if($_POST['action'] == 'venteTotal'){
        $sql = mysqli_query($con, "SELECT COUNT(*) AS totalV FROM history");
        if(@mysqli_num_rows($sql) > 0){
            $row = @mysqli_fetch_array($sql);
            $output .= '<p>'.$row['totalV'].'</p>';
        }else{
            $output .= '<p class="">Zero vent jusque la</p>';
        }
        print $output;
    }
    if($_POST['action'] == 'stockeTotal'){
        $sql = mysqli_query($con, "SELECT SUM(Quantite) AS totalV FROM savingproduct");
        if(@mysqli_num_rows($sql) > 0){
            $row = @mysqli_fetch_array($sql);
            $output .= '<p>'.$row['totalV'].' <small>Articles</small></p>';
        }else{
            $output .= '<p class="">Zero vent jusque la</p>';
        }
        print $output;
    }
    if($_POST['action'] == 'venteJour'){
        $sql = mysqli_query($con, "SELECT COUNT(*) AS totalV FROM history WHERE `Date` = now()");
        if(@mysqli_num_rows($sql) > 0){
            $row = @mysqli_fetch_array($sql);
            $output .= '<p class="text-danger">'.$row['totalV'].',000, 000</p>';
        }else{
            $output .= '<p class="">Zero vent jusque la</p>';
        }
        print $output;
    }
    if($_POST['action'] == 'Lastselle'){
        $sql = mysqli_query($con, "SELECT * FROM history ORDER BY id DESC LIMIT 8");
        if(@mysqli_num_rows($sql) > 0){
            $output .= '
            <table class="table text-center table-hover table-striped table-light table-sm">
            <thead>
                <tr>
                    <th> Nombre(s) </th>
                    <th> Non du product </th>
                    <th> Prix unitaire </th>
                    <th> Prix total </th>
                    <th> En Dollars </th>
                </tr>
            </thead>
            <tbody>
            ';
            while($row = @mysqli_fetch_array($sql)){
                $output .= '
                    <tr>
                        <td> '.$row['Quantite'].' </td>
                        <td> '.$row['Nom'].' </td>
                        <td class="text-success"> '.$row['Prix_Unitaire_Achat'].' </td>
                        <td class="text-danger"> '.$row['Prix_Total'].' </td>
                        <td> '.$row['Date'].' </td>
                    </tr>
                ';
            }
            $output .= '
                </tbody>
            </table>';
        }else{
            $output .= '<p class="">Zero vent jusque la</p>';
        }
        print $output;
    }
    if($_POST['action'] == 'stocket'){
        $output .= '
        <table class="table table-hover table-striped table-sm">
            <thead>
                <tr>
                    <th> Nom du product </th>
                    <th class="text-secondary"> Quantite </th>
                    <th class="text-secondary"> Image </th>
                    <th class="text-danger"> Prix unitaire </th>
                    <th class="text-danger"> Monnaie </th>
                    <th class="text-danger"> Operations </th>
                </tr>
            </thead>
            <tbody id="myTable">
        ';
        $sql = mysqli_query($con, "SELECT * FROM savingproduct ORDER BY nom DESC");
        if(@mysqli_num_rows($sql) > 0){
            while($row = mysqli_fetch_array($sql)){
                $output .= '
                    <tr>
                        <td> '. $row['Nom'] .' </td>
                        <td> '. $row['Quantite'] .' </td>
                        <td> 
                            <a href="'.$row['product_image'].'" data-lightbox="mygallery" title="'.$row['Nom'].'">
                                <img src="'.$row['product_image'] .'" class="ui image avatar">
                            </a>
                        </td>
                        <td> '. $row['Prix_Unitaire'] .' </td>
                        <td> '. $row['monnaie'] .' </td>
                        <td> 
                            <div class="btn-group">
                                <a href="stock.php?edit='.$row['id_product'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <a href="stock.php?delete='.$row['id_product'].'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                ';
            }
        }else{
            $output .= '
            <tr>
                <td colspan="4" class="text-center text-danger red"> Vous n\'avez rien en stocket !! :( </td>
            </tr>
            ';
        }
        $output .= '</tbody></table>';
        print $output;
    }
    if($_POST['action'] == 'stockCard'){
        $sql = mysqli_query($con, "SELECT * FROM savingproduct");
        if(@mysqli_num_rows($sql) > 0){
            while($row = mysqli_fetch_array($sql)){
                $output .= '                
                <div class="col-md-2 p-1 clearfix">
                    <div class="card">
                        <a href="'.$row['product_image'].'" data-lightbox="mygallery" title="'.$row['Nom'].'">
                            <img src="'.$row['product_image'].'" class="card-img-top img-fluid img ui image" style="max-height: 140px;">
                        </a>
                        <div class="card-body">
                            <small class="text-secondary">'.$row['Nom'].'</small>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-danger display-5">'.$row['Prix_Unitaire'].' '. $row['monnaie'] .'</p>
                                <a href="stock.php?edit='.$row['id_product'].'" class="btn text-info"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
        }else{
            $output .= '
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-danger">Vous n\'avez rien en stock</p>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        print $output;
    }
    if($_POST['action'] == 'aboutThis'){
        $id = htmlentities(mysqli_real_escape_string($con, trim($_POST['id'])));
        $sql = mysqli_query($con, "SELECT * FROM journale_tb WHERE id_product = '$id' ORDER BY id DESC LIMIT 5");
        if(@mysqli_num_rows($sql) > 0){
            $output .= '
            <div class="card mt-2 mb-3">
                <div class="card-header p-1">
                    <p class="text-primary bold">Les Modifications</p>
                </div>
                <div class="card-body">
                    <table class="ui table table-sm table-hover table-striped">
                        <thead class="">
                            <tr class="">
                                <th class="">N<sup>o</sup></th>
                                <th class=""> Quantite </th>
                                <th class=""> Prix </th>
                                <th class=""> Monnaie </th>
                                <th class=""> Admin </th>
                            </tr>
                        </thead>
                        <tbody>
            ';
            while($row = mysqli_fetch_array($sql)){
                
                $output .= '
                    <tr class="">
                        <td class=""> '. $row['id'] .' </td>
                        <td class=""> '. $row['stock'] .' </td>
                        <td class=""> '. $row['Prix_Unitaire'] .' </td>
                        <td class=""> '. $row['monnaie'] .' </td>
                        <td class=""> 
                            <div class="btn-group">
                                <a href="#edit" data-toggle="tooltip" title="Modifie" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="#delete" data-toggle="tooltip" title="Efface" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                ';
            }
            $output .= '
                        </tbody>
                    </table>
                    <div class="mt-2 d-flex justify-content-between align-items-center">
                        <button class="btn btn-sm btn-primary">Imprime <i class="fa fa-print"></i></button>
                        <div class="">
                            <div class="btn-group">
                                <button type="button" data-target="#myList" data-toggle="modal" class="btn btn-sm btn-warning text-light">Voir tout <i class="fa fa-list"></i></button>
                                <button class="btn btn-sm btn-danger">Efface tout <i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }else{
            $output .= '
            <div class="ui message mt-3 positive alert alert-success d-flex justify-content-between align-items-center">
                <p class="">Vous n\'avez jamais modifie cette article</p>
                <button class="btn btn-sm text-danger" style="font-size: 20px; margin-top: -15px;outline: none">&Cross;</button>
            </div>
            ';
        }
        print $output;
    }
    if($_POST['action'] == 'personnel'){
        $id = $_POST['id'];
        $sql = mysqli_query($con, "SELECT * FROM `login` WHERE Compte != '$id'");
        if(@mysqli_num_rows($sql) > 0){
            $output .= '<div class="list-group m-2">';
            while($row = mysqli_fetch_array($sql)){
                $output .= '
                    <a href="admin.php?username='.$row['id'].'" class="list-group-item list-group-item-primary d-flex justify-content-between align-items-center list-group-item-action">
                        '.$row['Compte'].'
                    </a>
                ';
            }
            $output .= '</div>';
        }else{
            $output .= '
                <p class="alert alert-danger ui message negative">Vous n\'avez pas du personnel</p>
            ';
        }
        print $output;
    }
    if($_POST['action'] == 'myAccount'){
        $id = $_POST['id'];
        $sql = mysqli_query($con, "SELECT * FROM `login` WHERE username = '$id'");
        if(@mysqli_num_rows($sql) == 1){
            while($row = mysqli_fetch_array($sql)){
                $output .= '
                    <div class="card m-2">
                        <div class="card-header p-1">
                            <h2 class="text-primary">Profile</h2>
                        </div>
                        <div class="card-body text-primary list-group-item-action">
                            <p class="">'.$row['Compte'].'</p>
                            <p class="">'.$row['Nom'].'</p>
                            <p class="text-primary nav-link">'.$row['Fonction'].'</p>
                        </div>
                    </div>
                ';
            }
        }
        print $output;
    }
    if($_POST['action'] == 'searchPersonnel'){
        $txt = htmlentities(mysqli_real_escape_string($con, trim($_POST['txt'])));
        $sql = mysqli_query($con, "SELECT * FROM `login` WHERE (Compte LIKE '%$txt%' OR Nom LIKE '%$txt%' OR Fonction LIKE '%$txt%')");
        if(mysqli_num_rows($sql) > 0){
            $output .= '<div class="list-group ml-2 mb-2">';
            while($row = mysqli_fetch_array($sql)){
                $output .= '<a href="admin.php?username='.$row['id'].'" class="list-group-item list-group-item-primary d-flex justify-content-between">
                    '.$row['Compte'].'
                    <span class="">'.$row['Fonction'].'</span>
                </a>';
            }
            $output .= '</div>';
        }else{
            $output .= '<p class="ui message negative alert alert-danger">Nom introuvable</p>';
        }
        print $output;
    }
    
    if($_POST['action'] == 'chiffreDaffaire'){
        print "chiffreDaffaire ajax add";
    }
}

if(isset($_POST['ajouter'])){
    $ID = htmlentities(mysqli_real_escape_string($con, trim($_POST['id'])));
    $nom = htmlentities(mysqli_real_escape_string($con, trim($_POST['nom'])));
    $quantite = htmlentities(mysqli_real_escape_string($con, trim($_POST['quantite'])));
    $prix = htmlentities(mysqli_real_escape_string($con, trim($_POST['prix'])));
    $monnaie = htmlentities(mysqli_real_escape_string($con, trim($_POST['monnaie'])));

    // image
    $target_dir = './images/product/';
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    if($imgFileType != 'jpg' && $imgFileType != 'png' && $imgFileType != 'jpeg' && $imgFileType != 'gif'){array_push($errors, "Desole seulement des images de format jpg png jpeg et gif");}

    if(empty($ID)){array_push($errors, "Identifie le product");}
    if(empty($nom)){array_push($errors, "Le nom est vide");}
    if(empty($quantite)){array_push($errors, "Quantite est vide");}
    if(empty($prix)){array_push($errors, "Prix unitaire est vide");}

    if(count($errors) == 0){
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $sql = mysqli_query($con, "INSERT INTO savingproduct(ID, Nom, Quantite, Prix_Unitaire, monnaie, product_image) VALUES('$ID','$nom','$quantite','$prix', '$monnaie', '$target_file')");
        if($sql){
            print '<p class="ui message positive alert alert-success">Enregistrement reussi '.$nom.'</p>';
            $ID = '';
            $nom = '';
            $quantite = '';
            $prix = '';
            $monnaie = '';
        }else{
            array_push($errors, "Probleme, verifie votre code");
        }
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $ID = htmlentities(mysqli_real_escape_string($con, trim($_POST['ID'])));
    $nom = htmlentities(mysqli_real_escape_string($con, trim($_POST['name'])));
    $quantite = htmlentities(mysqli_real_escape_string($con, trim($_POST['quantite'])));
    $prix = htmlentities(mysqli_real_escape_string($con, trim($_POST['prix'])));
    $monnaie = htmlentities(mysqli_real_escape_string($con, trim($_POST['monnaie'])));

    if(empty($ID)){array_push($errors, "Id Est vide");}
    if(empty($nom)){array_push($errors, "Le nom est vide");}
    if(empty($quantite)){array_push($errors, "La quantite est tres importante");}
    if(empty($prix)){array_push($errors, "Le prix est vraiment Utile");}
    if(empty($monnaie)){array_push($errors, "monnaie est important");}

    if(count($errors) == 0){
        $sql0 = mysqli_query($con, "INSERT INTO journale_tb(id_product, stock, Prix_Unitaire, monnaie, `Date`) VALUES('$id', '$quantite', '$prix', '$monnaie', now())");
        $sql = mysqli_query($con, "UPDATE savingproduct SET Nom='$nom', Quantite='$quantite', Prix_Unitaire='$prix', monnaie = '$monnaie' WHERE id_product = '$id'");
        if($sql){
            print '<p class="alert alert-success">Mise a jour reussi~ </p>';
        }else{
            array_push($errors, "Appelle les technicien vous avez de probleme");
        }
    }
}
if(isset($_POST['updateImg'])){
    $id = htmlentities(mysqli_real_escape_string($con, trim($_POST['id_product'])));
    $target_dir = './images/product';
    $target_file = $target_dir . basename($_FILES['img']['name']);
    $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imgFileType != 'jpg' && $imgFileType != 'png' && $imgFileType != 'jpeg' && $imgFileType != 'gif'){array_push($imgarray, "Seulement des images de format jpg, png, jpeg, et gif");}
    if(empty($_FILES['img']['name'])){array_push($imgarray, "Vous essaiez d'ajoute quelque chose qui est vide!!!");}
    if(count($imgarray) == 0){
        move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
        $sql = mysqli_query($con, "UPDATE savingproduct SET product_image = '$target_file' WHERE id_product = '$id'");
        if($sql){
            print '<p class="ui message positive alert alert-success">Mise jour reussi!</p>';
        }else{
            print '<p class="ui message negative alert alert-danger">Mise jour Echoue!</p>';
        }
    }
}

if(isset($_POST['ajouteImage'])){
    $id = htmlentities(mysqli_real_escape_string($con, trim($_POST['id_product'])));
    $target_dir = './images/product';
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imgFileType != 'jpg' && $imgFileType != 'png' && $imgFileType != 'jpeg' && $imgFileType != 'gif'){array_push($imgarray, "Seulement des images de format jpg, png, jpeg, et gif");}
    if(empty($_FILES['image']['name'])){array_push($imgarray, "Vous essaiez d'ajoute quelque chose qui est vide!!!");}
    if(count($imgarray) == 0){
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $sql = mysqli_query($con, "UPDATE savingproduct SET product_image = '$target_file' WHERE id_product = '$id'");
        if($sql){
            print '<p class="ui message positive alert alert-success">Mise jour reussi!</p>';
        }else{
            print '<p class="ui message negative alert alert-danger">Mise jour Echoue!</p>';
        }
    }
}

if(isset($_POST['ajouterPersonnel'])){
    $name = htmlentities(mysqli_real_escape_string($con, trim($_POST['name'])));
    $username = htmlentities(mysqli_real_escape_string($con, trim($_POST['username'])));
    $post = htmlentities(mysqli_real_escape_string($con, trim($_POST['post'])));
    $pass = 1234;

    if(empty($name)){array_push($errors, "Nom d'utilisateur est vide");}
    if(empty($username)){array_push($errors, "Nom est vide");}
    if(empty($post)){array_push($errors, "Fonction ou poste est vide");}

    if(count($errors) == 0){
        $sql = mysqli_query($con, "INSERT INTO `login`(Compte, `Nom`, `Mot_de_pass`, `Fonction`) VALUES('$username', '$name', '$pass', '$post')");
        if($sql){
            print '<p class="alert alert-success ui message positive">Enregistrement reussi!!!</p>';
        }else{
            print '<p class="alert alert-danger ui message negative">Echec</p>';
        }
    }
}

if(isset($_POST['changePassword'])){
    $id = $_POST['idGet'];
    $idADM = $_POST['idADM'];
    $new = htmlentities(mysqli_real_escape_string($con, trim($_POST['new'])));
    $pass = htmlentities(mysqli_real_escape_string($con, trim($_POST['pass'])));
    $password = htmlentities(mysqli_real_escape_string($con, trim($_POST['password'])));

    if(empty($new)){array_push($errors, "Le nouveau mot de pass est vide");}
    if(empty($pass)){array_push($errors, "La confirmation est vide");}
    if($new != $pass){array_push($errors, "Les Mot de pass ne semble pas");}
    if(empty($password)){array_push($errors, "Votre mot de pass est vide");}
    if(count($errors) == 0){
        $check = mysqli_query($con, "SELECT * FROM `login` WHERE id = '$idADM'");

        $row = mysqli_fetch_array($check);
        if($row['Mot_de_pass'] != $password){
            array_push($errors, "Votre mot de pass est incorrect");
        }else{
            $sql = mysqli_query($con, "UPDATE `login` SET Mot_de_pass = '$pass' WHERE id = '$id'");
            if($sql){
                print '<p class="alert alert-success ui message positive">Mot de pass Modifie</p>';
                $new = '';
                $pass = '';
                $password = '';
            }else{
                print '<p class="alert alert-danger ui message negative">Failed</p>';
            }
        }
    }
}

if(isset($_POST['updatePersonnel'])){
    $id = htmlentities(mysqli_real_escape_string($con, trim($_POST['id'])));
    $username = htmlentities(mysqli_real_escape_string($con, trim($_POST['username'])));
    $name = htmlentities(mysqli_real_escape_string($con, trim($_POST['name'])));

    if(empty($username)){array_push($errors, "Le nom d'utilisateur est vide");}
    if(empty($name)){array_push($errors, "Le nom est vide");}

    if(count($errors) == 0){
        $sql = mysqli_query($con, "UPDATE `login` SET Compte = '$username', `Nom` = '$name' WHERE id = '$id'");
        if($sql)
            print '<p class="ui message positive alert alert-success">Succe vous avez modifie le compte</p>';
        else
            print '<p class="ui meeage negative alert alert-danger">Echec probleme de reseaux veillez contact le Service</p>';
    }
}
?>