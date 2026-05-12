<?php

namespace App\Imports;

use App\Models\Labour;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LabourImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $projects;

    public function __construct()
    {
        $this->projects = Project::pluck('id', 'name');
    }

    public function model(array $row)
    {
        $projectId = null;
        if (!empty($row['project'])) {
            $projectId = $this->projects[$row['project']] ?? null;
        }

        return new Labour([
            'name'                     => $row['name'],
            'father_name'              => $row['father_name'] ?? null,
            'phone'                    => $row['phone'] ?? null,
            'current_address'          => $row['current_address'] ?? null,
            'permanent_address'        => $row['permanent_address'] ?? null,
            'city'                     => $row['city'] ?? null,
            'state'                    => $row['state'] ?? null,
            'pincode'                  => $row['pincode'] ?? null,
            'work_type'                => $row['work_type'] ?? null,
            'shift_type'               => $row['shift_type'] ?? null,
            'start_time'               => $row['start_time'] ?? null,
            'end_time'                 => $row['end_time'] ?? null,
            'break_time'               => $row['break_time'] ?? null,
            'skill_level'              => $row['skill_level'] ?? null,
            'project_id'               => $projectId,
            'wage_rate'                => $row['wage_rate'] ?? null,
            'wage_type'                => $row['wage_type'] ?? null,
            'overtime_rate'            => $row['overtime_rate'] ?? null,
            'aadhaar_number'           => $row['aadhaar_number'] ?? null,
            'pan_number'               => $row['pan_number'] ?? null,
            'emergency_contact_name'   => $row['emergency_contact_name'] ?? null,
            'emergency_contact_number' => $row['emergency_contact_number'] ?? null,
            'joining_date'             => $row['joining_date'] ?? null,
            'status'                   => $row['status'] ?? 'Active',
            'remarks'                  => $row['remarks'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            // Add more rules as needed
        ];
    }
}
