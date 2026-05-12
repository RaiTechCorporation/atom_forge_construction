<!DOCTYPE html>
<html>
<head>
    <title>Labour Profile - {{ $labour->name }}</title>
    <style>
        @page { margin: 120px 25px 50px 25px; }
        header { position: fixed; top: -100px; left: 0px; right: 0px; height: 80px; text-align: left; border-bottom: 2px solid #4f46e5; padding-bottom: 10px; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #333; }
        .company-info { float: left; width: 70%; }
        .company-name { font-size: 18px; font-weight: bold; color: #1e293b; text-transform: uppercase; margin-bottom: 2px; }
        .company-slogan { font-size: 9px; color: #64748b; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .logo-container { float: right; width: 30%; text-align: right; }
        .logo { height: 50px; }
        .header-content { margin-top: 10px; text-align: center; margin-bottom: 25px; clear: both; }
        .section-title { font-size: 14px; font-weight: bold; color: #4f46e5; margin-top: 25px; margin-bottom: 15px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px; }
        .details-container { background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; margin-bottom: 20px; }
        .details-row { width: 100%; margin-bottom: 10px; }
        .details-col { width: 50%; vertical-align: top; padding: 5px 10px; }
        .detail-item { margin-bottom: 12px; }
        .detail-label { font-size: 9px; font-weight: black; text-transform: uppercase; color: #64748b; margin-bottom: 3px; letter-spacing: 0.5px; }
        .detail-value { font-size: 12px; font-weight: bold; color: #1e293b; }
        .analytics-box { background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .analytics-grid { width: 100%; }
        .analytics-item { text-align: center; width: 33.33%; padding: 10px; }
        .analytics-label { font-size: 10px; text-transform: uppercase; color: #64748b; margin-bottom: 5px; }
        .analytics-value { font-size: 16px; font-weight: bold; color: #1e293b; }
        table.attendance-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.attendance-table th, table.attendance-table td { border: 1px solid #e2e8f0; padding: 8px; text-align: left; }
        table.attendance-table th { background-color: #f1f5f9; color: #475569; font-weight: bold; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 5px; }
    </style>
</head>
<body>
    <header>
        <div class="company-info">
            <div class="company-name">Atom Forge Construction</div>
            <div class="company-slogan">Building the Future, Forging Excellence</div>
            <div style="font-size: 9px; color: #64748b; margin-top: 5px;">
                Worker: {{ $labour->name }} | ID: {{ $labour->labour_unique_id }}
            </div>
        </div>
        <div class="logo-container">
            {{-- Logo removed temporarily: Requires PHP GD extension --}}
        </div>
    </header>

    <div class="header-content">
        <h1 style="margin: 0; color: #1e293b; font-size: 20px;">LABOUR PERFORMANCE ANALYSIS</h1>
        <p style="margin: 5px 0 0 0; color: #64748b; font-weight: bold;">Reporting Period: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
    </div>

    <div class="section-title">Personal Details</div>
    <div class="details-container">
        <table class="details-row">
            <tr>
                <td class="details-col">
                    <div class="detail-item">
                        <div class="detail-label">Worker Name</div>
                        <div class="detail-value">{{ $labour->name }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Labour ID</div>
                        <div class="detail-value" style="color: #4f46e5;">{{ $labour->labour_unique_id }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Father's Name</div>
                        <div class="detail-value">{{ $labour->father_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Aadhaar Number</div>
                        <div class="detail-value">{{ $labour->aadhaar_number ?? 'N/A' }}</div>
                    </div>
                </td>
                <td class="details-col">
                    <div class="detail-item">
                        <div class="detail-label">Phone Number</div>
                        <div class="detail-value">+91 {{ $labour->phone }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Work Type & Skill</div>
                        <div class="detail-value">{{ $labour->work_type }} • {{ $labour->skill_level }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Joining Date</div>
                        <div class="detail-value">{{ $labour->joining_date ? \Carbon\Carbon::parse($labour->joining_date)->format('d M Y') : 'N/A' }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span style="color: {{ $labour->status === 'Active' ? '#10b981' : '#ef4444' }};">
                                {{ $labour->status }}
                            </span>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        
        <div style="padding: 0 10px;">
            <div class="detail-item">
                <div class="detail-label">Current Address</div>
                <div class="detail-value" style="font-weight: normal; line-height: 1.4;">{{ $labour->current_address ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <div class="section-title">Financial Analytics (Filtered Period)</div>
    <div class="analytics-box">
        <table class="analytics-grid">
            <tr>
                <td class="analytics-item">
                    <div class="analytics-label">Total Earned</div>
                    <div class="analytics-value">&#8377;{{ number_format($rangeAnalytics['total_earned'], 2) }}</div>
                </td>
                <td class="analytics-item">
                    <div class="analytics-label">Total Paid</div>
                    <div class="analytics-value" style="color: #10b981;">&#8377;{{ number_format($rangeAnalytics['total_paid'], 2) }}</div>
                </td>
                <td class="analytics-item">
                    <div class="analytics-label">Balance Due</div>
                    <div class="analytics-value" style="color: #ef4444;">&#8377;{{ number_format($rangeAnalytics['balance_due'], 2) }}</div>
                </td>
            </tr>
            <tr>
                <td class="analytics-item">
                    <div class="analytics-label">Attendance</div>
                    <div class="analytics-value">{{ $rangeAnalytics['present_days'] }} Days</div>
                </td>
                <td class="analytics-item">
                    <div class="analytics-label">OT Hours</div>
                    <div class="analytics-value">{{ $rangeAnalytics['total_ot_hours'] }} Hrs</div>
                </td>
                <td class="analytics-item">
                    <div class="analytics-label">Wage Rate</div>
                    <div class="analytics-value">&#8377;{{ number_format($labour->wage_rate, 2) }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-title">Attendance & Payment History</div>
    <table class="attendance-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Project</th>
                <th>Shift</th>
                <th>Status</th>
                <th>OT Hrs</th>
                <th>Payment (&#8377;)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $record)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</td>
                    <td>{{ $record->project->name ?? 'N/A' }}</td>
                    <td>{{ $record->shift }}</td>
                    <td>{{ ucfirst($record->status) }}</td>
                    <td>{{ $record->overtime_hours }}</td>
                    <td>{{ number_format($record->payment_amount, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No records found for this period.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ now()->format('d M Y h:i A') }} | Construction Management System
    </div>
</body>
</html>
