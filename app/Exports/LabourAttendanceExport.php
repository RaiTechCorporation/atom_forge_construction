<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LabourAttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $attendances;

    public function __construct($attendances)
    {
        $this->attendances = $attendances;
    }

    public function collection()
    {
        return $this->attendances;
    }

    public function headings(): array
    {
        return [
            'Date',
            'Project',
            'Shift',
            'Status',
            'OT Hours',
            'Payment (₹)',
        ];
    }

    public function map($attendance): array
    {
        return [
            $attendance->date,
            $attendance->project->name ?? 'N/A',
            $attendance->shift,
            ucfirst($attendance->status),
            $attendance->overtime_hours,
            $attendance->payment_amount,
        ];
    }
}
