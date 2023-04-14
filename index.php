<?php
require_once "uploader/db.php";

session_start();

$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";

session_destroy();
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Data uploader</title>

        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div id="root">
            <div class="form-wrapper">
                <?php if ($message) : ?>
                    <div id="successbox"><?= $message ?></div>
                <?php endif; ?>
                <?php if ($error) : ?>
                    <div id="errorbox"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" action="uploader/fileUpload.php">
                    <h3>Nahrát soubor</h3>
                    <input id="uploadedFile" name="uploadedFile" type="file" accept="application/JSON">
                    <br>
                    <input type="submit">
                </form>
            </div>
            <div class="data-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th><th>Jméno</th><th>Příjmení</th><th>Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $zaznamy = $conn->query("SELECT * FROM `zaznamy` ORDER BY `datum`;")->fetchAll();

                        if (empty($zaznamy)) {
                            echo "<tr><td colspan='4' style='text-align: center'>Nebyly zatím nahrány žádné záznamy.</td></tr>";
                        }
                        else {
                            foreach ($zaznamy as $zaznam) {
                                echo "
                                <tr>
                                    <td>{$zaznam['id']}</td>
                                    <td>{$zaznam['jmeno']}</td>
                                    <td>{$zaznam['prijmeni']}</td>
                                    <td>{$zaznam['datum']}</td>
                                </tr>
                                ";
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

    <script src="js/index.js"></script>
    </body>
</html>