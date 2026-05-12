<?php

namespace App\Exports;

use App\Models\SiteManager;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiteManagerExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return SiteManager::with(['user', 'project'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Unique ID',
            'Name',
            'Email',
            'Phone',
            'Father Name',
            'Current Address',
            'Permanent Address',
            'City',
            'State',
            'Pincode',
            'Qualification',
            '10th Passing Year',
            '10th Percentage',
            '10th Board',
            '12th Passing Year',
            '12th Percentage',
            '12th Board',
            'Graduation Passing Year',
            'Graduation Percentage',
            'Graduation University',
            'Experience',
            'Project',
            'Salary Amount',
            'Salary Type',
            'Aadhaar Number',
            'PAN Number',
            'Emergency Contact Name',
            'Emergency Contact Number',
            'Joining Date',
            'Status',
            'Remarks',
        ];
    }

    public function map($manager): array
    {
        return [
            $manager->id,
            $manager->manager_unique_id,
            $manager->name,
            $manager->email,
            $manager->phone,
            $manager->father_name,
            $manager->current_address,
            $manager->permanent_address,
            $manager->city,
            $manager->state,
            $manager->pincode,
            $manager->qualification,
            $manager->tenth_passing_year,
            $manager->tenth_percentage,
            $manager->tenth_board,
            $manager->twelfth_passing_year,
            $manager->twelfth_percentage,
            $manager->twelfth_board,
            $manager->graduation_passing_year,
            $manager->graduation_percentage,
            $manager->graduation_university,
            $manager->experience,
            $manager->project->name ?? 'N/A',
            $manager->salary_amount,
            $manager->salary_type,
            $manager->aadhaar_number,
            $manager->pan_number,
            $manager->emergency_contact_name,
            $manager->emergency_contact_number,
            $manager->joining_date,
            $manager->status,
            $manager->remarks,
        ];
    }
}
