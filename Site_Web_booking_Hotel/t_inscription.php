<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
$conn->query("SET sql_mode = ''");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['pwd'])) {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT id_clt, nom FROM client WHERE email = '$email' AND pwd = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id_clt'];
        $_SESSION['name'] = $row['nom'];
        
        header('Location:index.php');
        exit;
    } else {
        echo "Identifiants incorrects.";
    }
}

if (isset($_POST['envoyer'])) {
    $nom = $_POST['nom'];
    $tel = $_POST['tel'];
    $adresse = $_POST['adresse'];
    $date_n = $_POST['date_n'];
    $email = $_POST['email2'];
    $pwd = $_POST['pwd'];

    $sql = $conn->prepare("INSERT INTO client (nom, tel, adresse, date_naiss, email, pwd) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssss", $nom, $tel, $adresse, $date_n, $email, $pwd);

    if ($sql->execute()) {
        session_start();
        $_SESSION['user_id'] = $conn->insert_id; 
        $_SESSION['name'] = $nom;
        header('Location:index.php?success=1');
        exit;
    } else {
        echo "Erreur : " . $sql->error;
    }

    $sql->close();
}

$conn->close();
?>
