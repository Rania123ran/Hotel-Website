<?php
include("header.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        
        .cont {
            padding: 20px;
            border-radius: 10px;
            margin-left: 6%;
            margin-right: 6%;
            margin-top: 3%;
        }

        h3 {
            color: #333;
        }

        .divp {
            margin-top: 20px;
            background-color: #c5e1c8;
            padding: 15px;
            height: 15vh;
            border-radius: 5px;
        }

        .fa-circle-check {
            color: green;
        }

        p {
            margin: 10px 0;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #0275d8;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="cont">

        <h3>PAYMENT STATUS</h3>
        <div class="divp">
        <p><i class="far fa-circle-check" ></i>  Payment done! Booking successful</p>           
         <a href="index.php">Home page</a>
        </div>
    </div>
    <?php
        include("footer.php");
        ?>
</body>
</html>