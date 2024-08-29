<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contact; // Replace with your actual model name
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportLeads extends Command
{
    protected $signature = 'import:leads {file}';
    protected $description = 'Import leads from a large JSON file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error('File not found.');
            return 1;
        }

        $chunkSize = 1000; // Adjust chunk size as needed
        $chunk = [];
        $file = fopen($filePath, 'r');

        while (($line = fgets($file)) !== false) {
            $chunk[] = json_decode($line, true);

            if (count($chunk) >= $chunkSize) {
                $this->processChunk($chunk);
                $chunk = [];
            }
        }

        if (!empty($chunk)) {
            $this->processChunk($chunk);
        }

        fclose($file);
        $this->info('Import completed.');

        return 0;
    }

    protected function processChunk(array $chunk)
    {
        \Log::info($chunk);
        foreach ($chunk as $lead) {
            // Check if $lead is an array and not null
            if (!is_array($lead) || is_null($lead)) {
                \Log::warning('Skipped processing due to invalid lead format:', ['lead' => $lead]);
             // Skip this iteration if $lead is not a valid array
            }

            $data = [
                'ghl_contact_id' => $lead['id'] ?? null,
                'location_id' => $lead['locationId'] ?? null,
                'name' => trim(($lead['firstName'] ?? '') . ' ' . ($lead['lastName'] ?? '')),
                'email' => $lead['email'] ?? null,
                'phone' => $lead['phone'] ?? null,
                'address' => $lead['address_1'] ?? null,
                'city' => $lead['city'] ?? null,
                'state' => $lead['state'] ?? null,
                'country' => $lead['country'] ?? null,
                'postal_code' => $lead['postalCode'] ?? null,
                'company' => $lead['companyName'] ?? null,
                'website' => $lead['website'] ?? null,
                'source' => $lead['source'] ?? null,
                'type' => $lead['type'] ?? null,
                'assigned_to' => $lead['assignedTo'] ?? null,
                'tags' => $lead['tags'] ?? [],
                'followers' => $lead['followers'] ?? [],
                'additional_emails' => $lead['additionalEmails'] ?? [],
                'attributions' => $lead['attributions'] ?? [],
                'custom_fields' => $lead['customFields'] ?? [],
                'dnd' => $lead['dnd'] ?? false,
                'dnd_settings_email' => $lead['dndSettings']['email'] ?? null,
                'dnd_settings_sms' => $lead['dndSettings']['sms'] ?? null,
                'dnd_settings_call' => $lead['dndSettings']['call'] ?? null,
                'date_added' => isset($lead['dateAdded']) ? Carbon::createFromTimestampMs($lead['dateAdded']) : null,
                'date_updated' => isset($lead['dateUpdated']) ? Carbon::createFromTimestampMs($lead['dateUpdated']) : null,
                'date_of_birth' => isset($lead['dateOfBirth']) ? Carbon::createFromTimestampMs($lead['dateOfBirth']) : null,
                'deleted_at' => $lead['deletedAt'] ?? null,
            ];

            // Use updateOrCreate to update existing or create new records
            Contact::updateOrCreate(
                ['ghl_contact_id' => $data['ghl_contact_id']], // Search criteria
                $data // Data to update or insert
            );
        }
    }

}
