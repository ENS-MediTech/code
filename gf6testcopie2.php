<!DOCTYPE html>
<html>
<head>
    <title>Validation des frais par visiteur</title>
    <style>
        body {
            background-color: orange;
        }
        form {
            margin: 0 auto;
            width: 50%;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="number"] {
            width: 100%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
include 'connexion.php';
$conn = connect();

// Récupérer les visiteurs depuis la base de données
$sql_visiteurs = "SELECT VIS_NOM, VIS_ID FROM visiteur";
$result_visiteurs = $conn->query($sql_visiteurs);

// Vérifier s'il y a des résultats pour les visiteurs
if ($result_visiteurs->num_rows > 0) {
    echo '<h1>Validation des frais par visiteur</h1>';
    echo '<form>';
    echo '<label for="visiteur">Choisir le visiteur :</label>';
    echo '<select id="visiteur" name="visiteur">';
    echo '<option value="0"> Choisir : </option>';
    
    // Parcourir les résultats pour afficher les options du formulaire
    while ($row_visiteur = $result_visiteurs->fetch_assoc()) {
        echo '<option value="' . $row_visiteur['VIS_ID'] . '">' . $row_visiteur['VIS_NOM'] . '</option>';
    }
    
    echo '</select>';
    echo '</form>';
} else {
    echo 'Aucun visiteur trouvé.';
}

// Si un visiteur est sélectionné dans le formulaire
if (isset($_GET['visiteur']) && $_GET['visiteur'] != '0') {
    $vis_id = $_GET['visiteur'];
    
    // Préparer la requête pour récupérer le VIS_ID spécifique
    $stmt = $conn->prepare("SELECT VIS_ID FROM visiteur WHERE VIS_ID = ?");
    $stmt->bind_param("s", $vis_id);
    $stmt->execute();
    $result_visiteurs2 = $stmt->get_result();

    if ($result_visiteurs2->num_rows > 0) {
        // Afficher les résultats
        while($row = $result_visiteurs2->fetch_assoc()) {
            echo "VIS_ID: " . $row["VIS_ID"]. "<br>";
        }
    } else {
        echo "Aucun visiteur trouvé pour l'ID spécifié.";
    }
    var_dump($result_visiteurs2);
}

?>



<label for="mois">Mois :</label>
<select id="mois" name="mois">
    <option value="JANVIER">Janvier</option>
    <option value="FEVRIER">Février</option>
    <option value="MARS">Mars</option>
    <option value="AVRIL">Avril</option>
    <option value="MAI">Mai</option>
    <option value="JUIN">Juin</option>
    <option value="JUILLET">Juillet</option>
    <option value="AOUT">Aout</option>
    <option value="SEPTEMBRE">Septembre</option>
    <option value="OCTOBRE">Octobre</option>
    <option value="NOVEMBRE">Novembre</option>
    <option value="DECEMBRE">Décembre</option>
</select>
<select id="annee" name="annee">
    <option value="janvier">Janvier</option>
    <option value="fevrier">Février</option>
    <option value="mars">Mars</option>
    <option value="avril">Avril</option>
    <option value="mai">Mai</option>
    <option value="juin">Juin</option>
    <option value="juillet">Juillet</option>
    <option value="aout">Aout</option>
    <option value="septembre">Septembre</option>
    <option value="octobre">Octobre</option>
    <option value="novembre">Novembre</option>
    <option value="decembre">Décembre</option>
</select>
<h2>Frais au forfait</h2>
<table>
    <tr>
        <td><label for="repas">Repas midi :</label></td>
        <tr><?php
        include 'connexion.php';
        $conn = connect();
        $sql_repas_midi = "SELECT LIG_QTE
		                   FROM ligne_frais_forfait
		                   INNER JOIN fiche_frais ON ligne_frais_forfait.FFR_id = fiche_frais.FFR_ID
		                   WHERE ligne_frais_forfait.FOR_ID = 'NUI'";
        $result_repas_midi = $conn->query($sql_repas_midi);
        if ($result_repas_midi->num_rows > 0) {
            while ($row_repas_midi = $result_repas_midi->fetch_assoc()) {
                echo '<td>' . $row_repas_midi['LIG_QTE'] . '</td>';
            }
        } else {
            echo '<td>Aucune donnée trouvée</td>';
        }
        $conn->close();
        ?></tr>
    </tr>
</table>

<table>
    <tr>
        <td><label for="nuitee">Nuitée :</label></td>
        <td><input type="number" id="nuitee" name="nuitee" min="0" required></td>
    </tr>
    <tr>
        <td><label for="etape">Etape :</label></td>
        <td><input type="number" id="etape" name="etape" min="0" required></td>
    </tr>
    <tr>
        <td><label for="km">Km :</label></td>
        <td><input type="number" id="km" name="km" min="0" value=""></td>
    </tr>
    <tr>
        <td><label for="situation">Situation :</label></td>
        <td>
            <input type="radio" id="valide" name="situation" value="valide" checked>
            <label for="valide">Validé</label>
            <input type="radio" id="non-valide" name="situation" value="non-valide">
            <label for="non-valide">Non validé</label>
        </td>
    </tr>
    <tr>
        <td><label for="justificatifs">Nb Justificatifs :</label></td>
        <td><input type="number" id="justificatifs" name="justificatifs" min="0"></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" value="Soumettre la requête"></td>
    </tr>
</table>

</body>
</html>
