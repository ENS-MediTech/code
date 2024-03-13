<?php
$serveur = "localhost";
$utilisateur = "user";
$mot_de_passe = "root";
$nom_base_de_donnees = "MediTech";
$nom_table = "visiteur";
$numero_port = 3306;

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees, $numero_port);

// Vérifier la connexion
if (!$connexion) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

$champ_id = "votre_champ_id";
$champ_nom = "votre_champ_nom";
$champ_email = "votre_champ_email";

$requete = "SELECT $champ_id, $champ_nom, $champ_email FROM $nom_table";
$resultat = mysqli_query($connexion, $requete);

// Vérifier la réussite de la requête
if (!$resultat) {
    die("Échec de la requête : " . mysqli_error($connexion));
}

// Afficher les utilisateurs
while ($utilisateur = mysqli_fetch_assoc($resultat)) {
    echo "ID : " . $utilisateur[$champ_id] . "<br>";
    echo "Nom : " . $utilisateur[$champ_nom] . "<br>";
    echo "Email : " . $utilisateur[$champ_email] . "<br>";
    echo "<br>";
}

// Libérer les résultats de la mémoire
mysqli_free_result($resultat);

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>
