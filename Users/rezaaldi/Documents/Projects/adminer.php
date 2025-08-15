<?php
// Download Adminer jika belum ada
$adminerFile = __DIR__ . '/adminer-latest.php';

if (!file_exists($adminerFile)) {
    echo "Downloading Adminer...\n";
    $adminerContent = file_get_contents('https://www.adminer.org/latest.php');
    if ($adminerContent !== false) {
        file_put_contents($adminerFile, $adminerContent);
        echo "Adminer downloaded successfully!\n";
    } else {
        die('Failed to download Adminer');
    }
}

// Include Adminer
require_once $adminerFile;
?>
