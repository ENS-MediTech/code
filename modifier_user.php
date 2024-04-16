<!DOCTYPE html>
<html>
<style>
.visiteur{
    width: 1000px;
    text-align: center;
}
label {
  display: inline-block;
  width: 140px;
  text-align: right;
  color : #133755;
}
</style>
<body>
<?php
ini_set('display_errors', 1);
include 'connexion.php';
$conn=connect();
$identifiant = $_GET['id'];
echo'<div class="visiteur"><h2><b>MODIFIER VISITEUR</b></h2></div>';
echo'<form id="formulaireVisiteur2" method="GET" action="modifier_user23.php?">';
echo'<input type="hidden" name="id" value=" '. $identifiant .' ">';
echo' <label for="nom">Nom:</label><input type="text" id="nom" name="nom" value=""><br>';
echo' <label for="prenom">Prénom:</label><input type="text" id="prenom" name="prenom" value=""><br>';
echo' <label for="adresse">Adresse:</label><input type="text" id="adresse" name="adresse" value=""><br>';
echo' <label for="ville">Ville:</label><input type="text" id="ville" name="ville" value=""><br>';
echo'<label for="cp">Code postal:</label><input type="text" id="cp" name="cp" value=""><br>';
echo'  <label for="date">Date embauche:</label><input type="text" id="date" name="date1" value=""><br>
  <button type="submit" name="action1" value="Modifier">Modifier</button>
  <button type="reset" id="reinitialiser">Réinitialiser</button>
</form>';
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["action1"])) {
        
        echo $identifiant;
    $nom = $_GET["nom"];
    echo $nom;
    $prenom = $_GET["prenom"];
    echo $prenom;
    $adresse = $_GET["adresse"];
    echo $adresse;
    $ville = $_GET["ville"];
    echo $ville;
    $cp = $_GET["cp"];
    echo $cp;
    $date_embauche = $_GET["date1"];
    echo $date_embauche;
   
    $requete = "UPDATE visiteur SET VIS_NOM = '$nom', VIS_PRENOM = '$prenom', VIS_ADRESSE = '$adresse', VIS_VILLE = '$ville', VIS_CP = '$cp', VIS_DATE_EMBAUCHE = '$date_embauche' WHERE VIS_ID = '$identifiant'";
    $resultat = $conn->query($requete);
    if ($resultat && mysqli_affected_rows($conn) > 0) {
        echo("utilisateur modifié :)");
    } else {
        echo("l'utilisateur n'a pas pu être modifié");
    }
}
}
?>
</body>
</html>