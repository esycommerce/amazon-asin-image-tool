<?php

function getOccurrence($start, $end, $string){
    $matches = null;
    $delimiter = '#';
    $regex = $delimiter . preg_quote($start, $delimiter) 
                        . '(.*?)' 
                        . preg_quote($end, $delimiter) 
                        . $delimiter 
                        . 's';
    preg_match($regex,$string,$matches);
    return $matches[1];
}

function zipFolder($name, $output){
    // Get real path for our folder
    $rootPath = realpath($name);

    // Initialize archive object
    $zip = new ZipArchive();
    $zip->open($output, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Create recursive directory iterator
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file)
    {
        // Skip directories (they would be added automatically)
        if (!$file->isDir())
        {
            // Get real and relative path for current file
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            // Add current file to archive
            $zip->addFile($filePath, $relativePath);
        }
    }

    // Zip archive will be created only after closing object
    $zip->close();
}

function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        return;
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}