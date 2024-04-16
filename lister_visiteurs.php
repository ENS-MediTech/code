<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E1EEFF;
        }

        h2 {
            color:#49A5EA;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-color: #AAC6ED;
            background-color: #F4FAFF;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border: 3px solid #A7C5ED;
            background-color: #F4FAFF;
        }

        th {
            background-color: #E9EFF6;
            color: rgb(1, 1, 1);
        }

        button {
            background-color: #F4FAFF;
            color: white;
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
        }

        .color {
            background-color: #407daf;
            color: rgb(255, 0, 0);
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
        }
        a i.fa-solid.fa-xmark {
    color: red; /* Couleur de l'icône */
    font-size: 20px; /* Taille de la police de l'icône */
    
}
        .backd {
            background-color: #E1EEFF;
        }
    </style>
</head>
<body>

<h2>LISTE DES VISITEURS</h2>

<table>
    
      <a href="ajouter_user.php">
        <button class="color">

          <span style="font-size: 20px;">+</span> Ajouter un visiteur
        </button>
      </a>
    
  <tr>
    
    <td><b>Nom</b></td>
    <td><b>Prénom</b></td> 
    <td><b>Date</b></td>
    <td><b>supprimer</b></td>
    <td><b>modifier</b></td>
    
  </tr>

  <?php 
  ini_set('display_errors', 1);
  require_once("connexion.php");
  $conn = connect();

  $sql1= "SELECT VIS_ID, VIS_NOM, VIS_PRENOM, VIS_DATE_EMBAUCHE FROM visiteur";
  $resultat = $conn->query($sql1);

if ($resultat->num_rows > 0) {
    while($row = $resultat->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['VIS_NOM'] . '</td>';
        echo '<td>' . $row['VIS_PRENOM'] . '</td>';
        echo '<td>' . $row['VIS_DATE_EMBAUCHE'] . '</td>';
        echo '<td class="image"><a href="supprimer_user.php?id=' . $row['VIS_ID'] . '"><i class="fa-solid fa-xmark"></i></a></td>';
        echo '<td><a href="modifier_user23.php?vis_id=' . $row['VIS_ID'] . '"><button><i class="fa-solid fa-pen"></i></button></a></td>';
        
        echo '</tr>';
    }
} else {
    // Afficher un message si aucun visiteur n'est trouvé
    echo "<tr><td colspan='6'>Aucun visiteur trouvÃ©.</td></tr>";
}
?>
</table>

</body>
</html>