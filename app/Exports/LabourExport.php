<?php

namespace App\Exports;

use App\Models\Labour;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LabourExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Labour::with('project')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Unique ID',
            'Name',
            'Father Name',
            'Phone',
            'Current Address',
            'Permanent Address',
            'City',
            'State',
            'Pincode',
            'Work Type',
            'Shift Type',
            'Start Time',
            'End Time',
            'Break Time',
            'Skill Level',
            'Project',
            'Wage Rate',
            'Wage Type',
            'Overtime Rate',
            'Aadhaar Number',
            'PAN Number',
            'Emergency Contact Name',
            'Emergency Contact Number',
            'Joining Date',
            'Status',
            'Remarks',
        ];
    }

    public function map($labour): array
    {
        return [
            $labour->id,
            $labour->labour_unique_id,
            $labour->name,
            $labour->father_name,
            $labour->phone,
            $labour->current_address,
            $labour->permanent_address,
            $labour->city,
            $labour->state,
            $labour->pincode,
            $labour->work_type,
            $labour->shift_type,
            $labour->start_time,
            $labour->end_time,
            $labour->break_time,
            $labour->skill_level,
            $labour->project->name ?? 'N/A',
            $labour->wage_rate,
            $labour->wage_type,
            $labour->overtime_rate,
            $labour->aadhaar_number,
            $labour->pan_number,
            $labour->emergency_contact_name,
            $labour->emergency_contact_number,
            $labour->joining_date,
            $labour->status,
            $labour->remarks,
        ];
    }
}
