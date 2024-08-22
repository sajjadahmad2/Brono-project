<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BaserowService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('BASEROW_API_URL', 'https://api.baserow.io/api/'),
            'headers' => [
                'Authorization' => 'Token ' . env('BASEROW_API_TOKEN'),
                'Accept'        => 'application/json',
            ],
        ]);
    }

    public function getTables($databaseId)
    {
        try {
            $endpoint = "database/tables/database/{$databaseId}/";
            $fullUrl = $this->client->getConfig('base_uri') . $endpoint;
            dd($fullUrl);
            $response = $this->client->get("database/fields/tables/{$databaseId}/");
            dd($response);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('An error occurred while retrieving tables for database: ' . $databaseId, ['exception' => $e]);
            return [];
        }
    }

    public function getTableData($tableId)
    {
        try {
            $response = $this->client->get("database/rows/table/{$tableId}/");
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('An error occurred while retrieving table data for table: ' . $tableId, ['exception' => $e]);
            return [];
        }
    }

    // Add more methods as needed for other API endpoints
}
