<?php
// Verbindung zur Datenbank herstellen – Pfad relativ zum aktuellen Verzeichnis
require dirname(__DIR__) . '/connect/connect.php';

// Die Buchungs-ID wird über die URL (GET-Parameter) übergeben
$id = $_GET['id'] ?? null;

// Wenn keine ID übergeben wurde, wird das Skript sofort beendet
if (!$id) die('Keine ID angegeben.');

// Eine vorbereitete SQL-Abfrage, um die Buchung mit der übergebenen ID abzurufen
$stmt = $pdo->prepare('SELECT * FROM buchung WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT); // Die ID als Integer binden
$stmt->execute(); // SQL-Abfrage ausführen
$buchung = $stmt->fetch(PDO::FETCH_ASSOC); // Ergebnis als assoziatives Array holen

// Wenn keine Buchung mit dieser ID existiert, Skript beenden
if (!$buchung) die('Buchung nicht gefunden.');

// Prüfung: Wurde das Formular per POST abgesendet?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Daten aus dem Formular auslesen
    $gast_id = $_POST['gast_id'];
    $ferienhaus_id = $_POST['ferienhaus_id'];
    $ankunft = $_POST['ankunft'];
    $abfahrt = $_POST['abfahrt'];

    // Sicherstellen, dass keine Felder leer sind
    if ($gast_id && $ferienhaus_id && $ankunft && $abfahrt) {
        // SQL-Update vorbereiten
        $stmt = $pdo->prepare("
            UPDATE buchung SET
            gast_id = :gast_id,
            ferienhaus_id = :ferienhaus_id,
            ankunft = :ankunft,
            abfahrt = :abfahrt
            WHERE id = :id
        ");

        // Parameter binden – schützt vor SQL-Injection
        $stmt->bindValue(':gast_id', $gast_id);
        $stmt->bindValue(':ferienhaus_id', $ferienhaus_id);
        $stmt->bindValue(':ankunft', $ankunft);
        $stmt->bindValue(':abfahrt', $abfahrt);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Abfrage ausführen
        $stmt->execute();

        // Weiterleitung zurück zur Übersicht nach erfolgreichem Update
        header('Location: buchung.php?updated=1');
        exit;
    } else {
        // Falls ein Feld leer ist: Fehlermeldung anzeigen
        echo "<p style='color:#e63946; text-align:center;'>Bitte alle Felder ausfüllen!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <!-- Zeichensatz und Skalierung -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buchung bearbeiten</title>

    <!-- Lucide Icons (extern geladen) -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- CSS-Design für das Formular -->
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #ffffff); /* Weicher Farbverlauf */
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 60px auto; /* zentriert */
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* weicher Schatten */
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

        /* Responsive Design für kleine Bildschirme */
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

<!-- Formularcontainer -->
<div class="container">
    <h1><i data-lucide="edit-3" class="icon"></i> Buchung bearbeiten</h1>

    <!-- Formular zum Bearbeiten einer Buchung -->
    <form method="POST">
        <!-- Eingabefeld für Gast-ID -->
        <label><i data-lucide="user" class="icon"></i> Gast-ID:</label>
        <input type="number" name="gast_id" value="<?= htmlspecialchars($buchung['gast_id']) ?>" required>

        <!-- Eingabefeld für Ferienhaus-ID -->
        <label><i data-lucide="home" class="icon"></i> Ferienhaus-ID:</label>
        <input type="number" name="ferienhaus_id" value="<?= htmlspecialchars($buchung['ferienhaus_id']) ?>" required>

        <!-- Eingabefeld für Ankunftsdatum -->
        <label><i data-lucide="calendar-plus" class="icon"></i> Ankunft:</label>
        <input type="date" name="ankunft" value="<?= htmlspecialchars($buchung['ankunft']) ?>" required>

        <!-- Eingabefeld für Abfahrtsdatum -->
        <label><i data-lucide="calendar-minus" class="icon"></i> Abfahrt:</label>
        <input type="date" name="abfahrt" value="<?= htmlspecialchars($buchung['abfahrt']) ?>" required>

        <!-- Absende-Button -->
        <button type="submit"><i data-lucide="save" class="icon"></i> Aktualisieren</button>
    </form>

    <!-- Link zurück zur Übersicht -->
    <a href="buchung.php" class="back-button"><i data-lucide="arrow-left-circle" class="icon"></i> Zurück zur Übersicht</a>
</div>

<!-- Lucide-Icons aktivieren -->
<script>
    lucide.createIcons();
</script>

</body>
</html>
