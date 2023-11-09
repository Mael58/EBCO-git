<?php
// Chemin du fichier ZIP
$userProfile = getenv('USERPROFILE');

if ($userProfile) {
    $scriptDirectory = __DIR__;
    $Fichierbat = $scriptDirectory . DIRECTORY_SEPARATOR . 'test.bat';


    $downloadsPath = $userProfile . DIRECTORY_SEPARATOR . 'Downloads';
    $zipFilePath = $downloadsPath . DIRECTORY_SEPARATOR . 'backup.zip';
    $sqlFilePath = $downloadsPath . DIRECTORY_SEPARATOR . 'ebcon_crm.sql';

    // Utilisez les chemins générés comme nécessaire

    // ...
} else {
    echo "Impossible d'obtenir le répertoire de l'utilisateur.";
}

if (file_exists($zipFilePath)) {
    $zip = new ZipArchive();

    if ($zip->open($zipFilePath) === true) {
        // Extrait le fichier SQL du ZIP


        if ($zip->extractTo($downloadsPath, 'ebcon_crm.sql')) {
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

$batFilePath = $Fichierbat;
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
