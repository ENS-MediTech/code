<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "Iroise29";
$nom_base_de_donnees = "MediTech";
$nom_table = "visiteur";
$numero_port = 3306;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["VIS_ID"];
    $nom = $_GET["VIS_NOM"];
    $prenom = $_GET["VIS_PRENOM"];
    $adresse = $_GET["VIS_ADRESSE"];
    $ville = $_GET["VIS_VILLE"];
    $cp = $_GET["VIS_CP"];
    $date_embauche = $_GET["VIS_DATE_EMBAUCHE"];
   // $login = $_GET["login"];
   // $mdp = $_GET["mdp"];

    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

    if (!$connexion) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }

    $requete = "UPDATE $nom_table SET VIS_NOM = '$nom', VIS_PRENOM = '$prenom', VIS_ADRESSE = '$adresse', VIS_VILLE = '$ville', VIS_CP = '$cp', VIS_DATE_EMBAUCHE = '$date_embauche' WHERE VIS_ID = $id";

    if (mysqli_query($connexion, $requete)) {
        echo "Utilisateur modifié avec succès.";
    } else {
        echo "Erreur lors de la modification de l'utilisateur : " . mysqli_error($connexion);
    }

    mysqli_close($connexion);
}
?>
