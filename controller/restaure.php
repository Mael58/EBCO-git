<?php
// Chemin du fichier ZIP
$zipFilePath = 'C:\Users\matze\Downloads\backup_08-11-2023_11-16-50.zip';




if (file_exists($zipFilePath)) {
    $zip = new ZipArchive();

    if ($zip->open($zipFilePath) === true) {
        // Extrait le fichier SQL du ZIP
        $zip->extractTo('C:\Users\matze\Downloads', 'backup_08-11-2023_11-16-50.sql');
        $zip->close();

        $sqlFilePath = "C:\Users\matze\Downloads\backup_08-11-2023_11-16-50.sql";


        echo 'extrait';
        $mysqlCommand = "Get-Content $sqlFilePath | mysql -u root -p test2";
        exec($mysqlCommand);
    } else {
        echo "Erreur lors de l'ouverture du fichier ZIP.";
    }
} else {
    echo "Le fichier ZIP n'existe pas.";
}


// Supprimez le fichier SQL extrait
// if (unlink("C:\Users\matze\Downloads\backup_08-11-2023_11-16-50.sql")) {
//     echo "Fichier SQL supprimé avec succès.";
// } else {
//     echo "Erreur lors de la suppression du fichier SQL.";
// }
