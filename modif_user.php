<?php
// Informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "votre_utilisateur";
$mot_de_passe = "votre_mot_de_passe";
$nom_base_de_donnees = "votre_base_de_donnees";
$nom_table = "votre_table";

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Récupération des données du formulaire
    $id = $_GET["id"];
    $nom = $_GET["nom"];
    $prenom = $_GET["prenom"];
    $adresse = $_GET["adresse"];
    $ville = $_GET["ville"];
    $cp = $_GET["cp"];
    $date_embauche = $_GET["date"];
    $login = $_GET["login"];
    $mdp = $_GET["mdp"];

    // Connexion à la base de données
    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

    // Vérification de la connexion
    if (!$connexion) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }

    // Requête SQL pour mettre à jour l'utilisateur
    $requete = "UPDATE $nom_table SET nom = '$nom', prenom = '$prenom', adresse = '$adresse', ville = '$ville', cp = '$cp', date_embauche = '$date_embauche', login = '$login', mdp = '$mdp' WHERE id = $id";

    // Exécution de la requête
    if (mysqli_query($connexion, $requete)) {
        echo "Utilisateur modifié avec succès.";
    } else {
        echo "Erreur lors de la modification de l'utilisateur : " . mysqli_error($connexion);
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($connexion);
}
?>