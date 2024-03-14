<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "Iroise29";
$nom_base_de_donnees = "MediTech";
$nom_table = "visiteur";
$numero_port = 3306;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];

    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

    if (!$connexion) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }

    $requete = "DELETE FROM $nom_table WHERE id = $id";

    if (mysqli_query($connexion, $requete)) {
        echo "Utilisateur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($connexion);
    }

    mysqli_close($connexion);
}
?>