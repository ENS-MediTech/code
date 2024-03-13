<?php
// Informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "votre_utilisateur";
$mot_de_passe = "votre_mot_de_passe";
$nom_base_de_donnees = "votre_base_de_donnees";
$nom_table = "votre_table";

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Récupération de l'identifiant de l'utilisateur à supprimer
    $id = $_GET["id"];

    // Connexion à la base de données
    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

    // Vérification de la connexion
    if (!$connexion) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }

    // Requête SQL pour supprimer l'utilisateur
    $requete = "DELETE FROM $nom_table WHERE id = $id";

    // Exécution de la requête
    if (mysqli_query($connexion, $requete)) {
        echo "Utilisateur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($connexion);
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($connexion);
}
?>