<?php
 include("./db.min.php");

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

if(isset($_POST['action'])){
    if($_POST['action'] == 'normal-stock'){
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
        if(@mysqli_num_rows($sql) > 0){
            while($row = mysqli_fetch_array($sql)){
                $output .= '
                    <tr class="">
                        <td class="">'.$row['Nom'].'</td>
                        <td class="">'.$row['Quantite'].'</td>
                        <td class="">'.$row['Prix_Unitaire_Achat'].'</td>
                        <td class="">'.$row['Prix_Unitaire_Vente'].'</td>';
                if($row['Monnaie'] == 'Francs'){
                    $output .= '<td class="text-light bg-success">'.$row['Monnaie'].'</td>';
                }elseif($row['Monnaie'] == 'Dollars'){
                    $output .= '<td class="text-light bg-primary">'.$row['Monnaie'].'</td>';
                }else{
                    $output .= '<td class="text-light bg-warning">'.$row['Monnaie'].'</td>';
                }
                if($row['Par_Piece'] == 1){
                    $output .= '<td class="text-success text-center"><i class="fa fa-check"></i></td>';
                }else{
                    $output .= '<td class="text-center text-danger"><i class="fa fa-trash"></i></td>';
                }
                $output .= '
                        <td class="btn-group">
                            <a href="stock.php?edit='.$row['id_product'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                ';
            }
        }else{
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
}
