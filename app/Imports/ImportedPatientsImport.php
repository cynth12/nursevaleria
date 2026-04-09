<?php

namespace App\Imports;

use App\Models\ImportedPatient;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class ImportedPatientsImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function model(array $row)
    {
    
        return new ImportedPatient([
            'name' => $row['name'] ?? '',
            'phone' => $row['phone'] ?? '',
            'email' => $row['email'] ?? '',
            'date' => $row['date'] ?? null,
        ]);
    }
}
