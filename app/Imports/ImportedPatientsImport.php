<?php

namespace App\Imports;

use App\Models\Patient;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class ImportedPatientsImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function model(array $row)
    {
        $dateBirth = null;

        if (!empty($row['date_of_birth'])) {
            try {
                $dateBirth = Date::excelToDateTimeObject($row['date_of_birth'])->format('Y-m-d');
            } catch (\Exception $e) {
                $dateBirth = null;
            }
        }

        $registrationDate = now();

        if (!empty($row['registration_date'])) {
            try {
                if (is_numeric($row['registration_date'])) {
                    $registrationDate = Carbon::instance(Date::excelToDateTimeObject($row['registration_date']));
                } else {
                    $registrationDate = Carbon::parse(trim($row['registration_date']));
                }
            } catch (\Exception $e) {
                $registrationDate = now();
            }
        }

        $patient = Patient::create([
            'registration_date' => $registrationDate,

            'name' => $row['name'] ?? '',
            'last_name' => $row['last_name'] ?? '',
            'date_of_birth' => $dateBirth,

            'address' => $row['address'] ?? null,
            'phone' => $row['phone'] ?? null,

            'email' => !empty($row['email']) ? $row['email'] : 'importado_' . uniqid() . '@nursevaleria.com',

            'reason' => $row['reason'] ?? null,
            'symptoms' => $row['symptoms'] ?? null,
            'referral_source' => $row['referral_source'] ?? null,

            'emergency_name' => $row['emergency_name'] ?? null,
            'emergency_relationship' => $row['emergency_relationship'] ?? null,
            'emergency_phone' => $row['emergency_phone'] ?? null,

            'iv_type' => $row['iv_type'] ?? null,

            'pregnant' => strtolower(trim($row['pregnant'] ?? '')) === 'yes',

            'allergy_medicine' => $row['allergy_medicine'] ?? null,

            'reaction' => $row['reaction'] ?? null,

            'vitamins_intolerance' => strtolower(trim($row['vitamins_intolerance'] ?? '')) === 'yes',

            'minerals_intolerance' => strtolower(trim($row['minerals_intolerance'] ?? '')) === 'yes',

            'medications' => $row['medications'] ?? null,

            'supplements' => $row['supplements'] ?? null,

            'consent_accepted' => strtolower(trim($row['consent_accepted'] ?? 'yes')) === 'yes',
        ]);

        $patient->consultations()->create([
            'registration_date' => $registrationDate,

            'name' => $patient->name,
            'last_name' => $patient->last_name,
            'date_of_birth' => $patient->date_of_birth,

            'phone' => $patient->phone,
            'email' => $patient->email,
            'address' => $patient->address,

            'reason' => $patient->reason,
            'symptoms' => $patient->symptoms,
            'referral_source' => $patient->referral_source,

            'emergency_name' => $patient->emergency_name,
            'emergency_relationship' => $patient->emergency_relationship,
            'emergency_phone' => $patient->emergency_phone,

            'iv_type' => $patient->iv_type,

            'pregnant' => $patient->pregnant,

            'allergy_medicine' => $patient->allergy_medicine,

            'reaction' => $patient->reaction,

            'vitamins_intolerance' => $patient->vitamins_intolerance,

            'minerals_intolerance' => $patient->minerals_intolerance,

            'medications' => $patient->medications,

            'supplements' => $patient->supplements,

            'consent_accepted' => $patient->consent_accepted,
        ]);

        return $patient;
    }
}
