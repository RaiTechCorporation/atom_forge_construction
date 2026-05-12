<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $month;
    protected $year;
    protected $projectId;
    protected $startDate;
    protected $endDate;

    public function __construct($month = null, $year = null, $projectId = null, $startDate = null, $endDate = null)
    {
        $this->month = $month;
        $this->year = $year;
        $this->projectId = $projectId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Attendance::with(['labour', 'project']);

        if ($this->startDate) {
            $query->where('date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->where('date', '<=', $this->endDate);
        }

        if ($this->year) {
            $query->whereYear('date', $this->year);
        }
        
        if ($this->month) {
            $query->whereMonth('date', $this->month);
        }

        if ($this->projectId) {
            $query->where('project_id', $this->projectId);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Labour ID',
            'Labour Name',
            'Project ID',
            'Project Name',
            'Shift',
            'Status',
            'Overtime Hours',
            'Payment Amount',
            'Remark',
        ];
    }

    public function map($attendance): array
    {
        return [
            $attendance->date,
            $attendance->labour_id,
            $attendance->labour->name ?? 'N/A',
            $attendance->project_id,
            $attendance->project->name ?? 'N/A',
            $attendance->shift,
            $attendance->status,
            $attendance->overtime_hours,
            $attendance->payment_amount,
            $attendance->remark,
        ];
    }
}
