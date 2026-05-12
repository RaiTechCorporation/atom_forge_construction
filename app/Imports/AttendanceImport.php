<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class AttendanceImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $constraints;

    public function __construct(array $constraints = [])
    {
        $this->constraints = $constraints;
    }

    public function model(array $row)
    {
        // Handle date format if it's not already a string
        $dateStr = $row['date'];
        if (is_numeric($dateStr)) {
            $dateObj = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateStr);
            $date = $dateObj->format('Y-m-d');
        } else {
            $dateObj = Carbon::parse($dateStr);
            $date = $dateObj->format('Y-m-d');
        }

        // Apply constraints if provided
        if (!empty($this->constraints)) {
            $type = $this->constraints['type'] ?? 'all';
            
            if ($type == 'day' && $date != $this->constraints['date']) {
                return null;
            }
            
            if ($type == 'week') {
                $weekParts = explode('-W', $this->constraints['week']);
                if (count($weekParts) == 2) {
                    $year = $weekParts[0];
                    $week = $weekParts[1];
                    if ($dateObj->format('o') != $year || $dateObj->format('W') != $week) {
                        return null;
                    }
                }
            }
            
            if ($type == 'month') {
                if ($dateObj->format('n') != $this->constraints['month'] || $dateObj->format('Y') != $this->constraints['year']) {
                    return null;
                }
            }
        }

        return Attendance::updateOrCreate(
            [
                'date'       => $date,
                'labour_id'  => $row['labour_id'],
                'project_id' => $row['project_id'],
                'shift'      => $row['shift'] ?? '1st Shift',
            ],
            [
                'status'         => strtolower($row['status'] ?? 'present'),
                'overtime_hours' => $row['overtime_hours'] ?? 0,
                'payment_amount' => $row['payment_amount'] ?? 0,
                'remark'         => $row['remark'] ?? null,
                'recorded_by'    => auth()->id(),
                'recorded_at'    => now(),
            ]
        );
    }

    public function rules(): array
    {
        return [
            'date'       => 'required',
            'labour_id'  => 'required|exists:labour,id',
            'project_id' => 'required|exists:projects,id',
            'status'     => 'required|in:present,absent,half day,leave',
        ];
    }
}
