<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PayrollExport implements FromCollection, WithHeadings, WithMapping
{
    protected $payouts;

    public function __construct($payouts)
    {
        $this->payouts = $payouts;
    }

    public function collection()
    {
        return $this->payouts;
    }

    public function headings(): array
    {
        return [
            'Supervisor Name',
            'Site/Project',
            'Month',
            'Base Salary',
            'Absence Deduction',
            'Late Deduction',
            'Penalty',
            'Advance Recovery',
            'Net Payable',
            'Paid Amount',
            'Status',
        ];
    }

    public function map($payout): array
    {
        return [
            $payout->siteManager->name,
            $payout->siteManager->project->name ?? 'N/A',
            $payout->month,
            $payout->base_salary,
            $payout->absence_deduction,
            $payout->late_arrival_deduction,
            $payout->penalty_deduction,
            $payout->advance_salary_recovery,
            $payout->net_amount,
            $payout->paid_amount,
            $payout->status,
        ];
    }
}
