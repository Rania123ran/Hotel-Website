<?php
$conn = mysqli_connect("localhost", "root", "", "hotel");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_GET['id'])) {
    $id_chambre = $_GET['id'];


    $sql = "DELETE FROM chambre WHERE id_chambre = $id_chambre";

    if (mysqli_query($conn, $sql)) {

        header("Location: admin.php?success=La chambre a été supprimée avec succès.");
        exit();
    } else {
     
        header("Location: admin.php?error=Erreur lors de la suppression de la chambre: " . mysqli_error($conn));
        exit();
    }
} else {

    header("Location: admin.php?error=ID de la chambre non spécifié.");
    exit();
}

if (mysqli_ping($conn)) {
 
    mysqli_close($conn);
}
?>
