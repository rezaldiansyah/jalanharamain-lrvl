<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BunnyService
{
    private $client;
    private $storageZone;
    private $accessKey;
    private $region;
    private $pullZone;
    private $baseHostname;

    public function __construct()
    {
        $this->client = new Client();
        $this->storageZone = config('services.bunny.storage_zone');
        $this->accessKey = config('services.bunny.access_key');
        $this->region = config('services.bunny.region', '');
        $this->pullZone = config('services.bunny.pull_zone');
        $this->baseHostname = 'storage.bunnycdn.com';
    }

    public function uploadFile($file, $directory = '')
    {
        // Debug all config values
        Log::info('Bunny Config Debug', [
            'storage_zone' => $this->storageZone,
            'pull_zone' => $this->pullZone,
            'access_key_exists' => !empty($this->accessKey),
            'region' => $this->region,
        ]);
        
        // Build hostname based on region (sesuai dokumentasi Bunny.net)
        $hostname = !empty($this->region) ? "{$this->region}.{$this->baseHostname}" : $this->baseHostname;
        
        // Generate unique filename
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $directory . $fileName;
        
        // Build upload URL sesuai dokumentasi: https://storage.bunnycdn.com/{storageZoneName}/{path}/{fileName}
        $uploadUrl = "https://{$hostname}/{$this->storageZone}/{$filePath}";
        
        // Log final URL
        Log::info('Bunny Upload URL', [
            'hostname' => $hostname,
            'upload_url' => $uploadUrl
        ]);
    
        try {
            $response = $this->client->put($uploadUrl, [
                'headers' => [
                    'AccessKey' => $this->accessKey,
                    'Content-Type' => 'application/octet-stream',
                ],
                'body' => fopen($file->getPathname(), 'r')
            ]);
    
            Log::info('Bunny Upload Success', [
                'status' => $response->getStatusCode(),
                'file' => $fileName
            ]);
    
            // Generate Pull Zone URL untuk akses publik
            // Format: https://{pullZoneName}.b-cdn.net/{path}/{fileName}
            $publicUrl = $this->generatePublicUrl($filePath);
            
            Log::info('Generated Public URL', [
                'public_url' => $publicUrl,
                'file_path' => $filePath
            ]);
    
            return [
                'success' => true,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'bunny_url' => $publicUrl,
                'file_size' => $file->getSize()
            ];
            
        } catch (\Exception $e) {
            Log::error('Bunny Upload Error', [
                'message' => $e->getMessage(),
                'url' => $uploadUrl,
                'file' => $fileName
            ]);
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function generatePublicUrl($filePath)
    {
        if (empty($this->pullZone)) {
            Log::error('Pull Zone not configured');
            return null;
        }
        
        // Bersihkan pull zone dari format yang salah
        $cleanPullZone = trim($this->pullZone, ' `');
        $cleanPullZone = str_replace(['https://', 'http://'], '', $cleanPullZone);
        $cleanPullZone = str_replace('.b-cdn.net/', '', $cleanPullZone);
        $cleanPullZone = rtrim($cleanPullZone, '/');
        
        // Bersihkan file path dari karakter tambahan dan encode untuk URL
        $cleanFilePath = trim($filePath);
        $cleanFilePath = str_replace(' ', '%20', $cleanFilePath); // Encode spasi
        
        // Log untuk debugging
        Log::info('Generating public URL', [
            'original_pull_zone' => $this->pullZone,
            'clean_pull_zone' => $cleanPullZone,
            'original_file_path' => $filePath,
            'clean_file_path' => $cleanFilePath
        ]);
        
        // Generate URL yang benar
        $url = "https://{$cleanPullZone}.b-cdn.net/{$cleanFilePath}";
        
        Log::info('Generated URL', ['url' => $url]);
        return $url;
    }

    public function deleteFile($filePath)
    {
        $hostname = !empty($this->region) ? "{$this->region}.{$this->baseHostname}" : $this->baseHostname;
        $url = "https://{$hostname}/{$this->storageZone}/{$filePath}";

        try {
            $response = $this->client->delete($url, [
                'headers' => [
                    'AccessKey' => $this->accessKey,
                ]
            ]);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            Log::error('Bunny Delete Error', $e->getMessage());
            return false;
        }
    }

    // Method untuk test koneksi
    public function testConnection()
    {
        try {
            // Test dengan list files di root storage
            $hostname = !empty($this->region) ? "{$this->region}.{$this->baseHostname}" : $this->baseHostname;
            $url = "https://{$hostname}/{$this->storageZone}/";
            
            $response = $this->client->get($url, [
                'headers' => [
                    'AccessKey' => $this->accessKey,
                ]
            ]);
            
            return [
                'success' => true,
                'status' => $response->getStatusCode(),
                'message' => 'Connection successful'
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Fix corrupted Bunny URL
     */
    public function fixCorruptedUrl($corruptedUrl)
    {
        // Remove backticks and extra spaces
        $cleanUrl = trim($corruptedUrl, ' `');
        
        // Remove duplicate https://
        $cleanUrl = preg_replace('/https:\/\/https:\/\//', 'https://', $cleanUrl);
        
        // Remove double slashes after domain
        $cleanUrl = preg_replace('/\.b-cdn\.net\/\//', '.b-cdn.net/', $cleanUrl);
        
        // Extract filename from corrupted URL
        if (preg_match('/([^\/]+\.pdf)$/', $cleanUrl, $matches)) {
            $fileName = $matches[1];
            
            // Encode spaces in filename
            $fileName = str_replace(' ', '%20', $fileName);
            
            // Rebuild URL with correct format
            $fixedUrl = "https://{$this->pullZone}/{$fileName}";
            
            Log::info('Fixed corrupted URL', [
                'original' => $corruptedUrl,
                'fixed' => $fixedUrl
            ]);
            
            return $fixedUrl;
        }
        
        return null;
    }
}