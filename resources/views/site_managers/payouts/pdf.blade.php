<!DOCTYPE html>
<html>
<head>
    <title>Payroll Report - {{ $month }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; }
        .company-header { border-bottom: 2px solid #4f46e5; padding-bottom: 10px; margin-bottom: 20px; height: 60px; }
        .company-info { float: left; width: 70%; }
        .company-name { font-size: 16px; font-weight: bold; color: #1e293b; text-transform: uppercase; }
        .company-slogan { font-size: 8px; color: #64748b; font-weight: bold; }
        .logo-container { float: right; width: 30%; text-align: right; }
        .logo { height: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; clear: both; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="company-header">
        <div class="company-info">
            <div class="company-name">Atom Forge Construction</div>
            <div class="company-slogan">Building the Future, Forging Excellence</div>
        </div>
        <div class="logo-container">
            {{-- Logo removed temporarily: Requires PHP GD extension --}}
        </div>
    </div>

    <div class="header">
        <h2>Supervisor Payroll Report</h2>
        <p>Month: {{ $month }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Supervisor</th>
                <th>Project</th>
                <th>Base Salary (&#8377;)</th>
                <th>Deductions (&#8377;)</th>
                <th>Net Payable (&#8377;)</th>
                <th>Paid Amount (&#8377;)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payouts as $payout)
                <tr>
                    <td>{{ $payout->siteManager->name }}</td>
                    <td>{{ $payout->siteManager->project->name ?? 'N/A' }}</td>
                    <td>{{ number_format($payout->base_salary, 2) }}</td>
                    <td>{{ number_format($payout->absence_deduction + $payout->late_arrival_deduction + $payout->penalty_deduction + $payout->advance_salary_recovery, 2) }}</td>
                    <td>{{ number_format($payout->net_amount, 2) }}</td>
                    <td>{{ number_format($payout->paid_amount, 2) }}</td>
                    <td>{{ $payout->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
