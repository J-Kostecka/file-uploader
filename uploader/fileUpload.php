<?php
require_once "db.php";

session_start();

$message = "";
$error = "";
$successCounter = 0;

try {
    if (isset($_FILES['uploadedFile'])) {
        if (!$_FILES['uploadedFile']['name']) {
            throw new Exception("Nebyl nahrán žádný soubor!");
        }
        if ($_FILES['uploadedFile']['type'] !== "application/json") {
            throw new Exception("Špatný formát souboru!");
        }

        $file = json_decode(file_get_contents($_FILES["uploadedFile"]["tmp_name"]), true);

        $values = [];
        foreach ($file as $row) {
            $sql = "INSERT INTO `zaznamy` (`id`, `jmeno`, `prijmeni`, `datum`) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE `jmeno`=VALUES(`jmeno`), `prijmeni`=VALUES(`prijmeni`), `datum`=VALUES(`datum`)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$row["id"], $row["jmeno"], $row["prijmeni"], $row["date"]]);
            $successCounter++;
            $message = "Bylo nahráno $successCounter záznamů z " . sizeof($file);
        }
    }
}
catch (Exception $exception) {
    $error = "Vyskytla se chyba: " . $exception->getMessage();
}

$_SESSION['message'] = $message;
$_SESSION['error'] = $error;
header('Location: ../index.php');

