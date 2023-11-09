<?php
$userProfile = getenv('USERPROFILE');

if ($userProfile) {
    $downloadsPath = $userProfile . DIRECTORY_SEPARATOR . 'Downloads';
    $today = strftime("%d-%m-%Y_%H-%M-%S");
    $zipFilePath = $downloadsPath . DIRECTORY_SEPARATOR . 'backup_' . $today . '.zip';
    $sqlFilePath = $downloadsPath . DIRECTORY_SEPARATOR . 'ebcon_crm.sql';

    // Vérifiez si le fichier de sauvegarde existe déjà
    if (!file_exists($sqlFilePath)) {
        // Commande de sauvegarde (MySQL)
        $command = "C:/xampp/mysql/bin/mysqldump -u root ebcon_crm > $sqlFilePath";
        exec($command);
    }

    // Créez le fichier ZIP
    $zip = new ZipArchive();
    if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
        $zip->addFile($sqlFilePath, 'ebcon_crm.sql');
        $zip->close();

        // Envoi du fichier ZIP au navigateur
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="backup_' . $today . '.zip"');
        header('Content-Length: ' . filesize($zipFilePath));

        ob_clean();
        flush();
        readfile($zipFilePath);

        // Supprimez les fichiers temporaires
        unlink($zipFilePath);
        unlink($sqlFilePath);

        exit;
    } else {
        echo "Erreur lors de la création du fichier ZIP.";
    }
} else {
    echo "Impossible d'obtenir le répertoire de l'utilisateur.";
}
