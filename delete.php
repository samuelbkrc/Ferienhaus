<?php
// ======================================
// PHP-Skript zum Löschen einer Buchung
// ======================================

// Verbindung zur Datenbank herstellen
require dirname(__DIR__) . '/connect/connect.php';

// Prüfen, ob in der URL ein Parameter "deleteID" übergeben wurde (z. B. delete.php?deleteID=5)
if (isset($_GET['deleteID'])) {

    // Die ID aus der URL holen und in eine Ganzzahl umwandeln zur Sicherheit
    $id = (int) $_GET['deleteID'];

    try {
        // SQL-Befehl vorbereiten zum Löschen der Buchung mit der angegebenen ID
        $stmt = $pdo->prepare('DELETE FROM buchung WHERE id = :id');

        // Die ID sicher an die SQL-Anweisung binden (verhindert SQL-Injection)
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // SQL-Befehl ausführen
        $stmt->execute();

        // Nach erfolgreichem Löschen zurück zur Übersicht mit Hinweis „deleted=1“
        header("Location: buchung.php?deleted=1");
        exit;

    } catch (PDOException $e) {
        // Wenn ein Fehler passiert, zeige Fehlermeldung und stoppe das Skript
        die("Fehler beim Löschen: " . $e->getMessage());
    }

} else {
    // Wenn keine ID übergeben wurde, zurück zur Übersicht mit Fehlerhinweis
    header("Location: buchung.php?error=1");
    exit;
}
?>

