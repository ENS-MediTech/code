<?php
// Informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "Iroise29";
$nom_base_de_donnees = "MediTech";
$nom_table = "visiteur";
$numero_port = 3306;

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Récupération des données du formulaire
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

    // Requête SQL pour insérer un nouvel utilisateur
    $requete = "INSERT INTO $nom_table (nom, prenom, adresse, ville, cp, date_embauche, login, mdp) VALUES ('$nom', '$prenom', '$adresse', '$ville', '$cp', '$date_embauche', '$login', '$mdp')";

    // Exécution de la requête
    if (mysqli_query($connexion, $requete)) {
        echo "Utilisateur ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur : " . mysqli_error($connexion);
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($connexion);
}
?>
