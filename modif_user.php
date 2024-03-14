<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "Iroise29";
$nom_base_de_donnees = "MediTech";
$nom_table = "visiteur";
$numero_port = 3306;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $nom = $_GET["nom"];
    $prenom = $_GET["prenom"];
    $adresse = $_GET["adresse"];
    $ville = $_GET["ville"];
    $cp = $_GET["cp"];
    $date_embauche = $_GET["date"];
    $login = $_GET["login"];
    $mdp = $_GET["mdp"];

    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

    if (!$connexion) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }

    $requete = "UPDATE $nom_table SET nom = '$nom', prenom = '$prenom', adresse = '$adresse', ville = '$ville', cp = '$cp', date_embauche = '$date_embauche', login = '$login', mdp = '$mdp' WHERE id = $id";

    if (mysqli_query($connexion, $requete)) {
        echo "Utilisateur modifié avec succès.";
    } else {
        echo "Erreur lors de la modification de l'utilisateur : " . mysqli_error($connexion);
    }

    mysqli_close($connexion);
}
?>