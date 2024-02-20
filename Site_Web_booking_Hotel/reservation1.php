<?php
include("header.php"); 
if (
    isset($_SESSION['user_id']) &&
    isset($_GET['room_id']) &&
    isset($_SESSION['date_checkin']) &&
    isset($_SESSION['date_checkout'])
) {
    $user_id = $_SESSION['user_id'];
    $room_id = $_GET['room_id'];
    $date_checkin = $_SESSION['date_checkin'];
    $date_checkout = $_SESSION['date_checkout'];

    $con = mysqli_connect("localhost", "root", "", "hotel");

    if ($con->connect_error) {
        die("Connexion échouée : " . $con->connect_error);
    } else {

        $insertQuery = "INSERT INTO réservation (id_clt, id_chambre, date_checkin, date_checkout) 
                        VALUES ('$user_id', '$room_id', '$date_checkin', '$date_checkout')";
        if (strtotime($date_checkin) > time()) {
            $updateQuery = "UPDATE chambre SET disponibilité = 1 WHERE id_chambre = '$room_id'";
        } else {
            $updateQuery = "UPDATE chambre SET disponibilité = 0 WHERE id_chambre = '$room_id'";
        }

        $updateResult = mysqli_query($con, $updateQuery);

        if (!$updateResult) {
            echo "Erreur lors de la mise à jour de la disponibilité : " . mysqli_error($con);
        }

        $insertResult = mysqli_query($con, $insertQuery);

        if (!($insertResult && $updateResult)) {
            echo "Erreur lors de l'insertion ou de la mise à jour : " . mysqli_error($con);
        } else {
           
            $sql = "SELECT * FROM chambre WHERE id_chambre = $room_id";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                $room_details = $result->fetch_assoc();
                $date1 = new DateTime($date_checkin);
                $date2 = new DateTime($date_checkout);
                $diff = $date1->diff($date2);
                $total_nights = $diff->format('%a');

                $total_amount = $total_nights * $room_details["prix"];
                $_SESSION['total_amount'] = $total_amount;
            } else {
                echo "La chambre spécifiée n'existe pas.";
            }
        }
    }
} else {
    echo "Données manquantes pour effectuer la réservation.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Page</title>
    <style>
        * {
    padding: 0;
    margin: 0;
}
body {
    font-family: 'Times New Roman', Times, serif;
    background-color: #e0e1dd;}

.txt-center {
    text-align: center;}
h1 {
    text-align: center;
    font-size: 2.5rem;
    padding-bottom: 20px;
    font-weight: 600;}
.room-item {
    top: 1%;
    background-color: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 20px;
    padding-bottom: 20px;
    transition: transform 0.3s ease-in-out;
    width: 60%;
    height: 100%;
}
.room-item img {
    width: 100%;
    height: auto;
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

i {
    margin-right: 10px;
}
.cheek {
            top: 1%;
            background-color: #ffffff;
            display: inline-block;
            position: absolute;
            top: 20%;
            right: 1%;
            width: 35%;
            height:auto;
            border-radius: 5px;
            padding: 20px;
        }

        .container {
            margin-top: 20px;
        }

        .panel {
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .panel-heading {
            background-color: #f8f9fa;
            padding: 15px;
        }

        .panel-body {
            padding: 20px;
        }

        .panel-footer {
            background-color: #f8f9fa;
            padding: 15px;
        }

        .row {
            margin-right: 15px;
            margin-left: 15px;
        }

        .text-center {
            text-align: center;
        }

        .images img {
            max-width: 100%;
            width: 18%;
            height: auto;
            margin-right: 8px;
            margin-left: 10px;
        }
        input {
            width: 200px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label{
            width: 100px;
            margin-left: -5px;
        }

        button {
    width: auto;
    padding: 10px;
    background-color: #3d5584;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 0 auto; 
    display: block;
}

        button:hover {
            background-color: #3d5564;
           
        }
        #checkin{
            margin-bottom:-15px;
            width: 100%;
        }
        #checkout{
            margin-bottom:-15px;
            width: 100%;
        }
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    border-radius: 5px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}


    </style>
</head>
<body>
    <?php
    if(isset($_GET['room_id'])) {
        $room_id = $_GET['room_id'];
        $con = mysqli_connect("localhost", "root", "", "hotel");
        if ($con->connect_error) {
            die("Connexion échouée : " . $con->connect_error);
        } else {
            $sql = "SELECT * FROM chambre WHERE id_chambre = $room_id";
            $result = $con->query($sql);

            if($result->num_rows > 0) {
                $room_details = $result->fetch_assoc();
            } else {
                echo "La chambre spécifiée n'existe pas.";
            }
        }
        mysqli_close($con);
    } else {
        header('Location: index.php'); 
        exit();
    }
    ?>
    <h1>Réservation pour <?php echo $room_details['type']; ?> </h1>
    <div class="room-item">
            <div>
            <img src="./image1/<?php echo $room_details["image"]; ?>" alt="">
                <small><?php echo $room_details["prix"] ."MAD/Nuit"; ?></small>
            </div>
            <div>
                <div>
                    <h5><?php echo $room_details["type"]; ?></h5>
                    <div>
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                        <small class="fa fa-star text-primary"></small>
                    </div>
                </div>
                <div>
                    <small><i class="fa fa-bed text-primary me-2"></i><?php echo $room_details["nbr_lit"]; ?></small>
                    <small><i class="fa fa-bath text-primary me-2"></i><?php echo $room_details["nbr_douche"]; ?></small>
                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                </div>
                <p><?php echo $room_details["description"]; ?></p>
                <div>
                </div>
            </div>
        </div>
<div class="cheek">
    
<div class="total-amount">
        <h3>Total à payer :</h3>
        <p id="totalAmount"></p>
    </div>
        <div class="container">
        <div class="row">
            <div>
                <div class="panel">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="text-center">Payment Details</h3>
                            <div class="images"> 
                                <img src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png">
                                <img src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png">
                                <img src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Paypal-Curved.png">
                                <img src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png">
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <div class="form-group">
                                <label>CARD NUMBER</label>
                                <input type="tel" placeholder="Valid Card Number"required>
                            </div>
                            
                                
                                    <div class="form-group">
                                        <label>EXPIRATION DATE</label>
                                        <input type="tel" placeholder="MM / YY"required>
                                    </div>
                                
                                
                                    <div class="form-group">
                                        <label>CV CODE</label>
                                        <input type="tel" placeholder="CVC"required>
                                    </div>
                                
                            
                            <div class="form-group">
                                <label>CARD OWNER</label>
                                <input type="text" placeholder="Card Owner Name"required>
                            </div>

                        </form>
                    </div>
                    <div class="panel-footer">
                   
                
<button id="paymentBtn">Confirm Payment</button>
                    </div>
                 

                </div>
            </div>
        </div>
    </div>
    <script>
     
        document.getElementById("paymentBtn").addEventListener("click", function() {
            window.location.href = "succes.php";
        });
    var totalAmount = <?php echo $total_amount; ?>;
    document.getElementById("totalAmount").innerHTML = totalAmount + " MAD";
    </script>
</body>
</html>
