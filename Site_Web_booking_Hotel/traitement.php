<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "hotel");

if ($con->connect_error) {
    die("Connexion échouée : " . $con->connect_error);
} else {
    if (isset($_POST["soumettre"])) {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];

        $req = "INSERT INTO client (nom, pwd, email) VALUES ('$nom', '$pwd', '$email')";

        if ($con->query($req) === TRUE) {
           header("location:index.php");
           
        } else {
            echo "Erreur lors de l'insertion : " . $con->error;
        }}}
?>