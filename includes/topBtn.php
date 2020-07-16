<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: calibri !important;
        }
        section{
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
            background-image: url(../images/animal-blur-fur-horns-207029.jpg);
            width: 100%;
            height: 100vh;
        }
    </style>
</head>
<body>
    <button type="button" id="TopBtn"><i class="fa fa-arrow-up"></i></button>

    <script src="../js/jquery-3.4.0.min.js"></script>
    <script src="../js/all.min.js"></script>
    <script>
        $(document).ready( function(){
            window.scroll( function(){
                if($(this).scrollTop > 40){
                    $('#TopBtn').fadeIn()
                }else{
                    $('#TopBtn').fadeOut()
                }
            })
            $('#TopBtn').click( function(){
                $('html, body').animate({scrollTop:0},80)
            })
        });
    </script>
</body>
</html>