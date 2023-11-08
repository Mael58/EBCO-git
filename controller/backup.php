<?php
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="backup_' . strftime("%d-%m-%Y_%H-%M-%S") . '.zip');

$today = strftime("%d-%m-%Y_%H-%M-%S");
$backupFile = 'C:/Users/matze/Downloads/backup_' . $today . '.sql';

// Vérifiez si le fichier de sauvegarde existe déjà
if (!file_exists($backupFile)) {
    // Commande de sauvegarde (MySQL)
    $command = "C:/xampp/mysql/bin/mysqldump -u root ebcon_crm > $backupFile";
    exec($command);
}

// Envoi du fichier de sauvegarde au navigateur
if (file_exists($backupFile)) {
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="backup_' . $today . '.zip"');

    $zip = new ZipArchive();
    $zipFileName = sys_get_temp_dir() . '/backup_' . $today . '.zip';
    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
        $zip->setPassword("123");

        $zip->addFile($backupFile, basename($backupFile));
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
