<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

class GoogleDriveService
{
    protected Drive $drive;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(Drive::DRIVE);

        $this->drive = new Drive($client);
    }

    public function upload(string $filePath, string $fileName)
    {
        $folderId = '1W0REBHnAK7PEr5W-EcQjp_9f6yhf26td';

        $fileMetadata = new DriveFile([
            'name' => $fileName,
            'parents' => [$folderId],
        ]);

        return $this->drive->files->create($fileMetadata, [
            'data' => file_get_contents($filePath),
            'uploadType' => 'multipart',
        ]);
    }
}
