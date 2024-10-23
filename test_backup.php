<?php

include_once 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['backup'])) {
    $projectDir = '\C:\xampp\htdocs\SIS_School';  // Your project directory
    $backupDir = '\C:\xampp\htdocs\SIS_School\Backup';       // Your backup location
    $date = date('Y-m-d');                     // Get the current date
    $backupFile = $backupDir . "/project_backup_$date.zip";  // Backup file name

    // Create a zip of the project files
    $zip = new ZipArchive();
    if ($zip->open($backupFile, ZipArchive::CREATE) === TRUE) {
        $dir = new RecursiveDirectoryIterator($projectDir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($projectDir) + 1);
            $zip->addFile($filePath, $relativePath);
        }

        $zip->close();
        echo "Backup completed! File saved as: $backupFile";
    } else {
        echo 'Failed to create the backup file.';
    }
}
include_once "header.php";
?>


<h1>Backup Your PHP Project</h1>

<!-- Backup Button -->
<form method="POST" action="">
    <button type="submit" name="backup" style="padding: 10px 20px; font-size: 16px;">Backup Now</button>
</form>
<?php include_once "footer.php"; ?>