<?php
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="backup_' . strftime("%d-%m-%Y_%H-%M-%S") . '.sql"');

$command = "C:/xampp/mysql/bin/mysqldump -u root ebcon_crm";
$descriptorspec = array(
    0 => array("pipe", "r"),
    1 => array("pipe", "w"),
);
$process = proc_open($command, $descriptorspec, $pipes);

if (is_resource($process)) {
    while (!feof($pipes[1])) {
        echo fread($pipes[1], 8192); // Envoyer la sortie de mysqldump directement à la réponse HTTP
        flush();
    }
    fclose($pipes[1]);
    proc_close($process);
}
