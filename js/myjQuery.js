$(document).ready(()=>{
    venteTotal();
    venteJour();
    stockeTotal();
    Lastselle();
    chiffreDaffaire();
    MyProfil();
    produitEcoule();
});

// Functions

function produitEcoule(){
    let action = 'produitEcoule';
    $.ajax({
        url: './config/event.php',
        method: 'post',
        data: {action: action},
        success: function(data){
            $('.produitEcoule').html(data);
        }
    })
}

function chiffreDaffaire(){
    let action = 'chiffreDaffaire';
    $.ajax({
        url: 'chiffreDaffaire',
        method: 'post',
        data: {action: action},
        success: function(data){
            $('.chiffreDaffaire').html(data);
        }
    })
}

function Lastselle(){
    let action = 'Lastselle';
    $.ajax({
        url: './config/config.php',
        method: 'post',
        data: {action: action},
        success: function(data){
            $('#Lastselle').html(data)
        }
    })
    setTimeout('Lastselle()', 1000);
}
function stockeTotal(){
    let action = 'stockeTotal';
    $.ajax({
        url: './config/config.php',
        method: 'post',
        data: {action: action},
        success: function(data){
            $('.stockeTotal').html(data)
        }
    })
    setTimeout('stockeTotal()', 1000);
}
function venteTotal(){
    let action = 'venteTotal';
    $.ajax({
        url: './config/config.php',
        method: 'post',
        data: {action: action},
        success: function(data){
            $('.venteTotal').html(data)
        }
    })
    setTimeout('venteTotal()', 1000);
}
function venteJour(){
    let action = 'venteJour';
    $.ajax({
        url: './config/config.php',
        method: 'post',
        data: {action: action},
        success: function(data){
            $('.venteJour').html(data)
        }
    })
    setTimeout('ventJour()', 500);
}