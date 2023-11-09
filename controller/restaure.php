<?php

$userProfile = getenv('USERPROFILE');

if ($userProfile) {
    $scriptDirectory = __DIR__;
    $Fichierbat = $scriptDirectory . DIRECTORY_SEPARATOR . 'test.bat';

    $downloadsPath = $userProfile . DIRECTORY_SEPARATOR . 'Downloads';

    // Trouver le fichier ZIP le plus récent
    $zipFiles = glob($downloadsPath . DIRECTORY_SEPARATOR . 'backup_*.zip');
    if (!empty($zipFiles)) {
        // Triez les fichiers par date (du plus récent au plus ancien)
        usort($zipFiles, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        // Récupérez le chemin du fichier ZIP le plus récent
        $zipFilePath = $zipFiles[0];

        // Assurez-vous que la date est récupérée correctement
        $today = strftime("%d-%m-%Y_%H-%M-%S");
        $sqlFilePath = $downloadsPath . DIRECTORY_SEPARATOR . 'ebcon_crm.sql';

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
            echo "Le fichier ZIP n'existe pas ou ne peut pas être ouvert.";
        }

        // Restaurez la base de données avec le fichier SQL
        // ...

    } else {
        echo "Aucun fichier ZIP trouvé dans le répertoire de téléchargement.";
    }
} else {
    echo "Impossible d'obtenir le répertoire de l'utilisateur.";
}


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
