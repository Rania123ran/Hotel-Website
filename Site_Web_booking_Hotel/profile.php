<?php
  include("header.php");
  if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

$conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 300); 

$query = "SELECT nom, tel, adresse FROM client WHERE id_clt = '$userId'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {

    echo "Erreur : Données de l'utilisateur non trouvées.";
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["newpwd"];
    $newFirstName = $_POST["firstname"];
    $newPhone = $_POST["phone"];
    $newBirthdate = $_POST["birthdate"];
    $newAddress = $_POST["address"];

    $updateQuery = "UPDATE client SET 
                nom = '$newFirstName',
                tel = '$newPhone',
                date_naiss = '$newBirthdate',
                adresse = '$newAddress'
                WHERE id_clt = '$userId'";
    $updateResult = $conn->query($updateQuery);}
   
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    font-family: 'Poppins', sans-serif;
    background-color: aliceblue;

}

.wrapper{
    padding: 30px 50px;
    border: 1px solid #ddd;
    border-radius: 15px;
    margin: 10px auto;
    max-width: 70%;
}
h4{
    letter-spacing: -1px;
    font-weight: 400;
}
.img{
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
}
#img-section p,#deactivate p{
    font-size: 12px;
    color: #777;
    margin-bottom: 10px;
    text-align: justify;
}
#img-section b,#img-section button,#deactivate b{
    font-size: 14px; 
}

label{
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 500;
    color: #777;
    padding-left: 3px;
}

.form-control{
    border-radius: 10px;
}

input[placeholder]{
    font-weight: 500;
}
.form-control:focus{
    box-shadow: none;
    border: 1.5px solid #0779e4;
}
select{
    display: block;
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 10px;
    height: 40px;
    padding: 5px 10px;
    
}

select:focus{
    outline: none;
}
.button{
    background-color: #fff;
    color: #0779e4;
}
.button:hover{
    background-color: #0779e4;
    color: #fff;
}
.btn-primary{
    background-color: #0779e4;
}


@media(max-width:576px){
    .wrapper{
        padding: 25px 20px;
    }
    #deactivate{
        line-height: 18px;
    }
}
.custom-file-input {
            display: none;
        }

        .custom-file-input {
            display: none; 
        }

        .custom-file-button {
            background-color:#0779e4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }

        .custom-file-input::before {
            content: 'Importer'; 
            display: inline-block;
            background-color:#0779e4;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .custom-file-input:hover::before {
            background-color:#1785ed;
        }
    </style>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
    <div  class="wrapper bg-white mt-sm-5" >
        <div class="d-flex align-items-start py-3 border-bottom">
        <h4 class="pb-4 border-bottom">Mon Profile</h4>
             
            <div class="pl-sm-4 pl-2" id="img-section">
               
            </div>
        </div>
        <div class="py-2">
            <div class="row py-2">
                <div class="col-md-6">
                    <label for="firstname">Nom </label>
                    <input name="firstname" type="text" class="bg-light form-control" placeholder="<?php echo $userData['nom']; ?>">
                </div>
                <div class="col-md-6 pt-md-0 pt-3">
                <label for="phone">Télephone </label>
                    <input name="phone" type="tel" class="bg-light form-control" placeholder="<?php echo $userData['tel']; ?>">
                </div>
            </div>
            <div class="row py-2">
            </div>
            <div class="row py-2">
                <div class="col-md-6">
                    <label>Date de naissance </label>
                    <input  name="birthdate" type="date" class="bg-light form-control">
                </div>
                <div class="col-md-6 pt-md-0 pt-3">
                    <label >Adresse  </label>
                    <input name="address" type="text" class="bg-light form-control"  placeholder="<?php echo $userData['adresse']; ?>">
                    </div>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-md-6">
                    <label>Nouveau mot de passe</label>
                    <input name="newpwd" type="password" id="newpwd" class="bg-light form-control" placeholder="**********">
                </div>
                <div class="col-md-6 pt-md-0 pt-3">
                        <label>Confirmer votre mot de passe</label>
                        <input type="password" id="newpwd1" class="bg-light form-control" placeholder="**********">
                    </div>
                </div>
                <div class="py-3 pb-4 border-bottom">
                <button class="btn btn-primary mr-3" name="save">Enregistrer</button>
                <button class="btn border button" onclick="redirectToIndex()">Retour</button>

            </div>
            </div>
        </div>
    </div>
    </form>
    <script>
    var fileInput = document.getElementById('fileInput');
    var profileImage = document.querySelector('.img');
    fileInput.addEventListener('change', function () {
        if (fileInput.files.length > 0) {
            var file = fileInput.files[0];
            var imageURL = URL.createObjectURL(file);
            profileImage.src = imageURL;
        }
    });
    function redirectToIndex() {
        window.location.href = 'index.php';
    }
</script>
</body>
</html>