<?php
include("header.php");
$conn = mysqli_connect("localhost", "root", "", "hotel");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//ajouter yne chambre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addtype = $_POST['roomType2'];
    $addimage = $_FILES['addimage']['name']; 
    $addprix = $_POST['addprix'];
    $adddescription = $_POST['addtext'];
    $addnbr_lit = $_POST['addlit'];
    $addnbr_douche = $_POST['adddouche'];
    $addnbr_pers = $_POST['addper'];
    $target_dir = "./image1/";
    $target_file = $target_dir . basename($_FILES['addimage']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["addimage"]["tmp_name"]);
    if ($check === false) {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
        echo "<script>alert('Désolé, le fichier existe déjà.')</script>";
        $uploadOk = 0;
    }
    if ($_FILES["addimage"]["size"] > 5000000000) {
        echo "<script>alert('Désolé, votre fichier est trop volumineux.')</script>";
        $uploadOk = 0;
    }

    $allowedExtensions = array("jpg", "jpeg", "png");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "<script>alert(''Désolé, seuls les fichiers JPG, JPEG, PNG  sont autorisés.)</script>";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "<script>alert('Désolé, votre fichier n'a pas été téléchargé.')</script>";
    } else {
      
        if (move_uploaded_file($_FILES["addimage"]["tmp_name"], $target_file)) {
            $sqll = "INSERT INTO chambre (type, image, prix, description, nbr_lit, nbr_douche, nbr_pers,disponibilité) 
                    VALUES (?, ?, ?, ?, ?, ?, ?,1)";
            $stmt = $conn->prepare($sqll);
            $stmt->bind_param("ssssiii", $addtype, $addimage, $addprix, $adddescription, $addnbr_lit, $addnbr_douche, $addnbr_pers);
            if ($stmt->execute()) {
                echo "<script>alert('Enregistrement ajouté avec succès.')</script>";
            } else {
                echo "Erreur : " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "<script>alert('Désolé, une erreur s'est produite lors du téléchargement de votre fichier.')</script>";
        }
    }
}

$sss = 'SELECT 
            réservation.id_réservation,
            client.nom AS nom_client,
            chambre.type AS type_chambre,
            réservation.date_checkin,
            réservation.date_checkout
        FROM 
            réservation
        JOIN 
            client ON réservation.id_clt = client.id_clt
        JOIN 
            chambre ON réservation.id_chambre = chambre.id_chambre';

$result = mysqli_query($conn, $sss);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #e0e1dd;
        }
        footer {
    position:fixed; 
    bottom: 0;
    width: 100%;
    background-color: #3d5574;
    color: #fff;
    text-align: center;
    padding: 10px;
}
        #wrapper {
            display: flex;
            height: 50vh;
        }

        #sidebar {
            display: none;
            width: 20%;
            background-color: #3d5574;
            color: #fff;
            padding: 20px;
            height: 50vh;
            box-sizing: border-box;
            border-radius: 10px;
            transition: width 0.5s; 
        }

        #main-content {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            margin-top:10%;
            transition: width 0.5s; 
        }

        #sidebar ul {
            list-style: none;
            padding: 0;
        }

        #sidebar ul li {
            margin-bottom: 60px;
        }

        #sidebar ul li a {
            color: black;
            text-decoration: none;
        }

        #sidebar ul li a:hover {
            color: black;
            font-size: large;
            text-decoration: none;
        }

        #main-content .dashboard-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .dashboard-item {
            width: 30%;
            background-color: #eee;
            padding: 20px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border-radius: 5px;
        }

        #main-content .dashboard-section .top-row {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        #main-content .dashboard-section .bottom-row {
            width: 80%;
            display: flex;
            justify-content: space-between;
            margin: auto;
        }

        .dashboard-item {
            width: 30%;
            padding:3% 3%;
        }

        .dashboard-item.small {
            width: 30%;
        }

        .item1 {
            border: solid 2px blue;
            background-color: #cfecf2;
        }

        .item2 {
            border: solid 2px green;
            background-color:#d6efc7;
        }

        .item3 {
            border: solid 2px red;
            background-color: #ffe5e5;
        }

        .item4 {
            border: solid 2px rgb(110, 215, 63);
            margin-left: 150px;
            background-color:#e9f2e5;
        }

        .item5 {
            border: solid 2px #ffb500;
            margin-right: 150px;
            background-color: #f3d8ce;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border:solid 2px black ;

        }

        th,
        td {
            border:solid 2px black ;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3d5584;
        }

        .i1 {
            color: red;
        }
        .dashboard-item {
    text-align: center;
}

.dashboard-item p {
    margin: 0;
}


.plusbtn {
        position: absolute;
        top: auto; 
        right: 20px; 
    }
    /*add */
    #mmy_modal{
    position: fixed;
    top: 20%;
    left: 20%;
    right: 20%;
    bottom: 20%;
    z-index: 1;
    display: none;
}
#mmy_modal.open{
    display: block !important;
}
.mmy_centent{
    max-width:600px;
    width: 100%;
    padding: 30px;
    box-sizing: border-box;
    background:#e0e1dd;
    position: absolute;
    border: solid 1px #3d5574;
    border-radius: 10px;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.mmy_exit{
  position: absolute;
  top: 0;
  right: 0;
  text-decoration: none;
  color: black;
  padding:5px 10px ;
  border-radius: 5px;

}
    </style>
</head>
<body>
<div id="wrapper"  >
<i id="menu-icon" class="fas fa-bars"></i>
    <div id="sidebar">
        <ul>
            <li><a href="?content=dashboard">Dashboard</a></li>
            <li><a href="?content=rooms">Rooms</a></li>
            <li><a href="?content=users">Users</a></li>
            <li><a href="?content=booking">Booking</a></li>
        </ul>
    </div>

    <div id="main-content">
        
        <?php
        if (isset($_GET['content'])) {
            $content = $_GET['content'];
            switch ($content) {
                case 'dashboard':
                    $sqlCountChambres = "SELECT COUNT(*) AS totalChambres FROM chambre";
                    $sqlCountReservations = "SELECT COUNT(*) AS totalReservations FROM réservation";
                    $sqlCountChambresReservees = "SELECT COUNT(DISTINCT réservation.id_chambre) AS chambresReservees 
                                                  FROM réservation 
                                                  JOIN chambre ON réservation.id_chambre = chambre.id_chambre
                                                  WHERE chambre.disponibilité = 0";
                    $sqlCountAvailableRooms = "SELECT COUNT(*) AS availableRooms FROM chambre WHERE disponibilité = 1";
                    
                    $resultCountChambres = mysqli_query($conn, $sqlCountChambres);
                    $resultCountReservations = mysqli_query($conn, $sqlCountReservations);
                    $resultCountChambresReservees = mysqli_query($conn, $sqlCountChambresReservees);
                    $resultCountAvailableRooms = mysqli_query($conn, $sqlCountAvailableRooms);
                    if (!isset($_SESSION['total_amount'])) {
                        $_SESSION['total_amount'] = 0;
                    }
                    
                    $totalRevenue = $_SESSION['total_amount'];
                    if ($resultCountChambres && $resultCountReservations && $resultCountChambresReservees   && $resultCountAvailableRooms) {
                        $rowCountChambres = mysqli_fetch_assoc($resultCountChambres);
                         $rowCountReservations = mysqli_fetch_assoc($resultCountReservations);
                            $rowCountChambresReservees = mysqli_fetch_assoc($resultCountChambresReservees);
                             $chambresReservees = $rowCountChambresReservees['chambresReservees'];
                             $rowCountAvailableRooms = mysqli_fetch_assoc($resultCountAvailableRooms);
                             $availableRooms = $rowCountAvailableRooms['availableRooms'];
                             if (isset($totalRevenue)) {
                                $totalRevenue += $_SESSION['total_amount'];
                            }
                            // Parie Dashboard 
                        echo "
                        <div class='dashboard-section'>
                            <div class='top-row'>
                                <div class='dashboard-item item1'>
                                    <p>Total Rooms</p>
                                    <p>{$rowCountChambres['totalChambres']}</p>
                                </div>
                                <div class='dashboard-item item2'>
                                <p>Total Reservations</p>
                                <p>{$rowCountReservations['totalReservations']}</p>
                                    
                                </div>
                                <div class='dashboard-item item3'>
                                <p>Booked Rooms</p>
                                <p>{$chambresReservees}</p>
                                </div>
                            </div>
                            <div class='bottom-row'>
                                <div class='dashboard-item small item4'>
                                <p>Available rooms</p>
                                <p>{$availableRooms}</p>
                                </div>
                                <div class='dashboard-item small item5'>
                                <p>Benefice</p>
                                <p>{$totalRevenue} MAD</p>
                                </div>
                            </div>
                        </div>";
                    } else {
                       
                        echo "Error: " . mysqli_error($conn);
                    }
                    break;
                    
                    
                    // Partie Booking 
                case 'booking':
                    if (mysqli_num_rows($result) > 0) {
                        
                        echo "<table border='1'>
                                <tr>
                                    <th>ID Réservation</th>
                                    <th>Nom Client</th>
                                    <th>Type Chambre</th>
                                    <th>Date Check-in</th>
                                    <th>Date Check-out</th>
                                </tr>";
                    
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id_réservation']}</td>
                                    <td>{$row['nom_client']}</td>
                                    <td>{$row['type_chambre']}</td>
                                    <td>{$row['date_checkin']}</td>
                                    <td>{$row['date_checkout']}</td>
                                  </tr>";
                        }
                    
                        echo "</table>";
                    } else {
                        echo "0 results";
                    }
                    
                    break;
                    // Partie Rooms
                case 'rooms':
                    echo "<div class='dashboard-section'>";

                            echo "<a href='javascript:void(0);' onclick='togglemymodal()' '>
                            <i  class='fa-regular fa-square-plus plusbtn'></i>
                        </a>";
                    $selectedType = isset($_POST['roomType']) ? $_POST['roomType'] : 'all';

                    if ($selectedType == 'all') {
                        $sql = "SELECT * FROM chambre";
                    } else {
                        $sql = "SELECT * FROM chambre WHERE type = '$selectedType'";
                    }

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Type</th>
                                    <th>Prix</th>
                                    <th>Description</th>
                                    <th>Nbr. de lits</th>
                                    <th>Nbr. de douches</th>
                                    <th>Delete</th>
                                </tr>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id_chambre']}</td>
                                    <td><img src='./image1/{$row['image']}' alt='' style='width: 100px;'></td>
                                    <td>{$row['type']}</td>
                                    <td>{$row['prix']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['nbr_lit']}</td>
                                    <td>{$row['nbr_douche']}</td>
                                    <td>
                                        <a href='supprimer.php?id={$row['id_chambre']}'><i class='fa-sharp fa-solid fa-trash i1'></i></a>
                                    </td>
                                    </tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "<br>0 results";
                    }

                    echo "</div>";
                    ?>
                   <!-- Modal S'ajouter  -->
        <div id="mmy_modal">
        <div class="mmy_centent">
            <a href="javascript:void(0)" onclick='togglemymodal()'><i class="fa-solid fa-x mmy_exit"></i></a>
            <h1>Ajouter une chambre</h1><br>
            <form method="POST" enctype="multipart/form-data" >
                    Type : <br>
                    <select name='roomType2' style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;">
             
                                    <option value='Simple Chambre'>Simple Chambre</option>
                                    <option value='Chambre Double'>Chambre Double</option>
                                    <option value='suite'>Suite</option>
                                    <option value='Suite de Luxe'>Suite de Luxe</option>
                                    <option value='Suite Familiale'>Suite Familiale</option>
                                </select><br>
                Image : <br>
                <input type="file" name="addimage" id=""><br>
                Prix :<br>
                <input type="text" id="addprix" name="addprix" required style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br><br>
                Description : <br>
                <textarea name="addtext" id="addtext" cols="30" rows="2" style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea><br><br>
                Nombre de lit :<br>
                
                <select id="addnbr_lit" name="addlit">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select><br>
                Nombre douche : <br>
                <select id="addnbr_douche" name="adddouche">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select><br>
                Nombre de personne : <br>
                <select id="addnbr_per" name="addper">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select><br><br>
                <input type="submit" value="ajouter" name="add" style="background-color: #3d5584; color: #fff; padding: 10px; border: none; border-radius: 4px; cursor: pointer;">
            </form>
        </div>
    </div>
                    <?php break;
                    // Users
                case 'users':
                    $sql = "SELECT * FROM client";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date de Naissance</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                </tr>";
                
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['id_clt']}</td>
                                    <td>{$row['nom']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['date_naiss']}</td>
                                    <td>{$row['adresse']}</td>
                                    <td>{$row['tel']}</td>
                                </tr>";
                        }
                
                        echo "</table>";
                    } else {
                        echo "Aucun client trouvé.";
                    }
                    break;
            }
            // Par defaut
        }else {

            $sql = "SELECT * FROM client";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Date de Naissance</th>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                        </tr>";
        
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id_clt']}</td>
                            <td>{$row['nom']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['date_naiss']}</td>
                            <td>{$row['adresse']}</td>
                            <td>{$row['tel']}</td>
                        </tr>";
                }
        
                echo "</table>";
            } else {
                echo "Aucun client trouvé.";
            }
    }
        ?>
    </div>
 <script>
    //dashboard 
        document.addEventListener('DOMContentLoaded', function () {
            const menuIcon = document.getElementById('menu-icon');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            let sidebarVisible = false;
            mainContent.style.width = '100%';

            menuIcon.addEventListener('click', function () {
                sidebarVisible = !sidebarVisible;

                if (sidebarVisible) {
                    sidebar.style.display = 'block';
                    mainContent.style.width = '80%';
                } else {
                    sidebar.style.display = 'none';
                    mainContent.style.width = '100%';
                }
            });

            sidebar.addEventListener('mouseleave', function () {
                if (!sidebarVisible) {
                    sidebar.style.display = 'none';
                    mainContent.style.width = '100%';
                }
            });

            window.addEventListener('mouseout', function (event) {
                if (!sidebar.contains(event.relatedTarget) && !menuIcon.contains(event.relatedTarget)) {
                    sidebar.style.display = 'none';
                    mainContent.style.width = '100%';
                    sidebarVisible = false;
                }
            });
        });

        //mon modal :
     
function togglemymodal() {
            let m1 = document.querySelector("#mmy_modal");
            m1.classList.toggle("open");
        }
    </script>
     <?php 
         mysqli_close($conn);
        ?>
</body>
</html>


