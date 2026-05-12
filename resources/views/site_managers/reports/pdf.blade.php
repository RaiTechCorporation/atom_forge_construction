<!DOCTYPE html>
<html>
<head>
    <title>Supervisor Attendance Report</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; }
        .company-header { border-bottom: 2px solid #4f46e5; padding-bottom: 10px; margin-bottom: 20px; height: 60px; }
        .company-info { float: left; width: 70%; }
        .company-name { font-size: 16px; font-weight: bold; color: #1e293b; text-transform: uppercase; }
        .company-slogan { font-size: 8px; color: #64748b; font-weight: bold; }
        .logo-container { float: right; width: 30%; text-align: right; }
        .logo { height: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; clear: both; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .info { margin-bottom: 20px; }
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
        <h2>Supervisor Attendance Report</h2>
        <p>Report Period: {{ $startDate }} to {{ $endDate }}</p>
    </div>

    <div class="info">
        <p><strong>Supervisor Name:</strong> {{ $siteManager->name }}</p>
        <p><strong>Project:</strong> {{ $siteManager->project->name ?? 'N/A' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Project</th>
                <th>Status</th>
                <th>OT Hours</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $record)
                <tr>
                    <td>{{ $record->date }}</td>
                    <td>{{ $record->project->name ?? 'N/A' }}</td>
                    <td>{{ $record->status }}</td>
                    <td>{{ $record->overtime_hours }}</td>
                    <td>{{ $record->remarks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
