<?php
// Chemin du fichier ZIP
$zipFilePath = 'C:\Users\matze\Downloads\backup_09-11-2023_11-07-48.zip';
$sqlFilePath = 'C:\Users\matze\Downloads\ebcon_crm.sql';

if (file_exists($zipFilePath)) {
    $zip = new ZipArchive();

    if ($zip->open($zipFilePath) === true) {
        // Extrait le fichier SQL du ZIP


        if ($zip->extractTo('C:\Users\matze\Downloads', 'ebcon_crm.sql')) {
            $zip->close();
            echo 'Extrait avec succès.';
        } else {
            echo "Erreur lors de l'ouverture du fichier ZIP.";
        }
    } else {
        echo "Le fichier ZIP n'existe pas.";
    }
}

// $sqlFilePath = "C:/Users/matze/Downloads/backup_08-11-2023_13-38-23.sql";
// //$powershellCommand = "C:/xampp/mysql/bin/mysql -u root test2 < $sqlFilePath";
// $powershellCommand = " Get-Content $sqlFilePath | C:/xampp/mysql/bin/mysql -u root test2";
// echo $powershellCommand;
// $output = shell_exec($powershellCommand);

// if ($output === null) {
//     echo "Erreur lors de l'exécution de la commande PowerShell.";
// } else {
//     echo "Commande MySQL exécutée avec succès.";
// }

$batFilePath = "C:/xampp/htdocs/EBCO-git/controller/test.bat";
$command = exec($batFilePath, $outputArray, $return_var);
$escaped_command = escapeshellcmd($command);

if ($return_var !== 0) {
    echo "Erreur d'exécution du script batch. Code d'erreur : $return_var";
    print_r($outputArray);
} else {
    echo "Script batch exécuté avec succès.";
    print_r($outputArray);
}

sleep(5);

if (unlink($sqlFilePath)) {
    echo "Fichier SQL supprimé avec succès.";
} else {
    echo "Erreur lors de la suppression du fichier SQL.";
}
