<?php
// Informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "Iroise29";
$nom_base_de_donnees = "Meditech";
$nom_table = "visiteur";
$numero_port = 3306; // Port MySQL par défaut

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees, $numero_port);

// Vérification de la connexion
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Noms des champs à sélectionner
$champ_id = "votre_champ_id";
$champ_nom = "votre_champ_nom";
$champ_email = "votre_champ_email";

// Requête SQL pour sélectionner les données
$requete = "SELECT $champ_id, $champ_nom, $champ_email FROM $nom_table";

// Exécution de la requête
$resultat = mysqli_query($connexion, $requete);

// Vérification de la réussite de la requête
if (!$resultat) {
    die("Échec de la requête : " . mysqli_error($connexion));
}

// Affichage des utilisateurs
while ($utilisateur = mysqli_fetch_assoc($resultat)) {
    echo "ID : " . htmlspecialchars($utilisateur[$champ_id]) . "<br>"; // Sécurisation contre les attaques XSS
    echo "Nom : " . htmlspecialchars($utilisateur[$champ_nom]) . "<br>"; // Sécurisation contre les attaques XSS
    echo "Email : " . htmlspecialchars($utilisateur[$champ_email]) . "<br>"; // Sécurisation contre les attaques XSS
    echo "<br>";
}

// Libération de la mémoire occupée par le résultat
mysqli_free_result($resultat);

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>
