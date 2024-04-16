<!DOCTYPE html>
<style>
body {
font-family: Arial, sans-serif;
background-color: white;
}
label {
  display: inline-block;
  width: 140px;
  text-align: right;
  color : #133755;
}

input {
  width: 200px;
  margin: .5em;
}
.visiteur{
  background-color: #8bc1f1;
  color : #133755;
  width: 500px;
  margin: 0 auto;
}

h2 {
    display: block;
    font-size: 1.5em;
    font-weight: bold;
    unicode-bidi: isolate;
    margin-left: auto;
    margin-right: auto;
    width: 6em
}


form#formulaireVisiteur {
    position: absolute;
    top: 20%;
    left: 45%;
    height: 200px;
    margin-left: -150px;
    margin-top: -100px;
}

</style>
</head>
<body>

<div class="visiteur"><h2><b>VISITEUR</b></h2></div>
<form id="formulaireVisiteur" method="GET" action="ajouter_user.php">
  <label for="id">Identifiant:<span style="color: red;">*</span></label><input type="text" id="id" name="identifi" value="" required><br>
  <label for="nom">Nom:<span style="color: red;">*</span></label><input type="text" id="nom" name="nom" value=""required><br>
  <label for="prenom">Prénom:<span style="color: red;">*</span></label><input type="text" id="prenom" name="prenom" value=""required><br>
  <label for="adresse">Adresse:</label><input type="text" id="adresse" name="adresse" value=""><br>
  <label for="ville">Ville:</span></label><input type="text" id="ville" name="ville" value=""><br>
  <label for="cp">Code postal:</label><input type="text" id="cp" name="cp" value=""><br>
  <label for="date">Date embauche:</label><input type="text" id="date" name="date1" value=""><br>
  <label for="login">login:<span style="color: red;">*</span></label><input type="text" id="login" name="login" value=""required><br>
  <label for="mdp">Mot de passe :<span style="color: red;">*</span></label><input type="password" id="mdp" name="mdp"required><br><br><br>
  <button type="submit" name="action1" value="ajouter">Ajouter</button>
  <button type="reset" id="reinitialiser">Réinitialiser</button>
</form>

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
        $requete2= "INSERT INTO USER (id, login, password, dteConnexion, role) VALUES ('$identifiant', '$login' , '$mdp', NULL, 'visiteur')";
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
