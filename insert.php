<?php
// =====================================
// PHP-BEREICH – Buchung speichern
// =====================================

// Verbindung zur Datenbank – Pfad relativ zum aktuellen Verzeichnis
require dirname(__DIR__) . '/connect/connect.php';

// Prüfen, ob das Formular abgeschickt wurde (per POST-Methode)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Eingaben aus dem Formular lesen und von Leerzeichen befreien
    $gast_id = trim($_POST['gast_id']);
    $ferienhaus_id = trim($_POST['ferienhaus_id']);
    $ankunft = trim($_POST['ankunft']);
    $abfahrt = trim($_POST['abfahrt']);

    // Sicherstellen, dass alle Felder ausgefüllt sind
    if (!empty($gast_id) && !empty($ferienhaus_id) && !empty($ankunft) && !empty($abfahrt)) {
        try {
            // SQL-Befehl zum Einfügen vorbereiten (mit Platzhaltern für Sicherheit)
            $stmt = $pdo->prepare("INSERT INTO buchung (gast_id, ferienhaus_id, ankunft, abfahrt) 
                                   VALUES (:gast_id, :ferienhaus_id, :ankunft, :abfahrt)");

            // Platzhalter durch echte Werte ersetzen
            $stmt->bindValue(':gast_id', $gast_id);
            $stmt->bindValue(':ferienhaus_id', $ferienhaus_id);
            $stmt->bindValue(':ankunft', $ankunft);
            $stmt->bindValue(':abfahrt', $abfahrt);

            // SQL-Anweisung ausführen (Buchung speichern)
            $stmt->execute();

            // Nach erfolgreichem Speichern zur Übersicht weiterleiten
            header('Location: buchung.php?success=1');
            exit;

        } catch (PDOException $e) {
            // Fehlerbehandlung: Wenn beim Speichern etwas schiefläuft
            die("Fehler beim Einfügen: " . $e->getMessage());
        }
    } else {
        // Wenn nicht alle Felder ausgefüllt wurden, Hinweis anzeigen
        echo "<p style='color:red; text-align:center;'>Bitte alle Felder ausfüllen!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <!-- Zeichencodierung für Sonderzeichen -->
    <meta charset="UTF-8">

    <!-- Responsives Layout für Mobilgeräte -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Neue Buchung hinzufügen</title>

    <!-- Lucide-Icons (werden mit JS geladen) -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- CSS-Styling für Layout und Design -->
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #ffffff); /* Farbverlauf als Hintergrund */
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 60px auto; /* Zentrierung */
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #cceeff;
        }

        h1 {
            text-align: center;
            color: #0097a7;
            margin-bottom: 30px;
        }

        label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-weight: 600;
            color: #006064;
        }

        label svg {
            margin-right: 8px;
            color: #00acc1;
        }

        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #b2ebf2;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            background-color: #f1fafd;
        }

        input:focus {
            outline: none;
            border-color: #00acc1;
            background-color: #e0f7fa;
        }

        button {
            width: 100%;
            background: #00acc1;
            color: white;
            padding: 14px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #00838f;
        }

        .back-button {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #0097a7;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s;
        }

        .back-button:hover {
            color: #006064;
        }

        .icon {
            width: 18px;
            height: 18px;
        }

        /* Mobile-Optimierung */
        @media (max-width: 640px) {
            .container {
                width: 90%;
                margin: 20px auto;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<!-- Formularcontainer mit Feldern zur Eingabe -->
<div class="container">
    <h1><i data-lucide="plus-circle" class="icon"></i> Neue Buchung hinzufügen</h1>

    <!-- Formular zur Übermittlung der Buchung per POST -->
    <form method="POST">
        <!-- Gast-ID (numerisch) -->
        <label><i data-lucide="user" class="icon"></i> Gast-ID:</label>
        <input type="number" name="gast_id" required>

        <!-- Ferienhaus-ID (numerisch) -->
        <label><i data-lucide="home" class="icon"></i> Ferienhaus-ID:</label>
        <input type="number" name="ferienhaus_id" required>

        <!-- Ankunftsdatum -->
        <label><i data-lucide="calendar-plus" class="icon"></i> Ankunft:</label>
        <input type="date" name="ankunft" required>

        <!-- Abfahrtsdatum -->
        <label><i data-lucide="calendar-minus" class="icon"></i> Abfahrt:</label>
        <input type="date" name="abfahrt" required>

        <!-- Formular absenden -->
        <button type="submit"><i data-lucide="save" class="icon"></i> Buchung speichern</button>
    </form>

    <!-- Link zurück zur Übersicht -->
    <a href="buchung.php" class="back-button"><i data-lucide="arrow-left-circle" class="icon"></i> Zurück zur Übersicht</a>
</div>

<!-- Icons durch Lucide aktivieren -->
<script>
    lucide.createIcons();
</script>

</body>
</html>
