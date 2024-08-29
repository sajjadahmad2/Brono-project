<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $row = array_change_key_case(array_map('trim', array_combine(array_keys($row), array_values($row))), CASE_LOWER);

        return new Contact([
            'ghl_contact_id' => $row[0],
            'name' => trim($row[1] . ' ' . $row[2]),
            'company' => $row[4] ?? null,
            'phone' => $row[5] ?? null,
            'location_id' => '0fu8c2Te17KqLDYyr8RE',
            'email' => $row[6] ?? null,
            'date_added' => $row[7] ?? now(),
            'date_updated' => $row[8] ?? now(),
            'tags' => $row[9] ? explode(', ', $row[9]) : [],
            'additional_emails' => $row[10] ? explode(', ', $row[10]) : [],
            'custom_fields' => [
                'business_name' => $row[3] ?? null,
                'additional_phones' => $row[11] ?? null,
            ],
        ]);
    }

}
