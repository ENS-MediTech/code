<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "Iroise29";
$nom_base_de_donnees = "MediTech";
$nom_table = "visiteur";
$numero_port = 3306;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["identifi"];
    $nom = $_GET["nom"];
    $prenom = $_GET["prenom"];
    $adresse = $_GET["adresse"];
    $ville = $_GET["ville"];
    $cp = $_GET["cp"];
    $date_embauche = $_GET["date"];
   // $login = $_GET["login"];
   // $mdp = $_GET["mdp"];

    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

    if (!$connexion) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }

    $requete = "UPDATE visiteur SET VIS_NOM = '$nom', VIS_PRENOM = '$prenom', VIS_ADRESSE = '$adresse', VIS_VILLE = '$ville', VIS_CP = '$cp', VIS_DATE_EMBAUCHE = '$date_embauche' WHERE VIS_ID = $id";

    if (mysqli_query($connexion, $requete)) {
        echo "Utilisateur modifié avec succès.";
    } else {
        echo "Erreur lors de la modification de l'utilisateur : " . mysqli_error($connexion);
    }

    mysqli_close($connexion);
}
