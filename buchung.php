<?php
// Verbindung zur Datenbank herstellen – Pfad zur Verbindungsdatei
require dirname(__DIR__) . '/connect/connect.php';

// SQL-Abfrage vorbereiten: Alle Einträge aus der Tabelle "buchung" nach ID sortiert
$stmt = $pdo->prepare('SELECT * FROM buchung ORDER BY id');
// Abfrage ausführen
$stmt->execute();
// Ergebnisse als assoziatives Array abrufen
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <!-- Zeichencodierung und Responsive-Design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buchungsübersicht</title>

    <!-- Einbindung von Icons aus der Lucide-Bibliothek -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Stil-Definition für die Seite -->
    <style>
        /* Allgemeines Layout und Schriftart */
        body {
            background: linear-gradient(to right, #e0f7fa, #ffffff);
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }

        /* Überschrift-Styling */
        h1 {
            text-align: center;
            color: #0097a7;
        }

        /* Tabellen-Layout und Design */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        /* Tabellenzellen-Design */
        th, td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #cceeff;
        }

        /* Tabellenkopf-Styling */
        th {
            background-color: #00acc1;
            color: white;
        }

        /* Wechselnde Zeilenfarbe für bessere Lesbarkeit */
        tr:nth-child(even) {
            background-color: #f1fafd;
        }

        /* Button-Styling (Update & Delete) */
        .action-btn {
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-update {
            background-color: #29b6f6;
            color: white;
        }

        .btn-update:hover {
            background-color: #0288d1;
        }

        .btn-delete {
            background-color: #ef5350;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c62828;
        }

        /* Button zum Hinzufügen neuer Buchungen */
        .add-btn-container {
            text-align: center;
            margin-top: 30px;
        }

        .add-btn-container a {
            background-color: #00acc1;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: bold;
            text-decoration: none;
        }

        .add-btn-container a:hover {
            background-color: #00838f;
        }

        /* Icon-Styling */
        .icon {
            width: 16px;
            height: 16px;
            vertical-align: middle;
            margin-right: 5px;
        }
    </style>
</head>
<body>

<!-- Hauptüberschrift mit Icon -->
<h1><i data-lucide="list-check" class="icon"></i> Buchungsübersicht</h1>

<!-- Tabellenstruktur für die Buchungsdaten -->
<table>
    <thead>
        <tr>
            <!-- Tabellenkopf mit Spaltennamen -->
            <th>ID</th>
            <th>Gast ID</th>
            <th>Ferienhaus ID</th>
            <th>Ankunft</th>
            <th>Abfahrt</th>
            <th>Erstellt am</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <!-- PHP-Schleife: Alle Buchungseinträge ausgeben -->
        <?php foreach ($results as $result): ?>
            <tr>
                <!-- Einzelne Felder der Buchung -->
                <td><?= htmlspecialchars($result['id']) ?></td>
                <td><?= htmlspecialchars($result['gast_id']) ?></td>
                <td><?= htmlspecialchars($result['ferienhaus_id']) ?></td>
                <td><?= htmlspecialchars($result['ankunft']) ?></td>
                <td><?= htmlspecialchars($result['abfahrt']) ?></td>
                <td><?= htmlspecialchars($result['erstellt_am']) ?></td>
                <!-- Button zum Bearbeiten der Buchung (führt zu update.php) -->
                <td>
                    <a href="update.php?id=<?= $result['id'] ?>" class="action-btn btn-update">
                        <i data-lucide="edit-3" class="icon"></i> Bearbeiten
                    </a>
                </td>
                <!-- Button zum Löschen mit JS-Bestätigung -->
                <td>
                    <a href="delete.php?deleteID=<?= $result['id'] ?>" class="action-btn btn-delete"
                       onclick="return confirm('Wirklich löschen?');">
                       <i data-lucide="trash-2" class="icon"></i> Löschen
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Button zum Einfügen neuer Buchungen -->
<div class="add-btn-container">
    <a href="insert.php"><i data-lucide="plus-circle" class="icon"></i> Neue Buchung hinzufügen</a>
</div>

<!-- Icons nachträglich durch Lucide initialisieren -->
<script>
    lucide.createIcons();
</script>

</body>
</html>
