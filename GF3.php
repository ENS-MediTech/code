<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="./jecpas2_files/all.min.css">
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
        
        .backd {
            background-color: #E1EEFF;
        }
    </style>
</head>
<body>
    <div class="backd">
        <h2>Fiche de frais de : VILLECHALANNE <button class="color" id="add-button"><i class="fas fa-plus"></i> Ajouter</button></h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>suprimer</th>
                    <th>modifier</th>
                    <th>voir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Récupération des données depuis la base de données
                $conn = new mysqli('localhost', 'root', 'Iroise29', 'MediTech', 3306);

                // Vérification de la connexion
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT FRR_ANNEE, FRR_MOIS, FRR_MONTANT_VALIDE, ETA_ID FROM fiche_frais";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $mois = convertirMoisEnNumero($row['FRR_MOIS']);
                        $etat = convertir2LETTRE($row['ETA_ID']);
                        ?>
                        <tr>
                            <td><?php echo $mois . "/" . $row["FRR_ANNEE"] ."  " .$row["FRR_MONTANT_VALIDE"] . "€"  . $etat; ?></td>
                            <td><button><img src='poubelle.png'></button></td>
                            <td><button><img src='modi.png'></button></td>
                            <td><button><img src='ou.png'></button></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>Aucune donnée disponible</td></tr>";
                }

                $conn->close();

                // Fonction de conversion du mois en numéro
                function convertirMoisEnNumero($mois) {
                    switch ($mois) {
                        case 'JANVIER':
                            return 1;
                        case 'FEVRIER':
                            return 2;
                        case 'MARS':
                            return 3;
                        case 'AVRIL':
                            return 4;
                        case 'MAI':
                            return 5;
                        case 'JUIN':
                            return 6;
                        case 'JUILLET':
                            return 7;
                        case 'AOUT':
                            return 8;
                        case 'SEPTEMBRE':
                            return 9;
                        case 'OCTOBRE':
                            return 10;
                        case 'NOVEMBRE':
                            return 11;
                        case 'DECEMBRE':
                            return 12;
                    }
                }

                // Fonction de conversion du code en lettre
                function convertir2LETTRE($L2) {
                    switch ($L2) {
                        case 'CL':
                            return "Saisie clôturée";
                        case 'CR':
                            return "Fiche créée, saisie en cours";
                        case 'RB':
                            return "Remboursée";
                        case 'VA':
                            return "Validée et mise en paiement";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
