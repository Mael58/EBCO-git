<?php
$currentFile = __FILE__;

// Récupère le nom du fichier sans l'extension
$fileNameWithoutExtension = pathinfo($currentFile, PATHINFO_FILENAME);

echo "Le fichier actuel est : $fileNameWithoutExtension";
