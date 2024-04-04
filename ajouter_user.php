<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "Iroise29";
$nom_base_de_donnees = "MediTech";
$numero_port = 3306;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $identifiant = $_GET["identifi"];
    $nom = $_GET["nom"];
    $prenom = $_GET["prenom"];
    $adresse = $_GET["adresse"];
    $ville = $_GET["ville"];
    $cp = $_GET["cp"];
    $date_embauche = $_GET["date1"];
    $login = $_GET["login"];
    $mdp = $_GET["mdp"];

    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

    if (!$connexion) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }

    // Requête d'insertion dans la table 'visiteur'
    $requete = "INSERT INTO visiteur (VIS_ID, VIS_NOM, VIS_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE) VALUES ('$identifiant', '$nom', '$prenom', '$adresse', '$cp', '$ville', '$date_embauche')";
    if (mysqli_query($connexion, $requete)) {
        // Requête d'insertion dans la table 'USER'
        $requete2= "INSERT INTO USER (id, login, password, dteConnexion, role) VALUES ('$identifiant', '$login' , '$mdp', NULL, NULL)";
        if (mysqli_query($connexion, $requete2)) {
            echo "Utilisateur ajouté avec succès.";
        } 
            else {
                echo "Erreur lors de l'ajout de l'utilisateur : " . mysqli_error($connexion);
                echo "Requête SQL : " . $requete2; // Affichez la requête pour débogage
            }
        
    } else {
        echo "Erreur lors de l'ajout du visiteur : " . mysqli_error($connexion);
    }

    // Fermeture de la connexion
    mysqli_close($connexion);
}
