<?php
$userProfile = getenv('USERPROFILE');

if ($userProfile) {
    $downloadsPath = $userProfile . DIRECTORY_SEPARATOR . 'Downloads';
    //$zipFilePath = $downloadsPath . DIRECTORY_SEPARATOR . 'backup.zip';
    $sqlFilePath = $downloadsPath . DIRECTORY_SEPARATOR . 'ebcon_crm.sql';
    $zipFileName = $downloadsPath . DIRECTORY_SEPARATOR . 'backup_' . $today . '.zip';

    putenv("BACKUP_ZIP_PATH=$zipFileName");


    // Utilisez les chemins générés comme nécessaire

    // ...
} else {
    echo "Impossible d'obtenir le répertoire de l'utilisateur.";
}



header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="backup_' . strftime("%d-%m-%Y_%H-%M-%S") . '.zip');

$today = strftime("%d-%m-%Y_%H-%M-%S");


// Vérifiez si le fichier de sauvegarde existe déjà
if (!file_exists($sqlFilePath)) {
    // Commande de sauvegarde (MySQL)
    $command = "C:/xampp/mysql/bin/mysqldump -u root ebcon_crm > $sqlFilePath";
    exec($command);
}

// Envoi du fichier de sauvegarde au navigateur
if (file_exists($sqlFilePath)) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="backup_' . $today . '.zip"');

    $zip = new ZipArchive();
    //$zipFileName = sys_get_temp_dir() . '/backup_' . $today . '.zip';
    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
        $zip->setPassword("123");

        $zip->addFile($sqlFilePath, basename($sqlFilePath));
        // $zip->setEncryptionName(basename($backupFile), ZipArchive::EM_AES_256);

        $zip->close();

        ob_end_clean();
        readfile($zipFileName);
        unlink($zipFileName); // Supprimer le fichier ZIP temporaire après l'envoi
    } else {
        echo "Erreur lors de la création du fichier ZIP.";
    }
} else {
    echo "Erreur lors de la création du fichier de sauvegarde.";
}
