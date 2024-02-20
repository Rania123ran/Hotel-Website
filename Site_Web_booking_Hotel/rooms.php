<?php
  include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>

* {
    padding: 0;
    margin: 0;
}

body {
    font-family: 'Times New Roman', Times, serif;
    background-color: #e0e1dd;
}

.txt-center {
    text-align: center;
}

h1 {
    text-align: center;
    font-size: 2.5rem;
    padding-bottom: 20px;
    font-weight: 600;
}

h2{
    text-align: center;
    color: #3d5584;
}

span {
    color: #3d5584;
}

.row {
    display: flex;
    flex-wrap: wrap;
}

.col-lg-4 {
    flex: 1 0 30%;
    max-width: 31%;
    margin-right: 2%;
    padding-right: 15px;
    padding-left: 15px;
}

.room-item {
    background-color: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 20px;
    padding-bottom: 10px;
    transition: transform 0.3s ease-in-out;
}

.room-item:hover {
    transform: scale(1.03);
}

.room-item img {
    width: 100%;
    height: 300px;
    border-bottom: 1px solid #dee2e6;
}

.room-item small {
    font-size: 0.8rem;
    margin-left: 9px;
}

.room-item h5 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    margin-left: 9px;
}

.room-item .fa-star {
    color: #ffc107;
    margin-left: 9px;
}

.room-item small i {
    margin-right: 10px;
    margin-left: 5px;
}

.room-item p {
    font-size: 0.9rem;
    color: #6c757d;
    padding-bottom: 20px;
    margin-left: 9px;
}

.btn-primary,
.btn-dark {
    width: 20%;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;
}

.btn-primary {
    background-color: #b8d0ea;
    color: black;
    text-decoration: none;
}

.btn-primary:hover {
    background-color: #ccddef;
}

.btn-dark {
    background-color: #1b263b;
    color: white;
    text-decoration: none;
}

.btn-dark:hover {
    background-color: #212f48;
}


    </style>
</head>
<body>
<?php

$con = mysqli_connect("localhost", "root", "", "hotel");

if ($con->connect_error) {
    die("Connexion échouée : " . $con->connect_error);
} else{?>
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h2 class="text-center ">Our Rooms</h2>
            <h1>Explore Our <span>Rooms</span></h1>
        </div>
    
      
    <div class="row g-4">
            
    <?php
            $sql = "select * from chambre ";
    $result = $con->query($sql );
    if($result->num_rows>0) {
        while($row = $result->fetch_assoc()) {?>
            <div class="col-lg-4  fadeInUp">
                <div class="container-xxl">
                <div class="container">
                    <div class="room-item ">
                        <div>
                        <img src="./image1/<?php echo $row["image"]; ?>" alt="">
                            <small><?php echo $row["prix"]." MAD/Nuit" ;?></small>
                        </div>
                        <div>
                            <div>
                                <h5><?php echo $row["type"] ;?></h5>
                                <div >
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                </div></div>
                            <div>
                                <small><i class="fa fa-bed text-primary me-2"></i><?php echo $row["nbr_lit"] ;?></small>
                                <small><i class="fa fa-bath text-primary me-2"></i><?php echo $row["nbr_douche"] ;?></small>
                                <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                            </div>
                            <p><?php echo $row["description"] ;?></p>
                            
                     
                      </div>
                    </div>
                </div>
                </div>   
            </div> 
                      <?php
}
}
}

        include("footer.php");

?>

</body>
</html>

